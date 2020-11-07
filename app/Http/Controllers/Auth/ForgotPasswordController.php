<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Mail;
use Carbon\Carbon;
use App\User;
use App\Mail\SendMailResetPassword;
use App\Model\Tables\ResetPasswordToken;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function forgotPasswordInit()
    {
        return view('auth.passwords.reset');
    }

    public function forgotPasswordFormat()
    {
        return view('auth.passwords.email');
    }

    public function validator(array $data)
    {
      // custom error message for valid_captcha validation rule
      $messages  = [
        'valid_captcha' => 'Wrong code. Try again please.'
      ];

      return Validator::make($data, [
        'email' => 'required|string',
        'g-recaptcha-response' => 'required|captcha'
      ], $messages);

    }

    public function forgotPassword(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()){
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator->errors());
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
            return redirect('forgot-password')->with('succ_message', 'Periksa email anda!');
        } else {
            return redirect('forgot-password')->with('err_message', 'Email anda tidak terdaftar!');
        }
    }

    public function forgotPasswordVerify($token)
    {
        $now_time = Carbon::now();
        $token = ResetPasswordToken::where('token', $token)->where('expired_at', '>=', $now_time->toDateTimeString())->first();
        if(isset($token)){
            return view('auth/verify-password')->with('data', $token);
        } else {
            return redirect('forgot-password')->with('err_message', 'Masa berlaku permintaan pembaruan kata sandi telah berakhir.');
        }
    }

    public function changePassword(Request $request)
    {
        if ($request->password != $request->re_password) {
          return redirect()->back()->with('err_message', 'Re-Type Password Not Match!');
        }else{
          User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
          return redirect('login')->with('succ_message', 'Selamat, kata sandi telah diperbarui');
        }
    }

}
