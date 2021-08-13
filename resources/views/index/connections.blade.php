@extends('layouts.master')

@section('stylesheets')
    <style>

        body.business header, body.business nav, body.business #navbarSupportedContent
        {
            background-color: #ffaa00;
        }

        body.residential header, body.residential nav, body.residential #navbarSupportedContent 
        {
            background-color: #ffaa00;
        }

        body.business .header-switch-switch 
        {
            fill: #f3f2f1;
        }

        td
        {
            padding: 10px;
        }

        .rounded-input-field
        {
            width: 100%;
            border-radius: 15px;
            padding: 10px;
            border: none;
            border: 1px solid;
        }

        .white-text
        {
            color: #f3f2f1;
        }

        .white-box-infographics
        {
            align-items: center;
            justify-content: center;
            margin: auto;
            height: auto;
            padding: 20px 0;
        }

        .white-box-infographics-inner
        {
            background-color: #f3f2f1;
            border-radius: 20px;
            width: 325px;
            height: 450px;
            padding: 20px;
            margin: auto;
            display: flex;
            align-items: center;
            max-width: 100%;
        }

        .service-infographics
        {
            align-items: center;
            justify-content: center;
            margin: auto;
            height: auto;
            padding: 20px 0;
        }

        .service-infographics-inner
        {
            background-color: #f3f2f1;
            border-radius: 20px;
            width: 500px;
            height: 350px;
            padding: 20px;
            margin: auto;
            display: flex;
            align-items: center;
            max-width: 100%;
            box-shadow: #0000003d 0px 3px 8px;
        }

        .infographics-header
        {
            margin-top: 50px;
            font-size: 26px;
            font-weight: 700;
        }

        .infographics-image
        {
            height: 150px;
            width: 140px;
        }

        .infographic-info-banner
        {
            border-radius: 20px;
            background-color: #f3f2f1;
            padding: 20px;
            margin: auto;
        }

        .section-headers
        {
            font-size: 40px; 
            padding: 20px;
        }
        @media (max-width: 991px)
        {
            .background-mobile-white { background-color: #f3f2f1; }
            .plus-many-font-medium { font-size: 22px;}
        }

        @media (max-width: 767px)
        {
            .background-image-non-moblie { background-color: #f3f2f1; }
            .background-image-non-moblie::before { background-image: none !important; }
        }

    </style>
@endsection

@section('before-header')
    <div class="d-flex">
        <div id="requestCallback" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
            <hr/>
            <div class="row flex-grow-1 no-padding background-image-coffee-shop center-content">
                <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
                <div class="col-xl-4 col-lg-6 col-md-8 col-12 row no-margin">
                    <div style="max-width: 100%; max-height: 100%;">
                        <h1 class="white-text">Get your home or business connected with peace of mind</h1>
                        <p class="white-text"> We can assist you in connecting your home or business to the mains gas or electricity supply. We go above and beyond to make the process of establishing a connection to your property straightforward and stress-free, leaving you with peace of mind. </p>
                    </div>
                </div>
                <div class="col-xl-1 d-none d-xl-block"></div>
                <div class="col-md-2 d-none d-lg-none d-md-block"></div>
                <div class="col-md-2 d-none d-lg-none d-md-block"></div>
                <div class="col-xl-5 col-lg-5 col-md-8 col-12 d-md-flex">
                    <div class="white-text" style="max-width: 100%; width: 600px;">
                        <form id="connectionsForm" class="form-black" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control tall-form-control" id="full_name" name="full_name" placeholder="Full Name" required="required" />
                            </div>
                            <div class="form-group">
                                <span class="form-error-message" id="phoneNumberError"></span>
                                <div><label for="phone_number">Phone Number</label></div>
                                <input type="text" class="form-control tall-form-control" id="phone_number" name="phone_number" placeholder="Contact Number" required="required"" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control tall-form-control" id="email" name="email_address" placeholder="Email" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="new_customer">New Customer<span class="text-danger">*</span></label>
                                <select id="new_customer" class="rounded-input-field" id="new_customer" name="new_customer" required />
                                    <option value="" disabled hidden></option>
                                    <option value="Lorem">Lorem</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="property_type">Property Type<span class="text-danger">*</span></label>
                                    <select id="property_type" class="rounded-input-field" id="new_customer" name="property_type" required />
                                        <option value="" disabled hidden></option>
                                        <option value="Lorem">Lorem</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="connection">Connection<span class="text-danger">*</span></label>
                                    <select id="connection" class="rounded-input-field" id="connection" name="connection" required />
                                        <option value="" disabled hidden></option>
                                        <option value="Lorem">Lorem</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md">
                                    <label for="callback_time">Call Back Time <span class="text-danger">*</span></label>
                                    <select id="callback_time" class="rounded-input-field" id="callback_time" name="callback_time" required />
                                        <option value="" disabled hidden></option>
                                        <option value="Lorem">Lorem</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md my-3 m-md-0 align-items-end d-flex">
                                <button type="submit" class="rounded-blue-button" style="width: 200px; padding: 10px; color: #f3f2f1;">Call Me</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-2 d-none d-lg-none d-md-block"></div>
            </div>
        </div>
    </div>
    <hr />
    <div class="d-flex">
        <div class="full-size container-fluid d-flex flex-column background-image-preston">
            <h2 class="section-headers ml-0 ml-md-3" style="color: #f3f2f1;"> How long will it take? </h2>
            <div class="row">
                <div class="col-12 col-lg-4 col-md-6 white-box-infographics" style="text-align: center;">
                    <div class="white-box-infographics-inner">
                        <div style="text-align: center;">
                            <img class="infographics-image" src="{{ asset('img/infographic icons/signed-form.svg') }}"/>
                            <p class="infographics-header"> Get a quote </p>
                            <p>Typically this will take around 2-4 weeks to get back to you</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 white-box-infographics">
                    <div class="white-box-infographics-inner">
                        <div style="text-align: center;">
                            <img class="infographics-image" src="{{ asset('img/infographic icons/search-icon.svg') }}"/>
                            <p class="infographics-header"> Gas implementation </p>
                            <p>This will normally take around 6-8 weeks to complete, depending on the scale of the work needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-lg-none"></div>
                <div class="col-12 col-lg-4 col-md-6 white-box-infographics">
                    <div class="white-box-infographics-inner">
                        <div style="text-align: center;">
                            <img class="infographics-image" src="{{ asset('img/infographic icons/switch-icon.svg') }}"/>
                            <p class="infographics-header"> Electricity implementation </p>
                            <p>This will normally take around 6-12 weeks to complete, depending on the scale of the work needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-lg-none"></div>
            </div>
            <div class="infographic-info-banner">
                <p> As soon as you get a call back from us, you will be in the best possible hands. We want to make the new connections
                    process as simple for you as possible. Sometimes things can slow down the process, such as:
                </p>
                <ul style="list-style-type: disc;">
                    <li>How far away the property is to the supply pipe</li>
                    <li>If the supply pipe is under the public highway</li>
                    <li>How far the pipe runs on public property</li>
                </ul> 
            </div>
        </div>
    </div>
    <hr />
    <div class="d-flex">
        <div class="full-size-60 container-lg d-flex flex-column">
            <h2 class="section-headers"> Our Services </h2>
            <div class="row">
                <div class="col-12 col-lg-4 col-md-6 service-infographic mb-5 mb-lg-0" style="text-align: center;">
                    <div class="service-infographics-inner center-content">
                        <div style="text-align: center;">
                            <img src="{{ asset('img/infographic icons/signed-form.svg') }}"/>
                            <p class="infographics-header"> Home Energy Switching </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 service-infographic mb-5 mb-lg-0">
                    <div class="service-infographics-inner center-content" style="background-color: #00c2cb">
                        <div style="text-align: center;">
                            <img src="{{ asset('img/infographic icons/search-icon.svg') }}"/>
                            <p class="infographics-header"> Business Energy Switching </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-lg-none"></div>
                <div class="col-12 col-lg-4 col-md-6 service-infographic mb-5 mb-lg-0">
                    <div class="service-infographics-inner center-content" style="background-color: #ffaa00">
                        <div style="text-align: center;">
                            <img src="{{ asset('img/infographic icons/switch-icon.svg') }}"/>
                            <p class="infographics-header"> Gas & Electricty Connections </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-lg-none"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.body.onload = function()
        {
            var phoneNumberError = document.getElementById("phoneNumberError");
            document.getElementById("requestCallbackForm").onsubmit = function (e)
            {
                var phoneNumber = document.getElementById("phone_number").value;

                if (phoneNumber.replace(/[^0-9]/g, "").length < 7)
                {
                    e.preventDefault();
                    phoneNumberError.innerHTML = "Please enter a valid phone number with at least 7 digits.";
                }
                else
                {
                    phoneNumberError.innerHTML = "";
                }
            }
        };
    </script>
@endsection
