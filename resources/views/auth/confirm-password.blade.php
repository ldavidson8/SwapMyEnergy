@extends('layouts.master')

@section('main-content')
    <main class="col-md-12">
        <div class="container">
            <h1>Confirm Your Password</h1>

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
                    <form role="form" method="POST" action="{{ route('password.confirm') }}">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" placeholder="Password" name="password" required />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection()