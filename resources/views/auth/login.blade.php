@extends('layouts.master')

@section('stylesheets')
    <style>
        .form-group i
        {
            cursor: pointer;
            color: #f3f2f1;
        }
        .input-group-append
        {
            background-color: #202020;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/password.css') }}" />
@endsection

@section('main-content')
    <hr />
    <main class="col-md-12">
        <div class="container" style="width: 800px; max-width: 100%;">
            <h1>Staff Login</h1>

            @if (Session::has('message-login'))
                <div class="alert alert-danger alert-dismissible" style="font-size:15px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background-color: transparent !important;">
                        <span aria-hidden="true" style="background-color: transparent !important;">×</span>
                    </button>
                    {{ Session::get('message-login') }}
                </div>
            @endif
            <form role="form" method="POST" action="{{ route('login') }}" class="form-black">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" placeholder=" " name="email" value="{{ old('email') }}" autofocus required />
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <div class="has-float-label pass_show">
                        <input type="password" class="form-control" name="password" placeholder=" " autocomplete="off" required />
                    </div>
                </div>
                {{-- <div class="form-group">
                    <div class="checkbox">
                        <input type="checkbox" name="remember" />
                        <label for="remember">Remember Me</label>
                    </div>
                </div> --}}
                <div class="form-group">
                    <input type="submit" class="btn btn-block btn-lg" value="Sign in" />
                </div>
                {{--
                    TODO: uncomment when working
                    <p><a href="{{ route('password.request') }}">Forgot YourPassword?</a></p>
                --}}
            </form>
        </div>
    </main>
@endsection()

@section('script')
<script>
    var registerPassword = document.getElementById('register_password');
    var registerConfirmPassword = document.getElementById('register_password_confirmation');
    var registerSubmit = document.getElementById('register_submit');
    function check_pass() {
        if (registerPassword.value == registerConfirmPassword.value) {
            registerSubmit.disabled = false;
        } else {
            registerSubmit.disabled = true;
        }
    }
</script>
<script type="text/javascript" src="{{ URL::asset('js/show-hide-password.js') }}"></script>
@endsection()
