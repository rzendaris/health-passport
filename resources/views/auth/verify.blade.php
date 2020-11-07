@extends('auth.master')

@section('css')
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/pages/css/login-4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<style>
    .login .content .forget-password {margin-top: 10px;}
    div#LoginCaptcha_CaptchaDiv {
        background: white;
        width: 100%!important;
        padding: 10px!important;
        height: auto!important;
    }
    .login-box-- {
        background: rgba(255, 255, 255, .7);
        border-radius: 10px!important;
        box-shadow: 0 0 10px rgba(51, 51, 51, 0.3);
    }
    .login-box-- .logo-default-login {
        margin:auto;
    }
    #CaptchaCode {
        padding-left: 10px;
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
<div class="logo">
    <!-- <a href="#">
        <img src="{{ asset('assets/global/img/logo.png') }}" alt="logo-mina-indonesia" width="100"/>
    </a> -->
</div>
<div class="content login-box--">
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="/" >
                    <img src="{{ asset('assets/global/img/logo.png') }}" alt="" width="100" class="logo-default-login" />
                </a>
                <h3 class="form-title">{{ __('Verify Your Email Address') }}</h3>
            </div>
        </div>

        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <br>
            <form class="d-inline" method="get" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="pull-right" href="#">Back to Login</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <br><br>
        </div>
    <!-- END LOGIN FORM -->
</div>

@endsection

@section('myscript')

    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/login-4.min.js') }}" type="text/javascript"></script>
@endsection
