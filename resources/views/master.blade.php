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
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
    <div class="row">
        <div id="logo" class="col-3 logo">
            <img src="images/logo.png"  width="100%" alt="" class="img-responsive">
        </div>
        <div id="title" class="col-4">
        <div id="title_cls" class="title_cls">Interview Management</div>
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
    <hr>

    <div class="row">
        <div class="col-2 res-menu">
          <div class="menu">
            <ul class="menu-left">
              {{--<li><a class="{{ (request()->is('customer*')) ? 'active' : '' }}" href="customer" >顧客管理</a></li>--}}
              {{--<li><a class="{{ (request()->is('sales*')) ? 'active' : '' }}" href="sales" >売上管理</a></li>--}}
              {{--<li><a class="{{ (request()->is('staff*')) ? 'active' : '' }}" href="staff" >スタッフ管理</a></li>--}}
              {{--<li><a class="{{ (request()->is('course*')) ? 'active' : '' }}" href="course">コース管理</a></li>--}}
              <li><a class="{{ (request()->is('interview-management*')) ? 'active' : '' }}" href="interview-management">Interview Management</a></li>
                {{--<li><a class="{{ (request()->is('interManagement*')) ? 'active' : '' }}" href="interManagement">Interview Question</a></li>--}}
            </ul>
          </div>

        </div>
        <div class="col-10">
          <div class="main">
    		    @show
    		    @yield('content')
          </div>
        </div>
    </div>
  </body>
</html>

