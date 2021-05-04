<ul class="navbar-nav mr-auto">
    @auth
        <li class="nav-item">
            <a class="nav-link navigation-link">
                <?php $current_hour = date('H'); ?>
                @if ($current_hour < 12)
                    Good&nbsp;Morning
                @elseif ($current_hour < 17)
                    Good&nbsp;Afternoon
                @else
                    Good&nbsp;Evening
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link navigation-link" href="{{ route('logout') }}">Logout</a>
        </li>
    @endauth
    @guest
        <li class="nav-item"><a class="navigation-link {{ ($navbar_page == "login") ? 'navigation-link-current-page' : '' }}" href="{{ route('login') }}">Login</a></li>
    @endguest
</ul>