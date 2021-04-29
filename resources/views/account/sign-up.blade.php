@extends('layouts.master', [ 'title' => 'Login' ])

@section('main-content')
    <h1>Sign Up</h1>

    <form action="" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <label for="email">Email: </label>
        <input type="email" name="email" placeholder="Email" required="required" />
        <br />

        <label for="password">Password: </label>
        <input type="password" name="password" placeholder="Password" required="required" />
        <br />

        <label for="password">Confirm Password: </label>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required="required" />
        <br />

        <input type="submit" value="Sign Up" />
    </form>
@endsection()