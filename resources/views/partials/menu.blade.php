<!-- #menu -->
<ul id="menu" class="bg-dark dker">
    <li class="nav-divider"></li>

    @foreach($items as $routeName => $values)
        <li>
            @if(!isset($values['link']))
                <a>
                    <i class="{{ $values['icon'] }}"></i>
                    <span class="link-title">&nbsp; {{ $routeName }}</span>
                    <span class="fa arrow"></span>
                </a>
                <ul>
                    @foreach($values['subMenu'] as $subMenuName => $subMenuLink)
                        <li>
                            <a href="{{ $subMenuLink }}">
                                <i class="fa fa-angle-right"></i>
                                &nbsp; {{ $subMenuName }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <a href="{{ route($values['link']) }}">
                    <i class="{{ $values['icon'] }}"></i>
                    <span class="link-title">&nbsp; {{ $routeName }}</span>
                </a>
            @endif
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