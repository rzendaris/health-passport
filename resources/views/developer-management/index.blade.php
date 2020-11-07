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
            <h1>Developer Management</h1>
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
                            <th>Profile PIC</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Website</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['user'] as $user)
                        <tr>
                            <td>{{ $user->no }}</td>
                            <td>
                                <img src="{{ url('/pictures/'.$user->picture) }}" width="100" onerror="this.src='{{ env('DEVELOPER_URL') }}/pictures/{{$user->picture}}';"/>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->country }}</td>
                            <td>{{ $user->dev_web }}</td>
                            <td>{{ $user->dev_address }}</td>
                            <td>@if($user->is_blocked==0)
                                    {{"Blocked"}}
                                  @else
                                    {{"Actived"}}
                                  @endif </td>
                            <td class="text-center">
                                <a href="{{ url('detail-developer-management/'.$user->id) }}"><i class="fa fa-eye fa-lg custom--1"></i></a>
                                <a href="{{ url('edit-developer-management/'.$user->id) }}"><i class="fa fa-pencil fa-lg custom--1"></i></a>
                                @if($user->is_blocked==0)
                                  <a href="#" data-toggle="modal" data-target="#modal-unbanned-{{ $user-> id }}"><i class="fa fa-folder-open fa-lg custom--1"></i></a>
                                @else
                                  <a href="#" data-toggle="modal" data-target="#modal-banned-{{ $user-> id }}"><i class="fa fa-ban fa-lg custom--1"></i></a>
                                @endif
                                <a href="#" data-toggle="modal" data-target="#modal-delete-{{ $user-> id }}"><i class="fa fa-trash fa-lg custom--1"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>



    @foreach($data['user'] as $user)
    <!-- Modal Delete -->
    <div id="modal-delete-{{ $user-> id }}" class="modal fade">
        <form method="post" action="{{url('delete-user')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h2>Warning</h2>
                        <p>Delete data can't be recovery, are you sure?</p>
                    </div>
                    <input type="hidden" name="id" value="{{ $user->id }}"/>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success pull-left" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Modal Banned -->
    <div id="modal-banned-{{ $user-> id }}" class="modal fade">
        <form method="post" action="{{url('block-user')}}" enctype="multipart/form-data">
          {{csrf_field()}}
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h2>Warning</h2>
                        <p>Are you sure?</p>
                    </div>
                    <input type="hidden" name="id" value="{{ $user->id }}"/>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success pull-left" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="modal-unbanned-{{ $user-> id }}" class="modal fade">
        <form method="post" action="{{url('unblock-user')}}" enctype="multipart/form-data">
          {{csrf_field()}}
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h2>Warning</h2>
                        <p>Are you sure?</p>
                    </div>
                    <input type="hidden" name="id" value="{{ $user->id }}"/>
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
                window.location.href="developer-management";
            } else {
                window.location.href="developer-management?search="+search;
            }
        });
        $('#sorting-table').DataTable( {
            "dom": '<"toolbar">frtip',
            "ordering": false,
            "info":     false,
            "paging":     false,
            "searching":     false,
        } );

        $("div.toolbar").html('<a class="float-right btn btn-success" href="{{ url('add-developer-management') }}">Tambah</a>');
    });
    </script>
@endsection
