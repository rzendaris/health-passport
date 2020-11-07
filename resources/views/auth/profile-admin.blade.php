@extends('panel.master')

@section('css')

<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="content-body-white">
    <form method="post" action="{{url('update-user')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="page-head">
            <div class="page-title">
                <h1>Profiles</h1>
            </div>
        </div>
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12 element">
                    <div class="box-pencarian-family-tree" style=" background: #fff; ">
                        <div class="row">
                          <div class="form-group text-left">
                              <label class="form-control-label">Email: *</label>
                              <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}" required="" readonly>
                          </div>
                          <div class="form-group text-left">
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}"/>
                              <label class="form-control-label">Name: *</label>
                              <input type="text" name="full_name" class="form-control" value="{{ Auth::user()->name }}" required="">
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
                <div class="col-xl-12 col-md-12 m-b-10px text-right">
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
