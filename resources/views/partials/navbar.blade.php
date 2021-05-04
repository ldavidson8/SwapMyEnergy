<?php
    if (!isset($navbar_page)) $navbar_page = "";
?>
<nav class="navbar navbar-expand-md navbar-light navbar-outer">
    <div class="container-fluid">
        <a class="navbar-brand navigation-link {{ ($navbar_page == "home") ? 'navigation-link-current-page' : '' }}" href="{{ route('Home') }}">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link navigation-link {{ ($navbar_page == "about") ? 'navigation-link-current-page' : '' }}" href="{{ route('About') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navigation-link {{ ($navbar_page == "my account") ? 'navigation-link-current-page' : '' }}" href="{{ route('My Account') }}">My Account</a>
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
                <div class="d-xs-block d-md-none">
                    @include('partials.navbar-account')
                </div>
            </ul>
        </div>
    </div>

    <div class="collapse navbar-collapse d-xs-none d-md-block">
        @include('partials.navbar-account')
    </div>
</nav>