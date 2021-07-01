@extends('layouts.master')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/result-page.css') }}" />
@endsection

@section('before-header')
    <div id="contact" class="full-size container-fluid d-flex h-100 flex-column background-image-docks">
@endsection

@section('main-content')
        <div class="row flex-grow-1 centered-content-white">
            <div>
                <h1>There was a problem processing your callback request</h1>
                <p>Please contact us using the details below.</p>
                <p>
                    Telephone: {{ env('DATA_CONTACT_PHONE_NUMBER') }}<br />
                    Email: {{ env('DATA_CONTACT_EMAIL') }}.
                </p>
                <a href="{{ route("$mode.home") }}"><button class="big-blue-button" style="width: auto; padding: 8px 15px;">Back to the homepage</button></a>
            </div>
        </div>
@endsection()

@section('after-footer')
    </div>
@endsection