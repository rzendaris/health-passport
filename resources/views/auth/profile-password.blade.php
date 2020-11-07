@extends('panel.master')

@section('css')

<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="content-body-white">
    <form method="post" action="{{url('change-pass-user')}}" enctype="multipart/form-data">
      {{csrf_field()}}
        <div class="page-head">
            <div class="page-title">
                <h1>Change Password</h1>
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
                            <div class="col-xl-6 col-md-6 m-b-10px">
                                <div class="form-group">
                                    <label class="form-control-label">Old Password :*</label>
                                    <input type="password" name="old_password" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6 m-b-10px">
                                <div class="form-group">
                                    <label class="form-control-label">New Password :*</label>
                                    <input type="password" name="new_password" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6 m-b-10px">
                                <div class="form-group">
                                    <label class="form-control-label">Re-type Password :*</label>
                                    <input type="password" name="re_password" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Clone In This Div -->
                <div class="results"></div>
                <!-- Clone In This Div -->
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12 m-b-10px text-left">
                    <a href="/" class="btn btn-primary pull-right">Batal</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
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
    </script>
@endsection
