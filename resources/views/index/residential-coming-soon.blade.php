@extends('layouts.header-only')

@section('stylesheets')
    <style>
        body
        {
            background-color: #202020;
        }

        .background-image-coming-soon
        {
            background-image: url({{ asset('img/background/website_coming_soon.png') }});
            background-origin: border-box;
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center center;
        }
    </style>
@endsection

@section('before-header')
    <div id="requestCallback" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="flex-grow-1 no-padding background-image-coming-soon"></div>
    </div>
@endsection