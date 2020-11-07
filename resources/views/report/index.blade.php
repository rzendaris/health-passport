@extends('panel.master')

@section('css')

<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<style>.btn-report-download {margin-top: 25px;}@media(max-width:767px){.btn-report-download {margin-top: 5px;}}</style>

@endsection

@section('content')

<div class="content-body-white">
    <form method="post" action="{{url('export-excel')}}" enctype="multipart/form-data">
          {{csrf_field()}}
        <div class="page-head">
            <div class="page-title">
                <h1>Report</h1>
            </div>
        </div>
        <div class="wrapper">
            <div class="row">
              @if(session()->has('err_message'))
                  <div class="alert alert-danger alert-dismissible" role="alert" auto-close="10000">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      {{ session()->get('err_message') }}
                  </div>
              @endif
              @if(session()->has('suc_message'))
                  <div class="alert alert-success alert-dismissible" role="alert" auto-close="10000">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      {{ session()->get('suc_message') }}
                  </div>
              @endif
                <div class="col-md-12 element">
                    <div class="box-pencarian-family-tree" style=" background: #fff; ">
                        <div class="row">
                            <div class="col-xl-12 col-md-5 m-b-10px">
                                <div class="form-group">
                                    <label class="form-control-label">Tanggal Awal :</label>
                                    <input id="date-start" type="date" name="from_date" class="form-control date" min="" max="" required/>
                                </div>
                            </div>
                            <div class="col-xl-12 col-md-5 m-b-10px">
                                <div class="form-group">
                                    <label class="form-control-label">Tanggal Akhir :</label>
                                    <input id="date-end" type="date" name="to_date" class="form-control date" min="" max="" required/>
                                </div>
                            </div>
                            <div class="col-xl-12 col-md-2 m-b-10px">
                                <button type="submit" class="btn btn-primary btn-report-download">Download <i class="fa fa-download"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Clone In This Div -->
                <div class="results"></div>
                <!-- Clone In This Div -->
            </div>

        </div>
    </form>
</div>

@endsection

@section('myscript')

    <script src="{{ asset('assets/global/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/add-family.js') }}"></script>
    <script>
        $('[type=tel]').on('change', function(e) {
            $(e.target).val($(e.target).val().replace(/[^\d\.]/g, ''))
        });
        $('[type=tel]').on('keypress', function(e) {
            keys = ['0','1','2','3','4','5','6','7','8','9','.']
            return keys.indexOf(event.key) > -1
        });

        $("#date-start").change(function(){
            $("#date-end").attr("min", $(this).val() );
            $("#date-end").attr("max", "" );
        });
        $("#date-end").change(function(){
            $("#date-start").attr("min", "" );
            $("#date-start").attr("max", $(this).val() );
        });
    </script>
@endsection
