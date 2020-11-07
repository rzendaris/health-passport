@extends('panel.master')

@section('css')

<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="content-body-white">
    <form method="post" action="{{url('update-developer-management')}}" enctype="multipart/form-data">
          {{csrf_field()}}
        <div class="page-head">
            <div class="page-title">
                <h1>Approval Apps</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="sliderapp" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                      @if(json_decode($data['apps']->media) != '')
                        @foreach(json_decode($data['apps']->media) as $key => $media)
                          @if($key=='media1')
                            <div class="item active">
                                <img src="{{ url('/media/'.$media) }}" alt="etalase" onerror="this.src='{{ env('DEVELOPER_URL') }}/media/{{ $media }}';">
                            </div>
                          @else
                            <div class="item">
                                <img src="{{ url('/media/'.$media) }}" alt="etalase" onerror="this.src='{{ env('DEVELOPER_URL') }}/media/{{ $media }}';">
                            </div>
                          @endif
                        @endforeach
                      @else
                          <div class="item active">
                              <img src="https://www.w3schools.com/bootstrap/la.jpg" alt="etalase">
                          </div>
                          <div class="item">
                              <img src="https://www.w3schools.com/bootstrap/chicago.jpg" alt="etalase">
                          </div>
                      @endif
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#sliderapp" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#sliderapp" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12 element">
                    <div class="box-pencarian-family-tree" style=" background: #fff; ">
                    <div class="row">
                      <div class="col-xl-2 col-md-2 m-b-10px">
                          <div class="form-group">
                              <img id="blah2" style="margin-bottom:5px;border:solid 1px #c2cad8;" width="150" height="150" src="{{ url('/apps/'.$data['apps']->app_icon) }}" onerror="this.src='{{ env('DEVELOPER_URL') }}/apps/{{ $data['apps']->app_icon }}';"/><br>
                              <!-- <input id="upload-img-2" name="photo" type="file" disabled onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" style=" width: 99%; border: solid 1px #c2cbd8; "> -->
                          </div>
                          <div class="form-group text-center">
                            <h2>Rating {{ $data['apps']->avg_ratings }} <i class="fa fa-star"></i></h2>
                          </div>
                          <div class="form-group">
                            <a href="{{ url('review-info/'.$data['apps']->id) }}" class="btn btn-primary" style="width:100%;"><i class="fa fa-star"></i> Review Info</a>
                          </div>
                          <div class="form-group">
                              <a href="{{ url('download-app/'.$data['apps']->id) }}" class="btn btn-primary" style="width:100%;"><i class="fa fa-android"></i> Download App</a>
                          </div>
                          @if($data['apps']->expansion_file != NULL)
                          <div class="form-group">
                              <a href="{{ url('download-expansion/'.$data['apps']->id) }}" class="btn btn-primary" style="width:100%;"><i class="fa fa-android"></i> Download OBB File</a>
                          </div>
                          @endif
                      </div>
                      <div class="col-xl-10 col-md-10 m-b-10px">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 m-b-10px">
                                <div class="form-group">
                                    <label class="form-control-label">Nama :</label>
                                    <input type="hidden" name="id" value="{{ $data['apps']->id }}">
                                    <input type="text" name="name"  value="{{ $data['apps']->name }}" class="form-control" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Category :</label>
                                    <select class="form-control" name="category" disabled>
                                      @foreach($data['category'] as $get)
                                      @if($data['apps']->category_id == $get->id)
                                              <option value="{{ $get->id}}" selected>{{ $get->name}}</option>
                                      @else
                                              <option value="{{ $get->id}}">{{ $get->name}}</option>
                                      @endif
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                     <div class="row">
                                          <div class="col-md-12">
                                            <label class="form-control-label">SDK Target : </label>
                                            <input type="text" class="form-control" name="eu_sdk_version" value="{{ $data['apps']->eu_sdk_version }}" readonly>
                                          </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">File Size :</label>
                                    <input type="text" name="file_size" value="{{ $data['apps']->file_size }}" class="form-control" disabled/>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 m-b-10px">
                                <div class="form-group">
                                    <label class="form-control-label">Type :</label>
                                    <select class="form-control" name="type" disabled>
                                        <option value="Games">Games</option>
                                        <option value="Hiburan">Hiburan</option>
                                        <option value="Musik">Musik</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Minimum Age :</label>
                                    <input type="text" name="rate" value="{{ $data['apps']->rate }}" class="form-control" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Version :</label>
                                    <input type="text" name="version" value="{{ $data['apps']->version }}" class="form-control" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Last Update :</label>
                                    <input type="text" name="updated_at" value="{{ $data['apps']->updated_at }}" class="form-control" disabled/>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-12 m-b-10px">
                                <div class="form-group">
                                    <label class="control-label">Description :</label>
                                    <textarea class="textarea-register form-control" name="description" rows="5" disabled>{{ $data['apps']->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">New Update Description :</label>
                                    <textarea class="textarea-register form-control" name="updates_description" rows="5" disabled>{{ $data['apps']->updates_description }}</textarea>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xl-2 col-md-2 m-b-10px">
                    <div class="form-group">
                        <img id="blah2" style="margin-bottom:5px;border:solid 1px #c2cad8;" width="100%" height="150" src="{{ url('/pictures/'.$data['user']->picture) }}" onerror="this.src='{{ env('DEVELOPER_URL') }}/pictures/{{ $data['user']->picture }}';"/><br>
                        <!-- <input id="upload-img-2" name="photo" type="file" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" style=" width: 99%; border: solid 1px #c2cbd8; "> -->
                    </div>
                    <div class="form-group">
                        <a href="{{ url('detail-developer-management/'.$data['user']->id) }}" target="_blank" class="btn btn-primary" style="width:100%;"><i class="fa fa-user"></i> Profile</a>
                    </div>
                </div>
                <div class="col-xl-5 col-md-5 m-b-10px">
                    <div class="form-group">
                        <label class="form-control-label">Nama :</label>
                        <input type="text" name="full_name" value="{{ $data['user']->name }}" class="form-control" disabled/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Website :</label>
                        <input type="text" name="email" value="{{ $data['user']->dev_web }}" class="form-control" disabled/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Address :</label>
                        <textarea class="textarea-register form-control" rows="5" disabled>{{ $data['user']->dev_address }}</textarea>
                    </div>
                </div>
                <div class="col-xl-5 col-md-5 m-b-10px">
                    <div class="form-group">
                        <label class="form-control-label">Email :</label>
                        <input type="text" name="full_name" value="{{ $data['user']->email }}" class="form-control" disabled/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Country :</label>
                        @if(isset($data['user']->countrys))
                            <input type="text" name="" value="{{ $data['user']->countrys->country }}" class="form-control" disabled/>
                        @else
                            <input type="text" name="" value="" class="form-control" disabled/>
                        @endif
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xl-12 col-md-12 m-b-10px text-right">
                    <a href="{{ url('apps-management') }}" class="btn btn-danger pull-left">Cancel</a>
                    <a href="#" data-toggle="modal" data-target="#modal-rejected" class="btn btn-warning">Rejected</a>
                    <a href="#" data-toggle="modal" data-target="#modal-approve" class="btn btn-success">Approve</a>
                </div>
            </div>
        </div>
    </form>
</div>

    <!-- Modal Rejected -->
    <div id="modal-rejected" class="modal fade">
        <form method="post" action="{{url('rejected-apps')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h2 style=" margin: auto; ">Warning</h2>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="form-group">
                                    <label class="control-label text-left">Rejected Reason :*</label>
                                    <input type="hidden" name="id" value="{{ $data['apps']->id }}">
                                    <textarea class="textarea-register form-control" name="reaseon" rows="3" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-success">Yes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Approve -->
    <div id="modal-approve" class="modal fade">
        <form method="post" action="{{url('approved-apps')}}" enctype="multipart/form-data">
          {{csrf_field()}}
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h2>Warning</h2>
                        <p>Are you sure?</p>
                    </div>
                    <input type="hidden" name="id" value="1"/>
                    <div class="modal-footer">
                    <input type="hidden" name="id" value="{{ $data['apps']->id }}">
                        <button type="button" class="btn btn-success pull-left" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
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
