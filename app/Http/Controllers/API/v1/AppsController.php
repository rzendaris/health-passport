<?php
namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use ApkParser\Parser;
use DB;

use App\User;
use App\Model\Table\MstCategories;
use App\Model\Table\MstData;
use App\Model\Table\InfraCertificate;

class AppsController extends Controller
{
    public function GetAppsCategory(Request $request)
    {
        $apps_category = MstCategories::get();
        foreach($apps_category as $app_category){
            $app_category->icon = "icon_category/".$app_category->icon;
        }
        return $this->appResponse(100, 200, $apps_category);
    }

    public function GetInfraList(Request $request)
    {
        // $mst_data = MstData::where('status', 1);
        $request->validate([
            'lat' => 'required',
            'long' => 'required'
        ]);
        $mst_data = DB::select('CALL GetInfraByZone("'.$request->lat.'","'.$request->long.'","'.$request->search.'")');
        $responses = $mst_data;
        foreach($responses as $response){
            $category = MstCategories::select('name')->where('id', $response->id)->first();
            $response->category_name = $category->name;
        }
        return $this->appResponse(100, 200, $responses);
    }

    public function GetInfraListById($infra_id, Request $request)
    {
        // $mst_data = MstData::where('status', 1);
        $request->validate([
            'lat' => 'required',
            'long' => 'required'
        ]);
        $mst_data = DB::select('CALL GetInfraByZone("'.$request->lat.'","'.$request->long.'","'.$request->search.'")');
        $return_response = array();
        foreach($mst_data as $response){
            if($response->id == $infra_id){
                $category = MstCategories::select('name')->where('id', $response->id)->first();
                $response->category_name = $category->name;
                array_push($return_response, $response);
            }
        }
        if(empty($return_response)){
            return $this->appResponse(104, 200);
        } else {
            return $this->appResponse(100, 200, $return_response[0]);
        }
    }

    public function GetInfraListRecommendation(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'long' => 'required'
        ]);
        $certificates = InfraCertificate::select('infra_id', DB::raw('count(*) as total'))
                        ->groupBy('infra_id')
                        ->get();
        $infra_id = array();
        foreach($certificates as $certificate){
            array_push($infra_id, $certificate->infra_id);
        }
        $temp_data = array();
        $mst_data = DB::select('CALL GetInfraByZone("'.$request->lat.'","'.$request->long.'","'.$request->search.'")');
        $responses = $mst_data;
        foreach($responses as $response){
            $category = MstCategories::select('name')->where('id', $response->id)->first();
            foreach($certificates as $certificate){
                if($response->id == $certificate->infra_id){
                    $response->total_certificate = $certificate->total;
                    $response->category_name = $category->name;
                    array_push($temp_data, $response);
                }
            }
        }
        
        usort($temp_data, $this->arrSortObjsByKey('total_certificate'));
        return $this->appResponse(100, 200, $temp_data);
    }

    public function GetListByCategoryId($category_id, Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'long' => 'required'
        ]);
        $certificates = InfraCertificate::select('infra_id', DB::raw('count(*) as total'))
                        ->groupBy('infra_id')
                        ->get();
        $infra_id = array();
        foreach($certificates as $certificate){
            array_push($infra_id, $certificate->infra_id);
        }
        $temp_data = array();
        $mst_data = DB::select('CALL GetInfraByZone("'.$request->lat.'","'.$request->long.'","'.$request->search.'")');
        $responses = $mst_data;
        foreach($responses as $response){
            if((int)$response->category_id == $category_id){
                $category = MstCategories::select('name')->where('id', $response->category_id)->first();
                foreach($certificates as $certificate){
                    if($response->id == $certificate->infra_id){
                        $response->total_certificate = $certificate->total;
                        $response->category_name = $category->name;
                        array_push($temp_data, $response);
                    }
                }
            }
        }
        if (isset($request->sort_by)){

            if($request->sort_by == 'REKOMENDASI'){
                usort($temp_data, $this->arrSortObjsByKey('total_certificate'));
            }
            if($request->sort_by == 'TERDEKAT'){
                usort($temp_data, $this->arrSortObjsByKey('distance', 'ASC'));
            }
        }
        return $this->appResponse(100, 200, $temp_data);
    }

    protected function searchEngine($request){
        $apps = AvgRatings::where('is_active', 1)->where('is_approve', 1);
        if (isset($request->category_id)){
            $apps = $apps->where('category_id', $request->category_id);
        }
        if (isset($request->type_apps)){
            $apps = $apps->where('type', $request->type_apps);
        }
        if (isset($request->search)){
            $apps = $apps->where('name', 'LIKE', "%{$request->search}%");
        }
        if (isset($request->sort_by)){
            if($request->sort_by == 'POPULER'){
                $apps = $apps->orderBy('avg_ratings', 'desc');
            }
            if($request->sort_by == 'TERLARIS'){
                $apps = $apps->orderBy('download_counter', 'desc');
            }
        }

        $return = $apps->get();
        return $return;
    }

    private function arrSortObjsByKey($key, $order = 'DESC') {
        return function($a, $b) use ($key, $order) {
    
            // Swap order if necessary
            if ($order == 'DESC') {
                    list($a, $b) = array($b, $a);
             } 
    
             // Check data type
             if (is_numeric($a->$key)) {
                 return $a->$key - $b->$key; // compare numeric
             } else {
                 return strnatcasecmp($a->$key, $b->$key); // compare string
             }
        };
    }
}