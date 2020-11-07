<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\Tables\ResetPasswordToken;
use Carbon\Carbon;
use App\User;

class VerifyEmailController extends Controller
{
    public function VerifyEmail($token)
    {
        $now_time = Carbon::now();
        $token = ResetPasswordToken::where('token', $token)->where('expired_at', '>=', $now_time->toDateTimeString())->first();
        if(isset($token)){
          User::where('email', $token->email)->update(['is_verified' => 1, 'email_verified_at' => date('Y-m-d H:i:s')]);
          ResetPasswordToken::where('token', $token)->delete();
          $message = "Terimakasih sudah mem-verifikasi akun anda!";
          return view('auth.verify-email')->with('message', $message);
        } else {
          $message = "Masa berlaku permintaan untuk mem-verifikasi akun anda telah berakhir.";
          return view('auth.verify-email')->with('message', $message);
        }
    }

}
