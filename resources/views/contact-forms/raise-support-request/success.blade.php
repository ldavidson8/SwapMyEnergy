@extends('layouts.master')
@section('stylesheets')
    <style>
        .centered-content-white
        {
            align-items: center;
            justify-content: center;
            margin: auto;
            height: 400px;
            padding: 20px;
            text-align: center;
        }
    </style>
@endsection

@section('before-header')
    <div id="contact" class="full-size container-fluid d-flex h-100 flex-column background-image-docks background-image-top">
@endsection

@section('main-content')
        <div class="row flex-grow-1 no-padding centered-content-white">
            <div>
                <h1>Thank you for raising a support request</h1>
                <p>Your support ticket is {{ $ticket }}.</p>
                <p>We will contact you soon.</p>
                <a href="{{ route("$mode.contact") }}"><button class="big-blue-button" style="width: auto; padding: 8px 15px;">Back to the Contact page</button></a>
            </div>
        </div>
    </div>
@endsection()