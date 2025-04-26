<header class="header">
    <div class="logo-container">
        <a href="/" class="logo my-0">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/Shymkent_logo.svg/1200px-Shymkent_logo.svg.png" width="50px" height="50px" alt="Eco Shymkent" />
        </a>

        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>

    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        <span class="separator"></span>
    @if(\Illuminate\Support\Facades\Auth::check())
        <div id="userbox" class="userbox">
            <a href="#" data-bs-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="https://cdn.pixabay.com/animation/2022/12/01/17/03/17-03-11-60_512.gif" alt="{{\Illuminate\Support\Facades\Auth::user()->name}}" class="rounded-circle" data-lock-picture="" />
                </figure>
                <div class="profile-info" data-lock-name="{{\Illuminate\Support\Facades\Auth::user()->name}}" data-lock-email="{{\Illuminate\Support\Facades\Auth::user()->email}}">
                    <span class="name">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                    @admin
                    <span class="role">Administrator</span>
                    @endadmin
                    @moder
                    <span class="role">Moderator</span>
                    @endmoder
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled mb-2">
                    <li class="divider"></li>
                    <li>
                        @admin
                            <a role="menuitem" tabindex="-1" href="{{route('admin-dashboard')}}"><i class="bx bx-user-circle"></i> Главная страница</a>
                        @endadmin
                        @moder
                            <a role="menuitem" tabindex="-1" href="{{route('moder-dashboard')}}"><i class="bx bx-user-circle"></i> Главная страница</a>
                        @endmoder
                        @agronom
                        <a role="menuitem" tabindex="-1" href="{{route('agronom-dashboard')}}"><i class="bx bx-user-circle"></i> Главная страница</a>
                        @endagronom
                        @consumer
                        <a role="menuitem" tabindex="-1" href="{{route('consumer-dashboard')}}"><i class="bx bx-user-circle"></i> Главная страница</a>
                        @endconsumer
                        @chef
                        <a role="menuitem" tabindex="-1" href="{{route('chef-dashboard')}}"><i class="bx bx-user-circle"></i> Главная страница</a>
                        @endchef
                        @agronomist
                        <a role="menuitem" tabindex="-1" href="{{route('agronomist-dashboard')}}"><i class="bx bx-user-circle"></i> Главная страница</a>
                        @endagronomist
                        @brigadier
                        <a role="menuitem" tabindex="-1" href="{{route('brigadier-dashboard')}}"><i class="bx bx-user-circle"></i> Главная страница</a>
                        @endbrigadier
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        <button class="px-2 py-1" type="submit" role="menuitem" tabindex="-1" href="{{route('logout')}}"><i class="bx bx-power-off"></i> Выход</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif
    <!-- end: search & user box -->
</header>
