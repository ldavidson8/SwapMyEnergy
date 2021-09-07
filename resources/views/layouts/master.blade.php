<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>{{ (isset($page_title)) ? "$page_title" : 'Swap My Energy' }}</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @if (isset($description))
        <meta name="description" content="{{ $description }}" />
    @endif

    <link rel="shortcut icon" type="image/jpg" href="{{ asset('favicon.png') }}"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet" />

    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-4.5.2.min.css') }}" />

    <!-- Our Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/site.css') }}" />

    <link rel="preload" href="{{ asset('css/site.preload.css') }}" as="style" onload="this.onload = null; this.rel = 'stylesheet';" />
    <noscript><link rel="stylesheet" href="{{ asset('css/site.preload.css') }}"></noscript>

    <script src="https://kit.fontawesome.com/6e2d0444fe.js" crossorigin="anonymous"></script>
    @yield('stylesheets')

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-4.5.2.min.js') }}" defer="true"></script>
    <!-- Google AdSense Script -->
    <script data-ad-client="ca-pub-7935793974309189" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Google Analytics Script -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5P3KQE148V"></script>
    <script src="{{ URL::asset('js/google-analytics.js') }}"></script>

    <!-- Our Scripts -->
    <script type="text/javascript" src="{{ URL::asset('js/intersection-observer-api.js') }}"></script>

    <!-- Cookie consent banner -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
</head>
<body class="{{ (isset($navbar_page) && in_array($navbar_page, [ 'connections', 'payment-solutions', 'business-water' ])) ? 'business' : $mode }}">
    @yield('before-header')

    @auth
        <div style="text-align: center; background-color: #202020; color: white; position: sticky; top: 0; z-index: 20;">Hello {{ Auth::user() -> name }}. You are logged in.</div>
    @endauth

    <header>
        <a aria-hidden="false" tabindex="-1" href="{{ ($mode == 'business') ? route('residential.home') : route('business.home') }}" class="mode-switch"></a>

        <div class="logo-svg" width="auto" style="position: relative;">
            <a href="{{ route("$mode.home") }}">
                <img alt="Swap My Energy Logo" src="{{ asset('img/header/logo_text.svg') }}" style="position: absolute; left: 8px; top: 0px; width: 85px;" />
            </a>
            <a aria-hidden="false" tabindex="-1" alt="Change Website Mode" href="{{ ($mode == 'business') ? route('residential.home') : route('business.home') }}" class="mode-switch">
                <svg aria-hidden="true" viewBox="142.99 202.403 191.238 88" xmlns="http://www.w3.org/2000/svg" width="43" height="20" style="position: absolute; left: 9px; top: 34px; width: 43px;"><defs><clipPath id="clip1"><path d="M 5.8125 147 L 197.0625 147 L 197.0625 236 L 5.8125 236 Z M 5.8125 147 "/></clipPath></defs><g clip-path="url(#clip1)" clip-rule="nonzero" transform="matrix(1, 0, 0, 1, 137.169662, 55.277882)"><path class="header-switch-animation-item header-switch-switch" style="stroke: none; fill-rule: nonzero; fill-opacity: 1;" d="M 49.644531 235.125 L 153.234375 235.125 C 177.136719 235.125 197.058594 215.527344 197.058594 191.125 C 197.058594 167.125 177.535156 147.125 153.234375 147.125 L 49.644531 147.125 C 25.742188 147.125 5.820312 166.726562 5.820312 191.125 C 5.820312 215.527344 25.34375 235.125 49.644531 235.125 Z M 49.644531 235.125 "/></g></svg>
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-1-shadow-left" src="{{ asset('img/header/logo_shadow_left.svg') }}" />
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-1-shadow-right" src="{{ asset('img/header/logo_shadow_right.svg') }}" />
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-1-slider" src="{{ asset('img/header/logo_slider.svg') }}" />
            </a>
        </div>
        <a href="{{ ($mode == 'business') ? route('residential.home') : route('business.home') }}">
            <div class="mode-switch float-right logo-svg" width="auto" style="position: relative; margin: 0px; height: 100px;">
                <svg aria-hidden="true" viewBox="142.99 202.403 191.238 88" xmlns="http://www.w3.org/2000/svg" width="55" height="25" style="position: absolute; left: 10px; top: 38px; width: 55px;"><defs><clipPath id="clip1"><path d="M 5.8125 147 L 197.0625 147 L 197.0625 236 L 5.8125 236 Z M 5.8125 147 "/></clipPath></defs><g clip-path="url(#clip1)" clip-rule="nonzero" transform="matrix(1, 0, 0, 1, 137.169662, 55.277882)"><path class="header-switch-animation-item header-switch-switch" style="stroke: none; fill-rule: nonzero; fill-opacity: 1;" d="M 49.644531 235.125 L 153.234375 235.125 C 177.136719 235.125 197.058594 215.527344 197.058594 191.125 C 197.058594 167.125 177.535156 147.125 153.234375 147.125 L 49.644531 147.125 C 25.742188 147.125 5.820312 166.726562 5.820312 191.125 C 5.820312 215.527344 25.34375 235.125 49.644531 235.125 Z M 49.644531 235.125 "/></g></svg>
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-2-shadow-left" src="{{ asset('img/header/logo_shadow_left.svg') }}" />
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-2-shadow-right" src="{{ asset('img/header/logo_shadow_right.svg') }}" />
                <img aria-hidden="true" alt="" class="header-switch-animation-item header-switch-2-slider" src="{{ asset('img/header/logo_slider.svg') }}" />
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

    @yield('after-footer')

    <!-- Scripts -->
    @yield('script')
    <script src="{{ asset('js/site.js') }}" defer="true"></script>
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
    <script>
    window.cookieconsent.initialise({
    "palette": {
        "popup": {
        "background": "#202020",
        "text": "#f3f2f1"
        },
        "button": {
        "background": "#00d2db",
        "text": "#202020"
        }
    },
    "theme": "classic",
    "position": "bottom-right",
    "content": {
        "message": "This website uses cookies. We use cookies to personalise content and ads, to provide social media features and to analyse our traffic ",
        "href": "https://swapmyenergy.co.uk/cookie-policy"
    }
    });
    </script>
</body>
</html>
