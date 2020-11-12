<?php
namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mail;
use Hash;
use App\Mail\SendMailResetPassword;
use App\Mail\SendMailVerifyEmail;
use App\Model\Tables\ResetPasswordToken;

use App\User;

class APIAuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'birthday' => 'required|date_format:Y-m-d',
            'photo' => 'mimes:jpeg,jpg,png|max:10000',
            'gender' => 'required|string',
            'nik' => 'string',
            'address' => 'string',
            'firebase_id' => 'string',
        ]);
        $check_user = User::where('email', $request->email)->first();
        if ($check_user){
            return $this->appResponse(505, 200, $check_user);
        } else {
            $file_name = "Picture doesn't exist";
            if($request->photo){
                $file_extention = $request->photo->getClientOriginalExtension();
                $file_name = $request->email.'image_profile.'.$file_extention;
                $file_path = $request->photo->move($this->MapPublicPath().'pictures',$file_name);
            }
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => 3,
                'password' => bcrypt($request->password),
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'nik' => $request->nik,
                'address' => $request->address,
                'is_blocked' => 1,
                'is_verified' => 1,
                'picture' => $file_name,
                'notification_id' => $request->firebase_id
            ]);
            $user->save();
            $token = md5(rand(1, 50) . microtime());
            $now_time = Carbon::now();
            $expired = Carbon::parse($now_time->toDateTimeString())->addHour();
            $data = array(
                'email' => $request->email,
                'name' => $user->name,
                'reset_url' => url('verify-account/'.$token),
            );
            // Mail::send(new SendMailVerifyEmail($data));
            // ResetPasswordToken::create([
            //     'email' => $request->email,
            //     'token' => $token,
            //     'expired_at' => $expired
            // ]);
            return $this->appResponse(500, 200);
        }
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @return [string] user_id
     * @return [string] email
     * @return [string] name
     * @return [string] token
     */

    public function login(Request $request){
        try{
            $hasher = app()->make('hash');
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required',
                'firebase_id' => 'string',
            ]);
            $user = User::where('email', $request->email)->where('role_id', 3)->first();
            if(isset($user)){
                if($user->is_blocked != 1){
                    return $this->appResponse(108, 401);
                } else {
                    if($user->is_verified == 1){
                        if($hasher->check($request->input('password'), $user->password)){
                            $apikey = $this->jwt($user);
                            $decode = JWT::decode($apikey, env('JWT_SECRET'), ['HS256']);
            
                            $data['user_email'] = $user->email;
                            $returnData = [
                                "user_id" => $user->id,
                                "email" => $user->email,
                                "name" => $user->name,
                                "role_id" => $user->role_id,
                                "token" => $apikey,
                            ];
                            if($request->firebase_id){
                                User::where('id', $user->id)->update([
                                    'notification_id' => $request->firebase_id
                                ]);
                            }
                            return $this->appResponse(201, 200, $returnData);
                        }else{
                            return $this->appResponse(105, 401);
                        }
                    } else {
                        $token = md5(rand(1, 50) . microtime());
                        $now_time = Carbon::now();
                        $expired = Carbon::parse($now_time->toDateTimeString())->addHour();
                        $data = array(
                            'email' => $request->email,
                            'name' => $user->name,
                            'reset_url' => url('verify-account/'.$token),
                        );
                        Mail::send(new SendMailVerifyEmail($data));
                        ResetPasswordToken::create([
                            'email' => $request->email,
                            'token' => $token,
                            'expired_at' => $expired
                        ]);
                        return $this->appResponse(107, 401);
                    }
                }
            }else{
                return $this->appResponse(105, 401);
            }
            
        } catch (Exception $e){
            return $this->appResponse(2000, 200);
        }
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->appResponse(202, 200);
    }

    /**
     * Update Profile
     */
    public function updateProfile(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'birthday' => 'required|date_format:Y-m-d',
            'photo' => 'mimes:jpeg,jpg,png|max:10000',
        ]);
        $check_user = User::where('email', $request->email)->first();
        if ($check_user){
            $file_name = $check_user->picture;
            if($request->photo){
                $file_extention = $request->photo->getClientOriginalExtension();
                $file_name = $request->email.'image_profile.'.$file_extention;
                $file_path = $request->photo->move($this->MapPublicPath().'pictures',$file_name);
            }
            User::where('id', $check_user->id)->update([
                'name' => $request->name,
                'eu_birthday' => $request->birthday,
                'picture' => $file_name
            ]);
            return $this->appResponse(501, 200);
        } else {
            return $this->appResponse(156, 200);
        }
    }

    /**
     * Function to Change User's Password
     */
    public function changePassword(Request $request){
        $request->validate([
            'email' => 'required|string',
            'old_password' => 'required|string',
            'new_password' => 'required|string',
        ]);
        $check_user = User::where('email', $request->email)->first();
        if ($check_user){
            if(Hash::check($request->old_password, $check_user->password, [])){
                User::where('id', $check_user->id)->update([
                    'password' => bcrypt($request->new_password)
                ]);
                return $this->appResponse(501, 200);
            } else {
                return $this->appResponse(157, 200);
            }
        } else {
            return $this->appResponse(156, 200);
        }
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        $user = User::where('email', $request->user_email)->where('role_id', 3)->where('is_blocked', 1)->first();
        $user->picture = "pictures/".$user->picture;
        return $this->appResponse(100, 200, $user);
    }
  
    /**
     * Forgot Password
     *
     * @return [json] user object
     */

    public function forgotPassword(Request $request)
    {
        $email = $request->email;
        if ($email == ""){
            return $this->appResponse(106, 200);
        }
        $user = User::where('email', $request->email)->first();
        if(isset($user)){
            $token = md5(rand(1, 50) . microtime());
            $now_time = Carbon::now();
            $expired = Carbon::parse($now_time->toDateTimeString())->addHour();
            $data = array(
                'email' => $request->email,
                'name' => $user->name,
                'reset_url' => url('forgot-password-verify/'.$token),
            );
            Mail::send(new SendMailResetPassword($data));
            ResetPasswordToken::create([
                'email' => $request->email,
                'token' => $token,
                'expired_at' => $expired
            ]);
            return $this->appResponse(200, 200, "Periksa email anda!");
        } else {
            return $this->appResponse(106, 200);
        }
    }
}