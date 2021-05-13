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
                        <button class="my-account-blue-button">Your Details</button>
                    </a>
                    <a href="{{ route('my account.options') }}" class="my-account-blue-button-outer">
                        <button class="my-account-blue-button my-account-blue-button-selected">Your Options</button>
                    </a>
                </div>
            </div>
            <div id="my-account-column-right" class="col-xl-7 col-lg-6 col-12 flex-grow-1" style="background-color: #f3f2f1;">
                @include('my-account.partials.greeting')
                <p><b>Your Details</b></p>
                <form method="post" aciton="{{ route('my account.options') }}" class="form-black">
                    @csrf
                    <div class="form-group">
                        <label for="change_plan">Change Plan?</label>
                        <select id="options_change_plan" class="form-control" name="change_plan">
                            <option value="option1">Choice 1 - Details</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cancel Plan?</label><br />
                        <label for="cancel_plan_no">
                            <input id="options_cancel_plan_no" class="form-control" type="checkbox" name="cancel_plan_no" style="display: none;" />
                            <img width="130px" height="72px" src="{{ asset('img/forms/no_button.png') }}" style="vertical-align: middle;" />
                        </label>
                        <div style="vertical-align: middle; font-size: 150px; line-height: 1; display: inline-block;">/</div>
                        <label for="cancel_plan_no">
                            <input id="options_cancel_plan_yes" class="form-control" type="checkbox" name="cancel_plan_yes" style="display: none;" />
                            <img width="130px" height="72px" src="{{ asset('img/forms/yes_button.png') }}" style="vertical-align: middle;" />
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Insert Password to confirm</label>
                        <input id="options_confirm_password" class="form-control" type="password" name="confirm_password" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="square-blue-button" value="Confirm" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection()