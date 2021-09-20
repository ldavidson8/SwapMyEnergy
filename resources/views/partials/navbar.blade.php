<?php
    if (!isset($navbar_page)) $navbar_page = "";
?>
<nav class="navbar navbar-expand-lg navbar-light navbar-outer" style="padding: 0; flex-flow: wrap; ms-flex-flow: wrap;">
    <div class="order-1 logo-svg" width="auto" style="position: relative;">
        <a href="{{ route("$mode.home") }}">
            <img alt="Swap My Energy Logo" src="{{ asset('img/header/logo_text.svg') }}" style="position: absolute; left: 8px; top: 0px; width: 85px;" />
        </a>
        @if (!isset($navbar_page) || !in_array($navbar_page, [ 'connections', 'payment-solutions', 'business-water' ]))
            <a aria-hidden="false" tabindex="-1" alt="Change Website Mode" href="{{ ($mode == 'business') ? route('residential.home') : route('business.home') }}" class="mode-switch">
                <svg aria-hidden="true" viewBox="142.99 202.403 191.238 88" xmlns="http://www.w3.org/2000/svg" width="43" height="20" style="position: absolute; left: 9px; top: 34px; width: 43px;"><defs><clipPath id="clip1"><path d="M 5.8125 147 L 197.0625 147 L 197.0625 236 L 5.8125 236 Z M 5.8125 147 "/></clipPath></defs><g clip-path="url(#clip1)" clip-rule="nonzero" transform="matrix(1, 0, 0, 1, 137.169662, 55.277882)"><path class="header-switch-animation-item header-switch-switch" style="stroke: none; fill-rule: nonzero; fill-opacity: 1;" d="M 49.644531 235.125 L 153.234375 235.125 C 177.136719 235.125 197.058594 215.527344 197.058594 191.125 C 197.058594 167.125 177.535156 147.125 153.234375 147.125 L 49.644531 147.125 C 25.742188 147.125 5.820312 166.726562 5.820312 191.125 C 5.820312 215.527344 25.34375 235.125 49.644531 235.125 Z M 49.644531 235.125 "/></g></svg>
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-1-shadow-left" src="{{ asset('img/header/logo_shadow_left.svg') }}" />
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-1-shadow-right" src="{{ asset('img/header/logo_shadow_right.svg') }}" />
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-1-slider" src="{{ asset('img/header/logo_slider.svg') }}" />
            </a>
        @else
            <a aria-hidden="false" tabindex="-1" href="{{ route('business.home') }}">
                <svg aria-hidden="true" viewBox="142.99 202.403 191.238 88" xmlns="http://www.w3.org/2000/svg" width="43" height="20" style="position: absolute; left: 9px; top: 34px; width: 43px;"><defs><clipPath id="clip1"><path d="M 5.8125 147 L 197.0625 147 L 197.0625 236 L 5.8125 236 Z M 5.8125 147 "/></clipPath></defs><g clip-path="url(#clip1)" clip-rule="nonzero" transform="matrix(1, 0, 0, 1, 137.169662, 55.277882)"><path class="header-switch-animation-item header-switch-switch" style="stroke: none; fill-rule: nonzero; fill-opacity: 1;" d="M 49.644531 235.125 L 153.234375 235.125 C 177.136719 235.125 197.058594 215.527344 197.058594 191.125 C 197.058594 167.125 177.535156 147.125 153.234375 147.125 L 49.644531 147.125 C 25.742188 147.125 5.820312 166.726562 5.820312 191.125 C 5.820312 215.527344 25.34375 235.125 49.644531 235.125 Z M 49.644531 235.125 "/></g></svg>
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-1-shadow-left" src="{{ asset('img/header/logo_shadow_left.svg') }}" />
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-1-shadow-right" src="{{ asset('img/header/logo_shadow_right.svg') }}" />
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-1-slider" src="{{ asset('img/header/logo_slider.svg') }}" />
            </a>
        @endif
    </div>
    <div class="order-2 navbar-toggler-button-outer">
        <div style="width: 100%; text-align: left;">
            <span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </span>
        </div>
    </div>
    <div class="order-5 order-lg-2 collapse navbar-collapse" id="navbarSupportedContent" style="margin: 0 !important; flex-grow: 100;">
        <ul class="navbar-nav mr-auto center-content" style="font-size: 22px; margin-left: 30px;">
            <li class="nav-item">
                <a class="nav-link navigation-link {{ ($navbar_page == "home") ? 'navigation-link-current-page' : '' }}" href="{{ route("$mode.home") }}">Home</a>
            </li>
            <div class="d-lg-inline d-none" style="font-weight: 700;">|</div>
            <li class="nav-item">
                <a class="nav-link navigation-link {{ ($navbar_page == "about") ? 'navigation-link-current-page' : '' }}" href="{{ route("$mode.about") }}">About</a>
            </li>
            <div class="d-lg-inline d-none" style="font-weight: 700;">|</div>
            <li class="nav-item">
                <a class="nav-link navigation-link {{ ($navbar_page == "our team") ? 'navigation-link-current-page' : '' }}" href="{{ route("$mode.our-team") }}">Our Team</a>
            </li>
            @if ($mode == "business")
                <div class="d-lg-inline d-none" style="font-weight: 700;">|</div>
                <li class="utilities-desktop nav-item">
                    <a class="nav-link navigation-link {{ ($navbar_page == "connections") ? 'navigation-link-current-page' : '' }}" href="{{ route("connections") }}">New Connections</a>
                </li>
                <div class="utilities-desktop" style="font-weight: 700;">|</div>
                <li class="utilities-desktop nav-item">
                    <a class="nav-link navigation-link {{ ($navbar_page == "payment-solutions") ? 'navigation-link-current-page' : '' }}" href="{{ route("payment-solutions") }}">Payment Solutions</a>
                </li>
                <div class="utilities-desktop" style="font-weight: 700;">|</div>
                <li class="utilities-desktop nav-item">
                    <a class="nav-link navigation-link {{ ($navbar_page == "business-water") ? 'navigation-link-current-page' : '' }}" href="{{ route("business.water") }}">Water</a>
                </li>
            @endif
            {{-- My Account Page
                <div class="d-lg-inline d-none" style="font-weight: 700;">|</div>
                <li class="nav-item">
                    <a class="nav-link navigation-link {{ ($navbar_page == "my account") ? 'navigation-link-current-page' : '' }}" href="{{ route("$mode.my account") }}">My Account</a>
                </li>
            --}}
            @if ($mode == "business")
                <li class="nav-item dropdown utilities-mobile">
                    <a class="nav-link navigation-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Services
                    </a>
                    <div id="nav-dropdown" class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="nav-link navigation-link {{ ($navbar_page == "connections") ? 'navigation-link-current-page' : '' }}" href="{{ route("connections") }}">Connections</a>
                        <a class="nav-link navigation-link {{ ($navbar_page == "payment-solutions") ? 'navigation-link-current-page' : '' }}" href="{{ route("payment-solutions") }}">Payment Solutions</a>
                        <a class="nav-link navigation-link {{ ($navbar_page == "business-water") ? 'navigation-link-current-page' : '' }}" href="{{ route("business.water") }}">Water</a>
                    </div>
                </li>
            @endif
            <div class="d-xs-block d-lg-none">
                @include('partials.navbar-account')
            </div>
            @if (!isset($navbar_page) || !in_array($navbar_page, [ 'connections', 'payment-solutions', 'business-water' ]))
                <a class="navbar-switch-mobile-small" href="{{ ($mode == 'business') ? route('residential.home') : route('business.home') }}">
                    <div class="mode-switch float-right logo-svg" width="auto" style="position: relative; margin: 0px; height: 100px;">
                        <svg aria-hidden="true" viewBox="142.99 202.403 191.238 88" xmlns="http://www.w3.org/2000/svg" width="55" height="25" style="position: absolute; left: 10px; top: 38px; width: 55px;"><defs><clipPath id="clip1"><path d="M 5.8125 147 L 197.0625 147 L 197.0625 236 L 5.8125 236 Z M 5.8125 147 "/></clipPath></defs><g clip-path="url(#clip1)" clip-rule="nonzero" transform="matrix(1, 0, 0, 1, 137.169662, 55.277882)"><path class="header-switch-animation-item header-switch-switch" style="stroke: none; fill-rule: nonzero; fill-opacity: 1;" d="M 49.644531 235.125 L 153.234375 235.125 C 177.136719 235.125 197.058594 215.527344 197.058594 191.125 C 197.058594 167.125 177.535156 147.125 153.234375 147.125 L 49.644531 147.125 C 25.742188 147.125 5.820312 166.726562 5.820312 191.125 C 5.820312 215.527344 25.34375 235.125 49.644531 235.125 Z M 49.644531 235.125 "/></g></svg>
                        <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-2-shadow-left" src="{{ asset('img/header/logo_shadow_left.svg') }}" />
                        <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-2-shadow-right" src="{{ asset('img/header/logo_shadow_right.svg') }}" />
                        <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-2-slider" src="{{ asset('img/header/logo_slider.svg') }}" />
                    </div>
                    <div class="mode-switch switch-text float-right center-text">
                        @if ($mode == 'business')
                            Switch to<br />
                            Residential<br />
                            Energy
                        @else
                            Switch to<br />
                            Business<br />
                            Services
                        @endif
                    </div>
                </a>
            @endif
        </ul>
    </div>
    @if (!isset($navbar_page) || !in_array($navbar_page, [ 'connections', 'payment-solutions', 'business-water' ]))
        <a class="order-4 navbar-switch-mobile-large-to-desktop" href="{{ ($mode == 'business') ? route('residential.home') : route('business.home') }}"">
            <div class="mode-switch float-right logo-svg" width="auto" style="position: relative; margin: 0px; height: 100px;">
                <svg aria-hidden="true" viewBox="142.99 202.403 191.238 88" xmlns="http://www.w3.org/2000/svg" width="55" height="25" style="position: absolute; left: 10px; top: 38px; width: 55px;"><defs><clipPath id="clip1"><path d="M 5.8125 147 L 197.0625 147 L 197.0625 236 L 5.8125 236 Z M 5.8125 147 "/></clipPath></defs><g clip-path="url(#clip1)" clip-rule="nonzero" transform="matrix(1, 0, 0, 1, 137.169662, 55.277882)"><path class="header-switch-animation-item header-switch-switch" style="stroke: none; fill-rule: nonzero; fill-opacity: 1;" d="M 49.644531 235.125 L 153.234375 235.125 C 177.136719 235.125 197.058594 215.527344 197.058594 191.125 C 197.058594 167.125 177.535156 147.125 153.234375 147.125 L 49.644531 147.125 C 25.742188 147.125 5.820312 166.726562 5.820312 191.125 C 5.820312 215.527344 25.34375 235.125 49.644531 235.125 Z M 49.644531 235.125 "/></g></svg>
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-2-shadow-left" src="{{ asset('img/header/logo_shadow_left.svg') }}" />
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-2-shadow-right" src="{{ asset('img/header/logo_shadow_right.svg') }}" />
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-2-slider" src="{{ asset('img/header/logo_slider.svg') }}" />
            </div>
            <div class="mode-switch switch-text float-right center-text">
                @if ($mode == 'business')
                    Switch to<br />
                    Residential<br />
                    Energy
                @else
                    Switch to<br />
                    Business<br />
                    Services
                @endif
            </div>
        </a>
    @endif

    <div class="collapse navbar-collapse d-xs-none d-lg-block">
        @include('partials.navbar-account')
    </div>
