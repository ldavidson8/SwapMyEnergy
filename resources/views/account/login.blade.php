@extends('layouts.master')

@section('main-content')
    <h1>Login</h1>

    <form action="" method="post">
        @csrf
        <div class="form-group">
            <label for="email">Email: </label>
            <input class="form-control" type="email" name="email" placeholder="Email" required="required" />
        </div>
        <div class="form-group">
            <label for="password">Password: </label>
            <input class="form-control" type="password" name="password" placeholder="Password" required="required" />
        </div>
        <div class="form-group">
            <input class="form-control" type="submit" value="Sign Up" required="required" style="width: auto;" />
        </div>
    </form>
@endsection()