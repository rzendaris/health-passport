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
    input#picture {
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
    span.invalid-feedback strong {
        color: red;
        font-weight: normal;
        line-height: 2.5;
        font-size: 12px;
        letter-spacing: 1px;
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
    <form method="POST" action="{{ route('register') }}"  enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="title-register">{{ __('Register') }}</h1>
                <hr>
                <div class="form-group">
                    <!-- {{ __('Foto') }} -->
                    <img id="blah" src="{{ asset('assets/global/img/no-profile.jpg') }}" style="margin-bottom:5px;border:solid 1px #c2cad8;" /><br>
                    <input id="picture" name="picture" type="file" required onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                </div>
                @error('picture')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="control-label">{{ __('Name') }} *</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dev_web" class="control-label">{{ __('Website') }} *</label>
                    <div class="input-icon">
                        <i class="fa fa-globe"></i>
                        <input id="dev_web" type="text" class="form-control @error('dev_web') is-invalid @enderror" name="dev_web" value="{{ old('name') }}" required autocomplete="dev_web" autofocus>
                    </div>
                    @error('dev_web')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="password" class="control-label">{{ __('Password') }} *</label>
                    <div class="input-icon">
                        <i class="fa fa-key"></i>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>     

                <div class="form-group">
                    <label for="password-confirm" class="control-label">Re-type Password* :</label>
                    <div class="input-icon">
                        <i class="fa fa-key"></i>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email" class="control-label">{{ __('E-Mail Address') }} *</label>
                    <div class="input-icon">
                        <i class="fa fa-at"></i>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dev_country_id" class="form-control-label">{{ __('Country') }} *</label>
                    <select class="form-control @error('dev_country_id') is-invalid @enderror" name="dev_country_id" value="{{ old('name') }}" required id="dev_country_id">
                        @foreach($country as $get)
                                <option value="{{ $get-> id}}">{{ $get->country}}</option>
                        @endforeach
                    </select>
                    @error('dev_country_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dev_address" class="control-label">{{ __('Address') }} *</label>
                    <textarea id="dev_address" class="textarea-register form-control @error('dev_address') is-invalid @enderror" name="dev_address" required autocomplete="dev_address" >{{ old('name') }}</textarea>
                    @error('dev_address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
               
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-xs-12 col-md-offset-4 col-md-4">
                <div class="form-actions">
                    <button type="submit" class="btn green w-100 btn-login">
                        <i class="fa fa-check"></i> {{ __('Register') }}
                    </button>
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
@endsection