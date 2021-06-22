<?php $logo_drag_text = "Drag the logo banner sideways to see more options"; ?>

@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        #form-main
        {
            background-color: #f3f2f1;
            border-radius: 35px;
            border: 2px solid #202020;
            padding: 30px 30px 0px;
            margin: 50px auto;
        }
        
        .scroll-text
        {
            float: right;
            font-size: 20px;
        }

        .radio-hidden
        {
            opacity: 0;
            width: 0;
        }

        .form-error-message
        {
            font-size: 20px;
        }

        .paragraph-margin
        {
            font-size: 28px;
        }
        
        input[type=radio]:checked + img
        {
            background-color: #00d2db;
            border-color: #07adb3;
        }

        .btn-group
        {
            width: 100%;
        }

        .btn-group input[type="radio"]
        {
            opacity: 0;
            position: fixed;
            width: 0;
        }

        .btn-group label
        {
            display: inline-block;
            background-color: #f3f2f1;
            padding: 12px 50px;
            font-size: 24px;
            border: 2px solid #202020;
            border-radius: 35px;
            margin: 15px auto;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 25%;
        }

        .btn-group.btn-group-4 label
        {
            width: 22%;
        }

        .btn-group.btn-group-3 label
        {
            width: 30%;
        }

        .btn-group.btn-group-2 label
        {
            width: 47%;
        }

        /* .btn-group label:first-of-type
        {
            margin-left: 0;
        }

        .btn-group label:last-of-type
        {
            margin-right: 0;
        } */

        .btn-group label:hover
        {
            background-color: #8bf0f3;
        }

        .btn-group input[type="radio"]:checked + label
        {
            background-color: #00d2db;
            border-color: #07adb3;
        }


        /* Swiper stylings */
        .swiper-container
        {
            width: 100vw;
            max-width: 100%;
            text-align: center;
        }

        .swiper-slide
        {
            max-width: 100%;
            width: 220px;
            height: 120px;
            border: 2px solid #202020;
            border-radius: 20px;
            font-size: 18px;
            text-align: center;
        }

        .swiper-slide input:checked + *
        {
            background-color: #00d2db;
        }
        
        .swiper-slide img
        {
            max-height: 100%;
            max-width: 100%;
            padding: 20px 0px;
            object-fit: contain;
            position: relative
        }

        .swiper-slide .img-outer
        {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            right: 0;
            border-radius: 20px;
            
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

        .your-usage-table
        {
            width: 100%;
        }

        .your-usage-table input
        {
            max-width: 100%;
        }

        @media (max-width: 1199px)
        {
            .swiper-slide
            {
                height: 120px;
            }
        }

        @media (max-width: 767px)
        {
            .btn-group label
            {
                width: 100% !important;
                height: auto;
                border-radius: 10px;
            }
        }
        
        @media (max-width: 575px)
        {
            #form-main
            {
                border-radius: 0px;
                margin: 0px;
                border: none;
            }

            .background-image-no-mobile::before
            {
                background-image: none !important;
            }

            .your-usage-table td
            {
                display: block;
                width: 100%;
            }
        }
    </style>
@endsection

@section('before-header')
    <div id="requestCallback" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr />
        <div class="row flex-grow-1 no-padding background-image-wind-turbines background-image-top background-image-contain background-image-no-mobile" style="color: #202020;">
            <form id="form-main" class="container" action="{{ route('residential.energy-comparison.2-existing-tariff') }}" method="POST" id="energy_form" style="width: 100%;">
                @csrf
                <input type="hidden" id="region_id" name="region_id" value="<?= $region["id"] ?>" />
                <div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors -> all() as $error)
                                {{ $error }}<br />
                            @endforeach
                        </div>
                    @endif

                    <span id="fuel_type_error" class="form-error-message text-danger"></span>
                    <p class="paragraph-margin"> What are you looking to compare? </p>
                    <div class="btn-group btn-group-3 flex-wrap" role="group">
                        <input type="radio" class="radio-hidden fuel_type_radio" name="fuel_type" value="dual" id="fuel_type_radio_dual" value="{{ old('gas-electric-radio') }}" autocomplete="off" />
                        <label for="fuel_type_radio_dual">Gas & Electricity </label>
                        <input type="radio" class="radio-hidden fuel_type_radio" name="fuel_type" value="gas" id="fuel_type_radio_gas" autocomplete="off" />
                        <label for="fuel_type_radio_gas"> Gas </label>
                        <input type="radio" class="radio-hidden fuel_type_radio" name="fuel_type" value="electric" id="fuel_type_radio_electric" autocomplete="off" />
                        <label for="fuel_type_radio_electric"> Electricity </label>
                    </div>
                    <br /><br />
                    
                    <div id="section_same_fuel_supplier" style="display: none;">
                        <span id="same_fuel_supplier_error" class="form-error-message text-danger"></span>
                        <p class="paragraph-margin"> Do you have the same supplier for both gas and electricity? </p>
                        <div class="btn-group btn-group-2 flex-wrap" role="group">
                            <input type="radio" class="radio-hidden same_fuel_supplier_radio" name="same_fuel_supplier" id="same_fuel_supplier_radio_yes" value="yes" autocomplete="off" />
                            <label for="same_fuel_supplier_radio_yes"> Yes </label>
                            <input type="radio" class="radio-hidden same_fuel_supplier_radio" name="same_fuel_supplier" id="same_fuel_supplier_radio_no" value="no" autocomplete="off" />
                            <label for="same_fuel_supplier_radio_no"> No </label>
                        </div>
                        <br /><br />
                    </div>
                </div>
                
                
                {{-- Dual Suppliers --}}
                
                <div id="section_dual_supplier" style="display: none;">
                    <span id="dual_supplier_error" class="form-error-message text-danger"></span>
                    <p class="paragraph-margin p-clear-right-mobile">Who is your current gas/electric supplier?<span class="scroll-text">{{ $logo_drag_text }}</span></p>
                    <!-- swiper -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($supplier_data["main_dual_suppliers"] as $main_dual_supplier)
                                <?php
                                    $image_src = "";
                                    switch ($main_dual_supplier["name"])
                                    {
                                        case "Bristol Energy": $image_src = "bristol-energy.png"; break;
                                        case "British Gas": $image_src = "british-gas.png"; break;
                                        case "EDF Energy": $image_src = "edf.png"; break;
                                        case "ENGIE": $image_src = "engie.png"; break;
                                        case "E.ON": $image_src = "eon.png"; break;
                                        case "OVO energy": $image_src = "ovo-energy.png"; break;
                                        case "ScottishPower": $image_src = "scottish-power.png"; break;
                                        case "SSE": $image_src = "SSE.png"; break;
                                        case "Utilita": $image_src = "utilita.png"; break;
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <label>
                                        <input type="radio" class="radio-hidden dual_supplier_radio" name="dual_supplier_radio" value="<?= $main_dual_supplier["id"] ?>" autocomplete="off">
                                        <div class="img-outer">
                                            <img src='<?= asset("img/supplier-logos/$image_src") ?>' />
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <br />
                    </div>
                    <label for="dual_supplier_dropdown" style="margin-top: 5px;">If your supplier is not shown above, please search this dropdown list.</label><br />
                    <select id="dual_supplier_dropdown" name="dual_supplier">
                        <option value=""></option>
                        @foreach ($supplier_data["dual_suppliers"] as $dual_supplier)
                            <option value="{{ $dual_supplier["id"] }}">{{ $dual_supplier["name"] }}</option>
                        @endforeach
                    </select>
                    <br />
                    <br />
                </div>
                
                
                {{-- Gas Suppliers --}}
                
                <div id="section_gas_supplier" style="display: none;">
                    <span id="gas_supplier_error" class="form-error-message text-danger"></span>
                    <p class="paragraph-margin p-clear-right-mobile">Who is your current gas supplier?<span class="scroll-text">{{ $logo_drag_text }}</span></p>
                    <!-- swiper -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($supplier_data["main_gas_suppliers"] as $main_gas_supplier)
                                <?php
                                    $image_src = "";
                                    switch ($main_gas_supplier["name"])
                                    {
                                        case "Bristol Energy": $image_src = "bristol-energy.png"; break;
                                        case "British Gas": $image_src = "british-gas.png"; break;
                                        case "EDF Energy": $image_src = "edf.png"; break;
                                        case "ENGIE": $image_src = "engie.png"; break;
                                        case "E.ON": $image_src = "eon.png"; break;
                                        case "OVO energy": $image_src = "ovo-energy.png"; break;
                                        case "ScottishPower": $image_src = "scottish-power.png"; break;
                                        case "SSE": $image_src = "SSE.png"; break;
                                        case "Utilita": $image_src = "utilita.png"; break;
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <label>
                                        <input type="radio" class="radio-hidden gas_supplier_radio" name="gas_supplier_radio" value="<?= $main_gas_supplier["id"] ?>" autocomplete="off">
                                        <div class="img-outer">
                                            <img src='<?= asset("img/supplier-logos/$image_src") ?>' />
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <br />
                    <label for="gas_supplier_dropdown" style="margin-top: 5px;">If your gas supplier is not shown above, please search this dropdown list.</label><br />
                    <select id="gas_supplier_dropdown" name="gas_supplier">
                        <option value=""></option>
                        @foreach ($supplier_data["gas_suppliers"] as $gas_supplier)
                            <option value="{{ $gas_supplier["id"] }}">{{ $gas_supplier["name"] }}</option>
                        @endforeach
                    </select>
                    <br /><br />
                </div>
                
                
                {{-- Tariff Details 1 --}}

                <div id="section_tariff_1" style="display: none;">
                    <div id="section_tariff_1_payment_method">
                        <span id="tariff_1_payment_method_error" class="form-error-message text-danger"></span>
                        <p class="paragraph-margin"> How do you pay for your energy? </p>
                        <div class="btn-group btn-group-4 flex-wrap" role="group">
                            <input type="radio" class="radio-hidden tariff_1_payment_method_radio" id="tariff_1_payment_method_monthlyDirectDebit" name="tariff_1_payment_method" value="MDD" autocomplete="off" checked="true" />
                            <label for="tariff_1_payment_method_monthlyDirectDebit"> Monthly Direct Debit </label>
                            <input type="radio" class="radio-hidden tariff_1_payment_method_radio" id="tariff_1_payment_method_quarterlyDirectDebit" name="tariff_1_payment_method" value="QDD" autocomplete="off" />
                            <label for="tariff_1_payment_method_quarterlyDirectDebit"> Quarterly Direct Debit </label>
                            <input type="radio" class="radio-hidden tariff_1_payment_method_radio" id="tariff_1_payment_method_cashCheque" name="tariff_1_payment_method" value="CAC" autocomplete="off" />
                            <label for="tariff_1_payment_method_cashCheque"> Cash / Cheque </label>
                            <input type="radio" class="radio-hidden tariff_1_payment_method_radio" id="tariff_1_payment_method_prepayment" name="tariff_1_payment_method" value="PRE" autocomplete="off" />
                            <label for="tariff_1_payment_method_prepayment"> Prepayment Meter </label>
                        </div>
                        <br /><br />
                    </div>
                    
                    <div id="section_tariff_1_e7">
                        <span id="tariff_1_e7_error" class="form-error-message text-danger"></span>
                        <p class="paragraph-margin"> Do you have Economy7? </p>
                        <div class="btn-group btn-group-2 flex-wrap" role="group">
                            <input type="radio" class="radio-hidden tariff_1_e7_radio" id="tariff_1_e7_radio_yes" name="tariff_1_e7" value="true" autocomplete="off" />
                            <label for="tariff_1_e7_radio_yes"> Yes </label>
                            <input type="radio" class="radio-hidden tariff_1_e7_radio" id="tariff_1_e7_radio_no" name="tariff_1_e7" value="false" autocomplete="off" checked="true" />
                            <label for="tariff_1_e7_radio_no"> No </label>
                        </div>
                        <br /><br />
                    </div>
                    
                    <div id="section_tariff_1_current_tariff">
                        <span id="tariff_1_current_tariff_error" class="form-error-message text-danger"></span>
                        <p class="paragraph-margin">What is the name of your current tariff?</p>
                        <div class="form-group">
                            <select id="tariff_1_current_tariff" name="tariff_1_current_tariff" style="width: 100%; margin-bottom: 10px;" >
                                <option class="initial-values" value="" disabled selected hidden></option>
                            </select>
                            <input type="checkbox" id="tariff_1_current_tariff_not_listed" name="tariff_1_current_tariff_not_listed" class="initial-values" value="notListed" />
                            <label id="tariff_1_current_tariff_not_listed_label" for="tariff_1_current_tariff_not_listed">Not listed/Not sure</label>
                            <br />
                            <p id="tariff_1_current_tariff_not_listed_message" style="display: none;">That's okay. We will compare against your supplier's most popular default tariff to bring you the best deals.</p>
                            <p id="tariff_1_current_tariff_no_content" style="display: none;">Sorry, but we could not find any tariffs from the data you provided. Please check your input above.</p>
                            <p id="tariff_1_current_tariff_error_message" style="display: none;">Sorry, but there was a problem processing your data. Please check your information above, or try again later.</p>
                        </div>
                        <br /><br />
                    </div>
                </div>
                

                {{-- Electric Suppliers --}}
                
                <div id="section_electric_supplier" style="display: none;">
                    <span id="electric_supplier_error" class="form-error-message text-danger"></span>
                    <p class="paragraph-margin"> Who is your current electricity supplier? <span class="scroll-text">{{ $logo_drag_text }}</span></p>
                    <!-- swiper -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($supplier_data["main_electric_suppliers"] as $main_electric_supplier)
                                <?php
                                    $image_src = "";
                                    switch ($main_electric_supplier["name"])
                                    {
                                        case "Bristol Energy": $image_src = "bristol-energy.png"; break;
                                        case "British Gas": $image_src = "british-gas.png"; break;
                                        case "EDF Energy": $image_src = "edf.png"; break;
                                        case "ENGIE": $image_src = "engie.png"; break;
                                        case "E.ON": $image_src = "eon.png"; break;
                                        case "OVO energy": $image_src = "ovo-energy.png"; break;
                                        case "ScottishPower": $image_src = "scottish-power.png"; break;
                                        case "SSE": $image_src = "SSE.png"; break;
                                        case "Utilita": $image_src = "utilita.png"; break;
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <label>
                                        <input type="radio" class="radio-hidden electric_supplier_radio" name="electric_supplier_radio" value="<?= $main_electric_supplier["id"] ?>" autocomplete="off">
                                        <div class="img-outer">
                                            <img src="<?= asset("img/supplier-logos/$image_src") ?>"/>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <br />
                    <label for="electric_supplier_dropdown" style="margin-top: 5px;">If your electricity supplier is not shown above, please search this dropdown list.</label><br />
                    <select id="electric_supplier_dropdown" name="electric_supplier">
                        <option value=""></option>
                        @foreach ($supplier_data["electric_suppliers"] as $electric_supplier)
                            <option value="{{ $electric_supplier["id"] }}">{{ $electric_supplier["name"] }}</option>
                        @endforeach
                    </select>
                    <br /><br />
                </div>
                
                
                {{-- Tariff Details 2 --}}

                <div id="section_tariff_2" style="display: none;">
                    <div id="section_tariff_2_payment_method">
                        <span id="tariff_2_payment_method_error" class="form-error-message text-danger"></span>
                        <p class="paragraph-margin"> How do you pay for your energy? </p>
                        <div class="btn-group btn-group-4 flex-wrap" role="group">
                            <input type="radio" class="radio-hidden tariff_2_payment_method_radio" id="tariff_2_payment_method_monthlyDirectDebit" name="tariff_2_payment_method" value="MDD" autocomplete="off" checked="true" />
                            <label for="tariff_2_payment_method_monthlyDirectDebit"> Monthly Direct Debit </label>
                            <input type="radio" class="radio-hidden tariff_2_payment_method_radio" id="tariff_2_payment_method_quarterlyDirectDebit" name="tariff_2_payment_method" value="QDD autocomplete="off" />
                            <label for="tariff_2_payment_method_quarterlyDirectDebit"> Quarterly Direct Debit </label>
                            <input type="radio" class="radio-hidden tariff_2_payment_method_radio" id="tariff_2_payment_method_cashCheque" name="tariff_2_payment_method" value="CAC" autocomplete="off" />
                            <label for="tariff_2_payment_method_cashCheque"> Cash / Cheque </label>
                            <input type="radio" class="radio-hidden tariff_2_payment_method_radio" id="tariff_2_payment_method_prepayment" name="tariff_2_payment_method" value="PRE" autocomplete="off" />
                            <label for="tariff_2_payment_method_prepayment"> Prepayment Meter </label>
                        </div>
                        <br /><br />
                    </div>
                    
                    <div id="section_tariff_2_e7">
                        <span id="tariff_2_e7_error" class="form-error-message text-danger"></span>
                        <p class="paragraph-margin"> Do you have Economy7? </p>
                        <div class="btn-group btn-group-2 flex-wrap" role="group">
                            <input type="radio" class="radio-hidden tariff_2_e7_radio" id="tariff_2_e7_radio_yes" name="tariff_2_e7" value="true" autocomplete="off" checked="true" />
                            <label for="tariff_2_e7_radio_yes"> Yes </label>
                            <input type="radio" class="radio-hidden tariff_2_e7_radio" id="tariff_2_e7_radio_no" name="tariff_2_e7" value="false" autocomplete="off" />
                            <label for="tariff_2_e7_radio_no"> No </label>
                        </div>
                        <br /><br />
                    </div>
                    
                    <div id="section_tariff_2_current_tariff">
                        <span id="tariff_2_current_tariff_error" class="form-error-message text-danger"></span>
                        <p class="paragraph-margin">What is the name of your current tariff?</p>
                        <div class="form-group">
                            <select id="tariff_2_current_tariff" name="tariff_2_current_tariff" style="width: 100%; margin-bottom: 10px;" >
                                <option class="initial-values" value="" disabled selected hidden></option>
                            </select>
                            <input type="checkbox" id="tariff_2_current_tariff_not_listed" name="tariff_2_current_tariff_not_listed" class="initial-values" value="notListed" />
                            <label id="tariff_2_current_tariff_not_listed_label" for="tariff_2_current_tariff_not_listed">Not listed/Not sure</label>
                            <br />
                            <p id="tariff_2_current_tariff_not_listed_message" style="display: none;">That's okay. We will compare against your supplier's most popular default tariff to bring you the best deals.</p>
                            <p id="tariff_2_current_tariff_no_content" style="display: none;">Sorry, but we could not find any tariffs from the data you provided. Please check your input above.</p>
                            <p id="tariff_2_current_tariff_error_message" style="display: none;">Sorry, but there was a problem processing your data. Please check your information above, or try again later.</p>
                        </div>
                        <br /><br />
                    </div>
                </div>
                
                <div id="section_your_usage" style="display: none;">
                    <div id="section_your_gas_usage" style="display: none;">
                        <p class="paragraph-margin"> Your Gas Usage </p>
                        <div style="text-align: center;">
                            <table class="your-usage-table">
                                <tr>
                                    <td></td>
                                    <td><span id="your_gas_usage_kwh_error" class="form-error-message text-danger"></span></td>
                                </tr>
                                <tr>
                                    <td><label for="your_gas_usage_kwh"> I use </label></td>
                                    <td><input class="form-control" type="number" pattern="[0-9]*" name="your_gas_usage_kwh" id="your_gas_usage_kwh" style="margin-bottom: 1em;" /></td>
                                </tr>
                                <tr>
                                    <td><span id="your_gas_usage_length_error" class="form-error-message text-danger"></span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="your_gas_usage_length"> kWh per </label></td>
                                    <td>
                                        <select class="form-control" id="your_gas_usage_length" name="your_gas_usage_length">
                                            <option value="Month"> Month </option>
                                            <option value="Quarter"> Quarter </option>
                                            <option value="Year"> Year </option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br />
                    <div id="section_your_electric_usage" style="display: none;">
                        <p class="paragraph-margin"> Your Electricity Usage </p>
                        <div style="text-align: center;">
                            <table class="your-usage-table">
                                <tr>
                                    <td></td>
                                    <td><span id="your_electric_usage_kwh_error" class="form-error-message text-danger"></span></td>
                                </tr>
                                <tr>
                                    <td><label for="your_electric_usage_kwh"> I use </label></td>
                                    <td><input class="form-control" type="number" pattern="[0-9]*" name="your_electric_usage_kwh" id="your_electric_usage_kwh" style="margin-bottom: 1em;" /></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><span id="your_electric_usage_length_error" class="form-error-message text-danger"></span></td>
                                </tr>
                                <tr>
                                    <td><label for="your_electric_usage_length"> kWh per </label></td>
                                    <td>
                                        <select class="form-control" id="your_electric_usage_length" name="your_electric_usage_length">
                                            <option value="Month"> Month </option>
                                            <option value="Quarter"> Quarter </option>
                                            <option value="Year"> Year </option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <br />
                    <input type="submit" id="form_submit_button" class="big-blue-button" value="Submit" style="width: 100%; padding: 30px 0px;" />
                    <br /><br />
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    
    <script type="text/javascript">
        document.body.onload = function()
        {
            var mainForm = $("#form-main");
            var sections = 
            {
                region_id: $("#region_id"),
                post_data:
                {
                    tariff_2: { },
                    tariff_1: { }
                },
                fuel_type:
                {
                    "error": $("#fuel_type_error"),
                    "radio": $(".fuel_type_radio")
                },
                same_fuel_supplier:
                {
                    "section": $("#section_same_fuel_supplier"),
                    "error": $("#same_fuel_supplier_error"),
                    "radio": $(".same_fuel_supplier_radio"),
                },
                dual_supplier:
                {
                    "section": $("#section_dual_supplier"),
                    "error": $("#dual_supplier_error"),
                    "radio": $(".dual_supplier_radio"),
                    "select": $("#dual_supplier_dropdown")
                },
                gas_supplier:
                {
                    "section": $("#section_gas_supplier"),
                    "error": $("#gas_supplier_error"),
                    "radio": $(".gas_supplier_radio"),
                    "select": $("#gas_supplier_dropdown")
                },
                electric_supplier:
                {
                    "section": $("#section_electric_supplier"),
                    "error": $("#electric_supplier_error"),
                    "radio": $(".electric_supplier_radio"),
                    "select": $("#electric_supplier_dropdown")
                },
                tariff_1:
                {
                    section: $("#section_tariff_1"),
                    payment_method:
                    {
                        "section": $("#section_tariff_1_payment_method"),
                        "error": $("#tariff_1_payment_method_error"),
                        "radio": $(".tariff_1_payment_method_radio")
                    },
                    e7:
                    {
                        "section": $("#section_tariff_1_e7"),
                        "error": $("#tariff_1_e7_error"),
                        "radio": $(".tariff_1_e7_radio")
                    },
                    current_tariff:
                    {
                        "section": $("#section_tariff_1_current_tariff"),
                        "error": $("#tariff_1_current_tariff_error"),
                        "input": $("#tariff_1_current_tariff"),
                        "notListed": $("#tariff_1_current_tariff_not_listed"),
                        "notListed_full": $("#tariff_1_current_tariff_not_listed_label, #tariff_1_current_tariff_not_listed"),
                        "notListed_message": $("#tariff_1_current_tariff_not_listed_message"),
                        "noContent": $("#tariff_1_current_tariff_no_content"),
                        "errorMessage": $("#tariff_1_current_tariff_error_message")
                    }
                },
                tariff_2:
                {
                    section: $("#section_tariff_2"),
                    payment_method:
                    {
                        "section": $("#section_tariff_2_payment_method"),
                        "error": $("#tariff_2_payment_method_error"),
                        "radio": $(".tariff_2_payment_method_radio")
                    },
                    e7:
                    {
                        "section": $("#section_tariff_2_e7"),
                        "error": $("#tariff_2_e7_error"),
                        "radio": $(".tariff_2_e7_radio")
                    },
                    current_tariff:
                    {
                        "section": $("#section_tariff_2_current_tariff"),
                        "error": $("#tariff_2_current_tariff_error"),
                        "input": $("#tariff_2_current_tariff"),
                        "notListed": $("#tariff_2_current_tariff_not_listed"),
                        "notListed_full": $("#tariff_2_current_tariff_not_listed_label, #tariff_2_current_tariff_not_listed"),
                        "notListed_message": $("#tariff_2_current_tariff_not_listed_message"),
                        "noContent": $("#tariff_2_current_tariff_no_content"),
                        "errorMessage": $("#tariff_2_current_tariff_error_message")
                    }
                },
                your_usage:
                {
                    "section": $("#section_your_usage")
                },
                your_gas_usage:
                {
                    "section": $("#section_your_gas_usage"),
                    "kwh_error": $("#your_gas_usage_kwh_error"),
                    "kwh": $("#your_gas_usage_kwh"),
                    "length_error": $("#your_gas_usage_length_error"),
                    "length": $("#your_gas_usage_length")
                },
                your_electric_usage:
                {
                    "section": $("#section_your_electric_usage"),
                    "kwh_error": $("#your_electric_usage_kwh_error"),
                    "kwh": $("#your_electric_usage_kwh"),
                    "length_error": $("#your_electric_usage_length_error"),
                    "length": $("#your_electric_usage_length")
                }
            };


            if (sections.tariff_1.current_tariff.notListed.prop("checked")) sections.tariff_1.current_tariff.notListed_message.show();
            if (sections.tariff_2.current_tariff.notListed.prop("checked")) sections.tariff_2.current_tariff.notListed_message.show();
            
            
            // fuel type
            sections.fuel_type.radio.change(function(e)
            {
                sections.post_data.fuel_type = e.target.value;
                HideSectionsFrom("same_fuel_supplier");
                switch (e.target.value)
                {
                    case "dual":
                        ShowSection("same_fuel_supplier");
                        break;
                    case "gas":
                        ShowSection("gas_supplier");
                        sections.post_data.fuel_char_1 = "G";
                        break;
                    case "electric":
                        ShowSection("electric_supplier");
                        sections.post_data.fuel_char_2 = "E";
                        break;
                }
            });
            
            // same fuel supplier
            sections.same_fuel_supplier.radio.change(function(e)
            {
                sections.post_data.same_fuel_supplier = e.target.value;
                HideSectionsFrom("dual_supplier");
                ShowSection("your_gas_usage");
                ShowSection("your_electric_usage");
                switch (e.target.value)
                {
                    case "yes":
                        ShowSection("dual_supplier");
                        sections.post_data.fuel_char_1 = "D";
                        break;
                    case "no":
                        ShowSection("gas_supplier");
                        sections.post_data.fuel_char_1 = "G";
                        ShowSection("electric_supplier");
                        sections.post_data.fuel_char_2 = "E";
                        break;
                }
            });
            
            
            // dual suppliers
            sections.dual_supplier.radio.change(function(e)
            {
                sections.dual_supplier.select.val(e.target.value);
                dualSupplierChange(e);
            });
            sections.dual_supplier.select.change(function(e)
            {
                sections.dual_supplier.radio.prop("checked", false);
                sections.dual_supplier.radio.filter("[value=" + e.target.value + "]").click();
                sections.dual_supplier.select.focus();
                dualSupplierChange(e);
            });
            function dualSupplierChange(e)
            {
                sections.post_data.supplier_1 = e.target.value;
                GetTariff1PaymentMethods(e.target.value, "D", sections.tariff_1.payment_method.radio);
                ShowSection("tariff_1");
                ShowSection("your_usage");
                GetTariffsForSupplier1();
            }
            
            
            // gas suppliers
            sections.gas_supplier.radio.change(function(e)
            {
                sections.gas_supplier.select.val(e.target.value);
                gasSupplierChange(e);
            });
            sections.gas_supplier.select.change(function(e)
            {
                sections.gas_supplier.radio.prop("checked", false);
                sections.gas_supplier.radio.filter("[value=" + e.target.value + "]").click();
                sections.gas_supplier.select.focus();
                gasSupplierChange(e);
            });
            function gasSupplierChange(e)
            {
                sections.post_data.supplier_1 = e.target.value;
                GetTariff1PaymentMethods(e.target.value, "G", sections.tariff_1.payment_method.radio);
                ShowSection("tariff_1");
                ShowSection("your_usage");
                ShowSection("your_gas_usage");
                GetTariffsForSupplier1();
                
                // HideSectionsFrom("electric_supplier");
                // if (sections.post_data.fuel_type == "dual")
                // {
                //     ShowSection("electric_supplier");
                // }
                // else
                // {
                //     ShowSection("payment_method");
                // }
            }
            

            /// tariff 1 ///
            // payment method
            sections.tariff_1.payment_method.radio.change(function(e)
            {
                sections.post_data.tariff_1.payment_method = e.target.value;
                GetTariffsForSupplier1();
            });
            // e7
            sections.tariff_1.e7.radio.change(function(e)
            {
                sections.post_data.tariff_1.e7 = e.target.value;
                GetTariffsForSupplier1();
            });
            // current tariff
            sections.tariff_1.current_tariff.input.change(function(e)
            {
                sections.post_data.tariff_1.current_tariff = e.target.value;
                sections.tariff_1.current_tariff.notListed.prop("checked", false);
            });
            sections.tariff_1.current_tariff.notListed.change(function(e)
            {
                if (sections.tariff_1.current_tariff.notListed.prop("checked"))
                {
                    sections.tariff_1.current_tariff.notListed_message.show();
                    sections.tariff_1.current_tariff.input.val("");
                }
                else sections.tariff_1.current_tariff.notListed_message.hide();
            });
            

            // electric suppliers
            sections.electric_supplier.radio.change(function(e)
            {
                sections.electric_supplier.select.val(e.target.value);
                electricSupplierChange(e);
            });
            sections.electric_supplier.select.change(function(e)
            {
                sections.electric_supplier.radio.prop("checked", false);
                sections.electric_supplier.radio.filter("[value=" + e.target.value + "]").next().click();
                sections.electric_supplier.select.focus();
                electricSupplierChange(e);
            });
            function electricSupplierChange(e)
            {
                sections.post_data.supplier_2 = e.target.value;
                GetTariff2PaymentMethods(e.target.value, "E", sections.tariff_2.payment_method.radio);
                ShowSection("tariff_2");
                ShowSection("your_usage");
                ShowSection("your_electric_usage");
                GetTariffsForSupplier2();
            }
            

            /// tariff 2 ///
            // payment method
            sections.tariff_2.payment_method.radio.change(function(e)
            {
                sections.post_data.tariff_2.payment_method = e.target.value;
                GetTariffsForSupplier2();
            });
            // e7
            sections.tariff_2.e7.radio.change(function(e)
            {
                sections.post_data.tariff_2.e7 = e.target.value;
                GetTariffsForSupplier2();
            });
            // current tariff
            sections.tariff_2.current_tariff.input.change(function(e)
            {
                sections.post_data.tariff_2.current_tariff = e.target.value;
                sections.tariff_2.current_tariff.notListed.prop("checked", false);
            });
            sections.tariff_2.current_tariff.notListed.change(function(e)
            {
                if (sections.tariff_2.current_tariff.notListed.prop("checked"))
                {
                    sections.tariff_2.current_tariff.input.val("");
                    sections.tariff_2.current_tariff.notListed_message.show();
                }
                else sections.tariff_2.current_tariff.notListed_message.hide();
            });
            

            /// your usage ///
            // gas
            sections.your_gas_usage.kwh.change(function(e)
            {
                sections.post_data.gas_usage_kwh = e.target.value;
            });
            sections.your_gas_usage.length.change(function(e)
            {
                sections.post_data.gas.usage_length = e.target.value;
            });
            // electric
            sections.your_electric_usage.kwh.change(function(e)
            {
                sections.post_data.electric_usage_kwh = e.target.value;
            });
            sections.your_electric_usage.length.change(function(e)
            {
                sections.post_data.electric.usage_length = e.target.value;
            });
            

            function GetTariff1PaymentMethods(supplierId, serviceType, radioItems)
            {
                if (!supplierId) return;
                var url = "{{ route('residential.energy-comparison.api.paymentMethods.by-supplier-id', [ 'supplierId' => 'supplierId', 'serviceType' => 'serviceType' ]) }}";
                url = url.replace('/supplierId', '/' + supplierId);
                url = url.replace('/serviceType', '/' + serviceType);
                SendAjaxRequest(url, function(result, success, xhr)
                {
                    if (xhr != null && xhr.status == 204)
                    {
                        return; // no data returned
                    }
                    
                    try
                    {
                        var result = result;
                        radioItems.filter(":selected").next().hide();
                        for (index in result)
                        {
                            switch (result[index]["id"])
                            {
                                case "MDD":
                                    $(radioItems[0]).next().show();
                                case "QDD":
                                    $(radioItems[1]).next().show();
                                case "CAC":
                                    $(radioItems[2]).next().show();
                                case "PRE":
                                    $(radioItems[3]).next().show();
                                    break;
                            }
                        }
                    }
                    catch (ex)
                    {
                        // an error ocurred processing the request
                    }
                }, function(xhr, status, error)
                {
                    // the request failed
                });
            }
            
            function GetTariff2PaymentMethods(supplierId, serviceType, radioItems)
            {
                if (!supplierId) return;
                var url = "{{ route('residential.energy-comparison.api.paymentMethods.by-supplier-id', [ 'supplierId' => 'supplierId', 'serviceType' => 'serviceType' ]) }}";
                url = url.replace('/supplierId', '/' + supplierId);
                url = url.replace('/serviceType', '/' + serviceType);
                SendAjaxRequest(url, function(result, success, xhr)
                {
                    if (xhr != null && xhr.status == 204)
                    {
                        return; // no data returned
                    }
                    
                    try
                    {
                        var result = result;
                        radioItems.filter(":selected").next().hide();
                        for (index in result)
                        {
                            switch (result[index]["id"])
                            {
                                case "MDD":
                                    $(radioItems[0]).next().show();
                                case "QDD":
                                    $(radioItems[1]).next().show();
                                case "CAC":
                                    $(radioItems[2]).next().show();
                                case "PRE":
                                    $(radioItems[3]).next().show();
                                    break;
                            }
                        }
                    }
                    catch (ex)
                    {
                        // an error ocurred processing the request
                    }
                }, function(xhr, status, error)
                {
                    // the request failed
                });
            }
            
            function GetTariffsForSupplier1()
            {
                var payment_method = sections.tariff_1.payment_method.radio.filter(":checked").val();
                if (!payment_method) return; // payment method is not set
                var e7 = sections.tariff_1.e7.radio.filter(":checked").val();
                if (!e7) return; // payment method is not set

                var url = "{{ route('residential.energy-comparison.api.tariffs.for-a-suppllier', [ 'supplierId' => 'supplierId', 'regionId' => 'regionId', 'serviceType' => 'serviceType', 'paymentMethod' => 'paymentMethod', 'e7' => 'e7' ]) }}";
                url = url.replace('/supplierId', '/' + sections.post_data.supplier_1);
                url = url.replace('/regionId', '/' + sections.region_id.val());
                url = url.replace('/serviceType', '/' + sections.post_data.fuel_char_1);
                url = url.replace('/paymentMethod', '/' + payment_method);
                url = url.replace('/e7', '/' + e7);
                SendAjaxRequest(url, function(results, success, xhr)
                {
                    sections.tariff_1.current_tariff.notListed_message.hide();
                    sections.tariff_1.current_tariff.noContent.hide();
                    sections.tariff_1.current_tariff.errorMessage.hide();
                    sections.tariff_1.current_tariff.notListed_full.show();
                    sections.tariff_1.current_tariff.input.find("option:not(.initial-values)").remove();

                    if (xhr != null && xhr.status == 204)
                    {
                        // no data returned
                        console.log("GetTariffsForSupplier1(): 204: No data was returned");
                        sections.tariff_1.current_tariff.noContent.show();
                        sections.tariff_1.current_tariff.notListed_full.hide();
                        return;
                    }
                    
                    try
                    {
                        results.sort((a, b) => (a.tariffName.localeCompare(b.tariffName, 'en', { numeric: true })));
                        
                        var dropdown = sections.tariff_1.current_tariff.input;
                        for (i in results)
                        {
                            var row = results[i];
                            dropdown.append($("<option value='" + row.tariffId + "'>" + row.tariffName + "</option>"));
                        }
                    }
                    catch (ex)
                    {
                        // an error ocurred processing the request
                        console.log("GetTariffsForSupplier1(): Error: " + ex.message);
                        sections.tariff_1.current_tariff.errorMessage.show();
                        sections.tariff_1.current_tariff.notListed_full.hide();
                    }
                }, function(xhr, status, error)
                {
                    // the request failed
                    console.log("GetTariffsForSupplier1(): Status: " + status);
                    sections.tariff_1.current_tariff.errorMessage.show();
                    sections.tariff_1.current_tariff.notListed_full.hide();
                });
            }
            
            function GetTariffsForSupplier2()
            {
                var payment_method = sections.tariff_2.payment_method.radio.filter(":checked").val();
                if (!payment_method) return; // payment method is not set
                var e7 = sections.tariff_2.e7.radio.filter(":checked").val();
                if (!e7) return; // payment method is not set

                var url = "{{ route('residential.energy-comparison.api.tariffs.for-a-suppllier', [ 'supplierId' => 'supplierId', 'regionId' => 'regionId', 'serviceType' => 'serviceType', 'paymentMethod' => 'paymentMethod', 'e7' => 'e7' ]) }}";
                url = url.replace('/supplierId', '/' + sections.post_data.supplier_2);
                url = url.replace('/regionId', '/' + sections.region_id.val());
                url = url.replace('/serviceType', '/' + sections.post_data.fuel_char_2);
                url = url.replace('/paymentMethod', '/' + payment_method);
                url = url.replace('/e7', '/' + e7);
                SendAjaxRequest(url, function(results, success, xhr)
                {
                    sections.tariff_2.current_tariff.notListed_message.hide();
                    sections.tariff_2.current_tariff.noContent.hide();
                    sections.tariff_2.current_tariff.errorMessage.hide();
                    sections.tariff_2.current_tariff.notListed_full.show();
                    sections.tariff_2.current_tariff.input.find("option:not(.initial-values)").remove();

                    if (xhr != null && xhr.status == 204)
                    {
                        // no data returned
                        console.log("GetTariffsForSupplier2(): 204: No data was returned");
                        sections.tariff_2.current_tariff.noContent.show();
                        sections.tariff_2.current_tariff.notListed_full.hide();
                        return;
                    }
                    
                    try
                    {
                        results.sort((a, b) => (a.tariffName.localeCompare(b.tariffName, 'en', { numeric: true })));
                        
                        var dropdown = sections.tariff_2.current_tariff.input;
                        for (i in results)
                        {
                            var row = results[i];
                            dropdown.append($("<option value='" + row.tariffId + "'>" + row.tariffName + "</option>"));
                        }
                    }
                    catch (ex)
                    {
                        // an error ocurred processing the request
                        console.log("GetTariffsForSupplier2(): Error: " + ex.message);
                        sections.tariff_2.current_tariff.errorMessage.show();
                        sections.tariff_2.current_tariff.notListed_full.hide();
                    }
                }, function(xhr, status, error)
                {
                    // the request failed
                    console.log("GetTariffsForSupplier2(): Status: " + status);
                    sections.tariff_2.current_tariff.errorMessage.show();
                    sections.tariff_2.current_tariff.notListed_full.hide();
                });
            }
            

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" } });

            // var url = "{{ route('residential.energy-comparison.api.addresses', [ 'postcode' => 'postcode' ]) }}";
            // url = url.replace('/postcode', '/' + inputPostcode.val());
            
            function SendAjaxRequest(url, success, error)
            {
                try
                {
                    $.ajax(
                    {
                        type: 'POST',
                        url: url,
                        success: success /*function(result, success, xhr)
                        {
                            if (xhr != null && xhr.status == 204)
                            {
                                // no data returned
                                return xhr.status;
                            }

                            try
                            {
                                // parse the returned json into an object
                                var rows = JSON.parse(result);

                                // sort the rows by the address property
                                rows.sort((a, b) => (a.address.localeCompare(b.address, 'en', { numeric: true })));

                                // empty the dropdown list
                                inputAddressValues.empty();

                                // add each row to the dropdown list
                                for (i in rows)
                                {
                                    inputAddressValues.append($('<option value="' + rows[i].mpan + '">' + rows[i].address + '</option>'));
                                }
                            }
                            catch (ex)
                            {
                                // an error ocurred processing the request
                                return false;
                            }
                        }*/,
                        error: error /* function(xhr, status, error)
                        {
                            // the request failed
                            return false;
                        } */
                    });
                }
                catch (ex)
                {
                    // an error ocurred sending the request
                    return false;
                }

                return true;
            }
            

            // submit button
            mainForm.submit(function(e)
            {
                HideErrors();
                // validation
                var fuel_type = sections.fuel_type.radio.filter(":checked").val();
                var same_fuel_supplier = sections.same_fuel_supplier.radio.filter(":checked").val();
                
                var dual_supplier = sections.dual_supplier.select.val();
                var gas_supplier = sections.gas_supplier.select.val();
                var electric_supplier = sections.electric_supplier.select.val();
                
                var tariff_1_payment_method = sections.tariff_1.payment_method.radio.filter(":checked").val();
                var tariff_1_e7 = sections.tariff_1.e7.radio.filter(":checked").val();
                var tariff_1_current_tariff = sections.tariff_1.current_tariff.input.val();
                var tariff_1_current_tariff_not_listed = sections.tariff_1.current_tariff.notListed.prop("checked");
                
                var tariff_2_payment_method = sections.tariff_2.payment_method.radio.filter(":checked").val();
                var tariff_2_e7 = sections.tariff_2.e7.radio.filter(":checked").val();
                var tariff_2_current_tariff = sections.tariff_2.current_tariff.input.val();
                var tariff_2_current_tariff_not_listed = sections.tariff_2.current_tariff.notListed.prop("checked");
                
                var your_gas_usage_kwh = sections.your_gas_usage.kwh.val();
                var your_gas_usage_length = sections.your_gas_usage.length.val();
                var your_electric_usage_kwh = sections.your_electric_usage.kwh.val();
                var your_electric_usage_length = sections.your_electric_usage.length.val();

                var checkDual = false; var checkGas = false; var checkElectric = false;

                if (!fuel_type) { ShowError("fuel_type", "Please select a fuel type to compare."); e.preventDefault(); return; }
                switch (fuel_type)
                {
                    case "dual":
                        if (!same_fuel_supplier) { ShowError("same_fuel_supplier", "Please select an option."); e.preventDefault(); return; }
                        if (same_fuel_supplier == "yes")
                        {
                            checkDual = true;
                            if (!supplier_1) { ShowError("dual_supplier", "Please select a supplier."); e.preventDefault(); return; }
                        }
                        else
                        {
                            checkGas = true; checkElectric = true;
                            if (!supplier_1) { ShowError("gas_supplier", "Please select a gas supplier."); e.preventDefault(); return; }
                            if (!supplier_2) { ShowError("electric_supplier", "Please selecte an electricity supplier."); e.preventDefault(); return; }
                        }
                        break;
                    case "gas":
                        checkGas = true;
                        if (!supplier_1) { ShowError("gas_supplier", "Please select a gas supplier."); e.preventDefault(); return; }
                        break;
                    case "electric":
                        checkElectric = true;
                        if (!supplier_2) { ShowError("electric_supplier", "Please selecte an electricity supplier."); e.preventDefault(); return; }
                        break;
                }

                if (checkDual || checkGas)
                {
                    if (!tariff_1_payment_method) { ShowErrorSubsection("tariff_1", "payment_method", "Please select a payment method."); e.preventDefault(); return; }
                    if (!tariff_1_e7) { ShowErrorSubsection("tariff_1", "e7", "Please select yes or no."); e.preventDefault(); return; }
                    if (!tariff_1_current_tariff && !tariff_1_current_tariff_not_listed) { ShowErrorSubsection("tariff_1", "current_tariff", "Please select a tariff."); e.preventDefault(); return; }
                }
                if (checkElectric)
                {
                    if (!tariff_2_payment_method) { ShowErrorSubsection("tariff_2", "payment_method", "Please select a payment method."); e.preventDefault(); return; }
                    if (!tariff_2_e7) { ShowErrorSubsection("tariff_2", "e7", "Please select yes or no."); e.preventDefault(); return; }
                    if (!tariff_2_current_tariff && !tariff_2_current_tariff_not_listed) { ShowErrorSubsection("tariff_2", "current_tariff", "Please select a tariff."); e.preventDefault(); return; }
                }
                if (checkDual || checkGas)
                {
                    if (!your_gas_usage_kwh) { sections.your_gas_usage.kwh_error.show().text("Please enter your kwh of gas usage."); e.preventDefault(); return; }
                    if (!your_gas_usage_length) { sections.your_gas_usage.length_error.show().text("Please enter a length of time."); e.preventDefault(); return; }
                }
                if (checkDual || checkElectric)
                {
                    if (!your_electric_usage_kwh) { sections.your_electric_usage.kwh_error.show().text("Please enter your kwh of electricity usage."); e.preventDefault(); return; }
                    if (!your_electric_usage_length) { sections.your_electric_usage.length_error.show().text("Please select a length of time."); e.preventDefault(); return; }
                }
            });
            

            var section_names =
            [
                "same_fuel_supplier",
                "dual_supplier",
                "gas_supplier",
                "tariff_1",
                "electric_supplier",
                "tariff_2",
                "your_usage",
                "your_gas_usage",
                "your_electric_usage",
            ];

            function ShowSection(section)
            {
                var section = sections[section];
                section.section.show();
                if (section.radio) section.radio.prop("checked", false);
            }

            function HideSection(section)
            {
                sections[section].section.hide();
            }

            function HideSectionsFrom(section)
            {
                var found = false;
                for (var index = 0 ; index < section_names.length; index++)
                {
                    if (section_names[index] == section) found = true;
                    if (found)
                    {
                        HideSection(section_names[index]);
                    }
                }
            }


            function ShowError(section, message)
            {
                if (message == null || message == undefined) message = "An error has occured. Please try again later.";
                sections[section].error.show().text(message);
            }
            
            function HideError(section)
            {
                sections[section].error.show().text(message);
            }

            function HideErrors()
            {
                $(".form-error-message").hide();
            }
            
            function ShowErrorSubsection(section, subsection, message)
            {
                if (message == null || message == undefined) message = "An error has occured. Please try again later.";
                sections[section][subsection].error.show().text(message);
            }

            function HideErrorSubsection(section, subsection)
            {
                sections[section][subsection].error.hide();
            }
        };
    </script>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".swiper-container",
        {
            observer: true,
            observeParents: true,
            // loop: true,
            // slideToClickedSlide: true,
            direction: 'horizontal',
            spaceBetween: 30,
            breakpoints:
            {
                0:
                {
                    slidesPerView: 1
                },
                400:
                {
                    slidesPerView: 2
                },
                768:
                {
                    slidesPerView: 3
                },
                1200:
                {
                    slidesPerView: 'auto'
                }
            }
        });
    </script>
@endsection