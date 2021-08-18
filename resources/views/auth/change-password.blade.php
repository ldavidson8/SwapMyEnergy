@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/password.css') }}" />
@endsection

@section('main-content')
    <main class="col-md-12">
        <div class="container">
            <h1>Change Your Password</h1>
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
                    <form role="form" method="POST" action="{{ route('change-password') }}" class="form-black">
                        {{ csrf_field() }}

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
                            <input type="submit" class="btn btn-lg" value="Change Password" />
                        </div>
                    </form>
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
