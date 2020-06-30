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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />
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
        <div class="row header-wrap">
          <div class="col-md-2 col-lg-2 col-sm-12 float-md-left float-sm-none">
              <div  class="logo1 center_content">
                  <img src="images/logo.png"  width="100%" alt="" class="img-responsive">
              </div>
          </div>
          <div id="title1" class="col-lg-6 col-md-6 col-sm-12 float-md-left float-sm-none">
              <div id="title_cls1" class="title_cls1 text-md-left text-center">Interview Management</div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 ">
                  <div  class="row" >
                      <div class="col-12 col-md-11">
                          <div class="text-center text-md-right">
                              @if (Session::get('user'))
                                  {{ Session::get('user')->u_name }}
                              @endif
                              <img src="images/user.svg"  class=" " style="width: 50px;margin:0  20px;">
                              <a id="user-logout1" class="user-logout1" href="{{ asset('/logout')}}">Logout</a>
                          </div>
                      </div>
                  </div>
              
          </div>
      </div>
      <div class="row d-block d-lg-none">
        <div class="col-12 ">
                  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                      <a class="navbar-brand" href="#">Menu</a>
                      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                      </button>

                      <div class="navbar-collapse collapse" id="navbarColor03" style="">
                          <ul class="navbar-nav mr-auto">
                              <li class="nav-item {{ (request()->is('interview-management*')) ? 'active' : '' }}">
                                  <a class="nav-link " href="interview-management">Interview Management @if((request()->is('interview-management*'))) <span class="sr-only">(current)</span>@endif</a>
                              </li>
                              <li class="nav-item {{ (request()->is('tech-list*')) ? 'active' : '' }}">
                                  <a class="nav-link " href="tech-list">Skill questions @if((request()->is('tech-list*'))) <span class="sr-only">(current)</span>@endif</a>
                              </li>
                              <li class="nav-item {{ (request()->is('iq-list*')) ? 'active' : '' }}">
                                  <a class="nav-link " href="iq-list">IQ questions @if((request()->is('iq-list*'))) <span class="sr-only">(current)</span>@endif</a>
                              </li>
                              <li class="nav-item {{ (request()->is('result-list*')) ? 'active' : '' }}">
                                  <a class="nav-link " href="result-list">Results @if((request()->is('result-list*'))) <span class="sr-only">(current)</span>@endif</a>
                              </li>
                              <li class="nav-item {{route('adminME')}}">
                                  <a class="nav-link " href="{{route('adminME')}}">Mail/Export</a></li>
                              </li>
                          </ul>

                      </div>
                  </nav>
              </div>
      </div>
    {{--<hr>--}}

    <div class="row">
        <div class="col-2 d-lg-block d-none res-menu">
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
        <div class="col-lg-10">
            <div class="header-index d-block d-md-flex">
                <div class="header-title">
                    <span style="font-weight: bold; padding: 20px 0; display:block">Send Mail/Export</span>
                </div>
            </div>
            <div class="mainexport">
                <div class="card card-default mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="get" id="search_form" action="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="cvno">CV No.</label>
                                                <input type="text" class="form-control" id="in_cvno"  name="in_cvno" value="{{old('in_cvno',$req_arr['in_cvno'])}}" placeholder="CV No.">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
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
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="firstname">First name</label>
                                                <input type="text" class="form-control" id="in_firstname"  name="in_firstname" value="{{old('in_firstname',$req_arr['in_firstname'])}}" placeholder="First name">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="lastname">Last name</label>
                                                <input type="text" class="form-control" id="in_lastname"  name="in_lastname" value="{{old('in_lastname',$req_arr['in_lastname'])}}" placeholder="Last name">
                                            </div>
                                        </div>
                                        {{--<div class="col-12 col-md-4">--}}
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
                                        <div class="col-12 col-md-4">
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
                                        <div class="col-12 col-md-4">
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
                                        <div class="col-12 col-md-4">
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
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="status">Test time from</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="date_from" class="form-control datetimepicker-input" value="{{ old('date_from') }}" id="date_from" data-date-format="DD-MM-YYYY">
                                                    <div class="input-group-append" data-target="#date_from" onclick="$('#date_from').focus();">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="status">Test time to</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="date_to" value="{{ old('date_to') }}" class="form-control datetimepicker-input" id="date_to" data-date-format="DD-MM-YYYY">
                                                    <div class="input-group-append" data-target="#date_from" onclick="$('#date_from').focus();">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
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
                        @if(Session::has('doneMessage'))
                            <div class="alert alert-success" role="alert">{{ Session::get('doneMessage') }}</div>
                        @endif
                        <form method="POST" action="{{route('postadminSentMail')}}" class="form-admin">
                        @csrf
                        <div class="panel panel-success filterable" style="overflow:auto;">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <button name="sent" value="sent" type="submit" class="btn btn-responsive button-alignment btn-primary" style="margin-bottom:7px;" data-toggle="button">Send Mail</button>
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

                            @php
                                function getStatusInterview_lay($status,$status_arr){

                                  $status_res = '';
                                  foreach ($status_arr as $key => $val){
                                      if ($status == $key){
                                          $status_res = $val;
                                      }
                                  }
                                  return $status_res;

                              }
                           function getCVChannel_lay($channel,$channel_arr){
                               $channel_text = '';
                               foreach ($channel_arr as $kcn => $vcn){
                                   if($channel == $kcn){
                                       $channel_text = $vcn;
                                   }
                               }
                               return $channel_text;
                           }
                           function getLanguage_lay($lang,$lang_arr){
                               $lag = '';
                               foreach ($lang_arr as $klg => $vlg){
                                   if($lang == $klg){
                                       $lag = $vlg;
                                   }
                               }
                               return $lag;
                           }
                            @endphp
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
                                            <td>{{ getCVChannel_lay($item->in_cvchannel,$cst_cvchannel) }}</td>
                                            <td>{{$item->in_lastname }}</td>
                                            <td>{{$item->in_firstname }}</td>
                                            <td>{{$item->in_mail }}</td>
                                            <td>{{getLanguage_lay($item->in_language ,$cst_lang)}}</td>
                                            <td>{{$item->in_note }}</td>
                                            <td>{{ getStatusInterview_lay($item->in_status,$cst_status) }}</td>
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
    <script src="{{URL::asset('js/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('frontEnd/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
  
 
<script>
    $(document).ready(function(){
        //
        $("#date_to").datetimepicker({
            format: 'DD-MM-YYYY',
            widgetPositioning:{
                vertical:'bottom'
            },
            useCurrent: false,
        });
        $("#date_from").datetimepicker({
            format: 'DD-MM-YYYY',
            widgetPositioning:{
                vertical:'bottom'
            },
            useCurrent: false,
        });
    });
</script>
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