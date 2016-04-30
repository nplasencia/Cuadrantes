{{--<!-- #menu -->
<ul id="menu" class="bg-dark dker">
    <li class="nav-divider"></li>

    @foreach($items as $routeName => $values)
    <li class="">
        <a href="{{ route($values['link']) }}">
            <i class="{{ $values['icon'] }}"></i>
            <span class="link-title">&nbsp; {{ $routeName }}</span>
            @if(isset($value['items']) && sizeof($values['items'])>0)
                <span class="fa fa-angle-down"></span>
            @endif
        </a>
    </li>
    @endforeach

</ul><!-- /#menu -->
--}}



<!-- #menu -->
<ul id="menu" class="bg-dark dker">
    <!--<li class="nav-header">Menu</li>-->
    <li class="nav-divider"></li>
    <li class="">
        <a href="#">
            <i class="fa fa-dashboard"></i>
            <span class="link-title">&nbsp; Principal</span>
        </a>
    </li>
    <li class="">
        <a href="">
            <i class="fa fa-users "></i>
            <span class="link-title">&nbsp; Conductores</span>
            <span class="fa arrow"></span>
        </a>
    <ul>
        <li>
            <a href="{{ route('driver.create') }}">
                <i class="fa fa-angle-right"></i>
                &nbsp; Nuevo conductor
            </a>
        </li>
        <li>
            <a href="{{ route('driver.all') }}">
                <i class="fa fa-angle-right"></i>
                &nbsp; Todos los conductores
            </a>
         </li>
     </ul>
    </li>
    <li class="">
        <a href="{{ route('bus.all') }}">
            <i class="fa fa-car "></i>
            <span class="link-title">&nbsp; Guaguas</span>
        </a>
    </li>

    <li class="nav-divider"></li>
    <li>
        <a href="#">
            <i class="fa fa-edit"></i>
            <span class="link-title">
                Configuración
            </span>
        </a>
    </li>
</ul><!-- /#menu -->