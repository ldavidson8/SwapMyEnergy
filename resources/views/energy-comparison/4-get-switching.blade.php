{{-- TODO: add empty string if values are null or undefined --}}
{{-- TODO: add carrets to the accordians --}}
{{-- TODO: add bank name input --}}

<?php
    $old_postcode = old('postcode');
    $old_address_line_1 = old('address_line_1');
    $old_address_line_2 = old('address_line_2');
    $old_town = old('town');
    $old_county = old('county');
    $old_smartMeter = old('smartMeter');
    $old_gas_meter_number = old('gas_meter_number');
    $old_elec_meter_number = old('elec_meter_number');
    
    $postcode = (isset($old_postcode)) ? $old_postcode : $mprn -> postcode;
    $address_line_1 = (isset($old_address_line_1)) ? $old_address_line_1 : trim($user_address["houseNo"] . " " . $user_address["houseName"]);
    $address_line_2 = (isset($old_address_line_2)) ? $old_address_line_2 : "";
    $town = (isset($old_town)) ? $old_town : $mprn -> post_town;
    $county = (isset($old_county)) ? $old_county : $mprn -> county;
    $smartMeter = (isset($old_smartMeter)) ? $old_smartMeter : "";
    $gas_meter_number = (isset($old_gas_meter_number)) ? $old_gas_meter_number : $mprn -> mprn;
    $elec_meter_number = (isset($old_elec_meter_number)) ? $old_elec_meter_number : $user_address["mpan"];
    
    
    $old_bankName = old('bankName');
    $old_accountName = old('accountName');
    $old_sortCode1 = old('sortCode1');
    $old_sortCode2 = old('sortCode2');
    $old_sortCode3 = old('sortCode3');
    $old_accountNumber = old('accountNumber');
    $old_preferredDay = old('preferredDay');
    $old_direct_debit_confirmation = old('direct_debit_confirmation');
    $old_receiveBills = old('receiveBills');
    
    $bankName = (isset($old_bankName)) ? $old_bankName : "";
    $accountName = (isset($old_accountName)) ? $old_accountName : "";
    $sortCode1 = (isset($old_sortCode1)) ? $old_sortCode1 : "";
    $sortCode2 = (isset($old_sortCode2)) ? $old_sortCode2 : "";
    $sortCode3 = (isset($old_sortCode3)) ? $old_sortCode3 : "";
    $accountNumber = (isset($old_accountNumber)) ? $old_accountNumber : "";
    $preferredDay = (isset($old_preferredDay)) ? $old_preferredDay : "";
    $direct_debit_confirmation = (isset($old_direct_debit_confirmation)) ? $old_direct_debit_confirmation : "";
    $receiveBills = (isset($old_receiveBills)) ? $old_receiveBills : "";


    $old_title = old('title');
    $old_firstName = old('firstName');
    $old_lastName = old('lastName');
    $old_telephone = old('telephone');
    $old_mobile = old('mobile');
    $old_emailAddress = old('emailAddress');

    $title = (isset($old_title)) ? $old_title : "";
    $firstName = (isset($old_firstName)) ? $old_firstName : "";
    $lastName = (isset($old_lastName)) ? $old_lastName : "";
    $telephone = (isset($old_telephone)) ? $old_telephone : "";
    $mobile = (isset($old_mobile)) ? $old_mobile : "";
    $emailAddress = (isset($old_emailAddress)) ? $old_emailAddress : "";
?>

@extends('layouts.master')

