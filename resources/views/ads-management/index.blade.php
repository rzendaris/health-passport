@extends('panel.master')

@section('css')

<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="content-body-white">
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
    <div class="page-head">
        <div class="page-title">
            <h1>Ads Management</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="table-responsive custom--2">
                <div class="row custom-position-header">
                    <div class="float-left col-xl-3 col-md-3 col-xs-8 m-b-10px">
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
                            <th>Picture</th>
                            <th>Name</th>
                            <th class="text-center">Link</th>
                            <th class="text-center">Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($data['ads'] as $ads)
                        <tr>
                            <td>{{ $ads->orders }} </td>
                            <td>
                                  <img src="{{ url('/pictures/'.$ads->picture) }}" width="100"/>
                            </td>
                            <td>{{ $ads->name }}</td>
                            <td class="text-center">{{ $ads->link }}</td>
                            <td>@if($ads->status==0)
                                    {{"Inactived"}}
                                  @else
                                    {{"Actived"}}
                                  @endif </td>
                            <td class="text-right">
                                <a href="#" data-toggle="modal" data-target="#modal-edit-ads-{{ $ads->id }}"><i class="fa fa-pencil fa-lg custom--1"></i></a>
                                <a href="#" data-toggle="modal" data-target="#modal-delete-ads-{{ $ads->id }}"><i class="fa fa-trash fa-lg custom--1"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal Add Ads -->
<div id="modal-add-ads" class="modal fade">
    <form method="post" action="{{url('insert-ads')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h2 style=" margin: auto; ">Create Ads </h2>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 m-b-10px">
                            <div class="form-group">
                                <img id="blah2" style="margin-bottom:5px;border:solid 1px #c2cad8;" width="100%" height="150" src="{{ asset('assets/global/img/no-profile.jpg') }}" /><br>
                                <input id="upload-img-2" name="photo" type="file" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" style=" width: 99%; border: solid 1px #c2cbd8; " required>
                                <p class="text-danger">Max. file size 2 MB</p>
                            </div>
                        </div>
                        <div class="col-md-8 m-b-10px">
                            <div class="form-group text-left">
                                <label class="form-control-label">Name: *</label>
                                <input type="text" name="name" class="form-control" value="" required="">
                            </div>
                            <div class="form-group text-left">
                                <label class="form-control-label">Link: *</label>
                                <input type="text" name="link" class="form-control" value="" required="">
                            </div>
                            <div class="form-group text-left">
                                <label class="form-control-label">Orders: *</label>
                                <select class="form-control" name="orders">
                              @foreach ($data['orders'] as $key )
                              <option value="{{ $key }}">{{ $key }}</option>
                              @endforeach
                                </select>
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
<!-- Modal Edit Ads -->
@foreach($data['ads'] as $ads)
<div id="modal-edit-ads-{{ $ads->id }}" class="modal fade">
    <form method="post" action="{{url('update-ads')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h2 style=" margin: auto; ">Update Ads</h2>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 m-b-10px">
                            <div class="form-group">
                                <img id="blah-{{ $ads->id }}" style="margin-bottom:5px;border:solid 1px #c2cad8;" width="100%" height="150" src="{{ url('/pictures/'.$ads->picture) }}" /><br>
                                <input id="upload-img-2" name="photo" type="file" onchange="document.getElementById('blah-{{ $ads->id }}').src = window.URL.createObjectURL(this.files[0])" style=" width: 99%; border: solid 1px #c2cbd8; ">
                                <p class="text-danger">Max. file size 2 MB</p>
                            </div>
                        </div>
                        <div class="col-md-8 m-b-10px">
                            <div class="form-group text-left">
                                <label class="form-control-label">Name: *</label>
                                <input type="hidden" name="id" class="form-control"  value="{{ $ads->id }}" required="">
                                <input type="text" name="name" class="form-control"  value="{{ $ads->name }}" required="">
                            </div>
                            <div class="form-group text-left">
                                <label class="form-control-label">Link: *</label>
                                <input type="text" name="link" class="form-control"  value="{{ $ads->link }}" required="">
                            </div>
                            <div class="form-group text-left">
                                <label class="form-control-label">Orders: *</label>
                                <select class="form-control" name="orders">

                                  <option value="{{ $ads->orders }}" selected>{{ $ads->orders }}</option>

                                  @foreach ($data['orders'] as $key )
                                  <option value="{{ $key }}">{{ $key }}</option>
                                  @endforeach
                                </select>
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
<!-- Modal Delete Ads -->
<div id="modal-delete-ads-{{ $ads->id }}" class="modal fade">
    <form method="post" action="{{url('delete-ads')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h2>Warning</h2>
                    <p>Are you sure?</p>
                </div>
                <input type="hidden" name="id" value="{{ $ads->id }}"/>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success">Yes</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endforeach

@endsection

@section('myscript')

    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}"></script>
    <script>
    $(function () {
        $('#search-button').click(function(){
            var search = $('#search-value').val();
            if (search == null || search == ""){
                window.location.href="ads-management";
            } else {
                window.location.href="ads-management?search="+search;
            }
        });
        $('#sorting-table').DataTable( {
            "dom": '<"toolbar">frtip',
            "ordering": false,
            "info":     false,
            "paging":     false,
            "searching":     false,
        } );

        $("div.toolbar").html('<a class="float-right btn btn-success" data-toggle="modal" data-target="#modal-add-ads" href="#">Tambah</a>');
    });
    </script>
@endsection
