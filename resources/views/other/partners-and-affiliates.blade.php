@extends('layouts.master')

@section('stylesheets')
    <style>
        .gallery-logo-outer {
            display: inline-block;
            padding: 30px;
            margin: auto;
            width: 19%;
        }

        img.gallery-logo {
            display: inline-block;
            max-width: 100%;
        }


        .center-div-outer {
            position: relative;
        }

        .center-div {
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
            border-right: 3px solid black;
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
            border-left: 3px solid black;
        }

        .bootstrap-select.btn-group .dropdown-menu > li > a:hover:not(:focus)
        {
            color: black;
        }

        .custom-select
        {
            background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='white' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right .75rem center/8px 10px;
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
                border-left: 3px solid black;
            }
        }
        
        @media (max-width: 992px)
        {
            .gallery-logo-outer
            {
                width: 32%;
                padding: 10px;
            }
            
            .border-bottom-lg
            {
                border-bottom: 3px solid black;
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
                border-bottom: 3px solid black;
            }

            .join-our-family
            {
                text-align: center;
            }
        }

    </style>
@endsection

@section('main-content')
    <hr />
    <div class="container-fluid" style="text-align: center;">
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
        <div class="gallery-logo-outer"><img class="gallery-logo" src="{{ asset('img/tradeenergygrants_light.png') }}" width="200" height="auto" /></div>
    </div>

    <hr />

    <div id="section01" class="container-fluid no-padding-left-right section-padding" style="background-color: white;">
        <div class="container no-padding-left-right">
            <div class="row">
                <div class="col-sm-6 col-12 border-right-sm border-bottom-sm section-padding" style="text-align: right;">
                    <h2> Your Benefits </h2>
                    <ul style="line-height: 1.2;">
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</li>
                        <li>Incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nostrud exercitation.
                        </li>
                        <li>Ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit.
                        </li>
                        <li>In voluptate velit esse cillum dolore eu fugiat nullapariatur. Excepteur sint occaecat cupidatate.</li>
                    </ul>
                </div>
                <div class="col-sm-6 col-12 join-our-family section-padding">
                    <h2 style="font-size: 45px;"> Join Our Family</h2>
                    <a href="#section03"><button type="button" class="big-blue-button btn-lg" href="#section03">Join Us</button></a>
                </div>
            </div>
        </div>
    </div>

    <hr />

    <div id="section02" class="full-size-80 container-fluid d-flex flex-column no-padding">
        <main class="row flex-grow-1 no-padding">
            <div class="col-xl-6 col-12 row no-padding align-items-center">
                <div class="col row no-padding">
                    <div class="col-sm-6 col-12 border-right-sm border-bottom-sm section-padding" style="text-align: right;">
                        <h2> Your Benefits </h2>
                        <ul style="line-height: 1.2;">
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</li>
                            <li>Incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nostrud exercitation.</li>
                            <li>Ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit.</li>
                            <li>In voluptate velit esse cillum dolore eu fugiat nullapariatur. Excepteur sint occaecat cupidatate.</li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-12 join-our-family section-padding">
                        <h2 style="font-size: 45px;">Our affiliates programme</h2>
                        <a href="#section03"><button class="big-blue-button btn-lg">Join Now</button></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 d-none d-xl-block section-border-left" style="background-color: white; min-height: 300px;"></div>
        </main>
    </div>

    <hr />
    <div id="section03" class="full-size-60 container-fluid d-flex flex-column no-padding" style="font-size: 22px;">
        <main class="row flex-grow-1 no-padding">
            <div class="col-lg-6 col-12 row no-padding border-bottom-lg">
                <div class="col" style="column-count: 2; column-width: 310px; column-fill: auto; padding: 20px; position: relative;">
                    <h2 style="column-span: all;">Apply to be a partner</h2>
                    <form id="formPartnerApply">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" required />
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="example@domain.com" required />
                        </div>  
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <p id="phoneNumberError" class="text-danger" style="font-size: 15px; margin-bottom: 0px;"></p>
                            <input type="text" class="form-control" id="phoneNumber" required />
                        </div>
                        <div class="form-group">
                            <label for="companyAddress">Company Address</label>
                            <textarea name="companyAddress" class="form-control" required rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="kindOfCompany">Nature of company</label>
                            <select id="kindOfCompany" class="custom-select form-control" required />
                                <option value="" disabled selected hidden></option>
                                <option value="energy-broker">Energy Broker</option>
                                <option value="lorem">Lorem</option>
                                <option value="ipsum">Ipsum</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="webLink">Link (If applicable)</label>
                            <input type="url" class="form-control" id="webLink">
                        </div>
                        <div class="form-group bottom-right">
                            <div class="text-center position-relative">
                                <button type="submit" class="btn big-blue-button btn-lg">Submit</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-6 col-12"></div>
                </div>
            </div>
            <div class="col-lg-6 col-12 row no-padding section-border-left-lg">
                <div class="col" style="column-count: 2; column-width: 310px; column-fill: auto; padding: 20px; position: relative;">
                    <h2 style="column-span: all;">Apply to be an affiliate</h2>
                    <form id="formPartnerApply">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" required />
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="example@domain.com" required />
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <p id="phoneNumberError" class="text-danger" style="font-size: 15px; margin-bottom: 0px;"></p>
                            <input type="text" class="form-control" id="phoneNumber" required />
                        </div>
                        <div class="form-group">
                            <label for="companyAddress">Company Address</label>
                            <textarea name="companyAddress" class="form-control" required rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="kindOfAffiliate">Nature of affiliate</label>
                            <select id="kindOfAffiliate" class="custom-select form-control" required>
                                <option value="" disabled selected hidden></option>
                                <option value="YouTuber">YouTuber</option>
                                <option value="lorem">Lorem</option>
                                <option value="ipsum">Ipsum</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="webLink">Link (If applicable)</label>
                            <input type="url" class="form-control" id="webLink" />
                        </div>
                        <div class="form-group bottom-right">
                            <div class="text-center position-relative">
                                <button type="submit" class="btn big-blue-button btn-lg">Submit</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-6 col-12"></div>
                </div>
            </div>
    </div>
          
        </main>
    
@endsection()

@section('script')
    <script>
        $(function()
        {
            var phoneNumberError = document.getElementById("phoneNumberError");
            document.getElementById("formPartnerApply").onsubmit = function (e)
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

    <script src="https://kit.fontawesome.com/6e2d0444fe.js" crossorigin="anonymous"></script>
@endsection