@section('stylesheets')
<style>
    .form-error-message
    {
        display: block;
        font-size: 20px;
    }

    .switchButton
    {
        width: 300px;
        padding: 20px;
        background-color: white;
        border-radius: 6px;
        position: relative;
        overflow: hidden;
        float: right;
        text-transform: uppercase;
        font-weight: 700;
    }

    .switchButton span
    {
        color: black;
        position: relative;
        z-index: 1;
        transition: color 0.6s cubic-bezier(0.53, 0.21, 0, 1);
    }

    .switchButton::before
    {
        content: 'SUBMIT';
        padding: 20px;
        text-transform: uppercase;
        font-weight: 700;
        position: absolute;
        top: 50%;
        left: 0;
        border-radius: 6px;
        transform: translate(-100%, -50%);
        width: 100%;
        height: 100%;
        background-color: #00c2cb;
        transition: transform 0.6s cubic-bezier(0.53, 0.21, 0, 1);
    }

    .switchButton:hover span
    {
        color: white;
    }

    .switchButton:hover::before
    {
        transform: translate(0, -50%);
    }


    .outer-rounded-container
    {
        border-radius: 35px;
        z-index: 11;
        font-weight: 700;
        font-size: 24px;
        color: #f3f2f1;
    }

    .rounded-container
    {
        border-radius: 0 0 35px 35px !important;
    }

    .blue-rounded-container
    {
        background-color: #00c2cb;
        z-index: 11;
        color: #f3f2f1;
        padding: 20px 30px;
    }

    .white-rounded-container
    {
        background-color: #f3f2f1;
        z-index: 10;
        color: #202020;
        padding: 50px;
        font-size: 20px;
    }

    .white-rounded-container-positioned
    {
        z-index: -1;
        position: absolute;
        left: 0;
        right: 0;
        top: -50px;
        width: 100%;
        height: 50px;
        background-color: #f3f2f1;
        border-left: solid 2px #202020;
        border-right: solid 2px #202020;
    }

    .form-top-heading
    {
        padding: 30px;
        text-transform: uppercase;
    }

    .form-top-left-heading
    {
        background-color: #202020;
        border-radius: 33px 0 0 0;
        text-align: center;
        display: inline-block;
        z-index: 2;
        position: relative;
    }
    
    .form-top-middle-heading
    {
        text-align: left;
    }

    .form-top-outer
    {
        /* background: url('{{ asset('img/bottom-border-white.png') }}') bottom repeat-x; */
        background-color: #00c2cb;
        border-radius: 33px 33px 0 0;
    }

    .form-top-img
    {
        background-color: #f3f2f1; 
        padding: 35px;
        /* border-radius: 0 35px 0 0; */
        border-radius: 0 33px 0 0;
        width: 200px;
        text-align: center;
        color: #202020;
    }
    .form-top-img img
    {
        max-width: 80%;
        max-height: 100px;
    }

    .form-table
    {
        width: 100%;
        height: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        display: inline-table;
    }

    .form-check
    {
        position: relative;
        display: block;
    }

    .form-check-input
    {
        position: absolute;
        margin-top: 10px;
    }

    .table-tariff
    {
        display: inline-block;
    }

    .table-tariff td
    {
        padding: 10px;
    }

    .white-progress-bar
    {
        width:350px;
        height:50px; 
        background-color: #202020; 
        border: 3px solid #f3f2f1;
        border-radius: 10px;
        color: #f3f2f1;
        text-align: center;
        z-index: 18;
        position: relative;
    }

    .white-progress-bar-text
    {
        z-index: 22;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        padding: 5px;
    }

    .white-progress-bar-border
    {
        width:350px;
        height:50px; 
        background-color: #202020; 
        border-radius: 10px;
        border: 2px solid #202020;
        color: #f3f2f1;
        text-align: center;
        z-index: 18;
        position: relative;
    }

    .white-progress-bar-border-text
    {
        z-index: 22;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        padding: 5px;
    }

    /* .black-progress-bar
    {
        height: 100%; 
        background-color: #202020; 
        border-radius: 7px;
        text-align: center;
        font-size: 24px;
        color: #00c2cb;
        padding: 5px 0;
        position: absolute;
        top: 0;
        z-index: 20;
    } */

    .blue-progress-bar
    {
        height: 100%; 
        background-color: #00c2cb; 
        border-radius: 7px;
        text-align: center;
        font-size: 24px;
        color: #00c2cb;
        padding: 5px 0;
        position: absolute;
        top: 0;
        z-index: 20;
    }

    .form-outer-box
    {
        padding: 20px 0;
    }

    .collapse-table
    {
        border: none;
        outline: none !important;
        font-weight: 700;
        padding: 20px 0;
        margin: 0 0 30px 0;
        border-bottom: solid 3px #00c2cb;
        width: 100%;
        text-align:left;
        background: none;
    }

    #tariff-info
    {
        text-transform: uppercase;
        text-align: center;
    }

    #tariff-info td
    {
        padding: 15px;
        width: 50%;
        border: 2px solid #202020;
    }

    #tariff-info td:first-child
    {
        font-weight: bold;
    }

    #tariff-info tbody:before
    {
        line-height: 20px
        content:"_";
        color: #f3f2f1;
        display:block;
    }

    #tariff-info td:nth-of-type(2n+1)
    {
       border-right: solid 2px #202020;
    }
    
    label
    {
        font-weight: bold;
        display: inline;
    }

    input:not([type="checkbox"])
    {
        display: block;
        width: 100%;
        max-width: 100%;
    }

    input[type="checkbox"]
    {
        float: left;
        margin: 11px 11px 11px 0px;
    }

    .small-input-text
    {
        font-size: 18px;
    }

    @media (min-width: 768px) and (max-width: 991px)
    {
        .form-top-left-border-md
        {
            border-radius: 33px 33px 0 0;
        }

        .form-top-img-border-md
        {
            border-radius: 0;
        }
    }


    @media (max-width: 767px)
    {

        .container, .container-fluid
        {
            max-width: 100% !important;
            width: 100%;
            padding: 0;
            border-radius: 0px !important;
        }

        .white-rounded-container
        {
            padding-bottom: 20px;
        }

        .form-outer-box
        {
            padding: 0;
        }

        .form-top-left-border-md
        {
            border-radius: 0;
        }
        
        .form-top-img-border-sm
        {
            border-radius: 0;
            width: 100%;
        }

        .form-top-middle-heading
        {
            text-align: center;
        }

        .table-block-on-mobile
        {
            width: 100%;
        }

        .table-block-on-mobile tbody,
        .table-block-on-mobile tr,
        .table-block-on-mobile td
        {
            display: block;
            width: 100%;
            max-width: 100%;
        }

        .table-tariff
        {
            width: 100%;
        }

        .table-tariff tbody,
        .table-tariff tr,
        .table-tariff td
        {
            display: block;
            width: 100%;
            max-width: 100%;
        }

        .white-progress-bar
        {
            width: 100%;
            max-width: 100%;
        }
        .white-progress-bar-border
        {
            width: 100%;
            max-width: 100%;
        }
        .blue-progress-bar
        {
            width: 100%;
            max-width: 100%;
        }
    }

    hr.thin-line
    {
        border-top: none;
    }
