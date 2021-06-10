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
        .table-steps
        {
            width: 100%;
        }
        
        td 
        {
            padding: 10px;
        }   

        .white-text
        {
            color: #f3f2f1;
        }
        .plus-many-font
        {
            font-size: 28px;
        }

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
            border: 2px solid #202020
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
        
        @media (max-width: 761px)
        {
        }

        @media (max-width: 515px)
        {
        }

    </style>
@endsection

@section('before-header')
    <div id="requestCallback" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="row flex-grow-1 no-padding background-image-coffee-shop justify-content-center">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12 row align-content-center no-margin">
                <div style="max-width: 100%;">
                    <h1 class="white-text">Empower your business to overcome rising energy prices</h1>
                    <table class="table-steps">
                        <tr>
                            <td>
                                <img src="{{ asset('img/business-homepage/upload.png')}}" style="width: 100px;" alt="upload icon">
                            </td>
                            <td>
                                <p class="white-text" style="font-weight: normal;"><b>Step One - Upload your bill or request a callback</b><br> To get started, simply submit a copy of your energy bill. One of our experts will analyse your bill and provide you with a list of the best deals available to you. </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{ asset('img/business-homepage/signed-document.png')}}" style="width: 100px;" alt="signed document">
                            </td>
                            <td>
                                <p class="white-text" style="font-weight: normal; "><b>Step Two - Pick the Best Deal </b><br> Simple select the option that is most appropriate for your company. We'll always be on hand to help you understand your options. </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{ asset('img/business-homepage/coins.png')}}" style="width: 100px;" alt="pound coins stacked on top each other">
                            </td>
                            <td>
                                <p class="white-text" style="font-weight: normal;"><b>Step Three - Save </b><br> Change to a less expensive plan. Take a seat and unwind. We'll let you know when your contract is up for renewal so you can make sure you're getting the best value possible. </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-2 d-none d-lg-none d-md-block"></div>
            <div class="col-md-2 d-none d-lg-none d-md-block"></div>
            <div class="col-xl-5 col-lg-5 col-md-8 col-12 d-md-flex center-content">
                <div class="white-text" style="max-width: 100%; width: 600px;">
                    <form id="requestCallbackForm" class="form-black" action="{{ route('business.request-callback') }}" method="post" enctype="multipart/form-data">
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
                            <input type="email" class="form-control tall-form-control" id="email" name="email_address" placeholder="Email (optional)" />
                        </div>
                        <button type="submit" class="big-blue-button">Call Me</button>
                    </form>
                </div>
            </div>
            <div class="col-md-2 d-none d-lg-none d-md-block"></div>
        </div>
    </div>
    <hr />
    <div class="full-size-40 container-fluid d-flex flex-column">
        <div class="row flex-grow-1">
            <div class="col-12 center-content" style="text-align: center;">
                <h2 style="padding-top: 30px;"> Our Suppliers</h2>
                <ul class="logos-container">
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/eon.png') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/ovo.png') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/british-gas.png') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/scottish-power.png') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/ecotricity.svg') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/utilita.png') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/avanti-gas.png') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/opus-energy.png') }}">
                    </li>
                    <li class="logos-item-outer hide-logo-medium">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/sse.png') }}">
                    </li>
                    <li class="logos-item-outer hide-logo-large">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/crown-gas.png') }}">
                    </li>
                </ul>
                <p style="font-size: 28px;"> Plus many more... </p>
            </div>
            <div class="col-md-2 col-sm-3 col-6">
                <a>
                    <img class="logos-item" src="{{ asset('img/supplier-logos/avanti-gas.png') }}">
                </a>
            </div>
            <div class="col-md-2 col-sm-3 col-6">
                <a>
                    <img class="logos-item" src="{{ asset('img/supplier-logos/opus-energy.png') }}">
                </a>
            </div>
            <div class="col-sm-3 d-sm-block d-md-none"></div>
            <div class="col-md-2 col-sm-3 col-6">
                <a>
                    <img class="logos-item" src="{{ asset('img/supplier-logos/sse.png') }}">
                </a>
            </div>
            <div class="col-md-2 col-sm-3 col-6">
                <a>
                    <img class="logos-item" src="{{ asset('img/supplier-logos/crown-gas.png') }}">
                </a>
            </div>
            <div class="col-md-1 d-md-block d-none"> </div>   
        </div>
        <div style="text-align: center;">
            <p class="plus-many-font plus-many-font-medium"> Plus many more... </p>
        </div>
    </div>
    <hr />
    <div class="full-size-50 container-fluid d-flex flex-column background-image-preston-behind">
        <div class="row flex-grow-1 padding-20px background-image-preston background-image-bottom preload">
            <div class="col-12 col-lg-6 center-content">
                <div style="max-width: 100%; text-align: center;">
                    <p class="white-text" style="font-size: 50px; font-weight: 700;">Let us help you navigate through the energy maze</p>
                    <p class="white-text">You can upload your bill and we'll do the rest</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 center-content" style="text-align: center;">
                <a href="#requestCallback"><button class="big-blue-button" style="width: auto; padding-left: 20px; padding-right: 20px;">Request a Callback</button></a>
            </div>
        </div>
    </div>
    <div class="full-size-30 container-fluid d-flex flex-column">
        <div class="row flex-grow-1 padding-20px">
            <div class="col-12 col-lg-9 center-content">
                <div style="max-width: 100%;">
                    <p style="font-size: 24px;"> At Swap My Energy, we pride ourselves on giving businesses of all sizes easy access to the best commerical energy tariffs on the market. With our market leading commerical energy calculator, you can quickly find the best energy prices to make maximum savings on your business gas and electric bills. Our specialist business energy advisors are committed to supporting you throughout the process, from finding the best deal for your business to negotiating with suppliers to ensure your switch runs smoothly.
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-3 center-content">
                <div style="text-align: center;">
                    <img src={{ asset('img/business-homepage/laptop.png')}} style="max-width: 100%;">
                </div>
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