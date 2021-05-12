<?php
    $user_name = "";
    $user_email = "";
    $user_phone_number = "";
    $user_address = "";
    if (isset($user_name))
    {
        if (isset($user["name"])) $user_name = $user["name"];
        if (isset($user["email"])) $user_email = $user["email"];
        if (isset($user["phone_number"])) $user_phone_number = $user["phone_number"];
        if (isset($user["address"])) $user_address = $user["address"];
    }
    if (null !== $request -> old('name')) $user_name = $request -> old('name');
    if (null !== $request -> old('email')) $user_email = $request -> old('email');
    if (null !== $request -> old('phone_number')) $user_phone_number = $request -> old('phone_number');
    if (null !== $request -> old('address')) $user_address = $request -> old('address');
?>

@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/my-account.css') }}" />
    
    <style type="text/css">
        form
        {
            column-width: 400px;
            column-count: 3;
            font-size: 22px;
        }

        form .form-group
        {
            display: inline-block;
            width: 100%;
        }

        input
        {
            font-size: inherit !important;
        }
    </style>
@endsection

@section('before-header')
    <div class="full-size full-size-exact-lg container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr />
        <div id="my-account-outer" class="row flex-grow-1">
            <div id="my-account-column-left" class="col-xl-5 col-lg-6 col-12 my-account-align-content-center">
                <div class="my-account-blue-box-outer">
                    <div class="my-account-blue-box">
                        <p class="my-account-big-bold-text">You are currently paying</p>
                        <p class="my-account-big-bold-text">£228.60</p>
                        <p>A saving of many pounds</p>
                        <p class="my-account-big-text">Ends: 01 Dec 2020</p>
                    </div>

                    <a href="{{ route('my account.plan') }}" class="my-account-blue-button-outer">
                        <button class="my-account-blue-button">Your Plan</button>
                    </a>
                    <a href="{{ route('my account.details') }}" class="my-account-blue-button-outer">
                        <button class="my-account-blue-button my-account-blue-button-selected">Your Details</button>
                    </a>
                    <a href="{{ route('my account.options') }}" class="my-account-blue-button-outer">
                        <button class="my-account-blue-button">Your Options</button>
                    </a>
                </div>
            </div>
            <div id="my-account-column-right" class="col-xl-7 col-lg-6 col-12 flex-grow-1" style="background-color: white;">
                @include('my-account.partials.greeting')
                <p><b>Your Details</b></p>
                @if ($errors -> count() > 0)
                    <div class="alert alert-danger">
                        <ul style="margin-bottom: 0px;">
                            @foreach ($errors -> all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('my account.details') }}" class="form-black">
                    @csrf
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input id="form_full_name" class="form-control" type="text" name="full_name" value="{{ $user_name }}" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="form_email" class="form-control" type="email" name="email" value="{{ $user_email }}" required />
                    </div>
                    <div class="form-group">
                        <label for="addressLine1 addressLine2 addressLine3">Address</label>
                        <textarea id="form_address" class="form-control" name="address" rows="3" required>{{ $user_address }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input id="form_phone_number" class="form-control" type="text" name="phone_number" value="{{ $user_phone_number }}" required />
                    </div>
                    <div class="form-group">
                        <label for="new_password">Change Your Password?</label>
                        <input id="form_new_password" class="form-control" type="password" name="new_password" />
                    </div>
                    <div class="form-group">
                        <label for="password">Enter your existing password to save</label>
                        <input id="form_password" class="form-control" type="password" name="password" required />
                    </div>
                    <div class="form-group" style="text-align: right;">
                        <input type="submit" class="square-blue-button" value="Save Details" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection()