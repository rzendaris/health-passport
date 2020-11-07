@extends('auth.master')

@section('css')
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/pages/css/login-4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<style>
    .login .content {
        width:80%;
        background: rgb(255 255 255 / 1);
        margin: 3% auto;
    }
    .login .content .forget-password {margin-top: 10px;}
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
    }
    .form-control {
        height: 38px;
    }
    .btn-login {
        width:100%;
    }
    .btn-registration {
        width:50%;
    }
    .login .content .form-actions {
        padding: 0 30px 15px;
    }
    
    img#blah {
        width: 200px;
        margin:15px auto;
    }
    .login .content label {color:#333;}
    .textarea-register {
        min-height: 115px;
    }
    input#upload-img {
        margin: 20px auto;
        border: solid 1px #c2cbd8;
        padding: 8px;
        width: 200px;
    }
    .select2-container .select2-selection--single {
        height: 38px;
        padding: 5px;
        border-color: #c2cad8;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 5px;
    }
    .title-register {
        font-size: 28px;
        padding: 0;
        margin: auto;
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

<div class="content login-box--">
    <form class="login-form" method="POST" action="{{ route('register') }}">

        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="title-register">Registration</h1>
                <hr>
                <div class="form-group">
                    <img id="blah" src="{{ asset('assets/global/img/no-profile.jpg') }}" style="margin-bottom:5px;border:solid 1px #c2cad8;" /><br>
                    <input id="upload-img" name="photo_master" type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Name* :</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" name="name" required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Website* :</label>
                    <div class="input-icon">
                        <i class="fa fa-globe"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" name="website" required autofocus/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Password* :</label>
                    <div class="input-icon">
                        <i class="fa fa-key"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" name="password" required autofocus/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Re-type Password* :</label>
                    <div class="input-icon">
                        <i class="fa fa-key"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" name="re_password" required autofocus/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Email* :</label>
                    <div class="input-icon">
                        <i class="fa fa-at"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" name="email" required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Country* :</label>
                    <select name="country" id="country" class="custom-select form-control" required>
                        <option value="">Pilih Country</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Address* :</label>
                    <textarea class="textarea-register form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('CaptchaCode') ? ' has-error' : '' }}">
                    <div class="input-icon">
                        {!! captcha_image_html('LoginCaptcha') !!}
                        <input type="text" class="form-control" name="CaptchaCode" id="CaptchaCode" required>

                        @if ($errors->has('CaptchaCode'))
                            <span class="help-block">
                                <strong>{{ $errors->first('CaptchaCode') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12 col-md-offset-4 col-md-4">
                <div class="form-actions">
                    <button type="submit" class="btn green w-100 btn-login"> <i class="fa fa-check"></i> Submit </button>
                </div>
            </div>
            <div class="col-xs-12 col-md-12">
                <div class="forget-password text-center">
                    <a href="{{ url('login') }}"><b>Already have account? Login <i class="fa fa-sign-in"></i></b></a>
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
    <script>
    $("select").select2();
    </script>
@endsection