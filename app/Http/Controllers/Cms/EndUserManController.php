<?php

namespace App\Http\Controllers\Cms;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Model\Table\MstCountry;
use App\Model\Table\Ratings;
use App\Model\Table\MstCategory;
use App\Model\Table\Apps;

class EndUserManController extends Controller
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

    public function EndUserMgmtInit(Request $request)
    {
        $paginate = 15;
        if (isset($request->query()['search'])){
            $search = $request->query()['search'];
            $user = User::with(['countrys'])->where('name', 'like', "%" . $search. "%")->where('role_id', 3)->orderBy('name', 'asc')->simplePaginate($paginate);
            $user->appends(['search' => $search]);
        } else {
            $user = User::with(['countrys'])->where('role_id', 3)->orderBy('name', 'asc')->simplePaginate($paginate);
        }
        // $user = User::with(['countrys'])->where('role_id', 3)->get();
        $country = MstCountry::get();
        $no = 1;
        foreach($user as $data){
            $data->no = $no;
            $no++;
        }
        $data = array(
            'user' => $user,
            'country' => $country
        );
        return view('end-user-management/index')->with('data', $data);
    }
    public function UserMgmtAddEndUser()
    {
        return view('end-user-management/add');
    }
    public function UserMgmtEditEndUser($id)
    {
        $user = User::where('id', $id)->first();
        return view('end-user-management/edit')->with('data', $user);
    }
    public function UserMgmtDetailEndUser($id,Request $request)
    {
        $paginate = 15;
        if (isset($request->query()['search'])){
            $search = $request->query()['search'];
            $ratings = Ratings::with(['apps'])->where('comment', 'like', "%" . $search. "%")->where('end_users_id',$id)->orderBy('comment_at', 'asc')->simplePaginate($paginate);
            $ratings->appends(['search' => $search]);
        } else {
            $ratings = Ratings::with(['apps'])->where('end_users_id',$id)->orderBy('comment_at', 'asc')->simplePaginate($paginate);
        }
        $user = User::where('id', $id)->first();
        $no = 1;
        foreach($ratings as $data){
            $data->no = $no;
            $no++;
        }
        $data = array(
            'id'=>$id,
            'user' => $user,
            'ratings' => $ratings
        );
        return view('end-user-management/detail')->with('data', $data);
    }
    public function UserMgmtInsert(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($request->password != $request->re_password) {
          return redirect()->back()->with('err_message', 'Re-Type Password Not Match!');
        }else{
          if(empty($user)){
              if($request->photo){
                  $file_extention = $request->photo->getClientOriginalExtension();
                  $file_name = $request->email.'image_profile.'.$file_extention;
                  $file_path = $request->photo->move($this->MapPublicPath().'pictures',$file_name);
              }
              User::create([
                  'name' => $request->full_name,
                  'email' => $request->email,
                  'eu_birthday' => $request->eu_birthday,
                  'role_id' => 3,
                  'is_blocked' => 1,
                  'picture' => $file_name,
                  'email_verified_at' => date('Y-m-d H:i:s'),
                  'password' => Hash::make($request->password),
                  // 'token' => Str::random(60),
              ]);
              return redirect('end-user-management')->with('suc_message', 'Data baru berhasil ditambahkan!');
          } else {
              return redirect()->back()->with('err_message', 'Email telah digunakan! Gunakan alamat email yang belum terdaftar!');
          }
        }
    }

    public function UserMgmtUpdate(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $email = User::where('email', $request->email)->first();
        if ($user->email == $request->email or empty($email)) {
          if($request->photo){
              $file_extention = $request->photo->getClientOriginalExtension();
              $file_name = $request->email.'image_profile.'.$file_extention;
              $file_path = $request->photo->move($this->MapPublicPath().'pictures',$file_name);
          }else{
            $file_name=$user->picture;
          }
            User::where('id', $request->id)
              ->update([
                  'name' => $request->full_name,
                  'picture' => $file_name,
                  'email' => $request->email
                  ]
                );
            if(!empty($request->password)){
                User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
            }
            return redirect('end-user-management')->with('suc_message', 'Data telah diperbarui!');
        }else if(!empty($email)){
            return redirect()->back()->with('err_message', 'Email telah digunakan! Gunakan alamat email yang belum terdaftar!');
        }else {
            return redirect()->back()->with('err_message', 'Data tidak ditemukan!');
        }
    }


}
