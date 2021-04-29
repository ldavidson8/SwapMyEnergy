<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>Laravel</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Our Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/site.css') }}" />
    
    <!-- Bootstrap Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Our Scripts -->
    <script src="{{ asset('js/site.js') }}"></script>

</head>
<body>

    <header>
        <div class="container">
            <h1>Swap My Energy</h1>
        </div>
    </header>

    <main class="col-md-12">
        <div class="container">
            @yield('main-content')
        </div>
    </main>

    <footer>
        <div class="container">
            <p><address>This is the footer.</address></p>
        </div>
    </footer>

</body>
</html>
