@extends('panel.master')

@section('css')

    <link href="{{ asset('assets/pages/css/error.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<div class="page-head">
    <div class="page-title">
        <h1>500 Page Option 1
            <small>500 page option 1</small>
        </h1>
    </div>
</div>
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="index.html">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">System</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12 page-500">
        <div class=" number font-red"> 500 </div>
        <div class=" details">
            <h3>Oops! This Menu Under Construction.</h3>
            <p> We are fixing it! Please come back in a while.
                <br/> </p>
            <p>
                <a href="#" class="btn red btn-outline"> Return home </a>
                <br> </p>
        </div>
    </div>
</div>
@endsection

@section('myscript')

<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/profile.min.js') }}" type="text/javascript"></script>

@endsection