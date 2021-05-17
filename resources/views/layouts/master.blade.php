<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>{{ (isset($page_title)) ? "$page_title" : 'Swap My Energy' }}</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @if (isset($description))
        <meta name="description" content="{{ $description }}" />
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet" />

    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Our Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/site.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    @yield('stylesheets')
    
    <!-- Bootstrap Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <!-- Our Scripts -->
    <script src="{{ asset('js/site.js') }}"></script>

</head>
<body class="{{ $mode }}">
    @yield('before-header')

    <header>
        <a href="{{ ($mode == 'business') ? route('residential.home') : route('business.home') }}" class="mode-switch"></a>
        <a href="{{ ($mode == 'business') ? route('residential.home') : route('business.home') }}">
            <div class="logo-svg mode-switch" width="auto" style="position: relative;">
                <img src="{{ asset('img/header/logo_text.svg') }}" style="position: absolute; left: 8px; top: 0px; width: 85px;" />
                <svg viewBox="142.99 202.403 191.238 88" xmlns="http://www.w3.org/2000/svg" width="43" height="20" style="position: absolute; left: 9px; top: 34px; width: 43px;"><defs><clipPath id="clip1"><path d="M 5.8125 147 L 197.0625 147 L 197.0625 236 L 5.8125 236 Z M 5.8125 147 "/></clipPath></defs><g clip-path="url(#clip1)" clip-rule="nonzero" transform="matrix(1, 0, 0, 1, 137.169662, 55.277882)"><path class="header-switch-animation-item header-switch-switch" style="stroke: none; fill-rule: nonzero; fill-opacity: 1;" d="M 49.644531 235.125 L 153.234375 235.125 C 177.136719 235.125 197.058594 215.527344 197.058594 191.125 C 197.058594 167.125 177.535156 147.125 153.234375 147.125 L 49.644531 147.125 C 25.742188 147.125 5.820312 166.726562 5.820312 191.125 C 5.820312 215.527344 25.34375 235.125 49.644531 235.125 Z M 49.644531 235.125 "/></g></svg>
                <img class="header-switch-animation-item header-switch-1-shadow-left" src="{{ asset('img/header/logo_shadow_left.svg') }}" />
                <img class="header-switch-animation-item header-switch-1-shadow-right" src="{{ asset('img/header/logo_shadow_right.svg') }}" />
                <img class="header-switch-animation-item header-switch-1-slider" src="{{ asset('img/header/logo_slider.svg') }}" />
            </div>
        </a>
        <a href="{{ ($mode == 'business') ? route('residential.home') : route('business.home') }}">
            <div class="mode-switch float-right logo-svg mode-switch" width="auto" style="position: relative; margin: 0px; height: 100px;">
                <svg viewBox="142.99 202.403 191.238 88" xmlns="http://www.w3.org/2000/svg" width="55" height="25" style="position: absolute; left: 10px; top: 38px; width: 55px;"><defs><clipPath id="clip1"><path d="M 5.8125 147 L 197.0625 147 L 197.0625 236 L 5.8125 236 Z M 5.8125 147 "/></clipPath></defs><g clip-path="url(#clip1)" clip-rule="nonzero" transform="matrix(1, 0, 0, 1, 137.169662, 55.277882)"><path class="header-switch-animation-item header-switch-switch" style="stroke: none; fill-rule: nonzero; fill-opacity: 1;" d="M 49.644531 235.125 L 153.234375 235.125 C 177.136719 235.125 197.058594 215.527344 197.058594 191.125 C 197.058594 167.125 177.535156 147.125 153.234375 147.125 L 49.644531 147.125 C 25.742188 147.125 5.820312 166.726562 5.820312 191.125 C 5.820312 215.527344 25.34375 235.125 49.644531 235.125 Z M 49.644531 235.125 "/></g></svg>
                <img class="header-switch-animation-item header-switch-2-shadow-left" src="{{ asset('img/header/logo_shadow_left.svg') }}" />
                <img class="header-switch-animation-item header-switch-2-shadow-right" src="{{ asset('img/header/logo_shadow_right.svg') }}" />
                <img class="header-switch-animation-item header-switch-2-slider" src="{{ asset('img/header/logo_slider.svg') }}" />
            </div>
            <div class="mode-switch switch-text float-right center-text">
                Switch to<br />
                {{ ($mode == 'business') ? 'Residential' : 'Business' }}<br />
                Mode
            </div>
        </a>
        @include('partials.navbar')
    </header>

    @yield('main-content')

    @include('partials.foooter')
    
    @yield('script')
    <script src="{{ asset('js/site.js') }}"></script>

</body>
</html>
