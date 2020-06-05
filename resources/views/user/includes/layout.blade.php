<!DOCTYPE html>
<html lang="en">
<head>
    @include('user.includes.head')
    @yield('headInclude')
</head>
<body>
<div id="wrapper">
    <!-- start header -->
    @include('user.includes.header')
            <!-- end header -->

    <!-- Content Section -->
    @yield('content')
            <!-- end of Content Section -->

    <!-- start footer -->
    @include('user.includes.footer')
            <!-- end footer -->
</div>
@include('user.includes.foot')
@yield('footInclude')
</body>
</html>