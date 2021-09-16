<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>{{ (isset($page_title)) ? "$page_title" : 'Swap My Energy' }}</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

    <!-- Hotjar Tracking Code for https://swapmyenergy.co.uk/ -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:2515642,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>

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
        window.cookieconsent.initialise(
        {
            "palette":
            {
                "popup":
                {
                    "background": "#202020",
                    "text": "#f3f2f1"
                },
                "button":
                {
                    "background": "#00d2db",
                    "text": "#202020"
                }
            },
            "theme": "classic",
            "position": "bottom-right",
            "content":
            {
                "message": "This website uses cookies. We use cookies to personalise content and ads, to provide social media features and to analyse our traffic ",
                "href": "https://swapmyenergy.co.uk/cookie-policy"
            }
        });
    </script>
</body>
</html>
