<?php
namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use ApkParser\Parser;
use DB;
use Validator;
use Illuminate\Support\Str;
use QrCode;
use File;

use App\User;
use App\Model\Table\Submission;

class SubmissionController extends Controller
{

    public function index(Request $request){
        $submission = Submission::where('user_id', $request->user_id)->orderBy('id', 'desc')->get();
        return $this->appResponse(100, 200, $this->compileQrCode($submission));
    }

    public function scanSubmission(Request $request){
        $request->validate([
            'uuid' => 'required|string'
        ]);
        $submission = Submission::where('identifier_id', $request->uuid)->first();
        if(empty($submission)){
            return $this->appResponse(104, 200);
        } else {
            $submission->qr_code = 'qr-code/'.$submission->id.'.png';
            $submission->document = 'document/'.$submission->document;
            $submission->user = User::select('name', 'picture', 'gender', 'nik', 'birthday', 'phone_number')->where('id', $submission->user_id)->first();
            $submission->user->age = $this->get_age($submission->user->birthday);
            $dt = Carbon::now();
            $submission->is_expired = FALSE;
            if(strtotime($submission->exp_date) < strtotime($dt->toDateString())){
                $submission->is_expired = TRUE;
            }
            return $this->appResponse(100, 200, $submission);
        }
    }

    public function createSubmission(Request $request)
    {
        $request->validate([
            'test_type' => 'required|string',
            'test_location' => 'required|string',
            'city' => 'required|string',
            'date' => 'required|date',
            'document' => 'required|mimes:jpeg,jpg,png|max:10000',
        ]);

        $submission = new Submission([
            'user_id' => $request->user_id,
            'test_type' => $request->test_type,
            'test_location' => $request->test_location,
            'city' => $request->city,
            'date' => $request->date,
            'identifier_id' => Str::uuid(),
            'status' => 'Not Verified',
            'exp_date' => Carbon::createFromFormat('Y-m-d', $request->date)->addDays(14)
        ]);
        $submission->save();

        $file_name = "Document doesn't exist";
        if($request->document){
            $file_extention = $request->document->getClientOriginalExtension();
            $file_name = $submission->id.'-document.'.$file_extention;
            $file_path = $request->document->move($this->MapPublicPath().'document',$file_name);
            Submission::where('id', $submission->id)->update([
                'document' => $file_name
            ]);
        }
        QrCode::format('png')->size(250)->generate((string)$submission->identifier_id, $this->MapPublicPath().'qr-code/'.$submission->id.'.png');

        $submission_return = Submission::where('id', $submission->id)->first();
        $submission_return->qr_code = 'qr-code/'.$submission_return->id.'.png';
        $submission_return->document = 'document/'.$submission_return->document;
        return $this->appResponse(100, 200, $submission_return);
    }

    private function compileQrCode($submissions){
        foreach($submissions as $submission){
            $submission->qr_code = 'qr-code/'.$submission->id.'.png';
            $submission->document = 'document/'.$submission->document;
            $submission->user = User::select('name', 'picture', 'gender', 'nik', 'birthday', 'phone_number')->where('id', $submission->user_id)->first();
            $submission->user->age = $this->get_age($submission->user->birthday);
            $dt = Carbon::now();
            $submission->is_expired = FALSE;
            if(strtotime($submission->exp_date) < strtotime($dt->toDateString())){
                $submission->is_expired = TRUE;
            }
        }

        return $submissions;
    }

    private function get_age($date, $units='years')
    {
        $modifier = date('n') - date('n', strtotime($date)) ? 1 : (date('j') - date('j', strtotime($date)) ? 1 : 0);
        $seconds = (time()-strtotime($date));
        $years = (date('Y')-date('Y', strtotime($date))-$modifier);
        switch($units)
        {
            case 'seconds':
                return $seconds;
            case 'minutes':
                return round($seconds/60);
            case 'hours':
                return round($seconds/60/60);
            case 'days':
                return round($seconds/60/60/24);
            case 'months':
                return ($years*12+date('n'));
            case 'decades':
                return ($years/10);
            case 'centuries':
                return ($years/100);
            case 'years':
            default:
                return $years;
        }
    }
}