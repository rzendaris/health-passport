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

use App\User;
use App\Model\Table\MstCategories;
use App\Model\Table\MstData;
use App\Model\Table\SpreadZone;
use App\Model\Table\InfraCertificate;

class SpreadZoneController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'long' => 'required'
        ]);
        $spreadzones = DB::select('CALL GetSpreadZone("'.$request->lat.'","'.$request->long.'")');
        
        $spreadzone_filter = array();
        foreach($spreadzones as $spreadzone){
            // if($spreadzone->distance < 10){
            //     array_push($spreadzone_filter, $spreadzone);
            // }
            array_push($spreadzone_filter, $spreadzone);
        }
        return $this->appResponse(100, 200, $spreadzone_filter);
    }

    public function spreadZoneInfraInfo(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'long' => 'required'
        ]);
        $spreadzones = DB::select('CALL GetInfraByZone("'.$request->lat.'","'.$request->long.'","'.$request->search.'")');
        
        $spreadzone_filter = array();
        foreach($spreadzones as $spreadzone){
            $category = MstCategories::select('name')->where('id', $spreadzone->category_id)->first();
            if($category){
                $spreadzone->category_name = $category->name;
            } else {
                $spreadzone->category_name = "";
            }
            // if($spreadzone->distance < 10){
            //     array_push($spreadzone_filter, $spreadzone);
            // }
            $spreadzone->spreadzone_status = 'GREEN_ZONE';
            $spreadzone->images = json_decode($spreadzone->images);
            $spreadzone->certificates = InfraCertificate::where('infra_id', $spreadzone->id)->get();
            
            $spreadzones_infra = DB::select('CALL GetSpreadZone("'.$spreadzone->latitude.'","'.$spreadzone->longitude.'")');
            foreach($spreadzones_infra as $spreadzone_infra){
                if($spreadzone_infra->radius > $spreadzone_infra->distance){
                    $spreadzone->spreadzone_status = 'RED_ZONE';
                }
            }
            array_push($spreadzone_filter, $spreadzone);
        }
        return $this->appResponse(100, 200, $spreadzone_filter);
    }

    public function userSpreadzone(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'long' => 'required'
        ]);
        $spreadzones = DB::select('CALL GetSpreadZone("'.$request->lat.'","'.$request->long.'")');
        
        $spreadzone_filter = array();
        foreach($spreadzones as $spreadzone){
            if($spreadzone->distance <= $spreadzone->radius){
                array_push($spreadzone_filter, $spreadzone);
            }
        }
        $return = NULL;
        $return_response = FALSE;
        if(isset($spreadzone_filter[0])){
            $return_response = TRUE;
            $user_info = User::where('id', $request->user_id)->first();
            if($user_info->notification_id != NULL){
                $title = "Pemberitahuan!";
                $body = "Anda memasuki zona rawan Covid-19, jagalah protokol kesehatan!";
                $controller = new Controller;
                $return = $controller->PushNotification($user_info->notification_id, $title, $body);
            }
        }
        return $this->appResponse(200, 200, $return_response);
    }
}