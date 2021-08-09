<?php
    $street_name = (isset($mprn -> dependent_street) && $mprn -> dependent_street != "") ? $mprn -> dependent_street : $mprn -> street;

    $coolingOff = 0;
    if (isset($selected_tariff["supplierCoolingOff"]) && is_numeric(isset($selected_tariff["supplierCoolingOff"])))
    {
        $coolingOff = isset($selected_tariff["supplierCoolingOff"]);
    }
    if (isset($selected_tariff["tariff_info"] -> supplierCoolingOff) && is_numeric(isset($selected_tariff["tariff_info"] -> supplierCoolingOff)))
    {
        $coolingOff = isset($selected_tariff["tariff_info"] -> supplierCoolingOff);
    }


    $legal_text_for_supplier = "";   // variable for legal text switch statements
    $preffered_payment_date = false; // whether to show the preffered payment date

    // Legal Text
    // Bristol Energy
    if ($selected_tariff['supplierId'] == 100 || $selected_tariff['supplierName'] == "Bristol Energy")
    {
        $legal_text_for_supplier = "Bristol Energy";
    }
    // EDF Energy
    if ($selected_tariff['supplierId'] == 68 || $selected_tariff['supplierName'] == "EDF Energy")
    {
        $legal_text_for_supplier = "EDF Energy";
        $preffered_payment_date = true;
    }
    // Green
    if ($selected_tariff['supplierId'] == 140 || $selected_tariff['supplierName'] == "Green")
    {
        $legal_text_for_supplier = "Green";
    }
    // Igloo Energy
    if ($selected_tariff['supplierId'] == 124 || $selected_tariff['supplierName'] == "Igloo Energy")
    {
        $legal_text_for_supplier = "Igloo Energy";
    }
    // ScottishPower
    if ($selected_tariff['supplierId'] == 16 || $selected_tariff['supplierName'] == "ScottishPower")
    {
        $legal_text_for_supplier = "ScottishPower";
    }
    // Shell Energy
    if ($selected_tariff['supplierId'] == 75 || $selected_tariff['supplierName'] == "Shell Energy")
    {
        $legal_text_for_supplier = "Shell Energy";
    }
    // Together Energy
    if ($selected_tariff['supplierId'] == 122 || $selected_tariff['supplierName'] == "Together Energy")
    {
        $legal_text_for_supplier = "Together Energy";
    }

    // Preffered Payment Date Only
    // PFP Energy
    if ($selected_tariff['supplierId'] == 99 || $selected_tariff['supplierName'] == "PFP Energy")
    {
        $legal_text_for_supplier = "PFP Energy";
        $preffered_payment_date = true;
    }
    // Spark Energy
    if ($selected_tariff['supplierId'] == 73 || $selected_tariff['supplierName'] == "Spark Energy")
    {
        $legal_text_for_supplier = "Spark Energy";
        $preffered_payment_date = true;
    }
    // Octopus Energy
    if ($selected_tariff['supplierId'] == 104 || $selected_tariff['supplierName'] == "Octopus Energy")
    {
        $legal_text_for_supplier = "Octopus Energy";
        $preffered_payment_date = true;
    }
    // Green Star Energy
    if ($selected_tariff['supplierId'] == 88 || $selected_tariff['supplierName'] == "Green Star Energy")
    {
        $legal_text_for_supplier = "Green Star Energy";
        $preffered_payment_date = true;
    }
    // OVO energy
    if ($selected_tariff['supplierId'] == 76 || $selected_tariff['supplierName'] == "OVO energy")
    {
        $legal_text_for_supplier = "OVO energy";
        $preffered_payment_date = true;
    }
    // E.ON
    if ($selected_tariff['supplierId'] == 14 || $selected_tariff['supplierName'] == "E.ON" || $selected_tariff['supplierId'] == 150 || $selected_tariff['supplierName'] == "E.ON Next")
    {
        $legal_text_for_supplier = "E.ON";
        $preffered_payment_date = true;
    }
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

        .collapse-table-button
        {
            border: none;
            outline: none !important;
            font-weight: 700;
            padding: 20px 0;
            margin: 0;
            border-bottom: solid 3px #00c2cb;
            width: 100%;
            text-align:left;
            background: none;
        }

        #tariff-info
        {
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
            text-transform: capitalize;
        }

        #tariff-info tbody:before
        {
            line-height: 20px
            content: "_";
            color: #f3f2f1;
            display: block;
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

        input:not([type="checkbox"]),
        select
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

        #billing_table th
        {
            padding: 7px;
            padding-bottom: 0px;
        }

        #billing_table td
        {
            padding: 7px;
        }

        .site-accordion-panel
        {
            padding-top: 20px;
        }


        .blue-text
        {
            color: #0044cb;
        }

        .grey-text
        {
            color: #555;
        }

        #direct_debit_guarantee_background
        {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.3);
        }
        #direct_debit_guarantee_popup_outer
        {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            height: 0;
            text-align: center;
        }
        #direct_debit_guarantee_popup
        {
            margin: 20px auto;
            padding: 20px;
            background-color: #f3f2f1;
            border: 2px solid #202020;
            color: #202020;
            border-radius: 20px;
            text-align: left;
            display: inline-block;
            width: 767px;
            height: auto;
            max-width: 90%;
            max-height: 90vh;
            overflow-y: scroll;
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

            #direct_debit_guarantee_popup
            {
                margin: 0px;
                padding: 10px;
                border: 2px solid #202020;
                border-radius: 0px;
            }
        }

        hr.thin-line
        {
            border-top: none;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/accordion.css') }}" />
@endsection

@section('before-header')
    <div id="section01" class="container-fluid no-padding d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr />
        <div class="background-image-wind-turbines background-image-top background-image-contain background-image-no-mobile-2 flex-fill">
            <div class="col-12 center-content form-outer-box">
                <div class="container outer-rounded-container no-padding flex-row" style="border: solid 2px #202020;">
                    <div class="row form-top-outer">
                        <div class="col-12 col-lg-4 form-top-heading form-top-left-heading form-top-left-border-md">
                            <table class="form-table"><tr><td>Step 4 | Get Switching </td></tr></table>
                        </div>
                        <div class="flex-fill form-top-heading form-top-middle-heading">
                            <table class="form-table"><tr><td>Selected Tariff</td></tr></table>
                        </div>
                        <div class="form-top-img form-top-img-border-sm form-top-img-border-md mobile-only-padding-30">
                            <table class="form-table"><tr><td><img src="{{ asset('img/supplier-logos/' . $selected_tariff["imageName"]) }}" alt="{{ $selected_tariff["supplierName"] }}" height="auto" width="auto" /></td></tr></table>
                        </div>
                    </div>
                    <div class="mobile-only-padding-30" style="position: relative; font-size; 22px; font-weight: normal;">
                        <div class="white-rounded-container-positioned"></div>
                        <div class="container rounded-container white-rounded-container">
                            <h1 style="margin: 0px 0px 20px 0px;">Switching to a new Tariff</h1>

                            <h2>What happens next?</h2>
                            <p>We will send your application securely to the new energy supplier. They will contact your current supplier to arrange a 'Supply Start Date' usually within the next 21-days. Everything will be handled by the energy suppliers meaning you only need to do something if asked to do so e.g. provide a final meter reading. If you have any questions whatsoever, contact us on 0800 448 0205 or email help@theenergyshop.com and we will be happy to help.</p>

                            @if (Session::has('fail') && Session::get('fail') == 'session_expired')
                                {{-- <div class="alert alert-danger post-error">
                                    Sorry, your session expired. Please try again.
                                </div> --}}
                            @elseif (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors -> all() as $error)
                                        @if (str_starts_with($error, "The billing "))
                                            Billing Address: The {{ substr($error, 12) }}<br />
                                        @else
                                            {{ $error }}<br />
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            {{-- <button class="site-accordion">Why choose Swap My Energy?</button>
                            <div class="site-accordion-panel">
                                <p>Swap My Energy are dedicated to switching made simple. We allow you to see as much information regarding your deals as possible, allowing you to know exactly why your prices are the way they are.</p>
                            </div>
                            <button class="site-accordion">How long does it take to switch?</button>
                            <div class="site-accordion-panel">
                                <p>Once you have decided to switch, your information will be provided to the supplier of your choice and your switching will be underway. Typically, suppliers take around two weeks to switch you over, this gives you a chance to change your mind and stop switching.</p>
                            </div> --}}
                            {{-- <button class="collapse-table-button" id="tariff-info-toggle" role="button">Information about the Selected Tariff</button> --}}
                            <button class="collapse-table-button site-accordion" role="button">Information about the Selected Tariff</button>
                            <div class="site-accordion-panel">
                                <table id="tariff-info" style="width: 100%;">
                                    <tr><td>Supplier</td><td>{{ $selected_tariff["supplierName"] }}</td></tr>
                                    <tr><td>Tariff Name</td><td>{{ $selected_tariff["tariffName"] }}</td></tr>
                                    <tr><td>Estimated Anuall Cost</td><td>{{ $selected_tariff["bill"] }}</td></tr>
                                    <tr><td>Estimated Anuall Saving</td><td>{{ $selected_tariff["saving"] }}</td></tr>
                                    @if ($existing_tariff -> fuel_type_char == "D" || $existing_tariff -> fuel_type_char == "G")
                                        <tr><td>Gas Unit Rate</td><td>{{ $selected_tariff["tariff_info"] -> price1Gas }}p</td></tr>
                                        <tr><td>Gas Standing Charge</td><td>{{ number_format($selected_tariff["tariff_info"] -> standingChargeGas / 365, 2) }}p</td></tr>
                                    @endif
                                    @if ($existing_tariff -> fuel_type_char == "D" || $existing_tariff -> fuel_type_char == "E")
                                        <tr><td>Electricity Unit Rate</td><td>{{ $selected_tariff["tariff_info"] -> price1Elec }}p</td></tr>
                                        <tr><td>Electricity Standing Charge</td><td>{{ number_format($selected_tariff["tariff_info"] -> standingChargeElec / 365, 2) }}p</td></tr>
                                    @endif
                                </table>
                            </div>
                            <br />

                            <h2>Your Current Address</h2>
                            <form id="main_form" action="{{ route('residential.energy-comparison.4-get-switching') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="house_number">House Number</label>
                                    <span id="house_number_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="house_number" name="house_number" value="{{ old('house_number', $mprn -> house_number) }}" />
                                </div>
                                <div class="form-group">
                                    <label for="postcode">Postcode <span class="text-danger">*</span></label>
                                    <span id="postcode_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="postcode" name="postcode" value="{{ old('postcode', $mprn -> postcode) }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="address_line_1">Address Line 1<span class="text-danger">*</span></label>
                                    <span id="address_line_1_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="address_line_1" name="address_line_1" value="{{ old('address_line_1', trim($user_address["houseNo"] . " " . $user_address["houseName"])) }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="address_line_2">Address Line 2</label>
                                    <span id="address_line_2_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="address_line_2" name="address_line_2" value="{{ old('address_line_2', '') }}" />
                                </div>
                                <div class="form-group">
                                    <label for="road_name">Road Name <span class="text-danger">*</span></label>
                                    <span id="road_name_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="road_name" name="road_name" value="{{ old('road_name', $street_name) }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="town">Town<span class="text-danger">*</span></label>
                                    <span id="town_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="town" name="town" value="{{ old('town', $mprn -> post_town) }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="county">County</label>
                                    <span id="county_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="county" name="county" value="{{ old('county', '') }}" />
                                </div>

                                @if ($get_previous_addresses)
                                    {{-- How Long At Current Address --}}
                                    <br /><br />
                                    <label>How long have you been at this address?</label>
                                    <div class="form-group">
                                        <label for="address_length_years">Years</label>
                                        <span id="address_length_years_error" class="form-error-message text-danger"></span>
                                        <input type="number" min="0" id="address_length_years" name="address_length_years" value="{{ old('address_length_years', "") }}" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <label for="address_length_months">Months</label>
                                        <span id="address_length_months_error" class="form-error-message text-danger"></span>
                                        <input type="number" min="0" max="11" id="address_length_months" name="address_length_months" value="{{ old('address_length_months', "") }}" required="required" />
                                    </div>

                                    {{-- Previous Address 1 --}}
                                    <fieldset class="form-group" id="prev_addr_1_section" style="display: none;" disabled>
                                        <br /><hr class="thin-line" /><br />

                                        <h2>Previous Address 1</h2>

                                        <div class="form-group">
                                            <label for="prev_addr_1_house_number">House Number <span class="text-danger">*</span></label>
                                            <span id="prev_addr_1_house_number_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_1_house_number" name="prev_addr_1_house_number" value="{{ old('prev_addr_1_house_number', "") }}" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_1_postcode">Postcode <span class="text-danger">*</span></label>
                                            <span id="prev_addr_1_postcode_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_1_postcode" name="prev_addr_1_postcode" value="{{ old('prev_addr_1_postcode', "") }}" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_1_address_line_1">Address Line 1 <span class="text-danger">*</span></label>
                                            <span id="prev_addr_1_address_line_1_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_1_address_line_1" name="prev_addr_1_address_line_1" value="{{ old('prev_addr_1_address_line_1', "") }}" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_1_address_line_2">Address Line 2</label>
                                            <span id="prev_addr_1_address_line_2_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_1_address_line_2" name="prev_addr_1_address_line_2" value="{{ old('prev_addr_1_address_line_2', "") }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_1_road_name">Road Name <span class="text-danger">*</span></label>
                                            <span id="prev_addr_1_road_name_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_1_road_name" name="prev_addr_1_road_name" value="{{ old('prev_addr_1_road_name', "") }}" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_1_town">Town <span class="text-danger">*</span></label>
                                            <span id="prev_addr_1_town_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_1_town" name="prev_addr_1_town" value="{{ old('prev_addr_1_town', "") }}" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_1_county">County</label>
                                            <span id="prev_addr_1_county_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_1_county" name="prev_addr_1_county" value="{{ old('prev_addr_1_county', "") }}" />
                                        </div>
                                        <br /><br />

                                        <label>How long have you been at this address?</label>
                                        <div class="form-group">
                                            <label for="prev_addr_1_length_years">Years</label>
                                            <span id="prev_addr_1_length_years_error" class="form-error-message text-danger"></span>
                                            <input type="number" min="0" id="prev_addr_1_length_years" name="prev_addr_1_length_years" value="{{ old('prev_addr_1_length_years', "") }}" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_1_length_months">Months</label>
                                            <span id="prev_addr_1_length_months_error" class="form-error-message text-danger"></span>
                                            <input type="number" min="0" max="11" id="prev_addr_1_length_months" name="prev_addr_1_length_months" value="{{ old('prev_addr_1_length_months', "") }}" required="required" />
                                        </div>
                                    </fieldset>

                                    {{-- Previous Address 2 --}}
                                    <fieldset class="form-group" id="prev_addr_2_section" style="display: none;" disabled>
                                        <br /><hr class="thin-line" /><br />

                                        <h2>Previous Address 2</h2>

                                        <div class="form-group">
                                            <label for="prev_addr_2_house_number">House Number <span class="text-danger">*</span></label>
                                            <span id="prev_addr_2_house_number_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_2_house_number" name="prev_addr_2_house_number" value="{{ old('prev_addr_2_house_number', "") }}" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_2_postcode">Postcode <span class="text-danger">*</span></label>
                                            <span id="prev_addr_2_postcode_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_2_postcode" name="prev_addr_2_postcode" value="{{ old('prev_addr_2_postcode', "") }}" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_2_address_line_1">Address Line 1 <span class="text-danger">*</span></label>
                                            <span id="prev_addr_2_address_line_1_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_2_address_line_1" name="prev_addr_2_address_line_1" value="{{ old('prev_addr_2_address_line_1', "") }}" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_2_address_line_2">Address Line 2</label>
                                            <span id="prev_addr_2_address_line_2_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_2_address_line_2" name="prev_addr_2_address_line_2" value="{{ old('prev_addr_2_address_line_2', "") }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_2_road_name">Road Name <span class="text-danger">*</span></label>
                                            <span id="prev_addr_2_road_name_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_2_road_name" name="prev_addr_2_road_name" value="{{ old('prev_addr_2_road_name', "") }}" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_2_town">Town <span class="text-danger">*</span></label>
                                            <span id="prev_addr_2_town_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_2_town" name="prev_addr_2_town" value="{{ old('prev_addr_2_town', "") }}" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_2_county">County</label>
                                            <span id="prev_addr_2_county_error" class="form-error-message text-danger"></span>
                                            <input type="text" id="prev_addr_2_county" name="prev_addr_2_county" value="{{ old('prev_addr_2_county', "") }}" />
                                        </div>
                                        <br /><br />

                                        <label>How long have you been at this address?</label>
                                        <div class="form-group">
                                            <label for="prev_addr_2_length_years">Years</label>
                                            <span id="prev_addr_2_length_years_error" class="form-error-message text-danger"></span>
                                            <input type="number" min="0" id="prev_addr_2_length_years" name="prev_addr_2_length_years" value="{{ old('prev_addr_2_length_years', "") }}" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label for="prev_addr_2_length_months">Months</label>
                                            <span id="prev_addr_2_length_months_error" class="form-error-message text-danger"></span>
                                            <input type="number" min="0" max="11" id="prev_addr_2_length_months" name="prev_addr_2_length_months" value="{{ old('prev_addr_2_length_months', "") }}" required="required" />
                                        </div>
                                    </fieldset>
                                @endif

                                <br /><hr class="thin-line" /><br />

                                <div class="form-group">
                                    <h2>Billing Address</h2>
                                    <input type="checkbox" id="same_current_address" name="same_current_address" {{ (old('same_current_address', true) == true) ? "checked" : "" }} />
                                    <span id="same_current_address_error" class="form-error-message text-danger"></span>
                                    <label for="same_current_address" style="font-weight: normal;">My billing address is the same as my supply address.</label>
                                </div>
                                <fieldset class="form-group" id="billing_section" style="display: none;" disabled>
                                    <div class="form-group">
                                        <label for="billing_house_number">House Number <span class="text-danger">*</span></label>
                                        <span id="billing_house_number_error" class="form-error-message text-danger"></span>
                                        <input type="text" id="billing_house_number" name="billing_house_number" value="{{ old('billing_house_number', "") }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_postcode">Postcode <span class="text-danger">*</span></label>
                                        <span id="billing_postcode_error" class="form-error-message text-danger"></span>
                                        <input type="text" id="billing_postcode" name="billing_postcode" value="{{ old('billing_postcode', '') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_address_line_1">Address Line 1 <span class="text-danger">*</span></label>
                                        <span id="billing_address_line_1_error" class="form-error-message text-danger"></span>
                                        <input type="text" id="billing_address_line_1" name="billing_address_line_1" value="{{ old('billing_address_line_1', '') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_address_line_2">Address Line 2</label>
                                        <span id="billing_address_line_2_error" class="form-error-message text-danger"></span>
                                        <input type="text" id="billing_address_line_2" name="billing_address_line_2" value="{{ old('billing_address_line_2', '') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_road_name">Road Name <span class="text-danger">*</span></label>
                                        <span id="billing_road_name_error" class="form-error-message text-danger"></span>
                                        <input type="text" id="billing_road_name" name="billing_road_name" value="{{ old('billing_road_name', "") }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_town">Town <span class="text-danger">*</span></label>
                                        <span id="billing_town_error" class="form-error-message text-danger"></span>
                                        <input type="text" id="billing_town" name="billing_town" value="{{ old('billing_town', '') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_county">County</label>
                                        <span id="billing_county_error" class="form-error-message text-danger"></span>
                                        <input type="text" id="billing_county" name="billing_county" value="{{ old('billing_county', "") }}" />
                                    </div>
                                </fieldset>

                                <br /><hr class="thin-line" /><br />

                                <h2>Meters</h2>
                                <div class="form-group">
                                    <label for="smartMeter">Do you already have a smart meter installed at your home?<span class="text-danger">*</span></label>
                                    <span id="smartMeter_error" class="form-error-message text-danger"></span>
                                    <select id="smartMeter" name="smartMeter" data-value="{{ old('smartMeter', '') }}" required>
                                        <option value="">Please Select</option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                        <option value="DK">Don't Know</option>
                                    </select>
                                    @switch($legal_text_for_supplier)
                                        {{-- Bristol Energy --}}
                                        @case("Bristol Energy")
                                            <p id="smartMeter_yesText_section" class="grey-text" style="display: none;">
                                                Please note that by proceeding with this contract you may not be able to benefit from the meter functionality and any related services that are associated with your smart meter.
                                            </p>
                                            <p id="smartMeter_dontKnowText_section" class="grey-text" style="display: none;">
                                                If you do have a smart meter and switch your supply, you may lose any non-standard smart metering functionality provided by your previous supplier and your meters will need to be read.
                                            </p>
                                            @break
                                        {{-- EDF Energy --}}
                                        @case("EDF Energy")
                                            <p id="smartMeter_yesText_section" class="grey-text" style="display: none;">
                                                Please note that by proceeding with this contract you may not be able to benefit from the meter functionality and any related services that are associated with your smart meter.
                                            </p>
                                            <p id="smartMeter_dontKnowText_section" class="grey-text" style="display: none;">
                                                If you do have a smart meter and switch your supply, you may lose any non-standard smart metering functionality provided by your previous supplier and your meters will need to be read.
                                            </p>
                                            @break
                                        {{-- Green --}}
                                        @case("Green")
                                            <p id="smartMeter_yesText_section" class="grey-text" style="display: none;">
                                                Please note that by proceeding with this contract you may not be able to benefit from the meter functionality and any related services that are associated with your smart meter.
                                            </p>
                                            <p id="smartMeter_dontKnowText_section" class="grey-text" style="display: none;">
                                                If you do have a smart meter and switch your supply, you may lose any non-standard smart metering functionality provided by your previous supplier and your meters will need to be read.
                                            </p>
                                            @break
                                        {{-- Igloo Energy --}}
                                        @case("Igloo Energy")
                                            <p id="smartMeter_yesText_section" class="grey-text" style="display: none;">
                                                Please note that by proceeding with this contract you may not be able to benefit from the meter functionality and any related services that are associated with your smart meter.
                                            </p>
                                            <p id="smartMeter_dontKnowText_section" class="grey-text" style="display: none;">
                                                If you do have a smart meter and switch your supply, you may lose any non-standard smart metering functionality provided by your previous supplier and your meters will need to be read.
                                            </p>
                                            @break
                                        {{-- ScottishPower --}}
                                        @case("ScottishPower")
                                            <span id="smartMeter_yesText_section" class="grey-text" style="display: none;">
                                                <p>If you currently have a smart meter you will lose some of its functionality by changing your supplier. As a guide, if your meter was installed or changed pre 2008, then it will not be a smart meter. From 2008 onwards, it could potentially be a smart meter which means that you will have some additional functionality, for example:</p>
                                                <p>A Smart meter can provide the automatic sending of meter readings to your supplier without the need for a visit to your property. It can tell you how much energy you are using at your property, and, if you also have an energy monitor, you may be able to see the cost of that energy. There are several variations of Smart meters available, some of which may offer other functionalities.</p>
                                                <p>By continuing you confirm that you understand you may lose some of your smart meter functionality.</p>
                                            </span>
                                            <p id="smartMeter_dontKnowText_section" class="grey-text" style="display: none;">
                                                If you do have a smart meter and switch your supply, you may lose any non-standard smart metering functionality provided by your previous supplier and your meters will need to be read.
                                            </p>
                                            @break
                                        {{-- Shell Energy --}}
                                        @case("Shell Energy")
                                            <p id="smartMeter_yesText_section" class="grey-text" style="display: none;">
                                                Please note that if your property has a Smart Meter installed you may lose some or all of the functions of this meter by switching supplier.
                                            </p>
                                            <p id="smartMeter_dontKnowText_section" class="grey-text" style="display: none;">
                                                If you do have a smart meter and switch your supply, you may lose any non-standard smart metering functionality provided by your previous supplier and your meters will need to be read.
                                            </p>
                                            @break
                                        {{-- Together Energy --}}
                                        @case("Together Energy")
                                        <p id="smartMeter_yesText_section" class="grey-text" style="display: none;">
                                            Please note that by proceeding with this contract you may not be able to benefit from the meter functionality and any related services that are associated with your smart meter.
                                        </p>
                                        <p id="smartMeter_dontKnowText_section" class="grey-text" style="display: none;">
                                            If you do have a smart meter and switch your supply, you may lose any non-standard smart metering functionality provided by your previous supplier and your meters will need to be read.
                                        </p>
                                        @break
                                    @endswitch
                                </div>
                                @if ($existing_tariff -> fuel_type_char == "D" || $existing_tariff -> fuel_type_char == "G")
                                    <div class="form-group">
                                        <label for="gas_meter_number">Gas meter number<span class="text-danger">*</span></label>
                                        <span id="gas_meter_number_error" class="form-error-message text-danger"></span>
                                        <p><input type="text" id="gas_meter_number" name="gas_meter_number" value="{{ old('gas_meter_number', $mprn -> mprn) }}" required /></p>
                                        <p>Your gas meter number is also known as a Meter Point Reference Number (MPRN). Please enter the number as you find it on your gas bill. If you are unable to find this information on your energy bill, you can get it by calling the National Grid on 0870 608 1524 (press 2 then 1).</p>
                                        <p>Or <a href="https://www.findmysupplier.energy/webapp/index.html">click here</a> to find this information online. Enter your postcode first and then your house number.</p>
                                    </div>
                                @endif
                                @if ($existing_tariff -> fuel_type_char == "D" || $existing_tariff -> fuel_type_char == "E")
                                    <div class="form-group">
                                        <label for="elec_meter_number">Electricity meter number<span class="text-danger">*</span></label>
                                        <span id="elec_meter_number_error" class="form-error-message text-danger"></span>
                                        <p><input type="text" id="elec_meter_number" name="elec_meter_number" value="{{ old('elec_meter_number', $user_address["mpan"]) }}" /></p>
                                        <p>Your electricity meter number is also known as a Supply (S) Number or MPAN. Please enter the bottom row of numbers as you find them on your electricity bill without spaces as highlighted in the example below.</p>
                                        <img alt="Example of an Electricity Number" src="" />
                                    </div>
                                @endif

                                <br /><hr class="thin-line" /><br />

                                <h2>Your Direct Debit Details</h2>
                                <p>You will pay &pound;{{ number_format($selected_tariff["bill"] / 12, 2) }} per month to {{ $selected_tariff["supplierName"] }}.</p>
                                @if ($coolingOff > 0)
                                    <p>Even after you have submitted this application you still have {{ $coolingOff }} days from today to cancel your contract if you change your mind.</p>
                                @endif

                                @switch($legal_text_for_supplier)
                                    {{-- EDF Energy --}}
                                    @case("EDF Energy")
                                        <span class="direct_debit_instruction_text grey-text" style="display: none;">
                                            <p>Direct Debit Instruction (if applicable)</p>
                                            <p>If you have chosen to pay by Direct Debit, EDF Energy Customers Ltd will send written confirmation of your Direct Debit Instruction to you within 3 working days or no later than 10 working days before the first collection.</p>
                                            <p>If you have chosen to pay by Direct Debit, the company name that will appear on your bank statement is EDF Energy.</p>
                                            <p>The personal projections provided for your EDF Energy Customers Ltd products are based on the energy usage figures that you provided. If you provided us with either annual, quarterly or monthly spend figures then it is assumed that this spend figure does not include any debt re-payments. If this assumption is incorrect please re-enter your annual spend figure excluding any historic debt repayments you are currently making.</p>
                                        </span>
                                        @break
                                    {{-- ScottishPower --}}
                                    @case("ScottishPower")
                                        {{-- Direct Debit: for Monthly Direct Debit applications only --}}
                                        <p class="direct_debit_instruction_text_mdd" style="display: none;">Your first direct debit will be taken shortly after you come on supply. There will be at least 21 days between your 1st and 2nd direct debits. The direct debit amount is calculated using your annual cost split over 12 monthly payments. We'll let you know the exact dates in your Welcome Pack. You can change your preferred payment date once you come on supply.</p>
                                        @break
                                @endswitch

                                <input type="hidden" id="existing_payment_method" name="payment_method" value="{{ $existing_tariff -> payment_method }}" />
                                {{-- <div class="form-group">
                                    <label for="payment_method">Payment Method <span class="text-danger">*</span></label>
                                    <span id="payment_method_error" class="form-error-message text-danger"></span>
                                    <select type="text" id="payment_method" name="payment_method" data-value="{{ old('payment_method', '') }}" required>
                                        <option value="">Please Select</option>
                                        @foreach ($selected_payment_methods as $spm)
                                            <option value="{{ $spm['id'] }}">{{ $spm['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                {{-- <div class="form-group">
                                    <label for="bankName" class="font-weight-bold">Bank Name <span class="text-danger">*</span></label>
                                    <span id="bankName_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="bankName" name="bankName" value="{{ old('bankName', '') }}" required="required" />
                                </div> --}}
                                <div class="form-group">
                                    <label for="accountName" class="font-weight-bold">Account Holder Name<span class="text-danger">*</span></label>
                                    <span id="accountName_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="accountName" name="accountName" value="{{ old('accountName', '') }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="sortCode1 sortCode2 sortCode3" class="font-weight-bold d-block">Sort Code<span class="text-danger">*</span></label>
                                    <span id="sortCode_error" class="form-error-message text-danger"></span>
                                    <input id="sortCode1" name="sortCode1" inputmode="tel" minlength="2" maxlength="2" type="text" value="{{ old('sortCode1', '') }}" required class="d-inline text-center" style="width: 150px; max-width: 100%;" />
                                    <input id="sortCode2" name="sortCode2" inputmode="tel" minlength="2" maxlength="2" type="text" value="{{ old('sortCode2', '') }}" required class="d-inline text-center" style="width: 150px; max-width: 100%;" />
                                    <input id="sortCode3" name="sortCode3" inputmode="tel" minlength="2" maxlength="2" type="text" value="{{ old('sortCode3', '') }}" required class="d-inline text-center" style="width: 150px; max-width: 100%;" />
                                </div>
                                <div class="form-group">
                                    <label for="accountNumber" class="font-weight-bold">Account Number<span class="text-danger">*</span></label>
                                    <span id="accountNumber_error" class="form-error-message text-danger"></span>
                                    <input id="accountNumber" name="accountNumber" inputmode="tel" maxlength="8" type="text" value="{{ old('accountNumber', '') }}" required />
                                    <span class="small-input-text">If your account number is less than 8 digits, you should add zeros to the beginning of your account number until it is exactly 8 digits long.</span>
                                </div>
                                @if ($preffered_payment_date == true)
                                    <div class="row no-margin">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="preferredDay" class="font-weight-bold">Select your payment date <span class="text-danger">*</span></label>
                                                <span id="preferredDay_error" class="form-error-message text-danger"></span>
                                                <select id="preferredDay" name="preferredDay" data-value="{{ old('preferredDay', '') }}" required>
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
                                @endif
                                @switch($legal_text_for_supplier)
                                    {{----------------------}}
                                    {{--- Bristol Energy ---}}
                                    {{----------------------}}
                                    @case("Bristol Energy")
                                        {{-- Billing --}}
                                        <?php $features = explode(",", $selected_tariff["features"]); ?>
                                        <div class="form-group">
                                            <label for="receiveBills" class="font-weight-bold">How would you like to receive all communications from Bristol Energy? An electronic preference means Bristol Energy communicate with you electronically wherever possible. <span class="text-danger">*</span></label>
                                            <span id="receiveBills_error" class="form-error-message text-danger"></span>
                                            <select id="receiveBills" name="receiveBills" value="{{ old('receiveBills', '') }}" required="required">
                                                <option value=""></option>
                                                <option value="Email">Electronically</option>
                                                <option value="Paper">All communications by post</option>
                                            </select>
                                        </div>
                                        {{-- Direct Debit Instructions --}}
                                        {{-- Direct Debit Guarantee --}}
                                        <button type="button" class="direct_debit_instruction_text collapse-table-button site-accordion" role="button" style="display: none;">Instructions to your Bank/Building Society</button>
                                        <div class="direct_debit_instruction_text site-accordion-panel" style="display: none;">
                                            <span class="grey-text">
                                                <p>
                                                    Please pay Bristol Energy Direct Debits from the account detailed in this instruction subject to the safeguards assured by the
                                                    <a href="javascript: void;" id="direct_debit_guarantee_button">Direct Debit Guarantee.</a>
                                                </p>
                                                <p>Your Direct Debit Instruction will be confirmed to you within 3 working days either by email or post.</p>
                                                <p>I understand that this instruction may remain with Bristol Energy and, if so, details will be passed electronically to my bank/building society.</p>
                                                <p>Date: {{ date('d/m/Y') }}</p>
                                                <p>Service User Number: {{ $selected_supplier -> ddOriginatorsNo }}</p>
                                                <p>Banks and building societies may not accept Direct Debit Instructions for some types of account.</p>
                                            </span>
                                            <div id="direct_debit_guarantee_background" class="direct_debit_guarantee_close" style="display: none;"></div>
                                            <div id="direct_debit_guarantee_popup_outer" style="display: none;">
                                                <div id="direct_debit_guarantee_popup">
                                                    <div class="direct_debit_guarantee_close" style="display: inline-block; padding: 10px; float: right;">
                                                        <span class="far fa-window-close" aria-hidden="true" style="font-size: 30px; cursor: pointer;"></span>
                                                    </div>
                                                    <h3>Direct Debit Guarantee</h3>
                                                    <ul>
                                                        <li>This Guarantee is offered by all banks and building societies that accept instructions to pay Direct Debits.</li>
                                                        <li>If there are any changes to the amount, date or frequency of your Direct Debit Bristol Energy will notify you 10 working days in advance of your account being debited or as otherwise agreed. If you request Bristol Energy to collect a payment, confirmation of the amount and date will be given to you at the time of the request.</li>
                                                        <li>If an error is made in the payment of your Direct Debit, by Bristol Energy or your bank or building society, you are entitled to a full and immediate refund of the amount paid from your bank or building society.</li>
                                                        <ul type="disc"><li>If you receive a refund you are not entitled to, you must pay it back when Bristol Energy asks you to.</li></ul>
                                                        <li>You can cancel a Direct Debit at any time by simply contacting your bank or building society. Written confirmation may be required. Please also notify Bristol Energy.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Cancellation Rights --}}
                                        @if (true || $coolingOff > 0)
                                            <button type="button" class="collapse-table-button site-accordion" role="button">Your Cancellation Rights</button>
                                            <p class="site-accordion-panel">If you change your mind and want to cancel the contract, you must tell Bristol Energy within the cooling off period, which ends 14 days from day after you sign up.</p>
                                        @endif
                                        {{-- Direct Debit Authorisation --}}
                                        <fieldset class="direct_debit_instruction_text form-group" style="display: none;">
                                            <span id="direct_debit_confirmation_error" class="form-error-message text-danger"></span>
                                            <input type="checkbox" id="direct_debit_confirmation" name="direct_debit_confirmation" {{ (old('direct_debit_confirmation', '') == true) ? "checked" : " " }} />
                                            <label for="direct_debit_confirmation" style="font-weight: normal;">I confirm I am the account holder and am the only person required to authorise Direct Debits from my bank account. <span class="text-danger">*</span></label>
                                        </fieldset>
                                        {{-- Terms and Conditions --}}
                                        <div class="form-group">
                                            <input type="checkbox" id="terms_and_conditions" name="terms_and_conditions" {{ (old('terms_and_conditions', "") == true) ? "checked" : "" }} required="required" />
                                            <label for="terms_and_conditions" style="font-weight: normal;">Read Bristol Energy's T&Cs <a href="https://s3-eu-west-1.amazonaws.com/tes-resources/TCs/BRSTL.pdf" target="_blank">Here</a>.</label>
                                        </div>
                                        @break
                                    {{------------------}}
                                    {{--- EDF Energy ---}}
                                    {{------------------}}
                                    @case("EDF Energy")
                                        {{-- Billing --}}
                                        <?php $features = explode(",", $selected_tariff["features"]); ?>
                                        @if (in_array(28, $features) || in_array(29, $features))
                                            <div class="form-group">
                                                <label for="receiveBills" class="font-weight-bold">How would you like to receive all communications from EDF Energy Customers Ltd? An electronic preference means EDF Energy Customers Ltd communicate with you electronically wherever possible.</label>
                                                <span id="receiveBills_error" class="form-error-message text-danger"></span>
                                                <select id="receiveBills" name="receiveBills" value="{{ old('receiveBills', '') }}" required="required">
                                                    <option value="Paper"></option>
                                                    <option value="Email">Electronically</option>
                                                </select>
                                            </div>
                                        @endif
                                        {{-- Cancellation Rights --}}
                                        @if (true || $coolingOff > 0)
                                            <button type="button" class="collapse-table-button site-accordion" role="button">Your Cancellation Rights</button>
                                            <p class="site-accordion-panel">If you change your mind and want to cancel the contract, you must tell EDF Energy within the cooling off period, which ends 14 days from day after you sign up.</p>
                                        @endif
                                        {{-- Direct Debit Authorisation --}}
                                        <fieldset class="direct_debit_instruction_text form-group" style="display: none;">
                                            <span id="direct_debit_confirmation_error" class="form-error-message text-danger"></span>
                                            <input type="checkbox" id="direct_debit_confirmation" name="direct_debit_confirmation" {{ (old('direct_debit_confirmation', '') == true) ? "checked" : " " }} />
                                            <label for="direct_debit_confirmation" style="font-weight: normal;">I confirm I am the account holder and adirect_debit_confirmationm the only person required to authorise Direct Debits from my bank account. <span class="text-danger">*</span></label>
                                        </fieldset>
                                        {{-- Terms and Conditions --}}
                                        <div class="form-group">
                                            <input type="checkbox" id="terms_and_conditions" name="terms_and_conditions" {{ (old('terms_and_conditions', "") == true) ? "checked" : "" }} required="required" />
                                            <label for="terms_and_conditions" style="font-weight: normal;">I confirm that I have read and accepted the <a href="https://s3-eu-west-1.amazonaws.com/tes-resources/TCs/EDF.pdf" target="_blank">terms and conditions</a> that apply for the tariff I have chosen and which include obligations to pay.</label>
                                        </div>
                                        @break
                                    {{-------------}}
                                    {{--- Green ---}}
                                    {{-------------}}
                                    @case("Green")
                                        {{-- Direct Debit Instructions --}}
                                        {{-- Direct Debit Guarantee --}}
                                        <button type="button" class="direct_debit_instruction_text collapse-table-button site-accordion" role="button" style="display: none;">Instructions to your Bank/Building Society</button>
                                        <div class="direct_debit_instruction_text site-accordion-panel" style="display: none;">
                                            <span class="grey-text">
                                                <p>
                                                    Please pay Green Supplier Limited Direct Debits from the account detailed in this instruction subject to the safeguards assured by the
                                                    <a href="javascript: void;" id="direct_debit_guarantee_button">Direct Debit Guarantee</a>.
                                                </p>
                                                <p>Your Direct Debit Instruction will be confirmed to you within 3 working days either by email or post.</p>
                                                <p>I understand that this instruction may remain with Green Supplier Limited and, if so, details will be passed electronically to my bank/building society.</p>
                                                <p>Date: {{ date('d/m/Y') }}</p>
                                                <p>Service User Number: {{ $selected_supplier -> ddOriginatorsNo }}</p>
                                                <p>Banks and building societies may not accept Direct Debit Instructions for some types of account.</p>
                                            </span>
                                            <div id="direct_debit_guarantee_background" class="direct_debit_guarantee_close" style="display: none;"></div>
                                            <div id="direct_debit_guarantee_popup_outer" style="display: none;">
                                                <div id="direct_debit_guarantee_popup">
                                                    <div class="direct_debit_guarantee_close" style="display: inline-block; padding: 10px; float: right;">
                                                        <span class="far fa-window-close" aria-hidden="true" style="font-size: 30px; cursor: pointer;"></span>
                                                    </div>
                                                    <h3>Direct Debit Guarantee</h3>
                                                    <ul>
                                                        <li>This Guarantee is offered by all banks and building societies that accept instructions to pay Direct Debits.</li>
                                                        <li>If there are any changes to the amount, date or frequency of your Direct Debit Green will notify you 10 working days in advance of your account being debited or as otherwise agreed. If you request Green to collect a payment, confirmation of the amount and date will be given to you at the time of the request.</li>
                                                        <li>If an error is made in the payment of your Direct Debit, by Green or your bank or building society, you are entitled to a full and immediate refund of the amount paid from your bank or building society.</li>
                                                        <ul><li type="disc">If you receive a refund you are not entitled to, you must pay it back when Green asks you to.</li></ul>
                                                        <li>You can cancel a Direct Debit at any time by simply contacting your bank or building society. Written confirmation may be required. Please also notify Green.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Cancellation Rights --}}
                                        @if (true || $coolingOff > 0)
                                            <button type="button" class="collapse-table-button site-accordion" role="button">Your Cancellation Rights</button>
                                            <p class="site-accordion-panel">If you change your mind and want to cancel the contract, you must tell Green within the cooling off period, which ends 14 days from day after you sign up.</p>
                                        @endif
                                        {{-- Direct Debit Authorisation --}}
                                        <fieldset class="direct_debit_instruction_text form-group" style="display: none;">
                                            <span id="direct_debit_confirmation_error" class="form-error-message text-danger"></span>
                                            <input type="checkbox" id="direct_debit_confirmation" name="direct_debit_confirmation" {{ (old('direct_debit_confirmation', '') == true) ? "checked" : " " }} />
                                            <label for="direct_debit_confirmation" style="font-weight: normal;">I confirm I am the account holder and am the only person required to authorise Direct Debits from my bank account. <span class="text-danger">*</span></label>
                                        </fieldset>
                                        {{-- Terms and Conditions --}}
                                        <div class="form-group">
                                            <input type="checkbox" id="terms_and_conditions" name="terms_and_conditions" {{ (old('terms_and_conditions', "") == true) ? "checked" : "" }} required="required" />
                                            <label for="terms_and_conditions" style="font-weight: normal;">To complete your application please accept Green's <a href="https://s3-eu-west-1.amazonaws.com/tes-resources/TCs/GREEN.pdf" target="_blank">Terms and Conditions</a>.</label>
                                        </div>
                                        @break
                                    {{--------------------}}
                                    {{--- Igloo Energy ---}}
                                    {{--------------------}}
                                    @case("Igloo Energy")
                                        {{-- Billing --}}
                                        <?php $features = explode(",", $selected_tariff["features"]); ?>
                                        <div class="form-group">
                                            <label for="receiveBills" class="font-weight-bold">How would you like to receive all communications from Igloo Energy Supply Limited? An electronic preference means Igloo Energy Supply Limited communicate with you electronically wherever possible. <span class="text-danger">*</span></label>
                                            <span id="receiveBills_error" class="form-error-message text-danger"></span>
                                            <select id="receiveBills" name="receiveBills" value="{{ old('receiveBills', '') }}" required="required">
                                                <option value="Paper"></option>
                                                <option value="Email">Electronically</option>
                                            </select>
                                        </div>
                                        {{-- Direct Debit Instructions --}}
                                        {{-- Direct Debit Guarantee --}}
                                        <button type="button" class="direct_debit_instruction_text collapse-table-button site-accordion" role="button" style="display: none;">Instructions to your Bank/Building Society</button>
                                        <div class="direct_debit_instruction_text site-accordion-panel" style="display: none;">
                                            <span class="grey-text">
                                                <p>
                                                    Please pay Igloo Energy Supply Limited Direct Debits from the account detailed in this instruction subject to the safeguards assured by the
                                                    <a href="javascript: void;" id="direct_debit_guarantee_button">Direct Debit Guarantee</a>.
                                                </p>
                                                <p>Your Direct Debit Instruction will be confirmed to you within 3 working days either by email or post.</p>
                                                <p>I understand that this instruction may remain with Igloo Energy Supply Limited and, if so, details will be passed electronically to my bank/building society.</p>
                                                <p>Date: {{ date('d/m/Y') }}</p>
                                                <p>Service User Number: {{ $selected_supplier -> ddOriginatorsNo }}</p>
                                                <p>Banks and building societies may not accept Direct Debit Instructions for some types of account.</p>
                                            </span>
                                            <div id="direct_debit_guarantee_background" class="direct_debit_guarantee_close" style="display: none;"></div>
                                            <div id="direct_debit_guarantee_popup_outer" style="display: none;">
                                                <div id="direct_debit_guarantee_popup">
                                                    <div class="direct_debit_guarantee_close" style="display: inline-block; padding: 10px; float: right;">
                                                        <span class="far fa-window-close" aria-hidden="true" style="font-size: 30px; cursor: pointer;"></span>
                                                    </div>
                                                    <h3>Direct Debit Guarantee</h3>
                                                    <ul>
                                                        <li>This Guarantee is offered by all banks and building societies that accept instructions to pay Direct Debits.</li>
                                                        <li>If there are any changes to the amount, date or frequency of your Direct Debit Igloo Energy will notify you 10 working days in advance of your account being debited or as otherwise agreed. If you request Igloo Energy to collect a payment, confirmation of the amount and date will be given to you at the time of the request.</li>
                                                        <li>If an error is made in the payment of your Direct Debit, by Igloo Energy or your bank or building society, you are entitled to a full and immediate refund of the amount paid from your bank or building society.</li>
                                                        <ul><li type="disc">If you receive a refund you are not entitled to, you must pay it back when Igloo Energy asks you to.</li></ul>
                                                        <li>You can cancel a Direct Debit at any time by simply contacting your bank or building society. Written confirmation may be required. Please also notify Igloo Energy.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Cancellation Rights --}}
                                        @if (true || $coolingOff > 0)
                                            <button type="button" class="collapse-table-button site-accordion" role="button">Your Cancellation Rights</button>
                                            <p class="site-accordion-panel">If you change your mind and want to cancel the contract, you must tell Igloo Energy within the cooling off period, which ends 14 days from day after you sign up.</p>
                                        @endif
                                        {{-- Direct Debit Authorisation --}}
                                        <fieldset class="direct_debit_instruction_text form-group" style="display: none;">
                                            <span id="direct_debit_confirmation_error" class="form-error-message text-danger"></span>
                                            <input type="checkbox" id="direct_debit_confirmation" name="direct_debit_confirmation" {{ (old('direct_debit_confirmation', '') == true) ? "checked" : " " }} />
                                            <label for="direct_debit_confirmation" style="font-weight: normal;">I confirm I am the account holder and am the only person required to authorise Direct Debits from my bank account. <span class="text-danger">*</span></label>
                                        </fieldset>
                                        {{-- Terms and Conditions --}}
                                        <div class="form-group">
                                            <input type="checkbox" id="terms_and_conditions" name="terms_and_conditions" {{ (old('terms_and_conditions', "") == true) ? "checked" : "" }} required="required" />
                                            <label for="terms_and_conditions" style="font-weight: normal;">Read Igloo Energy's T&Cs <a href="https://s3-eu-west-1.amazonaws.com/tes-resources/TCs/IGLOO.pdf" target="_blank">Here</a>.</label>
                                        </div>
                                        @break
                                    {{---------------------}}
                                    {{--- ScottishPower ---}}
                                    {{---------------------}}
                                    @case("ScottishPower")
                                        {{-- Direct Debit Instructions --}}
                                        {{-- Direct Debit Guarantee --}}
                                        <button type="button" class="direct_debit_instruction_text collapse-table-button site-accordion" role="button" style="display: none;">Instructions to your Bank/Building Society</button>
                                        <div class="direct_debit_instruction_text site-accordion-panel" style="display: none;">
                                            <span class="grey-text">
                                                <p>
                                                    Please pay ScottishPower Energy Retail Ltd Direct Debits from the account detailed in this instruction subject to the safeguards assured by the
                                                    <a href="javascript: void;" id="direct_debit_guarantee_button">Direct Debit Guarantee</a>.
                                                </p>
                                                <p>Your Direct Debit Instruction will be confirmed to you within 3 working days either by email or post.</p>
                                                <p>I understand that this instruction may remain with ScottishPower Energy Retail Ltd and, if so, details will be passed electronically to my bank/building society.</p>
                                                <p>Date: {{ date('d/m/Y') }}</p>
                                                <p>Service User Number: {{ $selected_supplier -> ddOriginatorsNo }}</p>
                                                <p>Banks and building societies may not accept Direct Debit Instructions for some types of account.</p>
                                            </span>
                                            <div id="direct_debit_guarantee_background" class="direct_debit_guarantee_close" style="display: none;"></div>
                                            <div id="direct_debit_guarantee_popup_outer" style="display: none;">
                                                <div id="direct_debit_guarantee_popup">
                                                    <div class="direct_debit_guarantee_close" style="display: inline-block; padding: 10px; float: right;">
                                                        <span class="far fa-window-close" aria-hidden="true" style="font-size: 30px; cursor: pointer;"></span>
                                                    </div>
                                                    <h3>Direct Debit Guarantee</h3>
                                                    <ul>
                                                        <li>This Guarantee is offered by all banks and building societies that accept instructions to pay Direct Debits.</li>
                                                        <li>If there are any changes to the amount, date or frequency of your Direct Debit ScottishPower will notify you 10 working days in advance of your account being debited or as otherwise agreed. If you request ScottishPower to collect a payment, confirmation of the amount and date will be given to you at the time of the request.</li>
                                                        <li>If an error is made in the payment of your Direct Debit, by ScottishPower or your bank or building society, you are entitled to a full and immediate refund of the amount paid from your bank or building society.</li>
                                                        <ul><li type="disc">If you receive a refund you are not entitled to, you must pay it back when ScottishPower asks you to.</li></ul>
                                                        <li>You can cancel a Direct Debit at any time by simply contacting your bank or building society. Written confirmation may be required. Please also notify ScottishPower.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Green Deal --}}
                                        <button type="button" class="collapse-table-button site-accordion" role="button">Green Deal</button>
                                        <p class="site-accordion-panel">If your property is subject to a Green Deal Plan, ScottishPower are required to collect the payments required under that plan from you and pass on those payments. Green Deal charges are not included within the gas and/or electricity prices quoted for this tariff.</p>
                                        {{-- Cancellation Rights --}}
                                        @if (true || $coolingOff > 0)
                                            <button type="button" class="collapse-table-button site-accordion" role="button">Your Cancellation Rights</button>
                                            <p class="site-accordion-panel">If you change your mind and want to cancel the contract, you must tell ScottishPower within the cooling off period, which ends 14 days from day after you sign up.</p>
                                        @endif
                                        {{-- Priority Services Register --}}
                                        <button type="button" class="collapse-table-button site-accordion" role="button">Priority Services Register</button>
                                        <p class="site-accordion-panel">ScottishPower have a Priority Services Register. Once Registered there are various free services you (or someone in your household) could be eligible for. For more information or to join their Priority Services Register please call their customer service team on 0800 027 0072. Alternatively you can apply on ScottishPower's website once you are on supply.</p>
                                        {{-- Direct Debit Authorisation --}}
                                        <fieldset class="direct_debit_instruction_text form-group" style="display: none;">
                                            <span id="direct_debit_confirmation_error" class="form-error-message text-danger"></span>
                                            <input type="checkbox" id="direct_debit_confirmation" name="direct_debit_confirmation" {{ (old('direct_debit_confirmation', '') == true) ? "checked" : " " }} />
                                            <label for="direct_debit_confirmation" style="font-weight: normal;">I confirm I am the account holder and am the only person required to authorise Direct Debits from my bank account. <span class="text-danger">*</span></label>
                                        </fieldset>
                                        {{-- Terms and Conditions --}}
                                        <div class="form-group">
                                            <input type="checkbox" id="terms_and_conditions" name="terms_and_conditions" {{ (old('terms_and_conditions', "") == true) ? "checked" : "" }} required="required" />
                                            <label for="terms_and_conditions" style="font-weight: normal;">To complete your application please accept ScottishPower's <a href="https://s3-eu-west-1.amazonaws.com/tes-resources/TCs/SPW.pdf" target="_blank">Terms and Conditions</a>.</label>
                                        </div>
                                        @break
                                    {{--------------------}}
                                    {{--- Shell Energy ---}}
                                    {{--------------------}}
                                    @case("Shell Energy")
                                        {{-- Direct Debit Instructions --}}
                                        {{-- Direct Debit Guarantee --}}
                                        <button type="button" class="direct_debit_instruction_text collapse-table-button site-accordion" role="button" style="display: none;">Instructions to your Bank/Building Society</button>
                                        <div class="direct_debit_instruction_text site-accordion-panel" style="display: none;">
                                            <span class="grey-text">
                                                <p>
                                                    Please pay Shell Energy Retail Limited Direct Debits from the account detailed in this instruction subject to the safeguards assured by the
                                                    <a href="javascript: void;" id="direct_debit_guarantee_button">Direct Debit Guarantee</a>.
                                                </p>
                                                <p>Your Direct Debit Instruction will be confirmed to you within 3 working days either by email or post.</p>
                                                <p>I understand that this instruction may remain with Shell Energy Retail Limited and, if so, details will be passed electronically to my bank/building society.</p>
                                                <p>Date: {{ date('d/m/Y') }}</p>
                                                <p>Service User Number: {{ $selected_supplier -> ddOriginatorsNo }}</p>
                                                <p>Banks and building societies may not accept Direct Debit Instructions for some types of account.</p>
                                            </span>
                                            <div id="direct_debit_guarantee_background" class="direct_debit_guarantee_close" style="display: none;"></div>
                                            <div id="direct_debit_guarantee_popup_outer" style="display: none;">
                                                <div id="direct_debit_guarantee_popup">
                                                    <div class="direct_debit_guarantee_close" style="display: inline-block; padding: 10px; float: right;">
                                                        <span class="far fa-window-close" aria-hidden="true" style="font-size: 30px; cursor: pointer;"></span>
                                                    </div>
                                                    <h3>Direct Debit Guarantee</h3>
                                                    <ul>
                                                        <li>This Guarantee is offered by all banks and building societies that accept instructions to pay Direct Debits.</li>
                                                        <li>If there are any changes to the amount, date or frequency of your Direct Debit Shell Energy will notify you 10 working days in advance of your account being debited or as otherwise agreed. If you request Shell Energy to collect a payment, confirmation of the amount and date will be given to you at the time of the request.</li>
                                                        <li>If an error is made in the payment of your Direct Debit, by Shell Energy or your bank or building society, you are entitled to a full and immediate refund of the amount paid from your bank or building society.</li>
                                                        <ul><li type="disc">If you receive a refund you are not entitled to, you must pay it back when Shell Energy asks you to.</li></ul>
                                                        <li>You can cancel a Direct Debit at any time by simply contacting your bank or building society. Written confirmation may be required. Please also notify Shell Energy.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Cancellation Rights --}}
                                        @if (true || $coolingOff > 0)
                                            <button type="button" class="collapse-table-button site-accordion" role="button">Your Cancellation Rights</button>
                                            <p class="site-accordion-panel">If you change your mind and want to cancel the contract, you must tell Shell Energy within the cooling off period, which ends 14 days from day after you sign up.</p>
                                        @endif
                                        {{-- Direct Debit Authorisation --}}
                                        <fieldset class="direct_debit_instruction_text form-group" style="display: none;">
                                            <span id="direct_debit_confirmation_error" class="form-error-message text-danger"></span>
                                            <input type="checkbox" id="direct_debit_confirmation" name="direct_debit_confirmation" {{ (old('direct_debit_confirmation', '') == true) ? "checked" : " " }} />
                                            <label for="direct_debit_confirmation" style="font-weight: normal;">I confirm I am the account holder and am the only person required to authorise Direct Debits from my bank account. <span class="text-danger">*</span></label>
                                        </fieldset>
                                        {{-- Terms and Conditions --}}
                                        <div class="form-group">
                                            <input type="checkbox" id="terms_and_conditions" name="terms_and_conditions" {{ (old('terms_and_conditions', "") == true) ? "checked" : "" }} required="required" />
                                            <label for="terms_and_conditions" style="font-weight: normal;">By clicking you agree to <a href="https://s3-eu-west-1.amazonaws.com/tes-resources/TCs/FU.pdf" target="_blank">Shell Energy's terms and conditions</a>, <a href="https://s3-eu-west-1.amazonaws.com/tes-resources/TCs/shell-energy-privacy-policy.pdf" target="_blank">privacy policy</a> and tariff terms & conditions.</label>
                                        </div>
                                        @break
                                    {{-- Together Energy --}}
                                    @case("Together Energy")
                                    {{-- Billing --}}
                                        <?php $features = explode(",", $selected_tariff["features"]); ?>
                                        <div class="form-group">
                                            <label for="receiveBills" class="font-weight-bold">How would you like to receive all communications from Together Energy (Retail) Limited? An electronic preference means Together Energy (Retail) Limited communicate with you electronically wherever possible. <span class="text-danger">*</span></label>
                                            <span id="receiveBills_error" class="form-error-message text-danger"></span>
                                            <select id="receiveBills" name="receiveBills" value="{{ old('receiveBills', '') }}" required="required">
                                                <option value=""></option>
                                                <option value="Email">Electronically</option>
                                                <option value="Paper">All communications by post</option>
                                            </select>
                                        </div>
                                        {{-- Direct Debit Instructions --}}
                                        {{-- Direct Debit Guarantee --}}
                                        <button type="button" class="direct_debit_instruction_text collapse-table-button site-accordion" role="button" style="display: none;">Instructions to your Bank/Building Society</button>
                                        <div class="direct_debit_instruction_text site-accordion-panel" style="display: none;">
                                            <span class="grey-text">
                                                <p>
                                                    Please pay Together Energy (Retail) Limited Direct Debits from the account detailed in this instruction subject to the safeguards assured by the
                                                    <a href="javascript: void;" id="direct_debit_guarantee_button">Direct Debit Guarantee</a>.
                                                </p>
                                                <p>Your Direct Debit Instruction will be confirmed to you within 3 working days either by email or post.</p>
                                                <p>I understand that this instruction may remain with Together Energy (Retail) Limited and, if so, details will be passed electronically to my bank/building society.</p>
                                                <p>Date: {{ date('d/m/Y') }}</p>
                                                <p>Service User Number: {{ $selected_supplier -> ddOriginatorsNo }}</p>
                                                <p>Banks and building societies may not accept Direct Debit Instructions for some types of account.</p>
                                            </span>
                                            <div id="direct_debit_guarantee_background" class="direct_debit_guarantee_close" style="display: none;"></div>
                                            <div id="direct_debit_guarantee_popup_outer" style="display: none;">
                                                <div id="direct_debit_guarantee_popup">
                                                    <div class="direct_debit_guarantee_close" style="display: inline-block; padding: 10px; float: right;">
                                                        <span class="far fa-window-close" aria-hidden="true" style="font-size: 30px; cursor: pointer;"></span>
                                                    </div>
                                                    <h3>Direct Debit Guarantee</h3>
                                                    <ul>
                                                        <li>This Guarantee is offered by all banks and building societies that accept instructions to pay Direct Debits.</li>
                                                        <li>If there are any changes to the amount, date or frequency of your Direct Debit Together Energy will notify you 10 working days in advance of your account being debited or as otherwise agreed. If you request Together Energy to collect a payment, confirmation of the amount and date will be given to you at the time of the request.</li>
                                                        <li>If an error is made in the payment of your Direct Debit, by Together Energy or your bank or building society, you are entitled to a full and immediate refund of the amount paid from your bank or building society
                                                        <ul><li type="disc">If you receive a refund you are not entitled to, you must pay it back when Together Energy asks you to.</li></ul>
                                                        <li>You can cancel a Direct Debit at any time by simply contacting your bank or building society. Written confirmation may be required. Please also notify Together Energy.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Cancellation Rights --}}
                                        @if (true || $coolingOff > 0)
                                            <button type="button" class="collapse-table-button site-accordion" role="button">Your Cancellation Rights</button>
                                            <p class="site-accordion-panel">If you change your mind and want to cancel the contract, you must tell Together Energy within the cooling off period, which ends 14 days from day after you sign up.</p>
                                        @endif
                                        {{-- Direct Debit Authorisation --}}
                                        <fieldset class="direct_debit_instruction_text form-group" style="display: none;">
                                            <span id="direct_debit_confirmation_error" class="form-error-message text-danger"></span>
                                            <input type="checkbox" id="direct_debit_confirmation" name="direct_debit_confirmation" {{ (old('direct_debit_confirmation', '') == true) ? "checked" : " " }} />
                                            <label for="direct_debit_confirmation" style="font-weight: normal;">I confirm I am the account holder and am the only person required to authorise Direct Debits from my bank account.<span class="text-danger">*</span></label>
                                        </fieldset>
                                        {{-- Terms and Conditions --}}
                                        <div class="form-group">
                                            <input type="checkbox" id="terms_and_conditions" name="terms_and_conditions" {{ (old('terms_and_conditions', "") == true) ? "checked" : "" }} required="required" />
                                            <label for="terms_and_conditions" style="font-weight: normal;">Read Together Energy's T&Cs <a href="https://s3-eu-west-1.amazonaws.com/tes-resources/TCs/TOG.pdf" target="_blank">Here</a>.</label>
                                        </div>
                                        @break
                                @endswitch

                                <br /><hr class="thin-line" /><br />

                                <h2>Your Contact Details</h2>
                                <div class="form-group">
                                    <label for="title" class="font-weight-bold">Title<span class="text-danger">*</span></label>
                                    <span id="title_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="title" name="title" value="{{ old('title', '') }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="firstName" class="font-weight-bold">First Name<span class="text-danger">*</span></label>
                                    <span id="firstName_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="firstName" name="firstName" value="{{ old('firstName', '') }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="lastName" class="font-weight-bold">Last Name<span class="text-danger">*</span></label>
                                    <span id="lastName_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="lastName" name="lastName" value="{{ old('lastName', '') }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="telephone" class="font-weight-bold">Telephone<span class="text-danger">*</span></label>
                                    <span id="telephone_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="telephone" name="telephone" value="{{ old('telephone', '') }}" required />
                                    <span class="small-input-text">Please enter the number starting with 0 and not the dialling code.</span>
                                </div>
                                <div class="form-group">
                                    <label for="mobile" class="font-weight-bold">Mobile</label>
                                    <span id="mobile_error" class="form-error-message text-danger"></span>
                                    <input type="text" id="mobile" name="mobile" value="{{ old('mobile', '') }}" />
                                    <span class="small-input-text">Please enter the number starting with 0 and not the dialling code.</span>
                                </div>
                                <div class="form-group">
                                    <label for="emailAddress" class="font-weight-bold">Email Address<span class="text-danger">*</span></label>
                                    <span id="emailAddress_error" class="form-error-message text-danger"></span>
                                    <input type="email" id="emailAddress" name="emailAddress" value="{{ old('emailAddress', '') }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="dob" class="font-weight-bold">Date of Birth<span class="text-danger">*</span></label>
                                    <span id="dob_error" class="form-error-message text-danger"></span>
                                    <input type="date" id="dob" name="dob" value="{{ old('dob', '') }}" required />
                                </div>

                                <br /><br /><hr class="thin-line" /><br />

                                @switch($legal_text_for_supplier)
                                    {{-- Bristol Energy --}}
                                    @case("Bristol Energy")
                                        {{-- Marketing Consent --}}
                                        <div class="form-group">
                                            <p class="grey-text">Bristol Energy would like to share information with you about any products, services on offer from Bristol Energy and its associated companies.</p>
                                            <input type="checkbox" id="supplier_opt_in" name="supplier_opt_in" {{ (old('supplier_opt_in', "") == true) ? "checked" : "" }} />
                                            <label for="supplier_opt_in" style="font-weight: normal;">Yes please, I would like to hear what Bristol Energy has to offer.</label>
                                        </div>
                                        @break
                                    {{-- EDF Energy --}}
                                    @case("EDF Energy")
                                        {{-- Priority Services Register --}}
                                        <div class="form-group">
                                            <p><label for="special_needs_priority_services_register">Special needs / Priority Services Register (PSR)</label></p>
                                            <span id="special_needs_priority_services_register" class="form-error-message text-danger"></span>
                                            <label style="font-weight: normal;">
                                                <input type="checkbox" id="special_needs_priority_services_register" name="special_needs_priority_services_register" {{ (old('special_needs_priority_services_register', "") != '') ? "checked" : " " }} />
                                                Would you like to receive information about EDF Energy Customers Ltd's Priority Services Register Scheme?
                                            </label>
                                        </div>
                                        {{-- Marketing Consent --}}
                                        <div class="form-group">
                                            <input type="checkbox" id="supplier_opt_in" name="supplier_opt_in" {{ (old('supplier_opt_in', "") == true) ? "checked" : "" }} />
                                            <label for="supplier_opt_in" style="font-weight: normal;">EDF will email you offers from time to time. You can tick this box if you want to unsubscribe.</label>
                                            <p class="grey-text">EDF will send you a confirmation email. If you don't wish to receive EDF email marketing, you can unsubscribe using the link at the bottom of their email.</p>
                                        </div>
                                        @break
                                    {{-- Green --}}
                                    @case("Green")
                                        {{-- Marketing Consent --}}
                                        <h2>Stay in touch</h2>
                                        <p class="grey-text">Green Supplier Limited would like to share information with you about any products, services on offer from Green Supplier Limited and its associated companies.</p>
                                        <div class="form-group">
                                            <input type="checkbox" id="supplier_opt_in" name="supplier_opt_in" {{ (old('supplier_opt_in', "") == true) ? "checked" : "" }} />
                                            <label for="supplier_opt_in" style="font-weight: normal;">Yes please, I would like to hear what {{ $selected_tariff["supplierName"] }} has to offer.</label>
                                        </div>
                                        @break
                                    {{-- Igloo Energy --}}
                                    @case("Igloo Energy")
                                        {{-- Marketing Consent --}}
                                        <h2>Stay in touch</h2>
                                        <p class="grey-text">Igloo Energy would like to share information with you about any products, services on offer from Igloo Energy and its associated companies.</p>
                                        <div class="form-group">
                                            <input type="checkbox" id="supplier_opt_in" name="supplier_opt_in" {{ (old('supplier_opt_in', "") == true) ? "checked" : "" }} />
                                            <label for="supplier_opt_in" style="font-weight: normal;">Yes please, I would like to hear what {{ $selected_tariff["supplierName"] }} has to offer.</label>
                                        </div>
                                        @break
                                    {{-- ScottishPower --}}
                                    @case("ScottishPower")
                                        {{-- Marketing Consent --}}
                                        <h2>Stay in touch</h2>
                                        <div class="grey-text">
                                            <p>At ScottishPower, we often have exclusive offers, new tariffs and updates to our services that we hope you'd like to hear about.</p>
                                            <p>We'll always treat your details with care and will never sell them to any third party for their marketing purposes. You can find out more about how we handle your personal data in our <a href="https://www.scottishpower.co.uk/legal/privacy-policy" target="_blank">Privacy Information Notice</a>. Remember, you can opt out at any time.</p>
                                            <p>If you're happy for us to contact you with relevant promotions and information now and again, please let us know your preferred contact methods:</p>
                                        </div>
                                        <div class="form-group">
                                            <label style="display: inline-block; font-weight: normal;"><input type="checkbox" id="supplier_partners_email" name="supplier_partners_email" {{ (old('supplier_partners_email', "") == true) ? "checked" : "" }}             style="float: none;" /> Email</label>
                                            <label style="display: inline-block; font-weight: normal;"><input type="checkbox" id="supplier_partners_sms" name="supplier_partners_sms" {{ (old('supplier_partners_sms', "") == true) ? "checked" : "" }}                   style="float: none; margin-left: 10px;" /> SMS Text</label>
                                            <label style="display: inline-block; font-weight: normal;"><input type="checkbox" id="supplier_partners_telephone" name="supplier_partners_telephone" {{ (old('supplier_partners_telephone', "") == true) ? "checked" : "" }} style="float: none; margin-left: 10px;" /> Telephone</label>
                                            <label style="display: inline-block; font-weight: normal;"><input type="checkbox" id="supplier_partners_letter" name="supplier_partners_letter" {{ (old('supplier_partners_letter', "") == true) ? "checked" : "" }}          style="float: none; margin-left: 10px; float: none;" /> Letter</label>
                                        </div>
                                        @break
                                    {{-- Shell Energy --}}
                                    @case("Shell Energy")
                                        {{-- Marketing Consent --}}
                                        <h2>Stay in touch</h2>
                                        <div class="grey-text">
                                            <p>Shell Energy are committed to helping you discover new ways of managing your energy and running your home more efficiently including smart home technology that can help make life that little bit easier. That is why they would like to keep you up to date with news and offers from Shell.</p>
                                            <p>Be the first to hear about:</p>
                                            <ul>
                                                <li>New deals on renewable home energy, smart technology and tools, plus other home essentials</li>
                                                <li>New products and services, competitions and news</li>
                                                <li>Exclusive rewards through Shell Go+ loyalty programme</li>
                                            </ul>
                                        </div>
                                        <p>If you are happy to receive this information from Shell Energy please tell us how you would like to hear from them. Tick those boxes that apply.</p>
                                        <p>Once you have switched you can change your preferences anytime you want by logging into your account with Shell Energy. If you choose to opt out of all marketing communications that is fine, but Shell Energy will still need to contact you about your account occasionally (for billing. payments, account updates etc).</p>
                                        <p>If you would like to find out more about how they handle your personal details, please read their <a href="https://s3-eu-west-1.amazonaws.com/tes-resources/TCs/shell-energy-privacy-policy.pdf" target="_blank">Privacy Policy</a>.</p>
                                        <div class="form-group">
                                            <label style="display: inline-block; font-weight: normal;"><input type="checkbox" id="supplier_partners_email" name="supplier_partners_email" {{ (old('supplier_partners_email', "") == true) ? "checked" : "" }}             style="float: none;" /> Email</label>
                                            <label style="display: inline-block; font-weight: normal;"><input type="checkbox" id="supplier_partners_sms" name="supplier_partners_sms" {{ (old('supplier_partners_sms', "") == true) ? "checked" : "" }}                   style="float: none; margin-left: 10px;" /> SMS Text</label>
                                            <label style="display: inline-block; font-weight: normal;"><input type="checkbox" id="supplier_partners_telephone" name="supplier_partners_telephone" {{ (old('supplier_partners_telephone', "") == true) ? "checked" : "" }} style="float: none; margin-left: 10px;" /> Telephone</label>
                                        </div>
                                        @break
                                    {{-- Together Energy --}}
                                    @case("Together Energy")
                                        {{-- Priority Services Register --}}
                                        <div>
                                            <p><b>Special needs / Priority Services Register</b></p>
                                            <input type="checkbox" id="special_needs_priority_services_register" name="special_needs_priority_services_register" {{ (old('special_needs_priority_services_register', "") == true) ? "checked" : "" }} style="float: none;" />
                                            <label for="special_needs_priority_services_register" style="font-weight: normal;">Would you like to receive information about Together Energy's Priority Services Register Scheme?</label>
                                        </div>
                                        @break
                                @endswitch

                                <div><button type="submit" class="switchButton">Get Switching</button></div>
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
            var errorSmartMeter = $("#smartMeter_error");
            var inputSmartMeter = $("#smartMeter");
            var yesTextSmartMeter = $("#smartMeter_yesText_section");
            var dontKnowTextSmartMeter = $("#smartMeter_dontKnowText_section");
            // var errorGasMeterNumber = $("#gas_meter_number_error");
            // var inputGasMeterNumber = $("#gas_meter_number");
            // var errorElecMeterNumber = $("#elec_meter_number_error");
            // var inputElecMeterNumber = $("#elec_meter_number");

            var inputSameCurrentAddress = $("#same_current_address");
            var billingSection = $("#billing_section");
            var errorBilling = $("#billing_error");
            var inputBillingPostcode = $("#billing_postcode");
            var inputBillingHouseNo = $("#billing_houseNo");
            var inputBillingAddress = $("#billing_address");
            var inputBillingStreetName = $("#billing_street_name");
            var inputBillingArea = $("#billing_area");
            var inputBillingTown = $("#billing_town");
            var inputBillingCounty = $("#billing_county");

            var directDebitInstructionText = $(".direct_debit_instruction_text");
            var directDebitInstructionTextMDD = $(".direct_debit_instruction_text_mdd");
            var directDebitGuaranteButton = $("#direct_debit_guarantee_button");
            var directDebitGuaranteeBackground = $("#direct_debit_guarantee_background");
            var directDebitGuaranteePopupOuter = $("#direct_debit_guarantee_popup_outer");
            var directDebitGuaranteeClose = $(".direct_debit_guarantee_close");

            var existingPaymentMethod = $("#existing_payment_method");
            var errorPaymentMethod = $("#payment_method_error");
            var inputPaymentMethod = $("#payment_method");
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
            var errorPreferredDay = $("#preferredDay_error");
            var inputPreferredDay = $("#preferredDay");
            var errorDirectDebitConfirmation = $("#direct_debit_confirmation_error");
            var inputDirectDebitConfirmation = $("#direct_debit_confirmation");
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

            var sections =
            {
                "addressLength":
                {
                    "years":
                    {
                        "error": $("#address_length_years_error"),
                        "input": $("#address_length_years")
                    },
                    "months":
                    {
                        "error": $("#address_length_months_error"),
                        "input": $("#address_length_months")
                    }
                },
                "prevAddr1":
                {
                    "section": $("#prev_addr_1_section"),
                    "postcode":
                    {
                        "error": $("#prev_addr_1_postcode_error"),
                        "input": $("#prev_addr_1_postcode")
                    },
                    "addressLine1":
                    {
                        "error": $("#prev_addr_1_address_line_1_error"),
                        "input": $("#prev_addr_1_address_line_1")
                    },
                    "addressLine2":
                    {
                        "error": $("#prev_addr_1_address_line_1_error"),
                        "input": $("#prev_addr_1_address_line_1")
                    },
                    "town":
                    {
                        "error": $("#prev_addr_1_town_error"),
                        "input": $("#prev_addr_1_town")
                    },
                    "county":
                    {
                        "error": $("#prev_addr_1_county_error"),
                        "input": $("#prev_addr_1_county")
                    },
                    "addressLength":
                    {
                        "years":
                        {
                            "error": $("#prev_addr_1_length_years_error"),
                            "input": $("#prev_addr_1_length_years")
                        },
                        "months":
                        {
                            "error": $("#prev_addr_1_length_months_error"),
                            "input": $("#prev_addr_1_length_months")
                        }
                    }
                },
                "prevAddr2":
                {
                    "section": $("#prev_addr_2_section"),
                    "postcode":
                    {
                        "error": $("#prev_addr_2_postcode_error"),
                        "input": $("#prev_addr_2_postcode")
                    },
                    "addressLine1":
                    {
                        "error": $("#prev_addr_2_address_line_1_error"),
                        "input": $("#prev_addr_2_address_line_1")
                    },
                    "addressLine2":
                    {
                        "error": $("#prev_addr_2_address_line_1_error"),
                        "input": $("#prev_addr_2_address_line_1")
                    },
                    "town":
                    {
                        "error": $("#prev_addr_2_town_error"),
                        "input": $("#prev_addr_2_town")
                    },
                    "county":
                    {
                        "error": $("#prev_addr_2_county_error"),
                        "input": $("#prev_addr_2_county")
                    },
                    "addressLength":
                    {
                        "years":
                        {
                            "error": $("#prev_addr_2_length_years_error"),
                            "input": $("#prev_addr_2_length_years")
                        },
                        "months":
                        {
                            "error": $("#prev_addr_2_length_months_error"),
                            "input": $("#prev_addr_2_length_months")
                        }
                    }
                }
            }


            // select previous input for dropdown lists
            try { if (inputSmartMeter != null) inputSmartMeter.find('[value=' + inputSmartMeter.attr('data-value') + ']').prop("selected", true); } catch {}
            try { if (inputPreferredDay != null) inputPreferredDay.find('[value=' + inputPreferredDay.attr('data-value') + ']').prop("selected", true); } catch {}
            // try { if (inputPaymentMethod != null) inputPaymentMethod.find('[value=' + inputPaymentMethod.attr('data-value') + ']').prop("selected", true); } catch {}


            // current address length section
            sections.addressLength.years.input.change(function(e)
            {
                sections.addressLength.years.error.text("");
                if (!isFinite(e.target.value)) { sections.addressLength.years.error.text("The years field must be a number."); return; }
                if (e.target.value < 0) { sections.addressLength.years.error.text("The years field must be greater than or equal to 0."); return; }
                PreviousAddressesShowHide();
            });
            sections.addressLength.months.input.change(function(e)
            {
                sections.addressLength.months.error.text("");
                if (!isFinite(e.target.value)) sections.addressLength.months.error.text("The months field must be a number.");
                if (e.target.value < 0 || e.target.value > 11) sections.addressLength.months.error.text("The months field must be between 0 and 12.");
                PreviousAddressesShowHide();
            });

            // previous address 1 length section
            sections.prevAddr1.addressLength.years.input.change(function(e)
            {
                sections.prevAddr1.addressLength.years.error.text("");
                if (!isFinite(e.target.value)) { sections.prevAddr1.addressLength.years.error.text("The years field must be a number."); return; }
                if (e.target.value < 0) { sections.prevAddr1.addressLength.years.error.text("The years field must be greater than or equal to 0."); return; }
                PreviousAddressesShowHide();
            });
            sections.prevAddr1.addressLength.months.input.change(function(e)
            {
                sections.prevAddr1.addressLength.months.error.text("");
                if (!isFinite(e.target.value)) sections.prevAddr1.addressLength.months.error.text("The months field must be a number.");
                if (e.target.value < 0 || e.target.value > 11) sections.prevAddr1.addressLength.months.error.text("The months field must be between 0 and 12.");
                PreviousAddressesShowHide();
            });

            // previous address 2 length section
            sections.prevAddr2.addressLength.years.input.change(function(e)
            {
                sections.prevAddr2.addressLength.years.error.text("");
                if (!isFinite(e.target.value)) { sections.prevAddr2.addressLength.years.error.text("The years field must be a number."); }
                if (e.target.value < 0) { sections.prevAddr2.addressLength.years.error.text("The years field must be greater than or equal to 0."); }
            });
            sections.prevAddr2.addressLength.months.input.change(function(e)
            {
                sections.prevAddr2.addressLength.months.error.text("");
                if (!isFinite(e.target.value)) sections.prevAddr2.addressLength.months.error.text("The months field must be a number.");
                if (e.target.value < 0 || e.target.value > 11) sections.prevAddr2.addressLength.months.error.text("The months field must be between 0 and 12.");
            });

            PreviousAddressesShowHide();
            function PreviousAddressesShowHide()
            {
                var currAddrYears = sections.addressLength.years.input.val();
                var currAddrMonths = sections.addressLength.months.input.val();
                if (!currAddrYears || currAddrYears >= 3)
                {
                    sections.prevAddr1.section.hide().attr("disabled", "disabled");
                    sections.prevAddr2.section.hide().attr("disabled", "disabled");
                }
                else
                {
                    sections.prevAddr1.section.show().removeAttr("disabled");

                    var prevAddr1Years = sections.prevAddr1.addressLength.years.input.val();
                    var prevAddr1Months = sections.prevAddr1.addressLength.months.input.val();
                    var totalMonths = parseInt(currAddrMonths) + parseInt(prevAddr1Months);
                    var totalYears = parseInt(currAddrYears) + parseInt(prevAddr1Years) + (totalMonths / 12);
                    if (!prevAddr1Years || totalYears >= 3)
                    {
                        sections.prevAddr2.section.hide().attr("disabled", "disabled");
                    }
                    else
                    {
                        sections.prevAddr2.section.show().removeAttr("disabled");
                    }
                }
            }


            // billing address section
            inputSameCurrentAddress.change(function() { BillingShowHideAddressSection(); });
            BillingShowHideAddressSection();
            function BillingShowHideAddressSection()
            {
                if (inputSameCurrentAddress.prop("checked")) billingSection.hide().attr("disabled", "disabled");
                else billingSection.show().removeAttr("disabled");
            }


            // smart meter text
            inputSmartMeter.change(SmartMeterTextShowHide);
            SmartMeterTextShowHide()
            function SmartMeterTextShowHide()
            {
                yesTextSmartMeter.hide();
                dontKnowTextSmartMeter.hide();
                switch (inputSmartMeter.val())
                {
                    case "Y":
                        yesTextSmartMeter.show();
                        break;
                    case "DK":
                        dontKnowTextSmartMeter.show();
                        break;
                }
            }

            existingPaymentMethod.change(DirectDebitInstructionTextShowHide);
            DirectDebitInstructionTextShowHide();
            function DirectDebitInstructionTextShowHide()
            {
                directDebitInstructionText.hide().find("input").attr("disabled", "disabled");
                directDebitInstructionTextMDD.hide().find("input").attr("disabled", "disabled");
                switch (existingPaymentMethod.val())
                {
                    case "MDD":
                        directDebitInstructionText.show().find("input").removeAttr("disabled");
                        directDebitInstructionTextMDD.show().find("input").removeAttr("disabled");
                        break;
                    case "QDD":
                    case "CAC":
                        directDebitInstructionText.show().find("input").removeAttr("disabled");
                        break;
                }
            }

            // direct debit guarantee text
            directDebitGuaranteButton.click(function()
            {
                directDebitGuaranteePopupOuter.show();
                directDebitGuaranteeBackground.show();
            });
            directDebitGuaranteeClose.click(function()
            {
                directDebitGuaranteePopupOuter.hide();
                directDebitGuaranteeBackground.hide();
            });


            // using ajax to find addresses

            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            // form submit code
            mainForm.onsubmit = function(e)
            {
                $(".form-error-message").text('');

                @if ($get_previous_addresses)

                @endif

                // if (inputPaymentMethod.val().length == 0)
                // {
                //     e.preventDefault();
                //     errorPaymentMethod.text("The payment method is required.");
                //     try { $("html, body").animate({ "scrollTop": errorPaymentMethod.offset().top }, 0); }
                //     catch (ex) {}
                //     return;
                // }

                if (inputDirectDebitConfirmation.length > 0 && !inputDirectDebitConfirmation[0].hasAttribute("disabled") && !inputDirectDebitConfirmation.prop("checked"))
                {
                    e.preventDefault();
                    errorDirectDebitConfirmation.text("You must confirm to continue.");
                    try { $("html, body").animate({ "scrollTop": errorDirectDebitConfirmation.offset().top }, 0); }
                    catch (ex) {}
                    return;
                }

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

    <script src="{{ asset('js/accordion.js') }}" defer="true"></script>
@endsection
