@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/connections.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/infographics.css') }}" />
@endsection

@section('before-header')
    <div class="d-flex">
        <div id="requestCallback" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
            <hr/>
            <div class="row flex-grow-1 no-padding background-image-coffee-shop center-content" style="padding: 30px 0 !important;">
                <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
                <div class="col-xl-4 col-lg-6 col-md-8 col-12 row no-margin">
                    <div style="max-width: 100%; max-height: 100%;">
                        <h1 class="white-text" style="margin-top: 0px;">Get Your Home Or Business Connected With Peace Of Mind</h1>
                        <p class="white-text"> We can assist you in connecting your home or business to the mains gas or electricity supply. We go above and beyond to make the process of establishing a connection to your property straightforward and stress-free, leaving you with peace of mind. </p>
                    </div>
                </div>
                <div class="col-xl-1 d-none d-xl-block"></div>
                <div class="col-md-2 d-none d-lg-none d-md-block"></div>
                <div class="col-md-2 d-none d-lg-none d-md-block"></div>
                <div class="col-xl-5 col-lg-5 col-md-8 col-12 d-md-flex">
                    <div class="white-text" style="max-width: 100%; width: 600px;">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger post-error">
                                @foreach ($errors -> all() as $error)
                                    {{ $error }}<br />
                                @endforeach
                            </div>
                        @endif
                        <form id="connectionsForm" class="form-black" method="post" action="{{ route("connections") }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="full_name">Full Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control tall-form-control" id="full_name" name="full_name" placeholder="Full Name" required="required" value="{{ old('full_name') }}" />
                            </div>
                            <div class="form-group">
                                <div><label for="phone_number">Phone Number<span class="text-danger">*</span></label></div>
                                <p id="phone_number_error" class="text-danger" style="font-size: 15px; margin-bottom: 0px;"></p>
                                <input type="text" class="form-control tall-form-control" id="phone_number" name="phone_number" placeholder="Contact Number" required="required" value="{{ old('phone_number') }}" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address<span class="text-danger">*</span></label>
                                <input type="email" class="form-control tall-form-control" id="email" name="email" placeholder="Email" required="required" value="{{ old('email') }}" />
                            </div>
                            <div class="form-group">
                                <label for="new_customer">New Customer<span class="text-danger">*</span></label>
                                <select id="new_customer" class="rounded-input-field" id="new_customer" name="new_customer" required="required" />
                                    <option value="" disabled selected hidden></option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="property_type">Property Type<span class="text-danger">*</span></label>
                                    <select id="property_type" class="rounded-input-field" name="property_type" required="required" />
                                        <option value="" disabled selected hidden></option>
                                        <option value="Domestic/Home">Domestic/Home</option>
                                        <option value="Commercial">Commercial</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="connection_type">Connection<span class="text-danger">*</span></label>
                                    <select id="connection_type" class="rounded-input-field" name="connection_type" required="required" />
                                        <option value="" disabled selected hidden></option>
                                        <option value="Gas">Gas</option>
                                        <option value="Electricity">Electricity</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md">
                                    <label for="call_back_time">Call Back Time <span class="text-danger">*</span></label>
                                    <select id="call_back_time" class="rounded-input-field" name="call_back_time" required="required" />
                                        <option value="" disabled selected hidden></option>
                                        <option value="Morning">Morning</option>
                                        <option value="Between 12-3pm">Between 12-3pm</option>
                                        <option value="Between 3-5pm">Between 3-5pm</option>
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
        <div class="container-fluid d-flex flex-column background-image-preston no-padding">
            <h2 id="how-long-will-it-take-section" class="section-headers3" style="text-align: center; margin: 0px;">How long will it take?</h2>
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4 white-box-infographics" style="text-align: center;">
                    <div class="white-box-infographics-inner" style="background-color: #ffafdd;">
                        <div style="text-align: center;">
                            <img class="infographics-image" src="{{ asset('img/connections-page/paper.png') }}" alt=""/>
                            <p class="infographics-header"> Get a quote </p>
                            <p>Typically this will take around 2-4 weeks to get back to you</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 white-box-infographics">
                    <div class="white-box-infographics-inner" style="background-color: #00c2cb;">
                        <div style="text-align: center;">
                            <img class="infographics-image" src="{{ asset('img/connections-page/flash.png') }}" alt=""/>
                            <p class="infographics-header"> Electricity implementation </p>
                            <p>This will normally take around 6-12 weeks to complete, depending on the scale of the work needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 d-lg-none"></div>
                <div class="col-12 col-sm-6 col-lg-4 white-box-infographics">
                    <div class="white-box-infographics-inner" style="background-color: #ffaa00;">
                        <div style="text-align: center;">
                            <img class="infographics-image" src="{{ asset('img/connections-page/flame.png') }}" alt=""/>
                            <p class="infographics-header"> Gas implementation </p>
                            <p>This will normally take around 6-8 weeks to complete, depending on the scale of the work needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 d-lg-none"></div>
            </div>
            <div class="container-xl no-padding">
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
    </div>
    <hr />
    <div class="d-flex">
        <div class="full-size-60 container-lg d-flex flex-column">
            <h2 class="section-headers"> Our Services </h2>
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4 service-infographic mb-5 mb-lg-0" style="text-align: center;">
                    <div class="service-infographics-inner center-content" style="background-color: #ffafdd;">
                        <div style="text-align: center;">
                            <img src="{{ asset('img/connections-page/home.png') }}" alt=""/>
                            <p class="infographics-header"> Home Energy Switching </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 service-infographic mb-5 mb-lg-0">
                    <div class="service-infographics-inner center-content" style="background-color: #00c2cb;">
                        <div style="text-align: center;">
                            <img src="{{ asset('img/connections-page/suitcase.png') }}" alt=""/>
                            <p class="infographics-header"> Business Energy Switching </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 d-lg-none"></div>
                <div class="col-12 col-sm-6 col-lg-4 service-infographic mb-5 mb-lg-0">
                    <div class="service-infographics-inner center-content" style="background-color: #ffaa00;">
                        <div style="text-align: center;">
                            <img src="{{ asset('img/connections-page/wrench.png') }}" alt=""/>
                            <p class="infographics-header"> Gas & Electricity Connections </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 d-lg-none"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.body.onload = function()
        {
            var phone_number_error = document.getElementById("phone_number_error");
            document.getElementById("connectionsForm").onsubmit = function (e)
            {
                var phoneNumber = document.getElementById("phone_number").value;

                if (phoneNumber.replace(/[^0-9]/g, "").length < 7)
                {
                    e.preventDefault();
                    phone_number_error.innerHTML = "Please enter a valid phone number with at least 7 digits.";
                }
                else
                {
                    phone_number_error.innerHTML = "";
                }
            }
        };
    </script>
@endsection
