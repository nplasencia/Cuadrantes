<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">

    <!-- Metis core stylesheet -->
    {!! Html::style('assets/css/main.min.css') !!}
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
                    Introduce tu usuario y contraseña
                </p>
                <input type="text" name="email" placeholder="Usuario" class="form-control top" value="{{ old('email') }}">
                <input type="password" name="password" placeholder="Contraseña" class="form-control bottom">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Recuérdame
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
            </form>
        </div>
        <div id="forgot" class="tab-pane">
            <form action="#">
                <p class="text-muted text-center">Introduce un email válido</p>
                <input type="email" placeholder="mail@domain.com" class="form-control">
                <br>
                <button class="btn btn-lg btn-danger btn-block" type="submit">Recuperar contraseña</button>
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
            <li> <a class="text-muted" href="#login" data-toggle="tab">Acceso</a>  </li>
            <li> <a class="text-muted" href="#forgot" data-toggle="tab">Recuperar contraseña</a>  </li>
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