@if (Session::get('user') == null)
<script type="text/javascript">
    window.location = "{{ url('/login') }}" //if not login -> back to login page
</script>
@endif
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>@yield('title')</title>

    <!-- CSS  -->
    <base href="{{asset('')}}">
      {{--<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">--}}
    <!-- font-awesome CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- master CSS -->
    <link href="css/master.css" rel="stylesheet">
    <!-- sales CSS -->
    <link href="css/sales.css" rel="stylesheet">
    <!-- staff CSS -->
    <link href="css/staff.css" rel="stylesheet">
    <!-- course CSS -->
    <link href="css/course.css" rel="stylesheet">
    <!-- jquery CSS -->
	  <link href="css/jquery-ui.css" rel="stylesheet">
      <!-- sales CSS -->
      <link href="css/sales.css" rel="stylesheet">


	  <!-- JavaScript-->
	  <!-- Jquery 3.4.1 -->
    <script src="js/jquery-3.4.1.min.js"></script>
	  <script src="js/jquery-ui.js"></script>
    <!-- moment JS -->
    <script src="js/moment.min.js"></script>
    <!-- numeraljs -->
    <script src="js/numeral.min.js"></script>
    <!-- Bootstrap JS  -->
    <script src="js/bootstrap.js"></script>
    <!-- Master JS  -->
    {{--<script src="js/app.js"></script>--}}
    <!-- sales JS -->
    {{--<script src="js/sales.js"></script>--}}
      <script src="js/page.js"></script>
    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>


      {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">--}}
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />
      {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>--}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>



  </head>
  <body>
  {{--@section('menu')--}}
  <div class="container-fluid">
      <div class="row header-wrap">
          <div class="col-md-3 col-lg-2 col-sm-12 float-md-left float-sm-none">
              <div  class="logo1 center_content">
                  <img src="images/logo.png"  width="100%" alt="" class="img-responsive">
              </div>
          </div>
          <div id="title1" class="col-lg-6 col-md-5 col-sm-12 float-md-left float-sm-none">
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


    {{--<div class="row header-br">--}}
        {{--<div id="logo" class="col-lg-2 col-md-2 col-sm-12 logo">--}}
            {{--<img src="images/logo.png"  width="100%" alt="" class="img-responsive">--}}
        {{--</div>--}}
        {{--<div id="title" class="col-lg-4 col-md-4 col-sm-12">--}}
        {{--<div id="title_cls" class="title_cls">Interview Management</div>--}}
        {{--</div>--}}
        {{--<div id="username" class="col-3">--}}
            {{--<div id="user-name" class="user-name">--}}
            {{--@if (Session::get('user'))--}}
            {{--{{ Session::get('user')->u_name }}--}}
            {{--@endif--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div id="user-img" class="col-1">--}}
            {{--<img src="images/user.svg"  class="img-responsive icon-user clswidthimg">--}}
        {{--</div>--}}
        {{--<a id="user-logout" class="user-logout" href="{{ asset('/logout')}}">Logout</a>--}}
        {{--<!-- <div class="col-1">--}}
          {{--<a class="user-logout" href="{{ asset('/logout')}}">Logout</a>--}}
        {{--</div> -->--}}
  	{{--</div>--}}
    {{--<hr>--}}

    <div class="row">
        <div class="col-2 d-lg-block d-none res-menu">
          <div class="menu">
            <ul class="menu-left">
                <li><a class="{{ (request()->is('interview-management*')) ? 'active' : '' }}" href="interview-management">Interview Management</a></li>
                <li><a class="{{ (request()->is('tech-list*')) ? 'active' : '' }}" href="tech-list">Skill questions</a></li>
                <li><a class="{{ (request()->is('iq-list*')) ? 'active' : '' }}" href="iq-list">IQ questions</a></li>
                <li><a class="{{ (request()->is('result-list*')) ? 'active' : '' }}" href="result-list">Results</a></li>
                <li><a href="{{route('adminME')}}">Mail/Export</a></li>
            </ul>

          </div>

        </div>
        <div class="col-12 col-lg-10 bg-white">
          <div class="main ml-0 ml-lg-3 p-0 pt-2 p-lg-1">
    		    @show
    		    @yield('content')
          </div>
        </div>
    </div>
  </div>
  </body>
</html>

