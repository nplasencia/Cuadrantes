<div class="text-center">
    Bienvenido al software de cuadrantes de la empresa IntercityBus. Estos son los datos de acceso:
    <ul>
        <li>
            Acceso: <a href="{{ $link = url(env('APP_URL')) }}"> {{ $link }} </a>
        </li>
        <li>
            Usuario: {{ $user->email }}
        </li>
        <li>
            Contraseña: {{ $password }}
        </li>
    </ul>
</div>