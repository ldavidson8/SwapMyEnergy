<?php
    if (!isset($navbar_page)) $navbar_page = "";
?>
<nav class="navbar navbar-expand-lg navbar-light navbar-outer">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse mt-5 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" style="display: flex; align-items: center; font-size: 22px;">
                <li class="nav-item">
                    <a class="nav-link navigation-link {{ ($navbar_page == "home") ? 'navigation-link-current-page' : '' }}" href="{{ route("$mode.home") }}">Home</a>
                </li>
                <div class="d-xl-inline d-none" style="font-weight: 700;">|</div>
                <li class="nav-item">
                    <a class="nav-link navigation-link {{ ($navbar_page == "about") ? 'navigation-link-current-page' : '' }}" href="{{ route("$mode.about") }}">About</a>
                </li>
                <div class="d-xl-inline d-none" style="font-weight: 700;">|</div>
                <li class="nav-item">
                    <a class="nav-link navigation-link {{ ($navbar_page == "our team") ? 'navigation-link-current-page' : '' }}" href="{{ route("$mode.our-team") }}">Our Team</a>
                </li>
                <div class="d-xl-inline d-none" style="font-weight: 700;">|</div>
                <li class="nav-item d-none d-xl-inline">
                    <a class="nav-link navigation-link {{ ($navbar_page == "connections") ? 'navigation-link-current-page' : '' }}" href="{{ route("connections") }}">Connections</a>
                </li>
                <div class="d-xl-inline d-none" style="font-weight: 700;">|</div>
                <li class="nav-item d-none d-xl-inline">
                    <a class="nav-link navigation-link {{ ($navbar_page == "payments") ? 'navigation-link-current-page' : '' }}" href="{{ route("payments") }}">Payments</a>
                </li>
                <div class="d-xl-inline d-none" style="font-weight: 700;">|</div>
                <li class="nav-item d-none d-xl-inline">
                    <a class="nav-link navigation-link {{ ($navbar_page == "connections") ? 'navigation-link-current-page' : '' }}" href="{{ route("connections") }}">Water</a>
                </li>
                {{-- My Account Page
                    <div class="d-lg-inline d-none" style="font-weight: 700;">|</div>
                    <li class="nav-item">
                        <a class="nav-link navigation-link {{ ($navbar_page == "my account") ? 'navigation-link-current-page' : '' }}" href="{{ route("$mode.my account") }}">My Account</a>
                    </li>
                --}}
                <li class="nav-item dropdown d-xl-none">
                <a class="nav-link navigation-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Services
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="nav-link navigation-link {{ ($navbar_page == "connections") ? 'navigation-link-current-page' : '' }}" href="{{ route("connections") }}">Connections</a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link navigation-link {{ ($navbar_page == "payments") ? 'navigation-link-current-page' : '' }}" href="{{ route("payments") }}">Payments</a>
                    <a class="nav-link navigation-link {{ ($navbar_page == "connections") ? 'navigation-link-current-page' : '' }}" href="{{ route("connections") }}">Water</a>
                </div>
                </li>
                <div class="d-xs-block d-lg-none">
                    @include('partials.navbar-account')
                </div>
            </ul>
        </div>
    </div>

    <div class="collapse navbar-collapse d-xs-none d-lg-block">
        @include('partials.navbar-account')
    </div>
</nav>
