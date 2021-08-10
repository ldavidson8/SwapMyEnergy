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
            <h1>Add a Staff Member Login</h1>

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
            <form role="form" method="POST" action="{{ route('register') }}" class="form-black">
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
