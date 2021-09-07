@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/payment-solutions.css') }}" />
@endsection

@section('before-header')
    <div class="d-flex">
        <div id="section01" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
            <hr/>
            <div class="row flex-grow-1 no-padding center-content" style="background-image: url('{{ asset('img/background/payment-solutions-background.png') }}'); background-position: center bottom; ">
                <div class="col-12 no-margin">
                    <div style="max-width: 100%; max-height: 100%;">
                        <h1 class="white-text text-center" style="text-shadow: 0px 2px 12px #000000; margin: 0;">Payment solutions, <br> perfect for your business</h1>
                    </div>
                </div>
                <a id="sdb01" class="d-md-block d-none" href="#CardTerminals"><span></span></a>
            </div>
        </div>
    </div>
    <div id="CardTerminals" class="full-size container-fluid">
        <div class="col-12" style="padding: 20px;">
            <h2 class="section-heading"> Card Terminals </h2>
            <div class="row">
                <div class="col-xl-4 col-12 text-center card-terminal-category">
                    <p class="card-terminal-heading"> Countertop </p>
                    <p> Accept card payments from a fixed location, directly from the till or sales counter. Great for all types of shops and retailers. </p>

                </div>
                <div class="col-xl-4 col-12 text-center card-terminal-category">
                    <p class="card-terminal-heading"> Portable </p>
                    <p> Connect via bluetooth or wi-fi, a portable machine is great for restaurants, bars and pubs where you need to take payments away from the till. </p>

                </div>
                <div class="col-xl-4 col-12 text-center card-terminal-category">
                    <p class="card-terminal-heading"> Mobile </p>
                    <p> Using a roaming sim card, our mobile card machines can be taken anywhere. Great for farmers markets, exhibitions, festivals and trades people, you can take payments wherever you are. </p>

                </div>
            </div>
            <div class="row no-margin mt-5">
                <div class="col-xl-2 col-lg-6 col-12 text-center"><img class="card-machine-image" src="{{ asset('img/payment-solutions-homepage/card-machines/card-machine-1.png') }}"></div>
                <div class="col-xl-2 col-lg-6 col-12 text-center"><img class="card-machine-image" src="{{ asset('img/payment-solutions-homepage/card-machines/card-machine-2.png') }}"></div>
                <div class="col-xl-2 col-lg-6 col-12 text-center"><img class="card-machine-image" src="{{ asset('img/payment-solutions-homepage/card-machines/card-machine-3.png') }}"></div>
                <div class="col-xl-2 col-lg-6 col-12 text-center"><img class="card-machine-image" src="{{ asset('img/payment-solutions-homepage/card-machines/card-machine-4.png') }}"></div>
                <div class="col-xl-2 col-lg-6 col-12 text-center"><img class="card-machine-image" src="{{ asset('img/payment-solutions-homepage/card-machines/card-machine-5.png') }}"></div>
                <div class="col-xl-2 col-lg-6 col-12 text-center"><img class="card-machine-image" src="{{ asset('img/payment-solutions-homepage/card-machines/card-machine-6.png') }}"></div>
            </div>
        </div>
        <div class="d-none d-lg-block mt-5 mb-5 mb-xl-0">
            <div class="row d-flex justify-content-around align-items-center">
                <img class="platform-logo" src="{{ asset('img/payment-solutions-homepage/icons/pax-logo.png') }}" alt="" height="100px" width="200px">
                <img class="platform-logo" src="{{ asset('img/payment-solutions-homepage/icons/ingenico-logo.png') }}" alt="" height="50px" width="200px">
                <img class="platform-logo" src="{{ asset('img/payment-solutions-homepage/icons/spire-logo.png') }}" alt="" height="100px" width="200px">
                <img class="platform-logo" src="{{ asset('img/payment-solutions-homepage/icons/ios-logo.png') }}" alt="" height="50px" width="100px">
                <img class="platform-logo" src="{{ asset('img/payment-solutions-homepage/icons/android-logo.png') }}" alt="" height="100px" width="100px">
            </div>
        </div>
    </div>
    <div class="full-size-60 container-fluid background-image-preston" style="padding: 20px;">
        <h2 class="white-text section-heading"> Go Mobile </h2>
        <div class="row">
            <div class="d-none d-xl-block    col-xl-2"></div>
            <div class="col-12 col-xl-4 text-center">
                <img src="{{ asset('img/payment-solutions-homepage/go-mobile-image.png') }}">
            </div>
            <div class="col-12 col-xl-4 justify-content-center d-flex justify-content-xl-start align-items-xl-center">
                <p class="white-text text-center text-xl-left" style="width: 400px; font-size: 1.2em"> Go Mobile, we supply your Mobile Payment Terminal and Smart Phone App. This simple to use payment solution is the perfect fit for all types of businesses. With attractive rates and in app analytics', this keeps everything at your fingertips no matter where your business takes you. </p>
            </div>
            <div class="d-none d-xl-block col-xl-2"></div>
        </div>

    </div>
    <div class="container-fluid" style="padding: 20px;">
        <h2 class="section-heading"> E-commerce & Virtual Terminal </h2>
        <div class="row">
            <div class="d-none d-xl-block col-xl-1"></div>
            <div class="col-12 col-xl-5 text-center"><img src="{{ asset('img/payment-solutions-homepage/virtual-terminal.png') }}"></div>
            <div class="col-12 col-xl-5 d-flex justify-content-center justify-content-xl-start align-items-xl-center">
                <p class=" text-center text-xl-left" style="font-size: 1.2em; width: 600px;"> A virtual terminal is a web-based payment system for processing over-the-phone transactions. It's basically a virtual card machine and you don't even need a company website to get one. Set up is quick and easy and you will be taking payments over the phone on any smartphone, tablet or PC in no time. Perfect for call centres or mail order businessess. No technical integration needed. </p>
            </div>
            <div class="d-none d-xl-block col-xl-1"></div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-xl-3 d-flex center-content flex-column">
                <img src="{{ asset('img/payment-solutions-homepage/icons/pie-chart.png') }}" height="auto" width="80">
                <p style="font-weight: 700;"> Instant Reporting </p>
            </div>
            <div class="col-12 col-md-6 col-xl-3 d-flex center-content flex-column">
                <img src="{{ asset('img/payment-solutions-homepage/icons/user.png') }}" height="auto" width="80">
                <p style="font-weight: 700;"> Access for up to 20 users </p>
            </div>
            <div class="col-12 col-md-6 col-xl-3 d-flex center-content flex-column">
                <img src="{{ asset('img/payment-solutions-homepage/icons/invoice.png') }}" height="auto" width="80">
                <p style="font-weight: 700;"> Send email receipts </p>
            </div>
            <div class="col-12 col-md-6 col-xl-3 d-flex center-content flex-column">
                <img src="{{ asset('img/payment-solutions-homepage/icons/placeholder.png') }}" height="auto" width="80">
                <p style="font-weight: 700;"> Accept payments remotely </p>
            </div>
        </div>
        <p> Whether you have a retail store, a digital business or something in between, we can help to get you trading online using our payment gateways. For new business and start-ups a brilliant option is the hosted payment page offering fast and secure transactions. At the point of purchase clients are taken from your website to the secure payment page to complete the transaction. We can also provide a tailored, branded integrated payment page that sits in your website. </p>

        <div style="padding: 20px;">
            <p class="section-heading" style="font-weight: bold"> Interested? </p>
            <div class="row no-margin">
                <div class="col-12 col-xl-6">
                    <ul class="green-tick-list">
                        <li>Simple to setup</li>
                        <li>Secure and reliable</li>
                        <li>Competitive pricing</li>
                        <li>Ability to serve customers 24/7</li>
                        <li>Reach customers anywhere</li>
                        <li>Real-time transactional reporting</li>
                        <li>Real-time payment autorisation</li>
                        <li>Low operational costs</li>
                    </ul>
                </div>
                <div class="col-12 col-xl-6">
                    <form id="paymentsForm" action="{{ route('payment-solutions') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="full_name">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control tall-form-control" id="full_name" name="full_name"required="required" />
                        </div>
                        <div class="form-group">
                            <span class="form-error-message" id="phone_number_error"></span>
                            <div><label for="phone_number">Phone Number</label></div>
                            <input type="text" class="form-control tall-form-control" id="phone_number" name="phone_number"/>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control tall-form-control" id="email" name="email" required="required" />
                        </div>
                        <div class="text-md-right text-center">
                        <button type="submit" class="rounded-green-button full-width-button">Call Me</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.body.onload = function()
        {
            var phoneNumberError = document.getElementById("phone_number_error");
            document.getElementById("paymentsForm").onsubmit = function (e)
            {
                var phoneNumber = document.getElementById("phone_number").value;

                if (phoneNumber && phoneNumber.replace(/[^0-9]/g, "").length < 7)
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
