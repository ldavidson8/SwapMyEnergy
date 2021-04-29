@extends('layouts.master')

@section('main-content')
    <h1>Login</h1>

    <form action="" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <label for="email">Email: </label>
        <input type="email" name="email" placeholder="Email" />
        <br />

        <label for="password">Password: </label>
        <input type="password" name="password" placeholder="Password" />
        <br />

        <input type="submit" value="Sign Up" />
    </form>
@endsection()