<?php

namespace App\Http\Controllers\Cms;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Model\Table\MstCountry;

class UserManController extends Controller
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

    public function UserMgmtInit(Request $request)
    {
        $paginate = 15;
        if (isset($request->query()['search'])){
            $search = $request->query()['search'];
            $user = User::with(['countrys'])->where('name', 'like', "%" . $search. "%")->where('role_id', 1)->orderBy('name', 'asc')->simplePaginate($paginate);
            $user->appends(['search' => $search]);
        } else {
            $user = User::with(['countrys'])->where('role_id', 1)->orderBy('name', 'asc')->simplePaginate($paginate);
        }
        // $user = User::with(['countrys'])->where('role_id', 1)->get();
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
        return view('user-management/index')->with('data', $data);
    }
    public function UserMgmtProfile()
    {
        $country = MstCountry::get();
        $user = User::where('id', Auth::user()->id)->first();

        $data = array(
            'user' => $user,
            'country' => $country
        );
        return view('auth/profile')->with($data);
    }
    public function UserMgmtProfileAdmin()
    {
        $country = MstCountry::get();
        $user = User::where('id', Auth::user()->id)->first();

        $data = array(
            'user' => $user,
            'country' => $country
        );
        return view('auth/profile-admin')->with($data);
    }
    public function UserMgmtProfilePassword()
    {
        return view('auth/profile-password');
    }
    public function UserMgmtInsert(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($request->password != $request->re_password) {
          return redirect()->back()->with('err_message', 'Re-Type Password Not Match!');
        }else{
          if(empty($user)){
              User::create([
                  'name' => $request->full_name,
                  'email' => $request->email,
                  'role_id' => 1,
                  'is_blocked' => 1,
                  'email_verified_at' => date('Y-m-d H:i:s'),
                  'password' => Hash::make($request->password),
                  // 'token' => Str::random(60),
              ]);
              return redirect('user-management')->with('suc_message', 'Data baru berhasil ditambahkan!');
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

            User::where('id', $request->id)
              ->update([
                  'name' => $request->full_name,
                  'email' => $request->email
                  ]
                );
            if(!empty($request->password)){
                User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
            }
            return redirect('user-management')->with('suc_message', 'Data telah diperbarui!');
        }else if(!empty($email)){
            return redirect()->back()->with('err_message', 'Email telah digunakan! Gunakan alamat email yang belum terdaftar!');
        }else {
            return redirect()->back()->with('err_message', 'Data tidak ditemukan!');
        }
    }
    public function UserMgmtUpdateProfile(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if(!empty($user)){
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
                  'dev_web' => $request->website,
                  'dev_country_id' => $request->country,
                  'dev_address' => $request->address,
                  'picture' => $file_name,
                  'email' => $request->email
                  ]
                );
            if(!empty($request->password)){
                User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
            }
            return redirect()->back()->with('suc_message', 'Data telah diperbarui!');
        } else {
            return redirect()->back()->with('err_message', 'Data tidak ditemukan!');
        }
    }
    public function UserMgmtResetPass(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if(!empty($user)){
            User::where('id', $request->id)
              ->update([
                    'password' => Hash::make($request->password),
                  ]
                );
            if(!empty($request->password)){
                User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
            }
            return redirect()->back()->with('suc_message', 'Data telah diperbarui!');
        } else {
            return redirect()->back()->with('err_message', 'Data tidak ditemukan!');
        }
    }
    public function UserMgmtChangePass(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        if ($request->new_password != $request->re_password) {
          return redirect()->back()->with('err_message', 'Re-Type Password Not Match!');
        }else{
          if(!empty($user)){
              if(Hash::check($request->old_password, $user->password)){
              User::where('id', Auth::user()->id)
                ->update([
                      'password' => Hash::make($request->new_password),
                    ]
                  );
              }else {
                  return redirect()->back()->with('err_message', 'Old Password Not Match!');
              }
              if(!empty($request->new_password)){
                  User::where('id', $request->id)->update(['password' => Hash::make($request->new_password)]);
              }
              return redirect()->back()->with('suc_message', 'Data telah diperbarui!');
          } else {
              return redirect()->back()->with('err_message', 'Data tidak ditemukan!');
          }
        }
    }
    public function UserMgmtDelete(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if(!empty($user)){
            User::where('id', $request->id)->delete();
            return redirect()->back()->with('suc_message', 'Data telah dihapus!');
        } else {
            return redirect()->back()->with('err_message', 'Data tidak ditemukan!');
        }
    }
    public function UserMgmtBlock(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if(!empty($user)){
            User::where('id', $request->id)
              ->update([
                    'is_blocked' => 0,
                  ]
                );
            if(!empty($request->password)){
                User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
            }
            return redirect()->back()->with('suc_message', 'Data telah diblock!');
        } else {
            return redirect()->back()->with('err_message', 'Data tidak ditemukan!');
        }
    }
    public function UserMgmtUnBlock(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if(!empty($user)){
            User::where('id', $request->id)
              ->update([
                    'is_blocked' => 1,
                  ]
                );
            if(!empty($request->password)){
                User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
            }
            return redirect()->back()->with('suc_message', 'Data telah diunblock!');
        } else {
            return redirect()->back()->with('err_message', 'Data tidak ditemukan!');
        }
    }
    public function RegisterUser(Request $request)
    {
      $files = $request->file('picture');
        // $fileName =  $data['email'].".".$files->getClientOriginalExtension();
      // $request->validate([
      //     'picture' => 'required|mimes:jpg,jpeg,png|max:2048',
      // ]);
       // $request->file('picture')->move($this->MapPublicPath('pictures'), $fileName);
       echo $request->picture;
       echo $request->name.$files;
       $files = $request->file('picture');
       $request->validate([
           'picture' => 'required|mimes:pdf,xlx,csv,zip|max:2048',
       ]);
       $fileName = $files->getClientOriginalName();  // '.'.$request->foto->extension();

       $request->foto->move(public_path('uploads'), $fileName);
         echo "selesai";
      // $fileName = $files->getClientOriginalName();
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'dev_web' => $data['dev_web'],
        //     'dev_country_id' => $data['dev_country_id'],
        //     'dev_address' => $data['dev_address'],
        //     'role' => 2,
        //     'picture' => $data['picture'].$files,
        //     'password' => Hash::make($data['password']),
        // ]);

    }
}
