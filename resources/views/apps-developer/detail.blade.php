@extends('panel.master')

@section('css')

<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="content-body-white">
    <div class="page-head">
        <div class="page-title">
            <h1>Apps Detail</h1>
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
                            <img src="{{ url('/media/'.$media) }}" onerror="this.src='{{ env('ADMIN_URL') }}/media/{{ $media }}';" alt="etalase">
                        </div>
                      @else
                        <div class="item">
                            <img src="{{ url('/media/'.$media) }}" onerror="this.src='{{ env('ADMIN_URL') }}/media/{{ $media }}';" alt="etalase">
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
    <div class="row">
        <div class="col-md-12 element">
            <div class="box-pencarian-family-tree" style=" background: #fff; ">
                <div class="row">
                    <div class="col-xl-2 col-md-2 m-b-10px">
                        <div class="form-group">
                            <img id="blah2" style="margin-bottom:5px;border:solid 1px #c2cad8;" width="100%" height="150" src="{{ url('/apps/'.$data['apps']->app_icon) }}" onerror="this.src='{{ env('ADMIN_URL') }}/apps/{{ $data['apps']->app_icon }}';" /><br>
                            <!-- <input id="upload-img-2" name="photo" type="file" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" style=" width: 99%; border: solid 1px #c2cbd8; "> -->
                        </div>
                        <div class="form-group text-center">
                            <h2>Rating {{ $data['apps']->avg_ratings }} <i class="fa fa-star"></i></h2>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('review-info/'.$data['apps']->id) }}" class="btn btn-primary" style="width:100%;"><i class="fa fa-star"></i> Review Info</a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-md-10 m-b-10px">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 m-b-10px">
                                <div class="form-group">
                                    <label class="form-control-label">Nama :</label>
                                    <input type="text" name="full_name"  value="{{ $data['apps']->name }}" class="form-control" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Category :</label>
                                    <input type="text" name="category"  class="form-control" value="{{ $data['apps']->categories->name }}" disabled/>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                      <div class="col-md-12">
                                        <label class="form-control-label">SDK Target : </label>
                                        <input type="text" class="form-control" name="eu_sdk_version" value="{{ $data['apps']->eu_sdk_version }}" readonly>
                                      </div>
                                      <!-- <div class="col-md-6">
                                        <label class="form-control-label">Package Name : </label>
                                        <input type="text" class="form-control" name="package_name" value="{{ $data['apps']->package_name }}" readonly>
                                      </div> -->
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
                                    <input type="text" name="type" value="{{ $data['apps']->type }}" class="form-control" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Minimum Age :</label>
                                    <input type="number" name="rate" value="{{ $data['apps']->rate }}" class="form-control" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Version :</label>
                                    <input type="text" name="type" value="{{ $data['apps']->version }}" class="form-control" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Last Update :</label>
                                    <input type="text" name="rate" value="{{ $data['apps']->updated_at }}" class="form-control" disabled/>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-12 m-b-10px">
                                <div class="form-group">
                                    <label class="control-label">Description :</label>
                                    <textarea class="textarea-register form-control" rows="5" disabled>{{ $data['apps']->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">New Update Description :</label>
                                    <textarea class="textarea-register form-control" rows="5" disabled>{{ $data['apps']->updates_description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- <div class="row">
        <div class="col-xl-2 col-md-2 m-b-10px">
            <div class="form-group">
                <img id="blah2" style="margin-bottom:5px;border:solid 1px #c2cad8;" width="100%" height="150" src="{{ url('/pictures/'.$data['user']->picture) }}" /><br>
                  </div>
            <div class="form-group">
                <a target="_blank" rel="noopener noreferrer" href="{{ url('detail-developer-management/'.$data['user']->id) }}" class="btn btn-primary" style="width:100%;"><i class="fa fa-user"></i> Profile</a>
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
                <input type="text" name="" value="{{ $data['user']->countrys->country }}" class="form-control" disabled/>
            </div>
        </div>
    </div> -->
    <hr>
    <div class="row">
        <div class="col-xl-12 col-md-12 m-b-10px text-right">
            <a href="{{ url('apps-developer') }}" class="btn btn-danger pull-left">Back</a>
        </div>
    </div>

</div>

@endsection

@section('myscript')

    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}"></script>
    <script>
    $(function () {
        $('#search-button').click(function(){
            var search = $('#search-value').val();
            if (search == null || search == ""){
                window.location.href="family-management";
            } else {
                window.location.href="family-management?search="+search;
            }
        });
        $('#sorting-table').DataTable( {
            "dom": '<"toolbar">frtip',
            "ordering": false,
            "info":     false,
            "paging":     false,
            "searching":     false,
        } );
    });
    </script>
@endsection