</nav>
{{--
<div class="container-fluid d-block d-lg-none">
    <div class="collapse" id="navbarSupportedContent" style="width: 100%; margin: 0 !important;">
        <ul class="navbar-nav mr-auto" style="display: flex; align-items: center; font-size: 22px;">
            @if (!isset($navbar_page) || !in_array($navbar_page, [ 'connections', 'payment-solutions', 'business-water' ]))
                <a class="navbar-switch-mobile-small" href="{{ ($mode == 'business') ? route('residential.home') : route('business.home') }}">
                    <div class="mode-switch float-right logo-svg" width="auto" style="position: relative; margin: 0px; height: 100px;">
                        <svg aria-hidden="true" viewBox="142.99 202.403 191.238 88" xmlns="http://www.w3.org/2000/svg" width="55" height="25" style="position: absolute; left: 10px; top: 38px; width: 55px;"><defs><clipPath id="clip1"><path d="M 5.8125 147 L 197.0625 147 L 197.0625 236 L 5.8125 236 Z M 5.8125 147 "/></clipPath></defs><g clip-path="url(#clip1)" clip-rule="nonzero" transform="matrix(1, 0, 0, 1, 137.169662, 55.277882)"><path class="header-switch-animation-item header-switch-switch" style="stroke: none; fill-rule: nonzero; fill-opacity: 1;" d="M 49.644531 235.125 L 153.234375 235.125 C 177.136719 235.125 197.058594 215.527344 197.058594 191.125 C 197.058594 167.125 177.535156 147.125 153.234375 147.125 L 49.644531 147.125 C 25.742188 147.125 5.820312 166.726562 5.820312 191.125 C 5.820312 215.527344 25.34375 235.125 49.644531 235.125 Z M 49.644531 235.125 "/></g></svg>
                        <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-2-shadow-left" src="{{ asset('img/header/logo_shadow_left.svg') }}" />
                        <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-2-shadow-right" src="{{ asset('img/header/logo_shadow_right.svg') }}" />
                        <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-2-slider" src="{{ asset('img/header/logo_slider.svg') }}" />
                    </div>
                    <div class="mode-switch switch-text float-right center-text">
                        @if ($mode == 'business')
                            Switch to<br />
                            Residential<br />
                            Energy
                        @else
                            Switch to<br />
                            Business<br />
                            Services
                        @endif
                    </div>
                </a>
            @endif
            <li class="nav-item">
                <a class="nav-link navigation-link {{ ($navbar_page == "home") ? 'navigation-link-current-page' : '' }}" href="{{ route("$mode.home") }}">Home</a>
            </li>
            <div class="d-lg-inline d-none" style="font-weight: 700;">|</div>
            <li class="nav-item">
                <a class="nav-link navigation-link {{ ($navbar_page == "about") ? 'navigation-link-current-page' : '' }}" href="{{ route("$mode.about") }}">About</a>
            </li>
            <div class="d-lg-inline d-none" style="font-weight: 700;">|</div>
            <li class="nav-item">
                <a class="nav-link navigation-link {{ ($navbar_page == "our team") ? 'navigation-link-current-page' : '' }}" href="{{ route("$mode.our-team") }}">Our Team</a>
            </li>
            @if ($mode == "business")
                <div class="d-lg-inline d-none" style="font-weight: 700;">|</div>
                <li class="nav-item dropdown utilities-mobile">
                    <a class="nav-link navigation-link dropdown-toggle" href="#" id="mobileServicesDropdown" role="button" data-toggle="mobileServicesDropdown" aria-haspopup="true" aria-expanded="false">
                        Services
                    </a>
                    <div id="nav-dropdown" class="dropdown-menu" aria-labelledby="mobileServicesDropdown">
                        <a class="nav-link navigation-link {{ ($navbar_page == "connections") ? 'navigation-link-current-page' : '' }}" href="{{ route("connections") }}">Connections</a>
                        <a class="nav-link navigation-link {{ ($navbar_page == "payment-solutions") ? 'navigation-link-current-page' : '' }}" href="{{ route("payment-solutions") }}">Payment Solutions</a>
                        <a class="nav-link navigation-link {{ ($navbar_page == "business-water") ? 'navigation-link-current-page' : '' }}" href="{{ route("business.water") }}">Water</a>
                    </div>
                </li>
            @endif
            <div class="d-xs-block d-lg-none">
                @include('partials.navbar-account')
            </div>
        </ul>
    </div>
</div> --}}
