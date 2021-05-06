<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>Laravel</title>

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
    @yield('stylesheets')
    
    <!-- Bootstrap Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Our Scripts -->
    <script src="{{ asset('js/site.js') }}"></script>

</head>
<body class="{{ $request -> session() -> get('mode', 'business') }}">
    @yield('before-header')

    <header>
        <img class="mode-switch logo" src="{{ asset('img/logo.png') }}" width="auto" />
        <img class="mode-switch switch float-right" src="{{ asset('img/switch.png') }}" width="auto" />
        <div class="mode-switch switch-text float-right center-text">Switch to<br />Business<br />Mode</div>
        @include('partials.navbar')
    </header>

    @yield('main-content')

    @include('partials.foooter')
    
    @yield('script')

    <script>
        $(document).ready(function()
        {
            var modeSwitchTags = $(".mode-switch");
            modeSwitchTags.click(function()
            {
                $("body").toggleClass("residential business");
            });
        });
    </script>

</body>
</html>
