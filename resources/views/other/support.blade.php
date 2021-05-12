@extends('layouts.master')

@section('before-header')
    <div class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <h1 style="text-align: center"> Get in touch </h1>
        <div class="row flex-grow-1 no-padding">
            <div class="col-12 col-lg-4 col-md-6" style="align-items: center; justify-content: center; margin: auto;">
                <h2> Call Us </h2>
                    <div style="text-align: center;">
                    <p> 01772 000000 </p>
                    <h3 style="text-decoration: underline; font-size: 24px;"> Opening Hours </h3>
                    <p> 10am - 4:30pm </p>
                    <p> Monday to Thursday </p>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6" style="align-items: center; justify-content: center; margin: auto;">  
                <h2> Email Us </h2> 
                <div style="text-align: center;">
                    <p> Email us and we will aim to get back to you within 24 hours </p>
                    <p> placeholder@swapmyenergy.co.uk </p>
                    <p> 
                        Technical Issues? <br> 
                        View our support page 
                    </p>
                </div>
            </div>
            <div class="col-md-3 d-lg-none"></div>
            <div class="col-12 col-lg-4 col-md-6" style="align-items: center; justify-content: center; margin: auto;">  
                <h2> Message Us </h2>
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
                    <button type="button"> Launch Chat </button>
                </div>
            </div>
            <div class="col-md-3 d-lg-none"></div>
        </div>
    </div>
    <div class="full-size container-fluid d-flex h-100 flex-column">
        <h1 style="text-align: center"> Support </h1>
            <div class="row flex-grow-1 no-padding">
                <div class="col-12 col-lg-4 col-md-6" style="align-items: center; justify-content: center; margin: auto;"></div>
                <div class="col-12 col-lg-4 col-md-6" style="align-items: center; justify-content: center; margin: auto;">
                    <div style="text-align: center;">  
                        <h2> Raise Support Issue</h2>
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
                            </form>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6" style="align-items: center; justify-content: center; margin: auto;"></div>
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