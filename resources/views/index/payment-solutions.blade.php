@extends('layouts.master')

@section('stylesheets')
    <style>

        body.business header, body.business nav, body.business #navbarSupportedContent
        {
            background-color: #279d7d;
        }

        body.residential header, body.residential nav, body.residential #navbarSupportedContent 
        {
            background-color: #279d7d;
        }

        body.business .header-switch-switch 
        {
            fill: #f3f2f1;
        }

        td
        {
            padding: 10px;
        }
        
        .white-text
        {
            color: #f3f2f1;
        }

        .card-terminal-category
        {

        }

        .card-terminal-category:nth-child(n+2)
        {
            border-left: 2px solid #787878;
        }

        .card-terminal-heading
        {
            font-weight: 700;
            font-size: 1.5em;
        }

    </style>
@endsection

@section('before-header')
    <div class="d-flex">
        <div id="requestCallback" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
            <hr/>
            <div class="row flex-grow-1 no-padding center-content" style="background-image: url('{{ asset('img/background/payment-solutions-background.png') }}'); background-position: center bottom; ">
                <div class="col-12 no-margin">
                    <div style="max-width: 100%; max-height: 100%;">
                        <h1 class="white-text text-center" style="text-shadow: 0px 2px 8px #000000;">Payment solutions, <br> perfect for your business</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="full-size container-fluid">
        <div class="row col-12" style="padding: 20px;">
            <h2 style="margin: 0 auto 1.5em auto; font-size: 2em;"> Card Terminals </h2>
            <div class="row">
                <div class="col-xl-4 col-12 text-center card-terminal-category">
                    <p class="card-terminal-heading"> Fixed </p>
                    <p> Perfect for accepting payments from a fixed location, i.e. a desk, till, etc. Great for a wide-range of retailers. </p>

                </div>
                <div class="col-xl-4 col-12 text-center card-terminal-category">
                    <p class="card-terminal-heading"> Portable </p>
                    <p> Perfect for accepting payments away from the till, i.e. at a customers table in a bar or restaurant. </p>

                </div>
                <div class="col-xl-4 col-12 text-center card-terminal-category">
                    <p class="card-terminal-heading"> Mobile </p>
                    <p> Perfect for remote payments. Accept payments from anywhere, i.e. festivals, exhibitions, trade fares, etc. </p>

                </div>
            </div>
            <div class="row center-content">
                <div class="col-xl-2 col-lg-6 col-12"><img class="card-machine-image" src="{{ asset('img/payment-solutions/card-machines/card-machine-1.png') }}"></div>
                <div class="col-xl-2 col-lg-6 col-12"><img class="card-machine-image" src="{{ asset('img/payment-solutions/card-machines/card-machine-2.png') }}"></div>
                <div class="col-xl-2 col-lg-6 col-12"><img class="card-machine-image" src="{{ asset('img/payment-solutions/card-machines/card-machine-3.png') }}"></div>
                <div class="col-xl-2 col-lg-6 col-12"><img class="card-machine-image" src="{{ asset('img/payment-solutions/card-machines/card-machine-4.png') }}"></div>
                <div class="col-xl-2 col-lg-6 col-12"><img class="card-machine-image" src="{{ asset('img/payment-solutions/card-machines/card-machine-5.png') }}"></div>
                <div class="col-xl-2 col-lg-6 col-12"><img class="card-machine-image" src="{{ asset('img/payment-solutions/card-machines/card-machine-6.png') }}"></div>
            </div>
        </div>
    </div>
    <div class="full-size-60 container-fluid background-image-preston">
        <h3 class="white-text"> Mobile Payments </h3>
    </div>
    <div class="container-fluid">
        <h3> Over-the-phone Transactions </h3>
    </div>
    <hr />
@endsection

@section('script')
    <script>
        document.body.onload = function()
        {
            var phone_number_error = document.getElementById("phone_number_error");
            document.getElementById("paymentsForm").onsubmit = function (e)
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
