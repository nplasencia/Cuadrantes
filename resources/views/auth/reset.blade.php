<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset ="UTF-8">
    <meta name = "author" content = "Auret S.L.P.">
    <title>@lang('auth.reset_page_title')</title>
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
        <div id="password_reset" class="tab-pane active">
            <form method="POST" action="{{ route('passwordReset') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">
                @include('partials.errors')
                <p class="text-muted text-center">
                    @lang('auth.reset_title')
                </p>
                <input type="text" name="email" placeholder="@lang('validation.attributes.email')" class="form-control" value="{{ old('email') }}">
                <input type="password" name="password" placeholder="@lang('validation.attributes.password')" class="form-control top">
                <input type="password" name="password_confirmation" placeholder="@lang('validation.attributes.password_confirmation')" class="form-control bottom">

                <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('auth.reset_button')</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>