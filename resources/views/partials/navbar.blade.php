<nav class="navbar navbar-expand-md navbar-light navbar-outer">
    <div class="container-fluid">
        <a class="navbar-brand navigation-link" href="{{ route('Home') }}">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link navigation-link" href="{{ route('About') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navigation-link" href="{{ route('About') }}">My Account</a>
                </li>
                {{-- Dropdown Example
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
                </li> --}}
            </ul>
        </div>
    </div>

    <div id="navbarNavAltMarkup">
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
                    <a class="nav-link navigation-link" href="{{ route('Logout') }}">Logout</a>
                </li>
            @endauth
            @guest
                <a class="navigation-link" href="{{ route('Login') }}">Login</a>
                <a class="navigation-link navigation-link-big" href="{{ route('Sign Up') }}">Sign&nbsp;Up</a>
            @endguest
        </ul>
    </div>
</nav>