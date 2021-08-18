@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/result-page.css') }}" />
@endsection

@section('before-header')
    <div class="d-flex">
        <div id="contact" class="full-size container-fluid d-flex h-100 flex-column background-image-docks">
@endsection

@section('main-content')
            <div class="d-flex flex-grow-1 centered-content-white">
                <div>
                    <div class="container-md" style="background-color: #f3f2f1; border-radius: 35px; padding: 1px 30px 30px;">
                        <h1>You are now logged in.</h1>
                        <p><a href="{{ route('change-password') }}">Change Password?</a></p>
                        <a href="{{ route('residential.energy-comparison.1-address') }}">
                            <button class="big-blue-button" style="width: auto; padding: 8px 15px;">Energy Comparison Form</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
