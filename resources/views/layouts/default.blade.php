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
        <div class="outer">
            <div class="inner bg-light lter">
                @yield('content')
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
</body>
</html>