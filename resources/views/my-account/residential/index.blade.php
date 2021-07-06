@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/my-account.css') }}" />
@endsection

@section('before-header')
    <div class="full-size full-size-exact-lg container-fluid d-flex h-100 flex-column background-image-docks">
@endsection

@section('main-content')
        <hr />
        <div id="my-account-outer" class="row flex-grow-1">
            <div id="my-account-column-left" class="col-12 my-account-align-content-center">
                <div class="my-account-blue-box-outer">
                    <div class="my-account-blue-box">
                        <p class="my-account-big-bold-text">You are currently paying</p>
                        <p class="my-account-big-bold-text">&pound;228.60</p>
                        <p>A saving of many pounds</p>
                        <p class="my-account-big-text">Ends: 01 Dec 2020</p>
                    </div>
                    
                    <a href="{{ route("residential.my account.plan") }}" class="my-account-blue-button-outer">
                        <button class="my-account-blue-button">Your Plan</button>
                    </a>
                    <a href="{{ route("residential.my account.details") }}" class="my-account-blue-button-outer">
                        <button class="my-account-blue-button">Your Details</button>
                    </a>
                    <a href="{{ route("residential.my account.options") }}" class="my-account-blue-button-outer">
                        <button class="my-account-blue-button">Your Options</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection()