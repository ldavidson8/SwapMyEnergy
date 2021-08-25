@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/white-box-infographics.css') }}" />
    <style>
        h2
        {
            margin-top: 1rem;
        }

        h3
        {
            margin-top: 1.5em;
        }

        .tall-form-control
        {
            padding: 8px 12px;
            height: auto;
        }
    </style>
@endsection

@section('before-header')
    <div class="d-flex">
        <div id="requestCallback" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
            <hr/>
            <div class="flex-grow-1 no-padding background-image-water d-flex center-content">
                <div class="row">
                    <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
                    <div class="col-xl-5 col-lg-6 col-md-8 col-12 row no-margin">
                        <div style="max-width: 100%;">
                            <h1>Business Water Comparison</h1>
                            <p>Since 2017, businesses have been allowed to change their water supplier. This allows you to have the freedom you deserve for your business. Find your business a supplier you can trust within your area by getting in touch today!</p>
                        </div>
                    </div>
                    <div class="col-md-2 d-none d-lg-none d-md-block"></div>
                    <div class="col-md-2 d-none d-lg-none d-md-block"></div>
                    <div class="col-xl-5 col-lg-5 col-md-8 col-12 d-md-flex">
                        <div style="max-width: 100%; width: 600px;">
                            <form id="requestCallbackForm" class="form-black" action="{{ route('business.water') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" class="form-control tall-form-control" id="full_name" name="full_name" placeholder="Full Name" required="required" />
                                </div>
                                <div class="form-group">
                                    <label for="business_name">Business Name</label>
                                    <input type="text" class="form-control tall-form-control" id="business_name" name="business_name" placeholder="Business Name" required="required" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control tall-form-control" id="email" name="email" placeholder="Email (optional)" required="required" />
                                </div>
                                <div class="form-group">
                                    <span class="form-error-message" id="phoneNumberError"></span>
                                    <div><label for="phone_number">Telephone Number</label></div>
                                    <input type="text" class="form-control tall-form-control" id="phone_number" name="phone_number" placeholder="Contact Number" required="required" />
                                </div>
                                <div class="form-row">
                                    <div class="col-12 col-md">
                                        <label for="call_back_time">Call Back Time <span class="text-danger">*</span></label>
                                        <select id="call_back_time" class="form-control" name="call_back_time" required="required" />
                                            <option value="" disabled selected hidden></option>
                                            <option value="Morning">Morning</option>
                                            <option value="Between 12-3pm">Between 12-3pm</option>
                                            <option value="Between 3-5pm">Between 3-5pm</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md my-3 m-md-0 align-items-end d-flex">
                                        <button type="submit" class="rounded-blue-button" style="padding: 8px; width: 250px;">Call Me</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2 d-none d-lg-none d-md-block"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xl" style="padding: 30px;">
        <h2>Common Water Switching Questions</h2>

        <h3>Is my business eligible to switch water supplier?</h3>
        <p>Any businesses based in England of Scotland are eligible to switch their supplier. It's a bit difference if your business is located in Wales or Northern Ireland. In Wales, if your business uses over 50 megalitres of water a year, then it's eligible. Unfortunately, businesses within Northern Ireland don't have the option to switch their water supplier.</p>

        <h3>How long does it take to switch?</h3>
        <p>Once your've decided on a new supplier, you can relax; we'll handle the rest. You will receive a confirmation once the switch has taken place, plus a final bill from your old supplier and your first from your new one. It will take around 28 days to switch water supplier, but this does depend on how many sites your business has.</p>

        <h3>Does it cose to switch supplier?</h3>
        <p>Unless it costs you to exit your previous contract, then switching supplier won't cost you anything.</p>

        <h3>Will my service be interrupted during the switching process?</h3>
        <p>No. You're only switching your water supplier and not the actual supply of water, therefore you'll have no interruptions during this process.</p>

        <h3>How do I find who my current supplier is?</h3>
        <p>The quickest and easiest way to find out who your water supplier is, is to find a bill.</p>
        <p> If you can't find a recent bill, it might be the case that your supplier is a regional water supplier for the area that your business is situated in. The Water Services Regulation Authority (Ofwat) have a <a href="javascript: void();">supplier map</a> that might help you work out who your current supplier is.</p>

        <h3>How is my business charged for water?</h3>
        <p>Typically, there are two different ways you can be charged for your water supply. Either, you'll be charged based on the amount of water that your business uses, including a set charge if you're on a meter, or you'll pay a set amount based on the value of your businesses property.</p>
    </div>

    <div class="d-flex">
        <div class="full-size-80 container-fluid d-flex flex-column background-image-preston center-content">
            <h2 style="color: #f3f2f1;">The Process</h2>
            <div class="row" style="width: 1300px; max-width: 100%;">
                <div class="col-12 col-lg-4 col-md-6 white-box-infographics" style="text-align: center;">
                    <div class="white-box-infographics-inner">
                        <div style="text-align: center;">
                            <img src="{{ asset('img/infographic icons/signed-form.svg') }}" alt="Image of a signed form" />
                            <p class="infographics-header">Fill in our form</p>
                            <p>Request a quote using our form at the top of the page.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 white-box-infographics">
                    <div class="white-box-infographics-inner">
                        <div style="text-align: center;">
                            <img src="{{ asset('img/connections-page/paper.png') }}" alt="Image of paper" />
                            <p class="infographics-header">Get a quote</p>
                            <p>We'll be back in touch with a list of prices for your business.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-lg-none"></div>
                <div class="col-12 col-lg-4 col-md-6 white-box-infographics">
                    <div class="white-box-infographics-inner">
                        <div style="text-align: center;">
                            <img src="{{ asset('img/infographic icons/switch-icon.svg') }}" alt="Image of a switch" />
                            <p class="infographics-header">Get switching</p>
                            <p>Once you've picked the deal that best suits your business, then we'll begin the switching process.</p>
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
