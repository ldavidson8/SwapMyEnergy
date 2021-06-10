@extends('layouts.master')

@section('stylesheets')
    <style>
        /* .gallery-logo-outer
        {
            display: inline-block;
            padding: 30px;
            margin: auto;
            width: 19%;
            height: 150px;
        }

        img.gallery-logo
        {
            display: inline-block;
            max-width: 100%;
            max-height: 100%;
        } */

        .oval-button
        {
            width: 250px;
            border-radius: 50px;
            padding: 10px;
            font-size: 24px;
            font-weight: bold;
            background-color: #00d2db;
            border: none;
        }

        ul {
        margin: 0;
        padding: 0;
        }

        ul.dashed 
        {
        list-style-type: none;
        }


        .heading-text
        {
            font-size: 40px;
            font-weight: 700;
        }

        .text-horizontal-center
        {
            display: flex;
            justify-content: center;
        }

        .div-padding-top-200
        {
            padding-top: 200px;
        }

        .large-blue-button
        {
            background-color: #00d2db;
            width: 500px;
            max-width: 100%;
            border-radius: 12px;
            padding: 30px;
            font-size: 27px;
            font-weight: bold;
            color:#f3f2f1;
            display: inline-block;
            overflow: hidden;
        }

        .clearfix:after 
        {
            content: " "; /* Older browser do not support empty content */
            visibility: hidden;
            display: block;
            height: 0;
            clear: both;
        }

        .border-radius-15
        {
            border-radius: 15px;
        }

        .rounded-input-field
        {
            width: 100%;
            border-radius: 15px;
            padding: 10px;
            border: 1px solid;
        }

        .rounded-input-field::focus 
        {
            outline: none;
            border-color: #ffaa00;
        }

        .center-div-outer
        {
            position: relative;
        }

        .center-div
        {
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
            border-right: 3px solid #202020;
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

        .section-border-left
        {
            border-left: 3px solid #202020;
        }

        .bootstrap-select.btn-group .dropdown-menu > li > a:hover:not(:focus)
        {
            color: #202020;
        }


        @media (min-width: 1364px)
        {
            .bottom-right
            {
                position: absolute;
                bottom: 0;
                right: 0;
                width: 50%;
            }
        }

        @media (max-width: 1200px)
        {
            .gallery-logo-outer
            {
                width: 24%;
            }
        }

        @media (min-width: 992px)
        {
            .section-border-left-lg
            {
                border-left: 3px solid #202020;
            }
        }
        
        @media (max-width: 991px)
        {
            .border-radius-none-md
            {
                border-radius: 0;
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
                border-bottom: 3px solid #202020;
            }

            .join-our-family
            {
                text-align: center;
            }
        }

    </style>
@endsection

@section('before-header')
    <div class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr />
        <div class="row flex-grow-1 no-padding background-image-hydropower-plant">
            <div class="col-xl-2 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-4 col-lg-6 col-md-8 col-12 no-margin" style="padding-top: 150px; color: #f3f2f1;">
                <h1>Help Shape the future of energy</h1>
                <p style="padding-top: 30px; width: 450px; max-width: 100%;">Join our Partnership or Affiliate programme and help us share the future energy</p>    
                <button class="oval-button">Find out more </button>
            </div>
            <div class="col-md-2 d-none d-lg-none d-md-block"></div>
            <div class="col-md-2 d-none d-lg-none d-md-block"></div>
            <div class="col-xl-6 col-lg-5 col-md-8 d-none d-md-block center-content" style="text-align: center;">
            </div>
            <div class="col-md-2 d-none d-lg-none d-md-block"></div>
        </div>
    </div>

    <hr />

    <div id="PartnerApply" class="full-size background-image-preston">
        <div class="container-lg no-padding">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-12 no-margin div-padding-top-200" style="color: #f3f2f1;">
                    <h2 class="heading-text">Have an idea of how we can work together?</h2>
                    <p style="padding-top: 30px; font-size: 24px;">Why not get in touch</p>    
                </div>
                <div class="col-xl-6 col-lg-6 col-12 div-padding-top-200">
                    <h2 style="color: #f3f2f1"> Apply to be a Partner </h2>
                    <form id="formPartnerApply" action="{{ route('partner-apply') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="full_name" style="color: #f3f2f1">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="email_address" style="color: #f3f2f1">Email Address <span class="text-danger">*</span></label>
                            <input type="email_address" class="form-control" id="email_address" name="email_address" value="{{ old('email_address') }}" placeholder="example@domain.com" required />
                        </div>  
                        <div class="form-group">
                            <label for="message" style="color: #f3f2f1">Message<span class="text-danger">*</span></label>
                            <textarea id="message" class="form-control" name="message" required rows="4">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn big-blue-button btn-lg">Submit</button>
                    </form>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col-12 no-padding">
                <div class="no-padding border-radius-none-md border-radius-15" style="background-color:#f3f2f1; margin: 150px 0 0 0;">
                    <div class="clearfix">
                        <img src="{{ asset('img/hipster.png') }}" height="90%" style="vertical-align: bottom; margin: auto; float: right;">
                        <span class="padding-left-inner" style="padding: 10px 0px; vertical-align: bottom;">
                            <p class="heading-text" style="padding-left: 10px"> Our Affiliate Program </p>
                            <ul class="dashed" style="font-weight: 700; padding-left: 20px;">
                                <li>- Promotion opportunities across our social channels and website</li>
                                <li>- Earn for when you help switch customers with us</li>
                                <li>- Potential collaboration opportunities upon discussion with ourselves</li>
                                <li>- And more when you get in touch</li>
                            </ul>
                        </span>  
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr />
    <div id="AffiliateApply" class="full-size-60 container-fluid background-image-market background-image-opacity-35 preload" style="font-size: 22px; padding: 50px;">
        <div class="row">
            <div class="col-12 col-lg-4">
                <p class="heading-text"> Interested in joining our affiliate programme? </p>
                <p> Fill in this form and we'll be back in touch </p>
            </div>
            <div class="col-12 col-lg-8 no-padding">
                <div class="col" style="column-count: 2; column-width: 310px; column-fill: auto; padding: 20px;">
                    @if ($errors -> hasBag('affiliate') > 0)
                        <div class="alert alertinfo text-danger">
                            @foreach ($errors -> getBag('affiliate') -> all() as $error)
                                {{ $error }}<br />
                            @endforeach
                        </div>
                    @endif
                    <form id="formAffiliateApply" class="form-black" action="{{ route('affiliate-apply') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="full_name">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="rounded-input-field" id="full_name" name="full_name" value="{{ old('full_name') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Email Address <span class="text-danger">*</span></label>
                            <input type="email_address" class="rounded-input-field" id="email_address" name="email_address" value="{{ old('email_address') }}" placeholder="example@domain.com" required />
                        </div>  
                        <div class="form-group">
                            <label for="phone_number">Phone Number <span class="text-danger">*</span></label>
                            <p id="phone_number_error" class="text-danger" style="font-size: 15px; margin-bottom: 0px;"></p>
                            <input type="text" class="rounded-input-field" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="web_link">Link (If applicable)</label>
                            <input type="url" class="rounded-input-field" id="web_link" name="web_link" value="{{ old('web_link') }}" />
                        </div>
                        <div class="form-group">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <textarea id="address" class="rounded-input-field" name="address" required rows="4">{{ old('address') }}</textarea>
                        </div>
                        <?php $type_of_affiliate = old('type_of_affiliate') ?>
                        <div class="form-group">
                            <label for="type_of_affiliate">Type of Affiliate <span class="text-danger">*</span></label>
                            <select id="type_of_affiliate" class="rounded-input-field" name="type_of_affiliate" required />
                                <option value="" disabled {{ (isset($type_of_affiliate)) ? '' : 'selected' }} hidden></option>
                                <option value="youtuber" {{ ($type_of_affiliate == 'youtuber') ? 'selected' : '' }}>Youtuber</option>
                                <option value="instagram_influencer" {{ ($type_of_affiliate == 'instagram_influencer') ? 'selected' : '' }}>Instagram Influencer</option>
                                <option value="blogger" {{ ($type_of_affiliate == 'blogger') ? 'selected' : '' }}>Blogger</option>
                                <option value="tiktoker" {{ ($type_of_affiliate == 'tiktoker') ? 'selected' : '' }}>Tiktoker</option>
                                <option value="podcaster" {{ ($type_of_affiliate == 'podcaster') ? 'selected' : '' }}>Podcaster</option>

                            </select>
                        </div>
                        <div class="text-center position-relative">
                            <button type="submit" class="btn large-blue-button" style="width: 100%;">Submit</button>
                        </div>
                    </form>
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
            document.getElementById("formAffiliateApply").onsubmit = function(e)
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