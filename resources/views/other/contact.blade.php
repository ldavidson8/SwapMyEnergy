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

        .contact-us-blue-boxes
        {
            font-size: 20px;
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
            font-size: 24px;
            font-weight: bold;
            border: none;
        }
        .bottom-aligner 
        {
            display: inline-block;
            height: 100%;
            vertical-align: bottom;
            width: 0px;
        }
    </style>
@endsection
@section('before-header')
    <div class="background-image-preston-behind">
        <div id="contact" class="full-size container-fluid d-flex h-100 flex-column background-image-preston background-image-top">
@endsection

@section('main-content')
            <h1 class="font-color-white" style="text-align: center"> Get in touch </h1>
            <div class="row flex-grow-1 no-padding font-color-white contact-us-blue-boxes">
                <div class="col-12 col-lg-4 col-md-6 contact-us-blue-box">
                    <div class="contact-us-blue-box-inner">
                        <div style="position: relative;">
                            <h2> Call us </h2>
                            <img alt="" width="80px" height="80px" src="{{ asset('img/support icons/phone.png') }}" style="position: absolute; right: 0; bottom: 0;"></img>
                        </div>
                        @include('media.dashed-white-line')
                        <div style="text-align: center;">
                            <p style="font-size:30px; padding-top: 25px; padding-bottom:40px;"> {{ env('DATA_CONTACT_PHONE_NUMBER') }} </p>
                            <h3 style="text-decoration: underline;"> Opening Hours </h3>
                            <p>
                                10am - 4:30pm <br>
                                Monday to Thursday 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 contact-us-blue-box">
                    <div class="contact-us-blue-box-inner">
                        <div style="position: relative;">
                            <h2> Email us </h2>
                            <img alt="" width="80px" height="80px" src="{{ asset('img/support icons/email.png') }}" style="position: absolute; right: 0; bottom: 0;"></img>
                        </div>
                        @include('media.dashed-white-line')
                        <div style="text-align: center; padding-top: 23px;">
                            <p> Email us and we will aim to get back to you within 24 hours </p>
                            <p style="overflow-wrap: break-word;">  {{ env('DATA_CONTACT_EMAIL') }} </p>
                            <div class="bottom-aligner"></div>
                            <p> 
                                Technical Issues? <br> 
                                Raise a support request
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-lg-none"></div>
                <div class="col-12 col-lg-4 col-md-6 contact-us-blue-box">
                    <div class="contact-us-blue-box-inner">
                        <div style="position: relative;">
                            <h2> Message us </h2>
                            <img alt="" width="80px" height="80px" src="{{ asset('img/support icons/chat.png') }}" style="position: absolute; right: 0; bottom: 0;"></img>
                        </div>
                        @include('media.dashed-white-line')
                        <div style="text-align: center; padding: 29px;">
                            {{-- 
                                <p style="text-decoration: underline">
                                    Live Hours
                                </p>
                                <p>
                                    10am - 4:30pm <br />
                                    Monday to Thursday
                                </p>
                                <p>
                                    We will aim to get back to you within 24 hours.
                                </p>
                                <button type="button" class="btn-lg big-white-button" style="width: auto; cursor: default;"> Webchat Coming Soon </button>
                            --}}
                            <p style="font-size: 30px;">Webchat Coming Soon</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-lg-none"></div>
            </div>
        </div>
    </div>
    <hr style="border-color: #00c2cb;" />
    <div class="background-image-preston-behind">
        <div id="support" class="full-size container-fluid d-flex h-100 flex-column font-color-white background-image-preston background-image-bottom preload">
            <h1 style="text-align: center"> Support </h1>
            <div class="row flex-grow-1 align-items-center padding-20px">
                <div class="center-content" style="width: 600px; max-width: 100%;">
                    <div class="contact-us-blue-box-inner" style='content: ""; clear: both; display: table;'>
                        <div style="position: relative;">
                            <h2 style="padding-right: 90px;">Raise A Support Request</h2>
                            <img alt="" width="80px" height="80px" src="{{ asset('img/support icons/cogs.png') }}" style="position: absolute; right: 0; bottom: 0;"></img>
                        </div>
                        @include('media.dashed-white-line')
                        <form id="formSupport" action="{{ route("raise-support-request") }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="full_name">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required="required" value="{{ old('full_name') }}" />
                            </div>
                            <div class="form-group">
                                <label for="email_address">Email Address <span class="text-danger">*</span></label>
                                <input type="email_address" class="form-control" id="email_address" name="email_address" value="{{ old('email_address') }}" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Contact Number <span class="text-danger">*</span></label>
                                <p id="phone_number_error" class="text-danger" style="font-size: 15px; margin-bottom: 0px;"></p>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="support_issue">Issue <span class="text-danger">*</span></label>
                                <textarea id="support_issue" class="form-control" name="support_issue" value="{{ old('support_issue') }}" rows="3" required="required"></textarea>
                            </div>
                            <button type="submit" class="small-white-button" style='float: right;'> Submit </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script')
    <script>
        document.body.onload = function()
        {
            var phoneNumberError = document.getElementById("phone_number_error");
            document.getElementById("formSupport").onsubmit = function (e)
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