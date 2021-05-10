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
        .my-account-small-text
        {
            font-size: 15px;
            margin: 0px;
            padding: 0px 0px 8px;
        }
        .my-account-tea-text
        {
            width: 200px;
            max-width: 100%;
            margin: auto;
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



        #my-account-your-details form
        {
            column-width: 400px;
            column-count: 3;
            font-size: 22px;
        }

        #my-account-your-details form .form-group
        {
            display: inline-block;
            width: 100%;
        }

        #my-account-your-details input
        {
            font-size: inherit;
        }


        #my-account-your-plan-graph
        {
            width: 60%;
        }
        #my-account-your-plan-expected-saving
        {
            width: 39%;
            display: inline-block;
        }


        .flex-column-outer
        {
            display: flex;
            flex-flow: column;
            height: 100%;
        }

        .flex-column-fixed-space
        {
            flex: 0 1 200px;
        }
        
        .flex-column-fill-space
        {
            flex: 1 1 auto;
        }
        .my-account-your-plan-bottom-text
        {
            vertical-align: middle;
        }


        @media (max-width: 991px)
        {
            #my-account-column-left
            {
                padding: 20px;
            }
        }
    </style>
@endsection

@section('before-header')
    <div class="full-size full-size-exact-lg container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        {{-- TODO: add noscript element --}}
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
                    <button id="btnYourPlan" class="my-account-blue-button">Your Plan</button>
                    <button id="btnYourDetails" class="my-account-blue-button">Your Details</button>
                    <button id="btnYourOptions" class="my-account-blue-button">Your Options</button>
                </div>
            </div>
            <div id="my-account-column-right" class="col-xl-7 col-lg-6 col-12 flex-grow-1" style="background-color: white;">
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

                <iframe>
                    
                </iframe>
                
                <div id="my-account-your-plan" class="flex-grow-1" style="display: none;">
                    <form method="post" action="{{ route('my account.details') }}">
                        <img id="my-account-your-plan-graph" src="{{ asset('img/my-account/my-account_your-plan_graph.png') }}" style="postion: relative;" />
                        <div id="my-account-your-plan-expected-saving" style="vertical-align: middle; text-align: center;">
                            <p class="my-account-big-bold-text" style="font-size: 27px;">Expected Saving</p>
                            <p class="my-account-big-text" style="font-size: 50px;">&pound;162.25</p>
                            <p class="my-account-small-text">OR</p>
                            <p class="my-account-tea-text">8 extra cups of tea per day to fuel your tea addiction**</p>
                        </div>
                        
                        <div style="position: absolute; bottom: 0px; width: 100%;">
                            <p>*expected usage based on proceeding months and past years data.</p>
                            <p>This may change based on your usage.</p>
                            <p>**this is based on average kettle power usage.</p>
                            <input type="Submit" class="square-blue-button" value="Save Details" style="position: absolute; right: 40px; bottom: 20px;" />
                        </div>

                        {{-- <div class="flex-column-outer">
                            <div class="flex-column-fill-space"></div>
                            <div class="flex-column-fixed-space">
                                <p>Lorem Ipsum</p>
                            </div>
                        </div> --}}
                    </form>
                </div>

                <div id="my-account-your-details" class="flex-grow-1">
                    <p><b>Your Details</b></p>
                    <form method="post" action="{{ route('my account.details') }}">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input id="form_fullName" class="form-control" type="text" name="fullName" value="{{ $user_name }}" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input id="form_email" class="form-control" type="email" name="email" value="{{ $user_email }}" />
                        </div>
                        <div class="form-group">
                            <label for="addressLine1 addressLine2 addressLine3">Address</label>
                            <input id="form_addressLine1" class="form-control" type="text" name="addressLine1" value="{{ $user_addressLine1 }}" />
                            <input id="form_addressLine2" class="form-control" type="text" name="addressLine2" value="{{ $user_addressLine2 }}" />
                            <input id="form_addressLine3" class="form-control" type="text" name="addressLine3" value="{{ $user_addressLine3 }}" />
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input id="form_phoneNumber" class="form-control" type="text" name="phoneNumber" value="{{ $user_phoneNumber }}" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="form_password" class="form-control" type="password" name="password" />
                        </div>
                        <div class="form-group">
                            <label for="old_password">Enter your old password to save</label>
                            <input id="form_old_password" class="form-control" type="password" name="old_password" />
                        </div>
                        <div class="form-group" style="text-align: right;">
                            <input type="submit" class="square-blue-button" value="Save Details" />
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
            var btnYourPlan = $("#btnYourPlan");
            var btnYourDetails = $("#btnYourDetails");
            var btnYourOptions = $("#btnYourOptions");

            btnYourPlan.click(function()
            {
                
            });

            myAccountBlueButtons.click(function()
            {
                thisButton = $(this);
                var selected = thisButton.hasClass("my-account-blue-button-selected");
                
                myAccountBlueButtons.removeClass("my-account-blue-button-selected");
                thisButton.addClass("my-account-blue-button-selected");
            });

            document.getElementById("form_password").value = "";
            document.getElementById("form_old_password").value = "";
        });
    </script>
@endsection