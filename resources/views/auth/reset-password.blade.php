@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/password.css') }}" />
@endsection

@section('main-content')
    <main class="col-md-12">
        <div class="container">
            <h1>Forgot Your Password?</h1>
            <p>Please enter you email address below so we can send you a verification email to reset your password.</p>

            <div class="form-box">
                <div class="form-bottom clearfix">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br /><br />
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form role="form" method="POST" action="{{ route('password.update') }}" class="form-black">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="text" class="form-control" name="token" value="{{ $token }}" onload="this.value = '{{ $token }}'" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input class="form-control" type="email" name="email" value="{{ $email }}" required="required" tabindex="10" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="has-float-label pass_show">
                                <input class="form-control" type="password" id="password" name="password" required tabindex="11" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="has-float-label pass_show">
                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required tabindex="12" />
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="big-blue-button" value="Reset Password" tabindex="13" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection()

@section('script')
    <script type="text/javascript" src="{{ URL::asset('js/show-hide-password.js') }}" defer="true"></script>
@endsection