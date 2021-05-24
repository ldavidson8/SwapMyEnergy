@extends('layouts.master')

@section('stylesheets')
    <style>
        /* .upload-btn-wrapper
        {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        .upload-btn-wrapper input[type=file]
        {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
        }
        .upload-btn-wrapper label
        {
            margin-bottom: 0px;
        }
        .upload-btn 
        {
            width: 250px;
            border-radius: 12px;
            padding: 10px;
            font-size: 27px;
            font-weight: bold;
        } */

        .logos-container
        {
            padding: 0;
            margin: 0;
            list-style: none;
            text-align: center;
            min-height: 300px;
            display: inline;
        }
        .logos-item-outer
        {
            width: 200px;
            height: 100px;
            max-width: 100%;
            text-align: center;
            display: inline-block;
            margin: 20px;
        }
        .logos-item
        {
            max-height: 100%;
            margin: auto;
            width: auto;
            max-width: 100%;
        }

        .tall-form-control
        {
            padding: 8px 12px;
            height: auto;
        }


        @media (max-width: 767px)
        {
            .background-image-non-moblie { background-color: #f3f2f1; }
            .background-image-non-moblie::before { background-image: none !important; }
        }
    </style>
@endsection

@section('before-header')
    <div id="requestCallback" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="row flex-grow-1 no-padding background-image-preston background-image-non-moblie align-items-center">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12 left-column-content">
                <h1>Empower your business to overcome rising energy prices</h1>
                <p>Your business is important to you, so let us help
                    you find a better energy deal for your business.</p>
                {{-- <div class="upload-btn-wrapper">
                    <label for="billsUpload"><button class="big-blue-button"> Upload your bills </button></label>
                    <input type="file" id="billsUpload" name="billsUpload" />
                </div> --}}
                <form id="requestCallbackForm" class="form-black" action="{{ route('business.request callback') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="full_name">Full Name/Business Name</label>
                        <input type="text" class="form-control tall-form-control" id="full_name" name="full_name" placeholder="Full Name/Business Name" required="required" />
                    </div>
                    <div class="form-group">
                        <span class="form-error-message" id="phoneNumberError"></span>
                        <div><label for="phone_number">Phone Number</label></div>
                        <input type="text" class="form-control tall-form-control" id="phone_number" name="phone_number" placeholder="Contact Number" required="required"" />
                    </div>
                    <div class="form-group">
                        <label for="billsUpload">Upload Your Bills (optional)</label>
                        <input type="file" class="form-control" id="billsUpload" name="billsUpload[]" multiple style="padding: 7px 10px; height: auto;" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address (optional)</label>
                        <input type="email" class="form-control tall-form-control" id="email" name="email" placeholder="Email (optional)" />
                    </div>
                    <button type="submit" class="big-blue-button">Call Me</button>
                </form>
            </div>
            <div class="col-xl-6 col-lg-5 col-md-2 col-12 d-md-flex d-none center-content" style="min-height: 300px;"></div>
        </div>
    </div>
    <hr />
    <div class="full-size-40 container-fluid d-flex flex-column">
        <div class="row flex-grow-1">
            <div class="col-12 center-content" style="text-align: center;">
                <h2 style="padding-top: 30px;"> Our Suppliers</h2>
                <ul class="logos-container">
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/british-gas.svg') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/edf.svg') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/scottish-power.svg') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/ecotricity.svg') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/eon.svg') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/ovo.svg') }}">
                    </li>
                </ul>
                <p> Plus more </p>
            </div>
        </div>
    </div>
    <hr />
    <div class="full-size-50 container-fluid d-flex flex-column background-image-preston-behind">
        <div class="row flex-grow-1 padding-20px background-image-preston background-image-bottom preload">
            <div class="col-12 col-lg-6 center-content">
                <div style="max-width: 100%; text-align: center;">
                    <p style="color: #f3f2f1; font-size: 50px;">Want us to do the heavy lifting?</p>
                    <p style="color: #f3f2f1;">You can upload your bill and we'll do the rest</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 center-content" style="text-align: center;">
                <a href="#requestCallback"><button class="big-blue-button" style="width: auto; padding-left: 20px; padding-right: 20px;">Request a Callback</button></a>
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