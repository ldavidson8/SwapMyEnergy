<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navigation-link navbar-brand" href="{{ route('Home') }}">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <span class="navigation-link navigation-link-big">
                <?php $current_hour = date('H'); ?>
                @if ($current_hour < 12)
                    Good Morning
                @elseif ($current_hour < 17)
                    Good Afternoon
                @else
                    Good Evening
                @endif
            </span>
            <a class="navigation-link navigation-link-big" href="{{ route('Sign Up') }}">Sign Up</a>
        </div>
    </nav>
</div>
