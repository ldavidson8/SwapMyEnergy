@extends('layouts.master')
@section('stylesheets')
    <style>
        body
        {
            background-color: darkslategrey;
        }

        .font-color-white
        {
            color: #f3f2f1;
        }

        .contact-us-blue-box
        {
            align-items: center;
            justify-content: center;
            margin: auto;
            height: 400px;
            padding: 20px;
        }

        .contact-us-blue-box-inner
        {
            background-color: #00c2cb;
            border-radius: 20px;
            width: 100%;
            height: 100%;
            padding: 20px;
        }
        .big-white-button
        {
            width: 250px;
            border-radius: 12px;
            padding: 10px;
            font-size: 27px;
            font-weight: bold;
            border: none;
        }
        .small-white-button
        {
            width: 200px;
            border-radius: 10px;
            padding: 5px;
            font-size: 27px;
            font-weight: bold;
            border: none;
        }
    </style>
@endsection
@section('before-header')
    <div id="contact" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <h1 class="font-color-white" style="text-align: center"> Get in touch </h1>
        <div class="row flex-grow-1 no-padding font-color-white">
            <div class="col-12 col-lg-4 col-md-6 contact-us-blue-box">
                <div class="contact-us-blue-box-inner">
                    <h2 style="display: inline-block"> Call Us </h2>
                    @include('media.dashed-white-line')
                    <div style="text-align: center;">
                        <p style="font-size:30px; padding-top: 25px; padding-bottom:40px;"> 01772 000000 </p>
                        <h3 style="text-decoration: underline; font-size: 24px;"> Opening Hours </h3>
                        <p>
                            10am - 4:30pm <br>
                            Monday to Thursday 
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 contact-us-blue-box">
                <div class="contact-us-blue-box-inner">
                    <h2 style="display: inline-block"> Email Us </h2>
                    @include('media.dashed-white-line')
                    <div style="text-align: center;">
                        <p> Email us and we will aim to get back to you within 24 hours </p>
                        <p> placeholder@swapmyenergy.co.uk </p>
                        <p> 
                            Technical Issues? <br> 
                            View our support page 
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-lg-none"></div>
            <div class="col-12 col-lg-4 col-md-6 contact-us-blue-box">
                <div class="contact-us-blue-box-inner">
                    <h2 style="display: inline-block"> Message Us </h2>
                    @include('media.dashed-white-line')
                    <div style="text-align: center;">
                        <p style="text-decoration: underline">
                            Live Hours
                        </p>
                            10am - 4:30pm <br />
                            Monday to Thursday
                        </p>
                        <p>
                            We will aim to get back to you within 24 hours.
                        </p>
                        <button type="button" class="btn-lg big-white-button"> Launch Chat </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-lg-none"></div>
        </div>
    </div>
    <div id="support" class="full-size container-fluid d-flex h-100 flex-column font-color-white">
        <h1 style="text-align: center"> Support </h1>
        <div class="row flex-grow-1 no-padding">
            <div class="col-12 col-lg-4 col-md-6 center-content"></div>
            <div class="col-12 col-lg-4 col-md-6 center-content">
                <div class="contact-us-blue-box-inner" style='content: ""; clear: both; display: table;'>
                    <h2> Raise Support Issue</h2>
                    @include('media.dashed-white-line')
                    <form id="formPartnerApply">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" required />
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" required />
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Contact Number</label>
                            <p id="phoneNumberError" class="text-danger" style="font-size: 15px; margin-bottom: 0px;"></p>
                            <input type="text" class="form-control" id="phoneNumber" required />
                        </div>
                        <div class="form-group">
                            <label for="supportIssue">Issue</label>
                            <textarea id="supportIssue" class="form-control" name="supportIssue" rows="3"></textarea>
                        </div>
                        <button type="button" class="small-white-button" style='float: right;'> Submit </button>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 center-content"></div>
        </div>
    </div>
@endsection()

@section('script')
    <script>
        $(function()
        {
            var phoneNumberError = document.getElementById("phoneNumberError");
            document.getElementById("formSupport").onsubmit = function (e)
            {
                var phoneNumber = document.getElementById("phoneNumber").value;

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
        });
    </script>
@endsection