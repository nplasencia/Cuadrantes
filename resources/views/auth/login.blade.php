<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset ="UTF-8">
    <meta name = "author" content = "Auret S.L.P.">
    <title>Login Page</title>
    <meta name = "description" content = "">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('partials.favicon')

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="{!! asset('assets/css/main.min.css') !!}">
</head>
<body class="login">
<div class="form-signin">
    <div class="text-center">
        <img src="{{ asset('assets/img/logoIntercity.png') }}" alt="Intercity Bus Logo">
    </div>
    <hr>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
            <form method="POST" action="{{ route('login') }}">
                {!! csrf_field() !!}

                @include('partials.errors')
                <p class="text-muted text-center">
                    @lang('auth.login_title')
                </p>
                <input type="text" name="email" placeholder="@lang('validation.attributes.user')" class="form-control top" value="{{ old('email') }}">
                <input type="password" name="password" placeholder="@lang('validation.attributes.password')" class="form-control bottom">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> @lang('auth.remember_me')
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('auth.enter')</button>
            </form>
        </div>
        <div id="forgot" class="tab-pane">
            <form method="POST" action="{{ route('passwordEmail') }}">
                {!! csrf_field() !!}
                @include('partials.errors')
                <p class="text-muted text-center">
                    @lang('auth.valid_email')
                </p>
                <input name="email" type="email" placeholder="mail@domain.com" class="form-control" value="{{ old('email') }}">
                <br>
                <button class="btn btn-lg btn-danger btn-block" type="submit">@lang('auth.forgotPassword_link')</button>
            </form>
        </div>
        <!--<div id="signup" class="tab-pane">
            <form action="index.html">
                <input type="text" placeholder="Usuario" class="form-control top">
                <input type="email" placeholder="mail@domain.com" class="form-control middle">
                <input type="password" placeholder="contraseña" class="form-control middle">
                <input type="password" placeholder="repite contraseña" class="form-control bottom">
                <button class="btn btn-lg btn-success btn-block" type="submit">Register</button>
            </form>
        </div>-->
    </div>
    <hr>
    <div class="text-center">
        <ul class="list-inline">
            <li> <a class="text-muted" href="#login" data-toggle="tab">@lang('auth.access_link')</a>  </li>
            <li> <a class="text-muted" href="#forgot" data-toggle="tab">@lang('auth.forgotPassword_link')</a>  </li>
            <!--<li> <a class="text-muted" href="#signup" data-toggle="tab">Signup</a>  </li>-->
        </ul>
    </div>
</div>

<!--jQuery -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!--Bootstrap -->
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $('.list-inline li > a').click(function() {
                var activeForm = $(this).attr('href') + ' > form';
                //console.log(activeForm);
                $(activeForm).addClass('animated fadeIn');
                //set timer to 1 seconds, after that, unload the animate animation
                setTimeout(function() {
                    $(activeForm).removeClass('animated fadeIn');
                }, 1000);
            });
        });
    })(jQuery);
</script>
</body>
</html>