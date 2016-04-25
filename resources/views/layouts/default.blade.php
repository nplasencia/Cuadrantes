<!DOCTYPE html>
<html class="no-js">
<head>
    @include('includes.head')
</head>

<body class="  ">
<div class="bg-dark dk" id="wrap">
    <div id="top">
        @include('includes.header')
    </div>
    <div id="left">
        @include('includes.left_menu')
    </div>
    <div id="content">
        @yield('content')
    </div>
</div>

@include('includes.footer')
</body>
</html>