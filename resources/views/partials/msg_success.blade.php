@if (Session::has('success'))
    <div class="alert alert-success text-center fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('success') }}
    </div>
@endif
@if(Session::has('info'))
    <div class="alert alert-info fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('info') }}
        @if(Session::has('info_complementary'))
            <br><br>
            <ul>
                @foreach(Session::get('info_complementary') as $infoComplementary)
                    <li>{{ $infoComplementary }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif