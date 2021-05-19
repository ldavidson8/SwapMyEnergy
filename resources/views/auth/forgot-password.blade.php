@extends('layouts.master')

@section('main-content')
    <main class="col-md-12">
        <div class="container">
            <h1>Forgot Your Password?</h1>
            <p>Please enter you email address below so we can send you a verification email to reset your password.</p>

            <div class="form-box">
                <div class="form-bottom clearfix">
                    @if ($success != false)
                        <div class="alert alert-info">
                            <h2>Password Sent</h2>
                            <p>If the email address you provided is correct, an email will be sent to that email address.</p>
                            <p>Please use the link in that email to reset your password.</p>
                        </div>
                    @endif
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
                    <form role="form" method="POST" action="{{ route('password.email') }}" class="form-black">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" class="form-control" placeholder="Email Address" name="email" required="required" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-lg" value="Send" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection()