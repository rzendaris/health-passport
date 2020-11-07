@extends('panel.master')

@section('css')

<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="loader" style="display:none;">
    <div class="loader-main"><i class="fa fa-spinner fa-pulse"></i></div>
</div>

<div class="content-body-white">
    <form method="post" action="{{url('created-app-dev')}}" enctype="multipart/form-data">
          {{csrf_field()}}
        <div class="page-head">
            <div class="page-title">
                <h1>Upload Application </h1>
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
              @if(session()->has('succ_message'))
                  <div class="alert alert-success alert-dismissible" role="alert" auto-close="10000">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      {{ session()->get('succ_message') }}
                  </div>
              @endif
                <div class="col-md-12 element">
                    <div class="box-pencarian-family-tree" style=" background: #fff; ">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 m-b-10px">
                                <div class="form-group">
                                  <input type="hidden" name="id" value="{{ $data['apps']->id }}">
                                    <input type="file" name="apk_file" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                        <p class="text-danger text-center" style="margin:auto;">Max. total file size 100 MB</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12 m-b-10px text-right">
                    <!-- <a href="{{ url('apps-developer') }}" class="btn btn-danger pull-left">Cancel</a> -->
                    <!-- <a href="{{ url('upload-expansion/'.$data['apps']->id) }}" class="btn btn-success">Add Expansion FIle</a> -->
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
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

        $(document).on('submit', 'form', function() {
            $(".loader").attr("style","display:block;");
        });
    </script>
@endsection
