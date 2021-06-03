<?php
    $mode = (isset($request)) ? $request -> session() -> get('mode', 'business') : 'business';
?>
@extends('layouts.master')
@section('stylesheets')
    <style>
        .map-responsive
        {
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
            height: 0;
            max-width: 100%;
        }

        .map-responsive iframe
        {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }

        @media (min-width: 992px)
        {
            .resp-iframe-lg 
            {
                position: absolute;
                top: 0;
                left: 40;
                width: 600px;
                height: 450px;
                border: 0;
            }
        }
    </style>
@endsection
@section('before-header')
    <div class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr />
        <div class="row flex-grow-1 no-padding background-image-docks">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12 left-column-content row align-content-center no-margin">
                <h1>What We Do</h1>
                <p style="padding-top: 15px;">We provide businesses and people like YOU with the opportunity to save on their energy bills. With our no nonsense approach, what you see is what you get. 
                At Swap My Energy, we give you savings based on facts, not estimates. 
                By finding you a cheaper unique cost you will have the opportunity to save money. 
                The more you use, the more you pay and vice versa. 
                You may end up paying more but that will only happen because you used more, not because the cost of usage is higher.</p>    
            </div>
            <div class="col-xl-6 col-lg-5 col-md-2 d-none d-md-block"></div>
        </div>
    </div>
    <hr/>
    <div class="full-size-50 container-fluid d-flex flex-column">
        <div class="row flex-grow-1 no-padding">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-4 col-lg-5 col-md-8 col-12 left-column-content align-items-center mobile-only-padding-30" style="text-align: left; background-color: transparent;">
                <div>
                    <h2> Our home </h2>
                    <p style="padding-top: 15px;">Preston is in our blood, savings are in our heart.</p>
                    <p style="font-weight: normal;"> Swap My Energy, operated by Znergi Ltd, is run right from the heart of Preston, with our home situated just off Fishergate. We have a small, but passionate team who are dedicated to providing you with the best possible deals for your energy.
                </div>
            </div>
            <div class="col-2 d-lg-none d-block"></div>
            <div class="col-2 d-md-none d-block"></div>
            <div class="col-xl-6 col-lg-6 col-md-12 no-padding center-content">
                <div class="map-responsive">
                    <iframe width="600" height="450" style="border:0;" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/place?q=18%20fox%20street%2C%20preston&key=AIzaSyCSV5ZAUwOLQdr8mz_ALHB5f1q-OlM00EI" align="center" width="100%"></iframe>
                </div>
            </div>
            <div class="col-2 d-md-none d-block"></div>
        </div>
    </div>
    <div class="d-flex flex-column background-image-preston-behind" style="height: 30vw; min-height: 300px;">
        <div class="row flex-grow-1 background-image-preston background-image-bottom preload" sytle="align-content: center;">
            <div class="center-content" style="width: 600px; max-width: 100%; text-align: center">
                <p style="font-weight: bold; font-size: 30px; color: #f3f2f1;">Need Help?</p>
                <a href="{{ route("$mode.contact") }}" class="btn big-blue-button btn-lg" role="button">Contact Us</a>             
            </div>
        </div>
    </div>
    {{-- <div class="full-size-50 container-fluid d-flex flex-column">
        <div class="row flex-grow-1 no-padding" style="background-color: #f3f2f1;">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-4 col-lg-5 col-md-8 col-12 left-column-content align-items-center mobile-only-padding-30" style="text-align: left;">
                <div>
                    <h2> Our team </h2>
                    <p style="padding-top: 15px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
