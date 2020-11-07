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
        margin-bottom: 5%;
    }
    .login .content .forget-password {margin-top: 25px;}
    div#LoginCaptcha_CaptchaDiv {
        background: white;
        width: 100%!important;
        padding: 10px!important;
        height: auto!important;
        border: solid 1px #c2cbd8;
        border-bottom: none;
    }
    .login-box-- {
        margin-top:20%;
        background: rgba(255, 255, 255, .7);
        border-radius: 5px!important;
        box-shadow: 0 0 10px rgba(51, 51, 51, 0.3);
    }
    .login-box-- .logo-default-login {
        margin:auto;
    }
    #CaptchaCode {
        padding-left: 10px;
        /* text-transform: unset!important; */
    }
    .form-control {
        height: 38px;
    }
    .btn-login {
        width:100%;
    }
    .btn-registration {
        width:100%;
    }
    .login .content .form-actions {
        padding: 0 30px 15px;
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


    <form class="login-form" method="POST" action="{{ route('login') }}" onsubmit="onsubmitform()">
    @csrf
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="/" >
                    <img src="{{ asset('assets/global/img/logo.png') }}" alt="" width="100" style="width:190px;" class="logo-default-login" />
                </a>
                <hr>
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
                @if($errors->has('g-recaptcha-response'))
                    <div class="alert alert-danger alert-dismissible" role="alert" auto-close="10000">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ $errors->first('g-recaptcha-response') }}
                    </div>
                @endif
                @if ($errors->has('email'))
                    <div class="alert alert-danger alert-dismissible" role="alert" auto-close="10000">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <!-- @if(session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible" role="alert" auto-close="10000">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session()->get('err_message') }}
                    </div>
                @endif -->
            </div>
        </div>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter any username and password. </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" required autofocus/>

                <!-- @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif -->
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" required/>
            </div>
        </div>
        <div class="form-group{{ $errors->has('CaptchaCode') ? ' has-error' : '' }}">
            <div class="input-icon">
              {!! NoCaptcha::display() !!}
              {{ csrf_field() }}
              <!-- @if ($errors->has('g-recaptcha-response'))
              <span class="help-block">
              <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
              </span>
              @endif -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="form-actions">
                    <button type="submit" class="btn green w-100 btn-login"> <i class="fa fa-sign-in"></i> Login </button>
                </div>
            </div>
            @if(env('ENV') == 'DEVELOPER')
            <div class="col-xs-12 col-md-12">
                <a href="{{ url('register-dev') }}" class="btn green w-100 btn-registration"> <i class="fa fa-user-plus"></i> Registration </a>
            </div>
            @endif
            <div class="col-xs-12 col-md-12">
                <div class="forget-password text-center">
                    <a href="{{ url('forgot-password') }}"><b> <i class="fa fa-unlock-alt"></i> Lupa Password ? </b></a>
                </div>
            </div>

        </div>

        <br>
    </form>
    <!-- END LOGIN FORM -->
</div>

@endsection

@section('myscript')

    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/login-4.min.js') }}" type="text/javascript"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <script>
    function onsubmitform() {
        $(".loader").attr("style","display:block;");
    }
    </script>
@endsection
