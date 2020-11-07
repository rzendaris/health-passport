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
        $mst_data = MstData::where('status', 1);
        if (isset($request->search)){
            $mst_data = $mst_data->where('name', 'LIKE', "%{$request->search}%");
        }
        $responses = $mst_data->get();
        foreach($responses as $response){
            $category = MstCategories::select('name')->where('id', $response->id)->first();
            $response->category_name = $category->name;
        }
        return $this->appResponse(100, 200, $responses);
    }

    public function GetInfraListRecommendation(Request $request)
    {
        $certificates = InfraCertificate::select('infra_id', DB::raw('count(*) as total'))
                        ->groupBy('infra_id')
                        ->get();
        $infra_id = array();
        foreach($certificates as $certificate){
            array_push($infra_id, $certificate->infra_id);
        }
        $mst_data = MstData::whereIn('id', $infra_id)->where('status', 1);
        if (isset($request->search)){
            $mst_data = $mst_data->where('name', 'LIKE', "%{$request->search}%");
        }
        $responses = $mst_data->get();
        foreach($responses as $response){
            $category = MstCategories::select('name')->where('id', $response->id)->first();
            foreach($certificates as $certificate){
                if($response->id == $certificate->infra_id){
                    $response->total_certificate = $certificate->total;
                }
            }
            $response->category_name = $category->name;
        }
        return $this->appResponse(100, 200, $responses->sortBy('total_certificate', SORT_REGULAR, true));
    }

    public function GetListByCategoryId($category_id, Request $request)
    {
        $mst_data = MstData::where('category_id', $category_id)->where('status', 1);
        if (isset($request->search)){
            $mst_data = $mst_data->where('name', 'LIKE', "%{$request->search}%");
        }
        $responses = $mst_data->get();
        foreach($responses as $response){
            $category = MstCategories::select('name')->where('id', $response->id)->first();
            $response->category_name = $category->name;
        }
        return $this->appResponse(100, 200, $responses);
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
}