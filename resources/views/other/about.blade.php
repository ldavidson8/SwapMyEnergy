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

        .rounded-blue-button
        {
            background-color: #00d2db;
            border: none;
            width: 300px;
            border-radius: 18px;
            padding: 12px;
            font-size: 27px;
            font-weight: bold;
            color: #202020;
        }
        

        /* video 
        {
            left: 50%;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
        } */

        @media (min-width: 1200px)
        {
            .lg-padding-content
            {
               padding-top: 50px;
            }
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
        <div class="row flex-grow-1 no-padding background-image-powerline">
            <div class="col-xl-2 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-4 col-lg-6 col-md-8 col-12 center-content no-margin" style="padding: 30px; color: #f3f2f1;">
                <h1>What We Do</h1>
                <p style="padding-top: 30px; width: 450px; max-width: 100%;">We provide businesses and people like YOU with the opportunity to save on their energy bills. With our no-nonsense approach, what you see is what you get. 
                At Swap My Energy, we give you savings based on facts, not estimates. 
                By finding you a unique deal you will have the opportunity to save money and the peace of mind that your energy bill switching is in good hands.
                </p>    
            </div>
            <div class="col-md-2 d-none d-lg-none d-md-block"></div>
            <div class="col-md-2 d-none d-lg-none d-md-block"></div>
            <div class="col-xl-6 col-lg-5 col-md-8 d-none d-md-block center-content" style="text-align: center;">
            </div>
            <div class="col-md-2 d-none d-lg-none d-md-block"></div>
        </div>
    </div>
    <hr/>
        <video width="100%" height="auto" style="margin: auto; max-width: 100%; background: black url('{{ asset('img/Loading-thumbnail.png') }}') center center no-repeat" preload="none" autoplay muted loop>
            <source src="{{ asset('media/sme_mute.mp4') }}" type="video/mp4" />
            <source src="{{ asset('media/sme_mute_mobi.mp4') }}" type="video/mp4 media='(max-width: 991px)'">
        </video>
    <div class="full-size-50 container-fluid d-flex flex-column">
        <div class="row flex-grow-1 no-padding">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-4 col-lg-5 col-md-8 col-12 left-column-content align-items-center mobile-only-padding-30" style="text-align: left; background-color: transparent;">
                <div>
                    <h2 style="font-size: 48px;"> Our home </h2>
                    <p style="padding-top: 15px; font-weight: 700;">Preston is in our blood; savings are in our heart.</p>
                    <p style="font-weight: normal;"> Swap My Energy, operated by Znergi Ltd, is run right from the heart of Preston, with our home situated just off Fishergate. We have a small, but passionate team who will provide you with the best possible deals for your energy. </p>
                    <div class="lg-padding-content">
                        <h3 style="padding-top: 15px; font-size: 30px; font-weight: 700; margin: 0; display:inline "> Find Us Online </h3>
                        <img alt="" src={{ asset('img/click-cursor.png')}}>
                        <p style="font-weight: 700;"> We're on your favourite social media sites! </p>
                        <a href="https://linktr.ee/swapmyenergy" rel="external"><button class="rounded-blue-button" role="button"> FOLLOW US </button></a>
                    </div>
                </div>
            </div>
            <div class="col-2 d-lg-none d-block"></div>
            <div class="col-2 d-md-none d-block"></div>
            <div class="col-xl-6 col-lg-6 col-md-12 no-padding center-content">
                <div class="map-responsive">
                    <iframe width="600" height="450" style="border:0;" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d294.8453044806136!2d-2.703525!3d53.7581131!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487b73cbe298c65b%3A0xc8a861caf3690757!2sZnergi%20Ltd!5e0!3m2!1sen!2suk!4v1623075572177!5m2!1sen!2suk" align="center" width="100%"></iframe>
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
