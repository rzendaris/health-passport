@extends('panel.master')

@section('css')

<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="content-body-white">
  <div class="page-head">
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
      <div class="text-center">
          <h2>{{ number_format((float)$data['avgrating'], 1, '.', '') }} <i class="fa fa-star"></i></h2>
          <h4>{{ count($data['ratings']) }} Feedbacks</h4>
      </div>
  </div>
    <hr>
    <div class="row">
        <div class="col-md-12">

            <div class="table-responsive custom--2">
                <div class="row custom-position-header">
                    <div class="float-left col-xl-3 col-md-3 col-xs-12 m-b-10px">
                        <input name="name" id="search-value" type="search" value="" placeholder="Search" class="form-control">
                    </div>
                    <div class="float-left col-xl-2 col-md-2 col-xs-12 m-b-10px">
                        <select class="form-control" name="apps" id="apps-value">
                          <option value="">Semua Apps</option>
                          @foreach($data['apps'] as $get)
                                  <option value="{{ $get->id}}">{{ $get->name}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="float-left col-xl-2 col-md-2 col-xs-12 m-b-10px">
                        <select class="form-control" name="rating" id="ratings-value">
                          <option value="">Semua Rating</option>
                          @for($i=1; $i<=5; $i++)
                                  <option value="{{ $i}}">{{ $i }}</option>
                          @endfor
                        </select>
                    </div>
                    <div class="float-left col-xl-3 col-md-3 col-xs-12 m-b-10px">
                        <button type="button" id="search-button" class="btn btn-primary">Cari</button>
                    </div>
                </div>
                <table id="sorting-table" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User Name</th>
                            <th>App Name</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Comment At</th>
                            <th>Reply</th>
                            <th>Reply At</th>
                            <th>Version</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($data['ratings'] as $ratings)
                      <tr>
                          <td>{{ $ratings->no }}</td>
                          <td><a href="#">{{ $ratings->endusers->email }}</a></td>
                          <td><a href="{{ url('detail-apps-dev/'.$ratings->apps_id) }}">{{ $ratings->apps->name }}</a></td>
                          <td>{{ $ratings->ratings }}</td>
                          <td>{{ $ratings->comment }}</td>
                          <td>{{ $ratings->comment_at }}</td>
                          <td>{{ $ratings->reply }}</td>
                          <td>{{ $ratings->reply_at }}</td>
                          <td>{{ $ratings->apps->version }}</td><td>
                          <a href="#" class="btn" data-toggle="modal" data-target="#modal-reply-{{ $ratings->id }}"><i class="fa fa-reply fa-2x custom--1"></i></a>
                          </td>
                      </tr>
                      @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@foreach($data['ratings'] as $ratings)

<div id="modal-reply-{{ $ratings->id }}" class="modal fade">
    <form method="post" action="{{ url('reply-feedbacks')}}" enctype="multipart/form-data">
      {{csrf_field()}}
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h2 style=" margin: auto; "><i class="fa fa-reply"></i> Reply</h2>
                    <p class="text-left">Message :</p>
                    <input type="hidden" name="id" value="{{ $ratings->id }}">
                    <input type="hidden" value="{{ $ratings->apps_id}}" name="apps">
                    <input type="hidden" value="{{ $ratings->apps->name}}" name="apps_name">
                    <input type="hidden" value="{{ $ratings->end_users_id}}" name="to_users_id">
                    <textarea class="form-control" rows="4" name="reply">{{ $ratings->reply }}</textarea>
                </div>
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
            var apps = $('#apps-value').val();
            var ratings = $('#ratings-value').val();
            if ( search == "" &&  apps == "" &&  ratings == ""){
                window.location.href="feedbacks-and-reply";
            }else if (ratings == "" && apps == ""){
              window.location.href="feedbacks-and-reply?search="+search;
            }else if (ratings == "" && search == ""){
              window.location.href="feedbacks-and-reply?apps="+apps;
            }else if (search == "" && apps == ""){
              window.location.href="feedbacks-and-reply?ratings="+ratings;
            }else if (ratings == "" ){
              window.location.href="feedbacks-and-reply?search="+search+"&apps="+apps;
            }else if (apps == "" ){
              window.location.href="feedbacks-and-reply?search="+search+"&ratings="+ratings;
            }else if (search == "" ){
              window.location.href="feedbacks-and-reply?ratings="+ratings+"&apps="+apps;
            } else {
              window.location.href="feedbacks-and-reply?search="+search+"&apps="+apps+"&ratings="+ratings;
            }
        });
        $('#sorting-table').DataTable( {
            "dom": '<"toolbar">frtip',
            "ordering": false,
            "info":     false,
            "paging":     false,
            "searching":     false,
        } );

        $("div.toolbar").html('<br>');
    });
    </script>
@endsection
