@extends('panel.master')

@section('css')

<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="loader" style="display:none;">
    <div class="loader-main"><i class="fa fa-spinner fa-pulse"></i></div>
</div>

<div class="content-body-white">
    <form method="post" action="{{url('create-apps')}}" enctype="multipart/form-data">
          {{csrf_field()}}
        <div class="page-head">
            <div class="page-title">
                <h1>Add Application</h1>
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
                                    <img id="blah2" style="margin-bottom:5px;border:solid 1px #c2cad8;" width="150" height="150" src="https://image.shutterstock.com/image-vector/male-silhouette-avatar-profile-picture-260nw-199246382.jpg" /><br>
                                    <input id="upload-img-2" name="photo" type="file" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" style=" width: 99%; border: solid 1px #c2cbd8; " required>
                                    <p class="text-danger text-center">Max. file size 2 MB</p>
                                </div>
                            </div>
                            <div class="col-xl-10 col-md-10 m-b-10px">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 m-b-10px">
                                      <div class="form-group">
                                          <label class="form-control-label">Nama : *</label>
                                          <input type="text" name="name"  class="form-control" required/>
                                      </div>
                                      <div class="form-group">
                                          <label class="form-control-label">Category : *</label>
                                          <select class="form-control" name="category" required>
                                            @foreach($data['category'] as $get)
                                                    <option value="{{ $get->id}}">{{ $get->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label class="form-control-label">Type : *</label>
                                          <select class="form-control" name="type" required>
                                            <option value="Games">Games</option>
                                            <option value="Application">Application</option>
                                          </select>
                                      </div>
                                      <!-- <div class="form-group">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <label class="form-control-label">APK File : *</label>
                                            <input type="file" name="apk_file" class="form-control" />
                                          </div>
                                          <div class="col-md-6">
                                            <label class="form-control-label">Expansion File : *</label>
                                            <input type="file" name="exp_file" class="form-control" />
                                          </div>
                                        </div>
                                      </div> -->
                                    </div>
                                    <div class="col-xl-6 col-md-6 m-b-10px">
                                        <div class="form-group">
                                            <label class="form-control-label">Minimum Age : *</label>
                                            <input type="number" name="rate" class="form-control" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Developer : *</label>
                                            <select name="developer" id="developer" class="custom-select form-control" required>
                                                <option value="">Pilih Developer</option>
                                                @foreach($data['dev'] as $get)
                                                    @if($data['devid'] == $get->id)
                                                            <option value="{{ $get->id}}" selected>{{ $get->name}}</option>
                                                    @else
                                                            <option value="{{ $get->id}}">{{ $get->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-12 m-b-10px">
                                        <div class="form-group">
                                            <label class="control-label">Description :</label>
                                            <textarea class="textarea-register form-control" name="description" rows="5" ></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">New Update Description :</label>
                                            <textarea class="textarea-register form-control" name="updates_description" rows="5" ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12 m-b-10px text-right">
                    <a href="{{ url('apps-management') }}" class="btn btn-danger pull-left">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Next">
                    <!-- <a href="{{ url('upload-media') }}" class="btn btn-primary">Next</a> -->
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
