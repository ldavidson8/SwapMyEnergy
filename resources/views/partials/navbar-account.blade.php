<ul class="navbar-nav mr-auto">
    @auth
        <li class="nav-item">
            <a class="nav-link navigation-link" href="{{ route('logout') }}">Logout</a>
        </li>
    @endauth
    @guest
        <li class="nav-item"><a class="navigation-link {{ ($navbar_page == "login") ? 'navigation-link-current-page' : '' }}" href="{{ route('login') }}">Login/Register</a></li>
    @endguest
</ul>