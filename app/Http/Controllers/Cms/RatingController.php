<?php

namespace App\Http\Controllers\Cms;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Model\Table\Ratings;
use App\Model\Table\Apps;

class RatingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     if (Auth::user()->role_id != 1){
        //         return redirect('/')->with('access_message', 'Akses untuk Menu User Management Ditolak!');
        //     }
        //     return $next($request);
        // });

    }

    public function RatingInit($id,Request $request)
    {
        $paginate = 15;
        if (isset($request->query()['search'], $request->query()['ratings'])){ // filter search and ratings
            $search = $request->query()['search'];
            $rate = $request->query()['ratings'];
            $ratings = Ratings::join('users','ratings.end_users_id','users.id')->where('users.email', 'like', "%" . $search. "%")->where('ratings',$rate)->orderBy('comment_at', 'asc')->simplePaginate($paginate);
            $ratings->appends(['search' => $search]);
        }else if (isset($request->query()['search'])){
            $search = $request->query()['search'];
            $ratings = Ratings::join('users','ratings.end_users_id','users.id')->where('users.email', 'like', "%" . $search. "%")->where('apps_id',$id)->orderBy('comment_at', 'asc')->simplePaginate($paginate);
            $ratings->appends(['search' => $search]);
        }else if (isset($request->query()['ratings'])){ // filter ratings
            $rate = $request->query()['ratings'];
            $ratings = Ratings::join('users','ratings.end_users_id','users.id')->where('ratings',$rate)->orderBy('comment_at', 'asc')->simplePaginate($paginate);
        }else {
          $ratings = Ratings::join('users','ratings.end_users_id','users.id')->where('apps_id',$id)->orderBy('comment_at', 'asc')->simplePaginate($paginate);
        }
        $ratingsall = Ratings::with(['endusers','apps'])->get();
        $avgrating = Ratings::where('apps_id',$id)->avg('ratings');
        $apps = Apps::with(['categories','ratings'])->where('id', $id)->first();
        $no = 1;
        foreach($ratings as $data){
            $data->no = $no;
            $no++;
        }
        $data = array(
            'id' => $id,
            'ratings' => $ratings,
            'avgrating' => $avgrating,
            'ratingsall' => $ratingsall,
            'apps'=> $apps,
        );
        return view('apps-management/reviewinfo')->with('data', $data);
    }

}
