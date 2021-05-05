@extends('layouts.master')

@section('main-content')
    <main class="col-md-12">
        <div class="container">
            <h1>Login or Register</h1>

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
                                <div class="alert alert-danger alert-dismissible " style="font-size:15px;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    {{ Session::get('message-login') }}
                                </div>
                            @endif
                            <form role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="email" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}" required />
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required />
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" /> Remember Me
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-lg">Sign in</button>
                                    <br/>
                                    <a class="pull-right" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h2>Sign up now</h2>
                                <p>Fill in the form below to get instant access:</p>
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
                            <form role="form" method="POST" action="{{ url('/register') }}">
                                {{ csrf_field() }}

                                
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control" placeholder="E-Mail Address" name="email" value="{{ old('email') }}" required />
                                </div>

                                <div class="form-group">
                                    <input id="register_password" type="password" class="form-control" name="password" placeholder="Password" oninput="check_pass();" required />
                                </div>

                                <div class="form-group">
                                    <input id="register_password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" oninput="check_pass();" required />
                                </div>

                                <div class="form-group">
                                    <button id="register_submit" type="submit" class="btn btn-block btn-success btn-lg"><i class="fa fa-user-plus"></i> Register</button>
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
@endsection()