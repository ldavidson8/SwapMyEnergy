@extends('layouts.master', [ 'title' => 'Login' ])

@section('main-content')
    <h1>Sign Up</h1>

    <form action="" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label for="email">Email: </label>
            <input class="form-control" type="email" name="email" required="required" />
        </div>
        <div class="form-group">
            <label for="password">Password: </label>
            <input class="form-control" type="password" name="password" required="required" />
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password: </label>
            <input class="form-control" type="password" name="confirm_password" required="required" />
        </div>
        <div class="form-group">
            <input class="form-control" type="submit" value="Sign Up" style="width: auto;" />
        </div>
    </form>
@endsection()