<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SentMail/Export</title>

    <!-- master CSS -->
    <link href="css/master.css" rel="stylesheet">
    <link href="{{URL::asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="css/datatable/dataTables.bootstrap.css" rel="stylesheet">
    <style>
        .mainexport {
            margin: 30px 0;
        }
        .dataTables_paginate ul.pagination li a {
            color: #6c757d;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: #dee2e6;
            margin-left: 0;
            border-top-left-radius: .25rem;
            border-bottom-left-radius: .25rem;
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
        li.paginate_button.active a {
            z-index: 3;
            color: #fff !important;
            background-color: #007bff !important;
            border-color: #007bff !important;
        }
    </style>
</head>
<body>
{{--@section('menu')--}}
  <div class="container-fluid">
    <div class="row header-br">
        <div id="logo" class="col-2 logo">
            <img src="images/logo.png"  width="100%" alt="" class="img-responsive">
        </div>
        <div id="title" class="col-4">
        <div id="title_cls" class="title_cls">Sent Mail / Export Excel</div>
        </div>
        <div id="username" class="col-3">
            <div id="user-name" class="user-name">
            @if (Session::get('user'))
            {{ Session::get('user')->u_name }}
            @endif
        </div>
        </div>
        <div id="user-img" class="col-1">
            <img src="images/user.svg"  class="img-responsive icon-user clswidthimg">
        </div>
        <a id="user-logout" class="user-logout" href="{{ asset('/logout')}}">Logout</a>
        <!-- <div class="col-1">
          <a class="user-logout" href="{{ asset('/logout')}}">Logout</a>
        </div> -->
  	</div>
    {{--<hr>--}}

    <div class="row">
        <div class="col-2 res-menu">
          <div class="menu">
            <ul class="menu-left">
                <li><a class="{{ (request()->is('interview-management*')) ? 'active' : '' }}" href="interview-management">Interview Management</a></li>
                <li><a class="{{ (request()->is('tech-list*')) ? 'active' : '' }}" href="tech-list">Skill questions</a></li>
                <li><a class="{{ (request()->is('iq-list*')) ? 'active' : '' }}" href="iq-list">IQ questions</a></li>
                <li><a class="{{ (request()->is('result-list*')) ? 'active' : '' }}" href="result-list">Results</a></li>
                <li><a class="active" href="{{route('adminME')}}">Mail/Export</a></li>
            </ul>
          </div>

        </div>
        <div class="col-10">
          <div class="mainexport">
                <div class="card card-default mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="get" id="search_form" action="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="cvno">CV No.</label>
                                                <input type="text" class="form-control" id="in_cvno"  name="in_cvno" value="{{old('in_cvno',$req_arr['in_cvno'])}}" placeholder="CV No.">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="language">CV channel</label>
                                                <select class="form-control" name="in_cvchannel" >
                                                    <option value="0" >Please choose CV channel</option>
                                                    @foreach($cst_cvchannel As $k1 => $v1){
                                                    <option value="{{$k1}}" {{ old('in_cvchannel',$req_arr['in_cvchannel']) == $k1 ? "selected"  : "" }}>{{$v1}}</option>
                                                    }
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="firstname">First name</label>
                                                <input type="text" class="form-control" id="in_firstname"  name="in_firstname" value="{{old('in_firstname',$req_arr['in_firstname'])}}" placeholder="First name">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="lastname">Last name</label>
                                                <input type="text" class="form-control" id="in_lastname"  name="in_lastname" value="{{old('in_lastname',$req_arr['in_lastname'])}}" placeholder="Last name">
                                            </div>
                                        </div>
                                        {{--<div class="col-4">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label for="tel">Tel</label>--}}
                                                {{--<input type="text" class="form-control {{ ($errors->first('in_tel')) ? 'is-invalid'  :'' }}" id="in_tel" name="in_tel" value="{{old('in_tel',$req_arr['in_tel'])}}" placeholder="Tel">--}}
                                                {{--<div class="invalid-feedback">--}}
                                                    {{--@error('in_tel')--}}
                                                    {{--{{ $message }}--}}
                                                    {{--@enderror--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="mail">Mail</label>
                                                <input type="text" class="form-control {{ ($errors->first('in_mail')) ? 'is-invalid'  :'' }}" id="in_mail" name="in_mail" value="{{old('in_mail',$req_arr['in_mail'])}}"  placeholder="Mail">
                                                <div class="invalid-feedback">
                                                    @error('in_mail')
                                                    {{ $message }}
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="language">Skill</label>
                                                <select class="form-control" name="in_language" >
                                                    <option value="0" >Please choose skill</option>
                                                    @foreach($cst_lang As $k => $v){
                                                    <option value="{{$k}}" {{ old('in_language',$req_arr['in_language']) == $k ? "selected"  : "" }}>{{$v}}</option>
                                                    }
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">


                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="in_status" >
                                                    <option value="0" >Please choose a status</option>
                                                    @foreach($cst_status As $k2 => $v2){
                                                    <option value="{{$k2}}" {{ old('in_status',$req_arr['in_status']) == $k2 ? "selected"  : "" }}>{{$v2}}</option>
                                                    }
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" name="submit" class="btn btn-primary">Search</button>
                                            <a role="button" href="{{url('interview-management')}}" class="btn btn-secondary btn-form" >Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row-->
                <div class="row">
                    <div class="col-lg-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{route('postadminSentMail')}}" class="form-admin">
                        @csrf
                        <div class="panel panel-success filterable" style="overflow:auto;">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <button name="sent" value="sent" type="submit" class="btn btn-responsive button-alignment btn-primary" style="margin-bottom:7px;" data-toggle="button">Sent Mail</button>
                                <button name="export" value="export" type="submit" class="btn btn-responsive button-alignment btn-primary" style="margin-bottom:7px;" data-toggle="button">Export</button>
                                </h3>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table table-striped table-bordered" id="table2">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="ui-check m-a-0">
                                                    <input type="checkbox" id="selectAll" />
                                                    <input type="hidden" id="seletitem" name="seletitem" >
                                                </label>
                                            </th>
                                            <th>N0.1</th>
                                            <th>Candidate_id</th>
                                            <th>CV No.</th>
                                            <th>CV Channel</th>
                                            <th>Last name</th>
                                            <th>First name</th>
                                            <th>Mail</th>
                                            <th>Skill</th>
                                            <th>Note</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $cnt = 1; ?>
                                        @foreach($list_interviewers as $item)
                                        <tr>
                                            <td>
                                                <label class="ui-check m-a-0">    
                                                    <input type="checkbox" class="itemcheck" value="{{$item->in_id}}" />
                                                </label>
                                            </td>
                                            <td>{{$cnt}}</td>
                                            <td>{{$item->in_id }}</td>
                                            <td>{{$item->in_cvno }}</td>
                                            <td>{{$item->in_cvchannel }}</td>
                                            <td>{{$item->in_lastname }}</td>
                                            <td>{{$item->in_firstname }}</td>
                                            <td>{{$item->in_mail }}</td>
                                            <td></td>
                                            <td>{{$item->in_note }}</td>
                                            <td>{{$item->in_status }}</td>
                                        </tr>  
                                        <?php $cnt++; ?>
                                        @endforeach                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
          </div>
        </div>
    </div>
  </div>
  <script src="{{ URL::asset('/js/jquery-3.4.1.min.js') }}"></script>
  <script src="js/bootstrap.js"></script>
  <script src="css/datatable/jquery.dataTables.js"></script>
  <script src="css/datatable/dataTables.bootstrap.js"></script>
  <script>
    $(document).ready(function() {
        //re-order columns
        var oTable = $('#table2').dataTable({
            responsive:true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
        });
        var allPages = oTable.fnGetNodes();
        var arrall = [];
        $('body').on('click', '#selectAll', function () {
            var all = $('input[type="checkbox"]', allPages);
            if ($(this).hasClass('allChecked')) {
                all.prop('checked', false);
                all.each(function(){
                    arrall = [];
                });
            } else {
                all.prop('checked', true);
                all.each(function(){
                    arrall.push($(this)[0].value);
                });
            }
            $(this).toggleClass('allChecked');
            $('#seletitem').val(arrall);
        });
        //        
        var arr = [];
        oTable.on('click','.itemcheck',function(){
            var all = $('input[type="checkbox"]', allPages);
            all.each(function(){
                if($(this)[0].checked == true){
                    if(arr.indexOf($(this)[0].value) == -1){
                        arr.push($(this)[0].value);
                    }
                }else{
                    if(arr.indexOf($(this)[0].value) != -1){
                        var index = arr.indexOf($(this)[0].value);
                        arr.splice(index,1);
                    }
                }
            })
            $('#seletitem').val(arr);
        });
    });
  </script>
</body>
</html>