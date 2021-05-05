@extends('layouts.master')

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
                    <form role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" class="form-control" placeholder="Email Address" name="email" required />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection()