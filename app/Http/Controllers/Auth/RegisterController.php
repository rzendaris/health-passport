<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Model\Table\MstCountry;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dev_web' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
     public function getRegister()
     {
        if (env('ENV') == 'DEVELOPER'){
         $country = MstCountry::all();
         $data = [
             'country' => $country
         ];

         return view('auth.register')->with($data);
       }else{
         return redirect('/');
       }
     }
    protected function create(array $data)
    {
      if($data['picture']){
          $file_extention = $data['picture']->getClientOriginalExtension();
          $file_name = $data['email'].'image_profile.'.$file_extention;
          $file_path = $data['picture']->move($this->MapPublicPath().'pictures',$file_name);
      }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'dev_web' => $data['dev_web'],
            'dev_country_id' => $data['dev_country_id'],
            'dev_address' => $data['dev_address'],
            'role_id' => 2,
            'is_blocked' => 1,
            'picture' => $file_name,
            'password' => Hash::make($data['password']),
        ]);

    }
}
