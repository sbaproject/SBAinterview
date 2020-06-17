<!DOCTYPE html>
<html lang="en">
<head>
    @include('user.includes.head')
    @yield('headInclude')
</head>
<body>
<div id="wrapper">
    <section>
        <iframe src="{{route('postUserTest', $type)}}" id="iframe-test"></iframe>
    </section>
</div>
@include('user.includes.foot')
@yield('footInclude')
</body>
</html>