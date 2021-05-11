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
            <div id="my-account-column-left" class="col-12 my-account-align-content-center">
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
                        <button class="my-account-blue-button">Your Options</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script')
    {{-- <script>
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
    </script> --}}
@endsection