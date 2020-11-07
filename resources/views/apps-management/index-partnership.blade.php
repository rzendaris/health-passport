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
            <h1>Partnership Apps Management</h1>
        </div>
        <a class="float-right btn btn-success pull-right" href="{{ url('apps-management') }}">Regular Apps <i class="fa fa-external-link fa-lg"></i></a>
    </div>
    <hr>
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
                            <th>Type</th>
                            <th>Category</th>
                            <th>Rate</th>
                            <th>Ratings</th>
                            <th>Version</th>
                            <th>Last Update</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($data['apps'] as $apps)
                      <tr>
                          <td>{{ $apps->no }}</td>
                          <td>
                                <img src="{{ url('/apps/'.$apps->app_icon) }}" width="100"/>
                          </td>
                          <td>{{ $apps->name }}</td>
                          <td>{{ $apps->type }}</td>
                          <td>{{ $apps->categories->name }}</td>
                          <td>{{ $apps->rate }}</td>
                          <td>{{ '0' }}</td>
                          <td>{{ $apps->version }}</td>
                          <td>{{ $apps->updated_at }}</td>
                          <td>@if($apps->is_active==0)
                                  {{"Blocked"}}
                                @else
                                  {{"Actived"}}
                                @endif </td>
                          <td class="text-center">
                              <a href="{{ url('detail-apps-management/'.$apps->id) }}"><i class="fa fa-eye fa-lg custom--1"></i></a>
                              <a href="{{ url('edit-apps-partnership/'.$apps->id) }}"><i class="fa fa-pencil fa-lg custom--1"></i></a>
                              @if($apps->is_active==0)
                                <a href="#" data-toggle="modal" data-target="#modal-unbanned-{{$apps->id}}"><i class="fa fa-folder-open fa-lg custom--1"></i></a>
                              @else
                                <a href="#" data-toggle="modal" data-target="#modal-banned-{{$apps->id}}"><i class="fa fa-ban fa-lg custom--1"></i></a>
                              @endif
                              <a href="#" data-toggle="modal" data-target="#modal-delete-{{$apps->id}}"><i class="fa fa-trash fa-lg custom--1"></i></a>
                          </td>
                      </tr>
                      @endforeach


                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>


@foreach($data['apps'] as $apps)
<!-- Modal Delete -->
<div id="modal-delete-{{$apps->id}}" class="modal fade">
    <form method="post" action="{{url('delete-apps')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h2>Warning</h2>
                    <p>Delete data can't be recovery, are you sure?</p>
                </div>
                <input type="hidden" name="id" value="{{ $apps->id }}"/>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success pull-left" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal Banned -->
<div id="modal-banned-{{$apps->id}}" class="modal fade">
    <form method="post" action="{{url('block-apps')}}" enctype="multipart/form-data">
      {{csrf_field()}}
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h2>Warning</h2>
                    <p>Are you sure?</p>
                </div>
                <input type="hidden" name="id" value="{{ $apps->id }}"/>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success pull-left" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="modal-unbanned-{{$apps->id}}" class="modal fade">
    <form method="post" action="{{url('unblock-apps')}}" enctype="multipart/form-data">
      {{csrf_field()}}
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h2>Warning</h2>
                    <p>Are you sure?</p>
                </div>
                <input type="hidden" name="id" value="{{ $apps->id }}"/>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success pull-left" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
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

        $("div.toolbar").html('<a class="float-right btn btn-success" href="{{ url('add-apps-partnership') }}">Tambah</a>');
    });
    </script>
@endsection
