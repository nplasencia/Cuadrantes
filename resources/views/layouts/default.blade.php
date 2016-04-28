<!DOCTYPE html>
<html class="no-js">
<head>
    @include('partials.head')
</head>

<body class="  ">
<div class="bg-dark dk" id="wrap">
    <div id="top">
        @include('partials.header')
    </div>
    <div id="left">
        @include('partials.menu_user')

        {{--{!! Html::menu('cuadrantes.menu') !!}--}}
        @include('partials.menu')
    </div>
    <div id="content">
        <div class="outer">
            <div class="inner bg-light lter">
                @yield('content')
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
</body>
</html>