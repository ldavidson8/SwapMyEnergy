@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/my-account.css') }}" />
@endsection

@section('before-header')
    <div class="full-size full-size-exact-lg container-fluid d-flex h-100 flex-column background-image-docks">
@endsection

@section('main-content')
        <hr />
        <div class="row flex-grow-1">
            <div class="col-md-1 col-lg-2 d-none d-md-block"></div>
            <div class="col-12 col-md-10 col-lg-8" style="background-color: #f3f2f1;">
                <h1>My Account</h1>
                <p>Please contact us via telephone: (01234567890), or by filling in the form below.</p>
            </div>
            <div class="col-md-1 col-lg-2 d-none d-md-block"></div>
        </div>
    </div>
@endsection()