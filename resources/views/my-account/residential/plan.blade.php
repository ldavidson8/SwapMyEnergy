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

    <style>
        #my-account-column-right
        {
            padding: 20px;
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

        #my-account-your-plan-bottom-left
        {
            position: absolute;
            left: 20px;
            right: 20px;
            bottom: 20px;
        }

        
        @media(max-width: 1300px)
        {
            #my-account-your-plan-bottom-left
            {
                position: static;
                padding-top: 30px;
            }
        }

        @media (max-width: 1300px) and (min-width: 992px)
        {
            #my-account-your-plan-graph
            {
                width: 100%;
            }
            #my-account-your-plan-expected-saving
            {
                width: 100%;
                display: block;
                padding-top: 30px;
            }

            #my-account-your-plan-bottom-left
            {
                text-align: center;
            }

            #my-account-your-plan-bottom-left p
            {
                clear: both;
                padding-top: 20px;
                text-align: left;
            }

            #my-account-your-plan-button
            {
                float: none;
            }
        }

        @media (max-width: 750px)
        {
            #my-account-your-plan-graph
            {
                width: 100%;
            }
            #my-account-your-plan-expected-saving
            {
                width: 100%;
                display: block;
                padding-top: 30px;
            }

            #my-account-your-plan-bottom-left
            {
                text-align: center;
            }

            #my-account-your-plan-bottom-left p
            {
                clear: both;
                padding-top: 20px;
                text-align: left;
            }

            #my-account-your-plan-button
            {
                float: none;
            }
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
                        <button class="my-account-blue-button my-account-blue-button-selected">Your Plan</button>
                    </a>
                    <a href="{{ route("residential.my account.details") }}" class="my-account-blue-button-outer">
                        <button class="my-account-blue-button">Your Details</button>
                    </a>
                    <a href="{{ route("residential.my account.options") }}" class="my-account-blue-button-outer">
                        <button class="my-account-blue-button">Your Options</button>
                    </a>
                </div>
            </div>
            <div id="my-account-column-right" class="col-xl-7 col-lg-6 col-12 flex-grow-1" style="background-color: #f3f2f1;">
                @include('my-account.residential.partials.greeting')
                <form method="post" action="{{ route("$mode.my account.plan") }}" class="form-black">
                    @csrf
                    <img id="my-account-your-plan-graph" src="{{ asset('img/my-account/my-account_your-plan_graph.png') }}" />
                    <div id="my-account-your-plan-expected-saving" style="vertical-align: middle; text-align: center;">
                        <p class="my-account-big-bold-text" style="font-size: 27px;">Expected Saving</p>
                        <p class="my-account-big-text" style="font-size: 50px;">&pound;162.25</p>
                        <p class="my-account-small-text">OR</p>
                        <p class="my-account-tea-text">8 extra cups of tea per day to fuel your tea addiction**</p>
                    </div>
                    
                    <div id="my-account-your-plan-bottom-left">
                        <p style="margin-bottom: 0px;">
                            *expected usage based on proceeding months and past years data.<br />
                            This may change based on your usage.<br />
                            **this is based on average kettle power usage.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection()