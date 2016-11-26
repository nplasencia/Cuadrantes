<!DOCTYPE html>
<html class="no-js">
    <head>
        @include('partials.head')
        <style>
            @media print {
                div {
                    -webkit-print-color-adjust: exact;
                }
            }
        </style>
    </head>

    <body class="  " onload="window.print();">
        @yield('content')

    </body>
</html>
