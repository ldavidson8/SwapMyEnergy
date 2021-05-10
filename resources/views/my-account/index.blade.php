<?php
    $user_name = "";
    $user_email = "";
    $user_phoneNumber = "";
    $user_addressLine1 = "";
    $user_addressLine2 = "";
    $user_addressLine3 = "";
    if (isset($user_name))
    {
        if (isset($user["name"])) $user_name = $user["name"];
        if (isset($user["email"])) $user_email = $user["email"];
        if (isset($user["phoneNumber"])) $user_phoneNumber = $user["phoneNumber"];
        if (isset($user["addressLine1"])) $user_addressLine1 = $user["addressLine1"];
        if (isset($user["addressLine2"])) $user_addressLine2 = $user["addressLine2"];
        if (isset($user["addressLine3"])) $user_addressLine3 = $user["addressLine3"];
    }
?>

@extends('layouts.master')

@section('stylesheets')
    <style>
        .my-account-align-content-center
        {
            display: flex;
            align-items: center;
            text-align: center;
        }

        .my-account-blue-box-outer
        {
            width: 500px;
            max-width: 100%;
            margin: auto;
        }
        .my-account-blue-box
        {
            padding: 20px 30px;
            background-color: rgba(0, 194, 203, 0.5);
        }

        .my-account-big-bold-text
        {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 0px;
        }
        .my-account-big-text
        {
            font-size: 28px;
            margin-bottom: 0px;
        }

        .my-account-blue-button
        {
            padding: 15px;
            min-width: 40%;
            border-radius: 10px;
            margin: 25px auto 5px;
            font-weight: 700;
            background-color: #00d2db;
        }
        .my-account-blue-button:first-of-type
        {
            margin-right: 25px;
        }
        .my-account-blue-button:hover
        {
            background-color: #00e6ee;
        }
        .my-account-blue-button-selected,
        .my-account-blue-button-selected:hover
        {
            background-color: white !important;
        }


        #my-account-column-right
        {
            padding: 20px;
        }

        /* TODO: remove if not in use */
        .column-no-padding
        {
            padding: 0px !important;
        }



        #my-account-your-details form
        {
            column-width: 500px;
            column-count: 3;
            /* overflow-y: scroll; */
            height: 100%;
        }

        #my-account-your-details form .form-group
        {
            display: inline-block;
            width: 100%;
        }
    </style>
@endsection

@section('before-header')
    <div class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr />
        <div class="row flex-grow-1">
            <div id="my-account-column-left" class="col-lg-5 col-12 my-account-align-content-center" style="padding: 0px;">
                <div class="my-account-blue-box-outer">
                    <div class="my-account-blue-box">
                        <p class="my-account-big-bold-text">You are currently paying</p>
                        <p class="my-account-big-bold-text">£228.60</p>
                        <p>A saving of many pounds</p>
                        <p class="my-account-big-text">Ends: 01 Dec 2020</p>
                    </div>
                    <button class="my-account-blue-button">Your Plan</button>
                    <button class="my-account-blue-button">Your Details</button>
                    <button class="my-account-blue-button">Your Options</button>
                </div>
            </div>
            <div id="my-account-column-right" class="col-lg-7 col-12 flex-grow-1" style="background-color: white;">
                <h2>
                    <?php $current_hour = date('H'); ?>
                    @if ($current_hour < 12)
                        Morning
                    @elseif ($current_hour < 17)
                        Afternoon
                    @else
                        Evening
                    @endif
                    {{ $user_name }}
                </h2>
                
                <div id="my-account-your-details">
                    <p><b>Your Details</b></p>
                    <form method="post" action="{{ route('my account.details') }}">
                        {{-- TODO: implement columns --}}
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input id="form_fullName" class="form-control" type="text" name="fullName" value="{{ $user_name }}" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input id="form_email" class="form-control" type="text" name="email" value="{{ $user_email }}" />
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input id="form_phoneNumber" class="form-control" type="text" name="phoneNumber" value="{{ $user_phoneNumber }}" />
                        </div>
                        <div class="form-group">
                            <label for="addressLine1 addressLine2 addressLine3">Address</label>
                            <input id="form_addressLine1" class="form-control" type="text" name="addressLine1" value="{{ $user_addressLine1 }}" />
                            <input id="form_addressLine2" class="form-control" type="text" name="addressLine2" value="{{ $user_addressLine2 }}" />
                            <input id="form_addressLine3" class="form-control" type="text" name="addressLine3" value="{{ $user_addressLine3 }}" />
                        </div>
                        <div class="form-group">
                            <label for="password">Text</label>
                            <input id="password" class="form-control" type="text" name="">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script')
    <script>
        $(function()
        {
            var myAccountBlueButtons = $(".my-account-blue-button");

            myAccountBlueButtons.click(function()
            {
                thisButton = $(this);
                var selected = thisButton.hasClass("my-account-blue-button-selected");
                
                myAccountBlueButtons.removeClass("my-account-blue-button-selected");
                thisButton.addClass("my-account-blue-button-selected");
            });
        });
    </script>
@endsection