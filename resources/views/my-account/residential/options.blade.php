<?php
    $user_name = "";
    if (isset($user))
    {
        if (isset($user["name"])) $user_name = $user["name"];
    }
?>

@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/my-account.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/password.css') }}" />

    <style>
        label.checkbox-image
        {
            position: relative;
        }

        label.checkbox-image::before
        {
            background-image: url("{{ asset('img/my-account/no-button.png') }}");
            background-repeat: no-repeat;
            background-size: cover;
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        :checked + label.checkbox-image::before
        {
            background-image: url("{{ asset('img/my-account/yes-button.png') }}");
        }
    </style>
@endsection

@section('before-header')
    <div class="full-size full-size-exact-lg container-fluid d-flex h-100 flex-column background-image-docks">
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
                    
                    <a href="{{ route("residential.my account.plan") }}" class="my-account-blue-button-outer">
                        <button class="my-account-blue-button">Your Plan</button>
                    </a>
                    <a href="{{ route("residential.my account.details") }}" class="my-account-blue-button-outer">
                        <button class="my-account-blue-button">Your Details</button>
                    </a>
                    <a href="{{ route("residential.my account.options") }}" class="my-account-blue-button-outer">
                        <button class="my-account-blue-button my-account-blue-button-selected">Your Options</button>
                    </a>
                </div>
            </div>
            <div id="my-account-column-right" class="col-xl-7 col-lg-6 col-12 flex-grow-1" style="background-color: #f3f2f1;">
                @include('my-account.residential.partials.greeting')
                <p><b>Your Details</b></p>
                <form method="post" aciton="{{ route("$mode.my account.options") }}" class="form-black">
                    @csrf
                    <div class="form-group">
                        <label for="change_plan">Change Plan?</label>
                        <select id="options_change_plan" class="form-control" name="change_plan">
                            <option value="option1">Choice 1 - Details</option>
                        </select>
                    </div>
                    <div class="form-group">
                        Cancel Plan?<br />
                        <input id="options_cancel_plan" class="form-control" type="checkbox" name="cancel_plan" style="display: none;" />
                        <label for="options_cancel_plan" class="checkbox-image">
                            <img height="70" src="{{ asset('img/my-account/no-button.png') }}" style="vertical-align: middle; visibility: hidden;" alt="Button displaying No" />
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Insert Password to confirm <span class="text-danger">*</span></label>
                        <div class="has-float-label pass_show">
                            <input id="options_confirm_password" class="form-control" type="password" name="confirm_password" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="square-blue-button" value="Confirm" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection()

@section('script')
    <script type="text/javascript" src="{{ URL::asset('js/show-hide-password.js') }}" defer="true"></script>
@endsection