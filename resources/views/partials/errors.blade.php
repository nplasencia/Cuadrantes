@if (count($errors) > 0)
    <div class="alert alert-danger">
        Por favor, revisa los problemas indicados en la siguiente lista:
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif