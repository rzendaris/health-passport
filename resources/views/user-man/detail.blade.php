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
                            <img id="blah2" style="margin-bottom:5px;border:solid 1px #c2cad8;" width="150" height="150" src="{{ url('/pictures/'.$data->picture) }}" /><br>
                            <input id="upload-img-2" name="photo" type="file" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" style=" width: 99%; border: solid 1px #c2cbd8; ">
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-5 m-b-10px">
                        <div class="form-group">
                            <label class="form-control-label">Nama :*</label>
                            <input type="text" name="full_name" value="{{ $data->name }}" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Email :*</label>
                            <input type="text" name="email" value="{{ $data->email }}" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-5 m-b-10px">
                        <div class="form-group">
                            <label class="form-control-label">Registered At :</label>
                            <input type="date" name="Registered" value="{{ date('Y-m-d', strtotime($data->created_at)) }}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Birthday :*</label>
                            <input type="date" name="Birthday"  value="{{ $data->eu_birthday }}" class="form-control"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">

            <div class="table-responsive custom--2">
                <div class="row">
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

                        <tr>
                            <td>1</td>
                            <td><a href="#">Ubisoft1</a></td>
                            <td>Game</td>
                            <td>RPG</td>
                            <td>13+</td>
                            <td>3</td>
                            <td>Loremp ipsum</td>
                            <td>Loremp ipsum</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="#">Ubisoft2</a></td>
                            <td>Game</td>
                            <td>RPG</td>
                            <td>13+</td>
                            <td>4</td>
                            <td>Loremp ipsum</td>
                            <td>Loremp ipsum</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="#">Ubisoft3</a></td>
                            <td>Game</td>
                            <td>RPG</td>
                            <td>13+</td>
                            <td>4</td>
                            <td>Loremp ipsum</td>
                            <td>Loremp ipsum</td>
                        </tr>

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
