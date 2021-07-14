@extends('layouts.master')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/result-page.css') }}" />
@endsection

@section('before-header')
    <div id="contact" class="full-size container-fluid d-flex h-100 flex-column background-image-docks">
@endsection

@section('main-content')
        <div class="row flex-grow-1 centered-content-white">
            <div class="container-md" style="background-color: #f3f2f1; border-radius: 35px; padding: 0px 30px 30px;">
                <h1>Thank you for swapping your energy with us.</h1>
                <p>Your reference is: {{ $reference }}</p>
                <p>We will send your application securely to the new energy supplier. They will contact your current supplier to arrange a 'Supply Start Date' usually within the next 21-days. Everything will be handled by the energy suppliers meaning you only need to do something if asked to do so e.g. provide a final meter reading. If you have any questions whatsoever, contact us on {{ env('DATA_CONTACT_PHONE_NUMBER') }} or email <a href="{{ env('DATA_CONTACT_EMAIL') }}">{{ env('DATA_CONTACT_EMAIL') }}</a> and we will be happy to help.</p>
                <a href="{{ route("$mode.home") }}"><button class="big-blue-button" style="width: auto; padding: 8px 15px;">Back to the homepage</button></a>
            </div>
        </div>
    </div>
@endsection()