</style>
@endsection

@section('before-header')
    <div id="section01" class="container-fluid no-padding d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr />
        <div class="background-image-wind-turbines background-image-top background-image-contain flex-fill">
            <div class="col-12 center-content form-outer-box">
                <div class="container outer-rounded-container no-padding flex-row" style="border: solid 2px #202020;">
                    <div class="row form-top-outer">
                        <div class="col-12 col-lg-4 form-top-heading form-top-left-heading form-top-left-border-md">
                            <table class="form-table"><tr><td>Step 4 | Get Switching </td></tr></table>
                        </div>
                        <div class="flex-fill form-top-heading form-top-middle-heading">
                            <table class="form-table"><tr><td>Selected Tariff</td></tr></table>
                        </div>
                        <div class="no-padding form-top-img form-top-img-border-sm form-top-img-border-md">
                            <table class="form-table"><tr><td><img src="{{ asset('img/supplier-logos/' . $selected_tariff["imageName"]) }}" alt="{{ $selected_tariff["supplierName"] }}" height="auto" width="auto" /></td></tr></table>
                        </div>
                    </div>
                    {{-- <div class="container rounded-container blue-rounded-container">
                        <table class="form-table">
                            <tr>
                                <td>
                                    <div class="row no-padding">
                                        <div class="col-lg-8 col-12 no-padding">
                                            <table class="table-tariff table-block-on-mobile" style=" vertical-align: bottom;">
                                                <tr>
                                                    <td>
                                                        Unit Rate:
                                                    </td>
                                                    <td>
                                                        <div class="white-progress-bar">
                                                            <div class="white-progress-bar-text">12p*</div>
                                                            <div class="blue-progress-bar" style="width: 80%;"></div>  
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Standing Charge:
                                                    </td>
                                                    <td>
                                                        <div class="white-progress-bar">
                                                            <div class="white-progress-bar-text">2p*</div>
                                                            <div class="blue-progress-bar" style="width: 30%"></div>  
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-4 col-12 no-padding">
                                            <table class="form-table" style="">
                                                <tr style="height: 100%;"></tr>
                                                <tr>
                                                    <td style="vertical-align: bottom; width: 50%; text-align: center;">
                                                        <p style="font-size: 20px; text-align: center; border-right: solid 2px #f3f2f1;">
                                                            <span style="font-size: 34px;">£81.76</span> 
                                                            <br /> 
                                                            per month
                                                        </p>
                                                    </td>
                                                    <td style="vertical-align: bottom; width: 50%; text-align: center;">
                                                        <p style="font-size: 20px;"> 24 month<br />contract </p>  
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div> --}}
                    <div style="position: relative; font-size; 22px; font-weight: normal;">
                        <div class="white-rounded-container-positioned"></div>
                        <div class="container rounded-container white-rounded-container">
                            <h1 style="margin: 0px 0px 20px 0px;">Switching to a new Tariff</h1>
                            
                            <h2>What happens next?</h2>
                            <p>We will send your application securely to the new energy supplier. They will contact your current supplier to arrange a 'Supply Start Date' usually within the next 21-days. Everything will be handled by the energy suppliers meaning you only need to do something if asked to do so e.g. provide a final meter reading. If you have any questions whatsoever, contact us on 0800 448 0205 or email help@theenergyshop.com and we will be happy to help.</p>
                            
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors -> all() as $error)
                                        {{ $error }}<br />
                                    @endforeach
                                </div>
                            @endif
                            
                            <button class="collapse-table" id="tariff-info-toggle" role="button">Information about the Selected Tariff</button>
                            <table id="tariff-info" style="width: 100%;">
                                <tr><td>Supplier</td><td>{{ $selected_tariff["supplierName"] }}</td></tr>
                                <tr><td>Tariff Name</td><td>{{ $selected_tariff["tariffName"] }}</td></tr>
                                <tr><td>Estimated Anuall Cost</td><td>{{ $selected_tariff["bill"] }}</td></tr>
                                <tr><td>Estimated Anuall Saving</td><td>{{ $selected_tariff["saving"] }}</td></tr>
                                <tr><td>Payment Method</td><td>{{ $selected_tariff["paymentMethod"] }}</td></tr>
                                @if ($existing_tariff -> fuel_type_char == "D" || $existing_tariff -> fuel_type_char == "G")
                                    <tr><td>Gas Unit Rate</td><td>{{ $selected_tariff["tariff_info"] -> price1Gas }}</td></tr>
                                    <tr><td>Gas Standing Charge</td><td>{{ number_format($selected_tariff["tariff_info"] -> standingChargeGas / 365, 2) }}</td></tr>
                                @endif
                                @if ($existing_tariff -> fuel_type_char == "D" || $existing_tariff -> fuel_type_char == "E")
                                    <tr><td>Electricity Unit Rate</td><td>{{ $selected_tariff["tariff_info"] -> price1Elec }}</td></tr>
                                    <tr><td>Electricity Standing Charge</td><td>{{ number_format($selected_tariff["tariff_info"] -> standingChargeElec / 365, 2) }}</td></tr>
                                @endif
                            </table>
                            
                            <br />
                            <form id="main_form" action="{{ route('residential.energy-comparison.4-get-switching') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <span id="postcode_error" class="form-error-message text-danger"></span>
                                    <label for="postcode">Postcode</label>
                                    <input type="text" id="postcode" name="postcode" value="{{ $postcode }}" />
                                </div>
                                <div class="form-group">
                                    <span id="address_line_1_error" class="form-error-message text-danger"></span>
                                    <label for="address_line_1">Address Line 1<span class="text-danger">*</span></label>
                                    <input type="text" id="address_line_1" name="address_line_1" value="{{ $address_line_1 }}" required />
                                </div>
                                <div class="form-group">
                                    <span id="address_line_2_error" class="form-error-message text-danger"></span>
                                    <label for="address_line_2">Address Line 2</label>
                                    <input type="text" id="address_line_2" name="address_line_2" value="{{ $address_line_2 }}" />
                                </div>
                                <div class="form-group">
                                    <span id="town_error" class="form-error-message text-danger"></span>
                                    <label for="town">Town<span class="text-danger">*</span></label>
                                    <input type="text" id="town" name="town" value="{{ $town }}" required />
                                </div>
                                <div class="form-group">
                                    <span id="county_error" class="form-error-message text-danger"></span>
                                    <label for="county">County</label>
                                    <input type="text" id="county" name="county" value="{{ $county }}" />
                                </div>
                                <div class="form-group">
                                    <span id="smartMeter_error" class="form-error-message text-danger"></span>
                                    <label for="smartMeter">Do you already have a smart meter installed at your home?<span class="text-danger">*</span></label>
                                    <select id="smartMeter" name="smartMeter" data-value="{{ $smartMeter }}" required>
                                        <option value="">Please Select</option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                        <option value="doNotKnow">Don't Know</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span id="gas_meter_number_error" class="form-error-message text-danger"></span>
                                    <label for="gas_meter_number">Gas meter number<span class="text-danger">*</span></label>
                                    <p><input type="text" id="gas_meter_number" name="gas_meter_number" value="{{ $gas_meter_number }}" required /></p>
                                    <p>Your gas meter number is also known as a Meter Point Reference Number (MPRN). Please enter the number as you find it on your gas bill. If you are unable to find this information on your energy bill, you can get it by calling the National Grid on 0870 608 1524 (press 2 then 1).</p>
                                    <p>Or <a href="https://www.findmysupplier.energy/webapp/index.html">click here</a> to find this information online. Enter your postcode first and then your house number.</p>
                                </div>
                                <div class="form-group">
                                    <span id="elec_meter_number_error" class="form-error-message text-danger"></span>
                                    <label for="elec_meter_number">Electricity meter number<span class="text-danger">*</span></label>
                                    <p><input type="text" id="elec_meter_number" name="elec_meter_number" value="{{ $elec_meter_number }}" /></p>
                                    <p>Your electricity meter number is also known as a Supply (S) Number or MPAN. Please enter the bottom row of numbers as you find them on your electricity bill without spaces as highlighted in the example below.</p>
                                    <img alt="Example of an Electricity Number" src="" />
                                </div>
                                
                                <br /><hr class="thin-line" /><br />
                                
                                <h2>Your Direct Debit Details</h2>
                                <p>You will pay &pound;{{ number_format($selected_tariff["bill"] / 12, 2) }} per month to {{ $selected_tariff["supplierName"] }}.</p>
                                <p>Even after you have submitted this application you still have 14 days from today to cancel your contract if you change your mind.</p>
                                
                                <div class="form-group">
                                    <span id="bankName_error" class="form-error-message text-danger"></span>
                                    <label for="bankName" class="font-weight-bold">Bank Name</label>
                                    <input type="text" id="bankName" name="bankName" value="{{ $bankName }}" required="required" />
                                </div>
                                <div class="form-group">
                                    <span id="accountName_error" class="form-error-message text-danger"></span>
                                    <label for="accountName" class="font-weight-bold">Account Holder Name<span class="text-danger">*</span></label> 
                                    <input type="text" id="accountName" name="accountName" value="{{ $accountName }}" required />
                                </div>
                                <div class="row no-margin">
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <span id="sortCode_error" class="form-error-message text-danger"></span>
                                            <label for="sortCode1 sortCode2 sortCode3" class="font-weight-bold d-block">Sort Code<span class="text-danger">*</span></label>
                                            <input id="sortCode1" name="sortCode1" inputmode="tel" minlength="2" maxlength="2" type="text" class="w-25 d-inline text-center" value="{{ $sortCode1 }}" required />
                                            <input id="sortCode2" name="sortCode2" inputmode="tel" minlength="2" maxlength="2" type="text" class="w-25 d-inline text-center" value="{{ $sortCode2 }}" required />
                                            <input id="sortCode3" name="sortCode3" inputmode="tel" minlength="2" maxlength="2" type="text" class="w-25 d-inline text-center" value="{{ $sortCode3 }}" required />
                                        </div>
                                    </div> 
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <span id="accountNumber_error" class="form-error-message text-danger"></span>
                                            <label for="accountNumber" class="font-weight-bold">Account Number<span class="text-danger">*</span></label> 
                                            <input id="accountNumber" name="accountNumber" inputmode="tel" maxlength="8" type="text" value="{{ $accountNumber }}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-margin">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <span id="preferredDay_error" class="form-error-message text-danger"></span>
                                            <label for="preferredDay" class="font-weight-bold">Select your payment date<span class="text-danger">*</span></label>
                                            <select id="preferredDay" name="preferredDay" data-value="{{ $preferredDay }}" required>
                                                <option value="" selected>Please Select</option> 
                                                <option value="1">1</option> 
                                                <option value="2">2</option> 
                                                <option value="3">3</option> 
                                                <option value="4">4</option> 
                                                <option value="5">5</option> 
                                                <option value="6">6</option> 
                                                <option value="7">7</option> 
                                                <option value="8">8</option> 
                                                <option value="9">9</option> 
                                                <option value="10">10</option> 
                                                <option value="11">11</option> 
                                                <option value="12">12</option> 
                                                <option value="13">13</option> 
                                                <option value="14">14</option> 
                                                <option value="15">15</option> 
                                                <option value="16">16</option> 
                                                <option value="17">17</option> 
                                                <option value="18">18</option> 
                                                <option value="19">19</option> 
                                                <option value="20">20</option> 
                                                <option value="21">21</option> 
                                                <option value="22">22</option> 
                                                <option value="23">23</option> 
                                                <option value="24">24</option> 
                                                <option value="25">25</option> 
                                                <option value="26">26</option> 
                                                <option value="27">27</option> 
                                                <option value="28">28</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span id="direct_debit_confirmation_error" class="form-error-message text-danger"></span>
                                    <input type="checkbox" id="direct_debit_confirmation" name="direct_debit_confirmation" {{ ($direct_debit_confirmation == true) ? "checked" : " " }} />
                                    <label for="direct_debit_confirmation" class="">I confirm I am the account holder and am the only person required to authorise Direct Debits from my bank account.</label>
                                </div>
                                <div class="row no-margin mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <span id="receiveBills_error" class="form-error-message text-danger"></span>
                                            <label for="receiveBills" class="font-weight-bold">
                                                How would you like to receive all communications from <!-- insert name of selected tariff here -->? An electronic preference means <!-- "they" will be name of selected tariff -->they will
                                                communicate with you electronically wherever possible.<span class="text-danger">*</span>
                                            </label> 
                                            <select id="receiveBills" name="receiveBills" value="{{ $receiveBills }}" required>
                                                <option value="Email">Email</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="collapse-table" id="cancellation-rights-toggle" role="button" style="border: none;">Your Cancellation Rights</button>
                                <div id="cancellation-rights" style="display: none">If you change your mind and want to cancel the contract, you must tell Igloo Energy within the cooling off period, which ends 14 days from day after you sign up.</div>
                                
                                <br /><hr class="thin-line" /><br />

                                <h2>Your Contact Details</h2>
                                <div class="form-group">
                                    <span id=title"_error" class="form-error-message text-danger"></span>
                                    <label for="title" class="font-weight-bold">Title<span class="text-danger">*</span></label> 
                                    <input type="text" id="title" name="title" value="{{ $title }}" required />
                                </div>
                                <div class="form-group">
                                    <span id="firstName_error" class="form-error-message text-danger"></span>
                                    <label for="firstName" class="font-weight-bold">First Name<span class="text-danger">*</span></label> 
                                    <input type="text" id="firstName" name="firstName" value="{{ $firstName }}" required />
                                </div>
                                <div class="form-group">
                                    <span id="lastName_error" class="form-error-message text-danger"></span>
                                    <label for="lastName" class="font-weight-bold">Last Name<span class="text-danger">*</span></label> 
                                    <input type="text" id="lastName" name="lastName" value="{{ $lastName }}" required />
                                </div>
                                <div class="form-group">
                                    <span id="telephone_error" class="form-error-message text-danger"></span>
                                    <label for="telephone" class="font-weight-bold">Telephone<span class="text-danger">*</span></label> 
                                    <input type="text" id="telephone" name="telephone" value="{{ $telephone }}" required />
                                    <span class="small-input-text">Please enter the number starting with 0 and not the dialling code.</span>
                                </div>
                                <div class="form-group">
                                    <span id="mobile_error" class="form-error-message text-danger"></span>
                                    <label for="mobile" class="font-weight-bold">Mobile</label> 
                                    <input type="text" id="mobile" name="mobile" value="{{ $mobile }}" />
                                    <span class="small-input-text">Please enter the number starting with 0 and not the dialling code.</span>
                                </div>
                                <div class="form-group">
                                    <span id="emailAddress_error" class="form-error-message text-danger"></span>
                                    <label for="emailAddress" class="font-weight-bold">Email Address<span class="text-danger">*</span></label> 
                                    <input type="email" id="emailAddress" name="emailAddress" value="{{ $emailAddress }}" required />
                                </div>
                                
                                <button type="submit" class="switchButton">Get Switching</button>
                            </form>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>

