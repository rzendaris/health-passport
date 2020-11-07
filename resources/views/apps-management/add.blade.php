@extends('panel.master')

@section('css')

<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="content-body-white">
    <form method="post" action="{{url('insert-developer-management')}}" enctype="multipart/form-data">
          {{csrf_field()}}
        <div class="page-head">
            <div class="page-title">
                <h1>Add Developer</h1>
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
                            <div class="col-xl-2 col-md-2 m-b-10px">
                                <div class="form-group">
                                    <img id="blah2" style="margin-bottom:5px;border:solid 1px #c2cad8;" width="150" height="150" src="{{ asset('assets/global/img/no-profile.jpg') }}" /><br>
                                    <input id="upload-img-2" name="photo" type="file" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" style=" width: 99%; border: solid 1px #c2cbd8; ">
                                </div>
                            </div>
                            <div class="col-xl-5 col-md-5 m-b-10px">
                                <div class="form-group">
                                    <label class="form-control-label">Nama :*</label>
                                    <input type="text" name="full_name" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Website :*</label>
                                    <input type="text" name="website" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Password :*</label>
                                    <input type="password" name="password" class="form-control date"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Re-type Password :*</label>
                                    <input type="password" name="password" class="form-control date"/>
                                </div>
                            </div>
                            <div class="col-xl-5 col-md-5 m-b-10px">
                                <div class="form-group">
                                    <label class="form-control-label">Email :*</label>
                                    <input type="text" name="email" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Country* :</label>
                                    <select name="country" id="country" class="custom-select form-control" required>
                                        <option value="">Pilih Country</option>
                                        @foreach($country as $get)
                                                <option value="{{ $get-> id}}">{{ $get->country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Address* :</label>
                                    <textarea class="textarea-register form-control" name="dev_address" rows="5"></textarea>
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
                    <a href="{{ url('developer-management') }}" class="btn btn-danger pull-left">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save & Add Apps</button>
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
    </script>
@endsection
