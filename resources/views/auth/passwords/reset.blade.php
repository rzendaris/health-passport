@extends('auth.master')

@section('css')
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/pages/css/login-4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<style>
    .login .content {
        background: rgb(255 255 255 / 1);
        margin-top: 8%;
    }
    .login .content label, .login .content p, .login .content h3, .login .content h4{
        color: #333;
    }
    .login .content .forget-password {margin-top: 10px;}
    div#LoginCaptcha_CaptchaDiv {
        background: white;
        width: 100%!important;
        padding: 10px!important;
        height: auto!important;
    }
    div#ResetPasswordCaptcha_CaptchaDiv {
        background: white;
        width: 100%!important;
        padding: 10px!important;
        height: auto!important;
        border: solid 1px #c2cbd8;
    }
    .login-box-- {
        background: rgba(255, 255, 255, .7);
        border-radius: 10px!important;
        box-shadow: 0 0 10px rgba(51, 51, 51, 0.3);
        border-radius: 5px!important;
    }
    .login-box-- .logo-default-login {
        margin:auto;
    }
    #CaptchaCode {
        padding-left: 10px;
    }
    .loader {
        position: fixed;
        top: 0;
        background: rgb(255 255 255 / .5);
        bottom: 0;
        left: 0;
        z-index: 99999;
        height: 100%;
        width: 100%;
    }
    .loader-main {
        color: #da8788;
        position: absolute;
        top: 50%;
        right: 50%;
        font-size: 33px;
    }
    @media (max-width:767px){
        .login .content {
            width:90%;
            margin-bottom: 60px;
        }
        .login .content h3 {
            font-size: 16px;
        }
    }
</style>

<div class="loader" style="display:none;">
    <div class="loader-main"><i class="fa fa-spinner fa-pulse"></i></div>
</div>

<div class="content login-box--">
  {!! NoCaptcha::renderJs() !!}
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="login-form" method="post" action="{{ url('forgot-password-send-email') }}" enctype="multipart/form-data" onsubmit="onsubmitform()">
    {{csrf_field()}}
        <h3>Lupa Password ?</h3>
        <p> Masukan alamat email anda dibawah ini untuk memperbarui kata sandi akun anda. </p>
        @if(session()->has('err_message'))
            <div class="alert alert-danger alert-dismissible" role="alert" auto-close="10000">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session()->get('err_message') }}
            </div>
        @endif
        @if(session()->has('succ_message'))
            <div class="alert alert-success alert-dismissible" role="alert" auto-close="10000">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session()->get('succ_message') }}
            </div>
        @endif
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email" required/>
            </div>
        </div>
        <div class="form-group{{ $errors->has('CaptchaCode') ? ' has-error' : '' }}">
            <div class="input-icon">
              {!! NoCaptcha::display() !!}
              {{ csrf_field() }}
              @if ($errors->has('g-recaptcha-response'))
              <span class="help-block">
              <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
              </span>
              @endif
            </div>
            <script src='https://www.google.com/recaptcha/api.js'></script>
        </div>
        <div class="form-actions">
            <a href="{{ url('login') }}" type="button" class="btn red btn-outline">Back </a>
            <button type="submit" class="btn green pull-right"> Submit </button>
        </div>
    </form>
</div>

@endsection

@section('myscript')

    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ asset('assets/pages/scripts/login-4.min.js') }}" type="text/javascript"></script>

    <script>
    function onsubmitform() {
        $(".loader").attr("style","display:block;");
    }
    </script>
@endsection