@endsection

@section('script')
    <script>
        document.body.onload = function()
        {
            var inputSmartMeter = $("#smartMeter");
            var inputPreferredDay = $("#preferredDay");
            inputSmartMeter.find('[value=' + inputSmartMeter.attr('data-value') + ']').prop("selected", true);
            inputPreferredDay.find('[value=' + inputPreferredDay.attr('data-value') + ']').prop("selected", true);
            

            // javascript validation
            var mainForm = document.getElementById("main_form");
            
            // var errorPostcode = $("#postcode_error");
            // var inputPostcode = $("#postcode");
            // var errorAddressLine1 = $("#address_line_1_error");
            // var inputAddressLine1 = $("#address_line_1");
            // var errorAddressLine2 = $("#address_line_2_error");
            // var inputAddressLine2 = $("#address_line_2");
            // var errorTown = $("#town_error");
            // var inputTown = $("#town");
            // var errorCounty = $("#county_error");
            // var inputCounty = $("#county");
            // var errorSmartMeter = $("#smartMeter_error");
            // var inputSmartMeter = $("#smartMeter");
            // var errorGasMeterNumber = $("#gas_meter_number_error");
            // var inputGasMeterNumber = $("#gas_meter_number");
            // var errorElecMeterNumber = $("#elec_meter_number_error");
            // var inputElecMeterNumber = $("#elec_meter_number");

            // var errorBankName = $("#bankName_error");
            // var inputBankName = $("#bankName");
            // var errorAccountName = $("#accountName_error");
            // var inputAccountName = $("#accountName");
            // var errorSortCode1 = $("#sortCode1_error");
            // var inputSortCode1 = $("#sortCode1");
            // var errorSortCode2 = $("#sortCode2_error");
            // var inputSortCode2 = $("#sortCode2");
            // var errorSortCode3 = $("#sortCode3_error");
            // var inputSortCode3 = $("#sortCode3");
            // var errorAccountNumber = $("#accountNumber_error");
            // var inputAccountNumber = $("#accountNumber");
            // var errorPreferredDay = $("#preferredDay_error");
            // var inputPreferredDay = $("#preferredDay");
            // var errorDirectDebitConfirmation = $("#direct_debit_confirmation_error");
            // var inputDirectDebitConfirmation = $("#direct_debit_confirmation");
            // var errorReceiveBills = $("#receiveBills_error");
            // var inputReceiveBills = $("#receiveBills");
            
            // var errorTitle = $("#title_error");
            // var inputTitle = $("#title");
            // var errorFirstName = $("#firstName_error");
            // var inputFirstName = $("#firstName");
            // var errorLastName = $("#lastName_error");
            // var inputLastName = $("#lastName");
            var errorTelephone = $("#telephone_error");
            var inputTelephone = $("#telephone");
            var errorMobile = $("#mobile_error");
            var inputMobile = $("#mobile");
            // var errorEmailAddress = $("#emailAddress_error");
            // var inputEmailAddress = $("#emailAddress");
            
            mainForm.onsubmit = function(e)
            {
                $(".form-error-message").text('');
                
                if (!inputTelephone.val().startsWith('0'))
                {
                    e.preventDefault();
                    errorTelephone.text("The telephone number must start with a zero.");
                    try { $("html, body").animate({ "scrollTop": errorTelephone.offset().top }, 0); }
                    catch(ex) {}
                    return;
                }
                if (inputTelephone.val().length != 11)
                {
                    e.preventDefault();
                    errorTelephone.text("The telephone number must be 11 digits long.");
                    try { $("html, body").animate({ "scrollTop": errorTelephone.offset().top }, 0); }
                    catch(ex) {}
                    return;
                }
                
                if (inputMobile.val().length > 0)
                {
                    if (!inputMobile.val().startsWith('0'))
                    {
                        e.preventDefault();
                        errorMobile.text("The mobile number must start with a zero.");
                        try { $("html, body").animate({ "scrollTop": errorMobile.offset().top }, 0); }
                        catch(ex) {}
                        return;
                    }
                    if (inputMobile.val().length != 11)
                    {
                        e.preventDefault();
                        errorMobile.text("The mobile number must be 11 digits long.");
                        try { $("html, body").animate({ "scrollTop": errorMobile.offset().top }, 0); }
                        catch(ex) {}
                        return;
                    }
                }
            };
        };

        $('input, select').change(function()
        {
            $(".form-error-message").text('');
        });

        $('#tariff-info-toggle').click(function()
        {
            $('#tariff-info').fadeToggle(750);
        });
        $('#cancellation-rights-toggle').click(function()
        {
            $('#cancellation-rights').fadeToggle(750);
        });
    </script>
@endsection