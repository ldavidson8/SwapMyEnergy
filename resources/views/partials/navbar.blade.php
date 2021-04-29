<div class="container-fluid navbar-outer">
    <nav class="navbar navbar-expand-lg navbar-light navbar-outer">
        <div class="container-fluid navbar-outer">
            <a class="navigation-link navbar-brand" href="{{ route('Home') }}">Home</a>
            <a class="navigation-link navbar-brand" href="{{ route('About') }}">About</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-outer" id="navbarNavAltMarkup">
            <a class="navigation-link" href="{{ route('Login') }}">Login</a>
            <a class="navigation-link navigation-link-big" href="{{ route('Sign Up') }}">Sign Up</a>
        </div>
    </nav>
</div>
