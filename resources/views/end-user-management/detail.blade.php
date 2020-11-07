@extends('panel.master')

@section('css')

<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="content-body-white">
    <div class="page-head">
        <div class="page-title">
            <h1>Detail End User</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 element">
            <div class="box-pencarian-family-tree" style=" background: #fff; ">
                <div class="row">
                    <div class="col-xl-2 col-md-2 m-b-10px">
                        <div class="form-group">
                            <img id="blah2" style="margin-bottom:5px;border:solid 1px #c2cad8;" width="150" height="150" src="{{ url('/pictures/'.$data['user']->picture) }}" /><br>
                            <!-- <input id="upload-img-2" name="photo" type="file" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" style=" width: 99%; border: solid 1px #c2cbd8; "> -->
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-5 m-b-10px">
                        <div class="form-group">
                            <label class="form-control-label">Nama :*</label>
                            <input type="text" name="full_name" value="{{ $data['user']->name }}" class="form-control" readonly required/>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Email :*</label>
                            <input type="text" name="email" value="{{ $data['user']->email }}" class="form-control" readonly/>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-5 m-b-10px">
                        <div class="form-group">
                            <label class="form-control-label">Registered At :</label>
                            <input type="date" name="Registered" value="{{ date('Y-m-d', strtotime($data['user']->created_at)) }}" class="form-control" readonly/>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Birthday :*</label>
                            <input type="date" name="Birthday"  value="{{ $data['user']->eu_birthday }}" class="form-control" readonly/>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-5 m-b-10px">
                        <div class="form-group">
                            <label class="form-control-label">Android Version :</label>
                            <input type="text" name="Registered" value="{{$data['user']->eu_sdk_version }}" class="form-control" readonly/>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Imei1 :</label>
                            <input type="text" name="Registered" value="{{$data['user']->eu_imei1 }}" class="form-control" readonly/>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-5 m-b-10px">

                      <div class="form-group">
                          <label class="form-control-label">Brand - Model Device :</label>
                          <input type="text" name="Birthday"  value="{{ $data['user']->eu_device_brand }} - {{ $data['user']->eu_device_model}}" class="form-control" readonly/>
                      </div>
                        <div class="form-group">
                            <label class="form-control-label">Imei2 :</label>
                            <input type="text" name="Birthday"  value="{{ $data['user']->eu_imei2 }}" class="form-control" readonly/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">

            <div class="table-responsive custom--2">
                <div class="row">
                    <div class="float-left col-xl-3 col-md-3 col-xs-8 m-b-10px">
                      <input type="hidden" name="id" id="id_app" value="{{ $data['id'] }}">
                      <input name="name" id="search-value" type="search" value="" placeholder="Search" class="form-control">
                    </div>
                    <div class="float-left col-xl-3 col-md-3 col-xs-4 m-b-10px">
                        <button type="button" id="search-button" class="btn btn-primary">Cari</button>
                    </div>
                </div>
                <table id="sorting-table" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>App Name</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Rate</th>
                            <th>Ratings</th>
                            <th>Comment</th>
                            <th>Reply</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($data['ratings'] as $ratings)
                        <tr>
                            <td>{{ $ratings->no}}</td>
                            <td>{{ $ratings->apps->name}}</td>
                            <td>{{ $ratings->apps->type}}</td>
                            <td>{{ $ratings->apps->categories->name}}</td>
                            <td>{{ $ratings->apps->rate}}</td>
                            <td>{{ $ratings->ratings}}</td>
                            <td>{{ $ratings->comment }}</td>
                            <td>{{ $ratings->reply}}</td>
                        </tr>
                      @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12 col-md-12 m-b-10px text-right">
            <a href="{{ url('end-user-management') }}" class="btn btn-danger pull-left">Back</a>
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
          var id = $('#id_app').val();
          if (search == null || search == ""){
              window.location.href="{{ url('detail-end-user') }}/"+id;
          } else {
              window.location.href="{{ url('detail-end-user') }}/"+id+"?search="+search;
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
