@extends('layouts.master')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/result-page.css') }}" />
@endsection

@section('before-header')
    <div id="contact" class="full-size container-fluid d-flex h-100 flex-column background-image-docks background-image-top">
@endsection

@section('main-content')
        <div class="row flex-grow-1 centered-content-white">
            <div>
                <h1>Thank you for applying to be an affiliate.</h1>
                <p>We will contact you soon.</p>
                <a href="{{ route("$mode.home") }}"><button class="big-blue-button" style="width: auto; padding: 8px 15px;">Back to the homepage</button></a>
            </div>
        </div>
@endsection()

@section('after-footer')
    </div>
@endsection