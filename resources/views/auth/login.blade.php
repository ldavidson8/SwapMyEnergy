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
        <div class="container">
            <h1 style="text-align: center;">Login or Register</h1>
            <br />

            <div class="row">
                <div class="col-md-6">
                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h2>Login to our site</h2>
                                <p>Enter email and password to log on:</p>
                            </div>
                        </div>
                        <div class="form-bottom clearfix">
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
                                <div class="form-group">
                                    <div class="checkbox">
                                        <input type="checkbox" name="remember" /> 
                                        <label for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-block btn-lg" value="Sign in" />
                                    {{-- TODO: uncomment when email system works <br/>
                                    <a class="pull-right" href="{{ route('password.request') }}">Forgot Your Password?</a> --}}
                                </div>
                                <p><a href="{{ route('password.request') }}">Forgot Password?</a></p>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h2>Register now</h2>
                                <p>Fill in the form below to register:</p>
                            </div>
                        </div>
                        <div class="form-bottom">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form role="form" method="POST" action="{{ url('/register') }}" class="form-black">
                                {{ csrf_field() }}
                                
                                <div class="form-group">
                                    <label for="email">Full Name <span class="text-danger">*</span></label>
                                    <input id="register_name" type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address <span class="text-danger">*</span></label>
                                    <input id="register_email" type="email" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="email">Password <span class="text-danger">*</span></label>
                                    <div class="has-float-label pass_show">
                                        <input id="register_password" type="password" class="form-control" name="password" autocomplete="off" placeholder=" " oninput="check_pass();" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Confirm Password <span class="text-danger">*</span></label>
                                    <div class="has-float-label pass_show">
                                        <input id="register_password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder=" " autocomplete="off" oninput="check_pass();" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input id="register_submit" type="submit" class="btn btn-block btn-success btn-lg" value="Register" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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