<div class="media user-media bg-dark dker">
    <div class="user-media-toggleHover">
        <span class="fa fa-user"></span>
    </div>
    <div class="user-wrapper bg-dark">
        <a class="user-link" href="">
            <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{ asset('assets/img/user.gif') }}">
            {{--<span class="label label-danger user-label">16</span>--}}
        </a>
        <div class="media-body">
            <h5 class="media-heading">{{ Auth::user()->name }}</h5>
            <ul class="list-unstyled user-info">
                <li>{{ Auth::user()->role }}</li>
                <li>Último acceso:
                    <br>
                    <small>
                        <i class="fa fa-calendar"></i>
                        &nbsp;{{ Auth::user()->updated_at->format('d M - H:i') }}
                    </small>
                </li>
            </ul>
        </div>
    </div>
</div>