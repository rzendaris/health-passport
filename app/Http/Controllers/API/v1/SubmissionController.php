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
        $submission = Submission::where('user_id', $request->user_id)->get();
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
            return $this->appResponse(100, 200, $submission);
        }
    }

    public function createSubmission(Request $request)
    {
        $request->validate([
            'test_type' => 'required|string',
            'test_location' => 'required|string',
            'city' => 'required|string',
            'date' => 'required|date'
        ]);

        $submission = new Submission([
            'user_id' => $request->user_id,
            'test_type' => $request->test_type,
            'test_location' => $request->test_location,
            'city' => $request->city,
            'date' => $request->date,
            'identifier_id' => Str::uuid()
        ]);
        $submission->save();
        QrCode::format('png')->size(250)->generate((string)$submission->identifier_id, $this->MapPublicPath().'qr-code/'.$submission->id.'.png');

        $submission->qr_code = 'qr-code/'.$submission->id.'.png';
        return $this->appResponse(100, 200, $submission);
    }

    private function compileQrCode($submissions){
        foreach($submissions as $submission){
            $submission->qr_code = 'qr-code/'.$submission->id.'.png';
        }

        return $submissions;
    }
}