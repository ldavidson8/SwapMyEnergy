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
                        <h1>Thank you for raising a support request</h1>
                        <p>Your reference number is {{ $ticket }}.</p>
                        <p>We will contact you soon.</p>
                        <a href="{{ route("$mode.contact") }}"><button class="big-blue-button" style="width: auto; padding: 8px 15px;">Back to the Contact page</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
