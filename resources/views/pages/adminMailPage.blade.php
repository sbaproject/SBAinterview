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
                @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
            <div class="mainexport">
                    <!-- row-->
                    {{Form::open(['route'=>'sendMail', 'method'=>'POST', 'class'=>'sentmail'])}}
                    <div class="row">                    
                        <div class="col-lg-8">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 form-control-label">Gửi đến
                                </label>
                                <div class="col-sm-10">
                                    <div class="box p-a-xs">
                                        {!! Form::textarea('mails', $mails, ['class' => 'form-control', 'rows' => '5', 'required' => 'true']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="title" class="col-sm-2 form-control-label">CC
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="box p-a-xs">
                                            {!! Form::text('mailcc', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label for="title" class="col-sm-2 form-control-label">Tiêu đề mail
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="box p-a-xs">
                                            {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label for="title" class="col-sm-2 form-control-label">Nội dung mail
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="box p-a-xs">
                                            {!! Form::textarea('content', $content, ['id' => 'content','class' => 'form-control']) !!}
                                        </div>
                                    </div>
                            </div>
                            <div class="panel-heading text-center">
                                <button name="sent" value="sent" type="submit" class="btn btn-responsive button-alignment btn-primary">Send Mail</button>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
            </div>
        </div>
    </div>
  </div>
  <script src="{{ URL::asset('/js/jquery-3.4.1.min.js') }}"></script>
  <script src="js/bootstrap.js"></script>
  <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
  <script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
  CKEDITOR.replace( 'content', options);
</script>
</body>
</html>