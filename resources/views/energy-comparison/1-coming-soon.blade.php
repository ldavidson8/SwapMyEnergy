@extends('layouts.master')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />
    <style>
        #form-container
        {
            background-color: #f3f2f1;
            border-radius: 35px;
            padding: 50px;
            width: 600px;
            max-width: 100%;
            margin: auto;
            color: #202020;
            text-align: center;
            font-size: 22px;
        }

        #form-container p:last-child
        {
            margin-bottom: 0px;
        }
    </style>
@endsection

@section('before-header')
    <div id="requestCallback" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="row flex-grow-1 no-padding background-image-preston center-content" style="color: #f3f2f1;">
            <div id="form-container">
                <p>Our energy comparison service is coming soon.</p>
                <p>If you would like to swap your energy provider with us, or you have any questions for us, please <a href="{{ route("$mode.contact") }}">contact us</a>.</p>
            </div>
        </div>
@endsection

@section('after-footer')
    </div>
@endsection
