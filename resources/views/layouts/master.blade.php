<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>Laravel</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Our Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/site.css') }}" />
    
    <!-- Bootstrap Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Our Scripts -->
    <script src="{{ asset('js/site.js') }}"></script>

</head>
<body>
    <header>
        <div class="col-md-12">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <a class="nav-item nav-link active" href="{{ route('login') }}">Home <span class="sr-only"></span></a>
                        <a class="nav-item nav-link active" href="{{ route('login') }}">Login</a>
                    </div>
                </nav>
            </div>
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
