@extends('layouts.master')

@section('stylesheets')
    <style>
        .gallery-logo-outer {
            display: inline-block;
            padding: 30px;
            margin: auto;
            width: 19%;
        }

        img.gallery-logo {
            display: inline-block;
            max-width: 100%;
        }


        .center-div-outer {
            position: relative;
        }

        .center-div {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            padding: 10px;
        }

        
        .border-right-sm
        {
            border-right: 3px solid black;
        }

        .join-our-family
        {
            text-align: left;
        }


        .section-padding
        {
            padding: 30px 25px 40px;
        }

        .no-padding-left-right
        {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }

        
        @media (max-width: 1200px)
        {
            .gallery-logo-outer
            {
                width: 24%;
            }
        }
        
        @media (max-width: 992px)
        {
            .gallery-logo-outer
            {
                width: 32%;
                padding: 10px;
            }
        }
        
        @media (max-width: 576px)
        {
            .gallery-logo-outer
            {
                width: 49%;
            }

            .border-right-sm
            {
                border-right: none;
            }
            .border-bottom-sm
            {
                border-bottom: 3px solid black;
            }

            .join-our-family
            {
                text-align: center;
            }
        }

    </style>
@endsection

@section('main-content')
    <div class="container-fluid" style="text-align: center;">
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
    </div>
    <hr />
    <div class="container-fluid no-padding-left-right section-padding" style="background-color: white;">
        <div class="container no-padding-left-right">
            <div class="row">
                <div class="col-sm-6 col-12 border-right-sm border-bottom-sm section-padding" style="text-align: right;">
                    <h2> Your Benefits </h2>
                    <ul style="line-height: 1.2;">
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</li>
                        <li>Incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nostrud exercitation.
                        </li>
                        <li>Ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit.
                        </li>
                        <li>In voluptate velit esse cillum dolore eu fugiat nullapariatur. Excepteur sint occaecat cupidatate.</li>
                    </ul>
                </div>
                <div class="col-sm-6 col-12 join-our-family section-padding">
                    <h2 style="font-size: 45px;"> Join Our Family</h2>
                    <button type="button" class="big-blue-button btn-lg">Join Us</button>
                </div>
            </div>
        </div>
    </div>
    <hr />

    <div class="full-size-80 container-fluid d-flex flex-column no-padding">
        <main class="row flex-grow-1 no-padding">
            <div class="col-xl-6 col-12 row no-padding align-items-center">
                <div class="col row no-padding">
                    <div class="col-sm-6 col-12 border-right-sm border-bottom-sm section-padding" style="text-align: right;">
                        <h2> Your Benefits </h2>
                        <ul style="line-height: 1.2;">
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</li>
                            <li>Incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nostrud exercitation.</li>
                            <li>Ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit.</li>
                            <li>In voluptate velit esse cillum dolore eu fugiat nullapariatur. Excepteur sint occaecat cupidatate.</li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-12 join-our-family section-padding">
                        <h2 style="font-size: 45px;">Our affiliates programme</h2>
                        <button type="button" class="big-blue-button btn-lg">Join Now</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 d-none d-xl-block" style="background-color: white; min-height: 300px;"></div>
        </main>
    </div>
@endsection()