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

class SpreadZoneController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'long' => 'required'
        ]);
        $spreadzones = DB::table('spreadzone')
            ->select(DB::raw("
                id, name, latitude, longitude, radius,
                ( 6371 * acos( cos( radians(latitude) ) * cos( radians( $request->lat ) ) * cos( radians( $request->long ) - radians(longitude) ) + sin( radians(latitude) ) * sin( radians( $request->lat ) ) ) ) AS distance
            "))
            ->get();
        
        $spreadzone_filter = array();
        foreach($spreadzones as $spreadzone){
            if($spreadzone->distance < 10){
                array_push($spreadzone_filter, $spreadzone);
            }
        }
        return $this->appResponse(100, 200, $spreadzone_filter);
    }

    public function spreadZoneInfraInfo(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'long' => 'required'
        ]);
        $spreadzones = DB::table('mst_data')
            ->select(DB::raw("
                id, name, latitude, longitude,
                ( 6371 * acos( cos( radians(latitude) ) * cos( radians( $request->lat ) ) * cos( radians( $request->long ) - radians(longitude) ) + sin( radians(latitude) ) * sin( radians( $request->lat ) ) ) ) AS distance
            "))
            ->get();
        
        $spreadzone_filter = array();
        foreach($spreadzones as $spreadzone){
            if($spreadzone->distance < 10){
                array_push($spreadzone_filter, $spreadzone);
            }
        }
        return $this->appResponse(100, 200, $spreadzone_filter);
    }
}