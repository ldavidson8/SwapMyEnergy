@extends('layouts.master')

@section('stylesheets')
    <style>
        .form-group i
        {
            cursor: pointer;
            color: #f3f2f1;
        }
        .input-group-append
        {
            background-color: #202020;
        }

        button.logout-button
        {
            margin: 5px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/password.css') }}" />
@endsection

@section('before-header')
    <div class="d-flex">
        <div id="section01" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
            <hr/>
            <div class="row flex-grow-1 no-padding background-image-wind-turbines background-image-left center-content">
                <div class="container" style="width: 800px; max-width: 100%; text-align: center; background-color: #f3f2f1; border-radius: 35px;">
                    <h1 style="text-align: center;">Are you sure you want to logout?</h1>

                    <p style="margin-bottom: 40px;">
                        <a href="{{ url() -> previous() }}" id="link-back">
                            <button class="btn btn-lg rounded-blue-button logout-button" style="background-color: rgb(41, 172, 41); color: white;">No</button>
                        </a>
                        <a href="{{ route('logout') }}">
                            <button class="btn btn-lg rounded-blue-button logout-button">Yes</button>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script')
    <script>
        $('link-back').click(function(e)
        {
            history.back();
            e.preventDefault();
        });
    </script>
@endsection
