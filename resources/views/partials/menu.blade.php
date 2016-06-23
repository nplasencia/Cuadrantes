<!-- #menu -->
<ul id="menu" class="bg-dark dker">
    <li class="nav-divider"></li>

    @foreach($items as $routeName => $values)
        <li class="">
            <a href="{{ route($values['link']) }}">
                <i class="{{ $values['icon'] }}"></i>
                <span class="link-title">&nbsp; {{ $routeName }}</span>
            </a>
        </li>
    @endforeach

    <li class="nav-divider"></li>
    <li>
        <a href={{ route('user_profile.resume') }}>
            <i class="fa fa-edit"></i>
            <span class="link-title">&nbsp; Configuración cuenta</span>
        </a>
    </li>

</ul><!-- /#menu -->