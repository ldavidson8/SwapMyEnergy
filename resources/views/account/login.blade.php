@extends('layouts.master')

@section('main-content')
    <h1>Login</h1>

    <div class="row">
    <div class="col-md-6">
        <div class="form-box">
            <div class="form-top">
                <div class="form-top-left">
                    <h3>Login to our site</h3>
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
                <form role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('login-email') ? ' has-error' : '' }}">
                        <input  type="text" class="form-control" placeholder="E-mail Address" name="login-email" value="{{ old('email') }}">
                        @if ($errors->has('login-email'))
                            <span class="help-block">
                                {{ $errors->first('login-email') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('login-password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" name="login-password" placeholder="Password">
                        @if ($errors->has('login-password'))
                            <span class="help-block">
                                {{ $errors->first('login-password') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary btn-lg"><i class="fa fa-sign-in"></i> Sign in!</button>
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
                    <h3>Sign up now</h3>
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
                        <input id="email" type="email" class="form-control" placeholder="E-Mail Address" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success btn-lg"><i class="fa fa-user-plus"></i> Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection()