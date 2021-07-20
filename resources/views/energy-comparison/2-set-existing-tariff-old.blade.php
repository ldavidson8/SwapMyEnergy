<?php
    $logo_drag_text = "Drag the logo banner sideways to see more options";
    $dmq = $supplier_data["mprn"] -> dmq;
    
    $old_fuel_type = old('fuel_type');
    $old_same_fuel_supplier = old('same_fuel_supplier');
    $old_dual_supplier_radio = old('dual_supplier_radio');
    $old_gas_supplier_radio = old('gas_supplier_radio');
    $old_tariff_1_payment_method = old('tariff_1_payment_method');
    $old_tariff_1_e7 = old('tariff_1_e7');
    $old_tariff_1_current_tariff = old('tariff_1_current_tariff');
    $old_tariff_1_current_tariff_not_listed = old('tariff_1_current_tariff_not_listed');
    $old_electric_supplier_radio = old('electric_supplier_radio');
    $old_electric_supplier = old('electric_supplier');
    $old_tariff_2_payment_method = old('tariff_2_payment_method');
    $old_tariff_2_e7 = old('tariff_2_e7');
    $old_tariff_2_current_tariff = old('tariff_2_current_tariff');
    $old_tariff_2_current_tariff_not_listed = old('tariff_2_current_tariff_not_listed');
    
    $fuel_type = (isset($old_fuel_type)) ? $old_fuel_type : "";
    $same_fuel_supplier = (isset($old_same_fuel_supplier)) ? $old_same_fuel_supplier : "";
    $dual_supplier_radio = (isset($old_dual_supplier_radio)) ? $old_dual_supplier_radio : "";
    $dual_supplier = (isset($old_dual_supplier)) ? $old_dual_supplier : "";
    $gas_supplier_radio = (isset($old_gas_supplier_radio)) ? $old_gas_supplier_radio : "";
    $gas_supplier = (isset($old_gas_supplier)) ? $old_gas_supplier : "";
    $tariff_1_payment_method = (isset($old_tariff_1_payment_method)) ? $old_tariff_1_payment_method : "";
    $tariff_1_e7 = (isset($old_tariff_1_e7)) ? $old_tariff_1_e7 : "false";
    $tariff_1_current_tariff = (isset($old_tariff_1_current_tariff)) ? $old_tariff_1_current_tariff : "";
    $tariff_1_current_tariff_not_listed = (isset($old_tariff_1_current_tariff_not_listed)) ? $old_tariff_1_current_tariff_not_listed : "";
    $electric_supplier_radio = (isset($old_electric_supplier_radio)) ? $old_electric_supplier_radio : "";
    $electric_supplier = (isset($old_electric_supplier)) ? $old_electric_supplier : "";
    $tariff_2_payment_method = (isset($old_tariff_2_payment_method)) ? $old_tariff_2_payment_method : "";
    $tariff_2_e7 = (isset($old_tariff_2_e7)) ? $old_tariff_2_e7 : "false";
    $tariff_2_current_tariff = (isset($old_tariff_2_current_tariff)) ? $old_tariff_2_current_tariff : "";
    $tariff_2_current_tariff_not_listed = (isset($old_tariff_2_current_tariff_not_listed)) ? $old_tariff_2_current_tariff_not_listed : "";
?>

@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        #outer-container
        {
            padding-bottom: 50px !important;
        }
        
        #form-main
        {
            background-color: rgba(243, 242, 241, 0.35);
            border-radius: 35px;
            border: 2px solid #202020;
            padding: 30px;
            margin: 50px auto auto;
        }
        
        .radio-hidden
        {
            /* opacity: 0;
            width: 0; */
        }

        .form-error-message
        {
            font-size: 20px;
        }

        .question-heading
        {
            padding-bottom: 5px;
            font-size: 28px;
            border-bottom: 1px solid #00c2cb;
            font-weight: bold;
        }
        
        .scroll-text
        {
            float: right;
            font-size: 20px;
            font-weight: normal;
            padding: 6px 0px;
        }

        .question-heading:not(.first-question-heading)
        {
            margin-top: 30px;
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
            /* opacity: 0;
            position: fixed;
            width: 0; */
        }

        .btn-group label
        {
            display: inline-block;
            background-color: #f3f2f1;
            padding: 12px 50px;
            font-size: 24px;
            border: 2px solid #202020;
            border-radius: 22px;
            margin: 15px auto;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 25%;
            display: none;
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
            border-radius: 22px;
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
            border-radius: 22px;
            
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

        .hr-blue-small
        {
            margin: 10px 0px;
        }
        

        #section_your_usage
        {
            background-color: #202020;
            border-radius: 20px;
            padding: 20px;
            color: #f3f2f1;
            margin-top: 30px;
        }

        #section_your_usage .question-heading
        {
            margin-top: 0px;
            font-weight: normal;
        }

        #section_your_gas_usage,
        #section_your_electric_usage,
        #section_your_electric_e7
        {
            margin-bottom: 20px;
        }
        
        #section_your_usage .btn-group label
        {
            width: 100%;
            color: #202020;
        }
        
        .your-usage-label
        {
            font-size: 26px;
            text-transform: capitalize;
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
        <div id="outer-container" class="row flex-grow-1 no-padding background-image-wind-turbines background-image-top background-image-auto background-image-no-mobile" style="color: #202020;">
            <form id="form-main" class="container" action="{{ route('residential.energy-comparison.2-existing-tariff') }}" method="POST" id="energy_form" style="width: 100%;">
                @csrf
                <input type="hidden" id="region_id" name="region_id" value="<?= $supplier_data["region"]["id"] ?>" />
                <div>
                    @if (Session::has('fail') && Session::get('fail') == 'session_expired')
                        {{-- <div class="alert alert-danger post-error">
                            Sorry, your session expired. Please try again.
                        </div> --}}
                    @elseif (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors -> all() as $error)
                                {{ $error }}<br />
                            @endforeach
                        </div>
                    @endif

                    <span id="fuel_type_error" class="form-error-message text-danger"></span>
                    <p class="question-heading first-question-heading">What are you looking to compare?</p>
                    <div class="btn-group btn-group-3 flex-wrap" role="group">
                        <input type="radio" class="radio-hidden fuel_type_radio" name="fuel_type" value="dual" id="fuel_type_radio_dual" {{ ($fuel_type == "dual") ? "checked" : "" }} />
                        <label for="fuel_type_radio_dual">Gas & Electricity </label>
                        <input type="radio" class="radio-hidden fuel_type_radio" name="fuel_type" value="gas" id="fuel_type_radio_gas" {{ ($fuel_type == "gas") ? "checked" : "" }} />
                        <label for="fuel_type_radio_gas"> Gas </label>
                        <input type="radio" class="radio-hidden fuel_type_radio" name="fuel_type" value="electric" id="fuel_type_radio_electric" {{ ($fuel_type == "electric") ? "checked" : "" }} />
                        <label for="fuel_type_radio_electric"> Electricity </label>
                    </div>
                    
                    <div id="section_same_fuel_supplier" style="display: none;">
                        <span id="same_fuel_supplier_error" class="form-error-message text-danger"></span>
                        <p class="question-heading"> Do you have the same supplier for both gas and electricity? </p>
                        <div class="btn-group btn-group-2 flex-wrap" role="group">
                            <input type="radio" class="radio-hidden same_fuel_supplier_radio" name="same_fuel_supplier" id="same_fuel_supplier_radio_yes" value="yes" {{ ($same_fuel_supplier == "yes") ? "checked" : "" }} />
                            <label for="same_fuel_supplier_radio_yes"> Yes </label>
                            <input type="radio" class="radio-hidden same_fuel_supplier_radio" name="same_fuel_supplier" id="same_fuel_supplier_radio_no" value="no" {{ ($same_fuel_supplier == "no") ? "checked" : "" }} />
                            <label for="same_fuel_supplier_radio_no"> No </label>
                        </div>
                    </div>
                </div>
                
                
                {{-- Dual Suppliers --}}
                
                <div id="section_dual_supplier" style="display: none;">
                    <span id="dual_supplier_error" class="form-error-message text-danger"></span>
                    <p class="question-heading p-clear-right-mobile">Who is your current gas/electric supplier?<span class="scroll-text">{{ $logo_drag_text }}</span></p>
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
                                        <input type="radio" class="radio-hidden dual_supplier_radio" name="dual_supplier_radio" value="<?= $main_dual_supplier["id"] ?>" {{ ($dual_supplier_radio == $main_dual_supplier["id"]) ? "selected" : "" }} />
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
                    <select id="dual_supplier_dropdown" name="dual_supplier" value="{{ $dual_supplier }}">
                        <option value=""></option>
                        @foreach ($supplier_data["dual_suppliers"] as $dual_supplier)
                            <option value="{{ $dual_supplier["id"] }}">{{ $dual_supplier["name"] }}</option>
                        @endforeach
                    </select>
                </div>
                
                
                {{-- Gas Suppliers --}}
                
                <div id="section_gas_supplier" style="display: none;">
                    <span id="gas_supplier_error" class="form-error-message text-danger"></span>
                    <p class="question-heading p-clear-right-mobile">Who is your current gas supplier?<span class="scroll-text">{{ $logo_drag_text }}</span></p>
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
                                        <input type="radio" class="radio-hidden gas_supplier_radio" name="gas_supplier_radio" value="<?= $main_gas_supplier["id"] ?>" {{ ($gas_supplier_radio == $main_gas_supplier["id"]) ? "selected" : "" }} />
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
                    <select id="gas_supplier_dropdown" name="gas_supplier" value="{{ $gas_supplier }}">
                        <option value=""></option>
                        @foreach ($supplier_data["gas_suppliers"] as $gas_supplier)
                            <option value="{{ $gas_supplier["id"] }}">{{ $gas_supplier["name"] }}</option>
                        @endforeach
                    </select>
                </div>
                
                
                {{-- Tariff Details 1 --}}

                <div id="section_tariff_1" style="display: none;">
                    <div id="section_tariff_1_payment_method">
                        <span id="tariff_1_payment_method_error" class="form-error-message text-danger"></span>
                        <p class="question-heading"> How do you pay for your energy? </p>
                        <div class="btn-group btn-group-4 flex-wrap" role="group">
                            <input type="radio" class="radio-hidden tariff_1_payment_method_radio" id="tariff_1_payment_method_monthlyDirectDebit" name="tariff_1_payment_method" value="MDD" {{ ($tariff_1_payment_method == "MDD" || $tariff_1_payment_method == "") ? "checked" : "" }} />
                            <label for="tariff_1_payment_method_monthlyDirectDebit"> Monthly Direct Debit </label>
                            <input type="radio" class="radio-hidden tariff_1_payment_method_radio" id="tariff_1_payment_method_quarterlyDirectDebit" name="tariff_1_payment_method" value="QDD" {{ ($tariff_1_payment_method == "QDD") ? "checked" : "" }} />
                            <label for="tariff_1_payment_method_quarterlyDirectDebit"> Quarterly Direct Debit </label>
                            <input type="radio" class="radio-hidden tariff_1_payment_method_radio" id="tariff_1_payment_method_cashCheque" name="tariff_1_payment_method" value="CAC" {{ ($tariff_1_payment_method == "CAC") ? "checked" : "" }} />
                            <label for="tariff_1_payment_method_cashCheque"> Cash / Cheque </label>
                            <input type="radio" class="radio-hidden tariff_1_payment_method_radio" id="tariff_1_payment_method_prepayment" name="tariff_1_payment_method" value="PRE" {{ ($tariff_1_payment_method == "PRE") ? "checked" : "" }} />
                            <label for="tariff_1_payment_method_prepayment"> Prepayment Meter </label>
                        </div>
                    </div>
                    
                    <div id="section_tariff_1_e7" style="display: none;">
                        <span id="tariff_1_e7_error" class="form-error-message text-danger"></span>
                        <p class="question-heading"> Do you have Economy 7? </p>
                        <div class="btn-group btn-group-2 flex-wrap" role="group">
                            <input type="radio" class="radio-hidden tariff_1_e7_radio" id="tariff_1_e7_radio_yes" name="tariff_1_e7" value="true" {{ ($tariff_1_e7 == "true") ? "checked" : "" }} />
                            <label for="tariff_1_e7_radio_yes"> Yes </label>
                            <input type="radio" class="radio-hidden tariff_1_e7_radio" id="tariff_1_e7_radio_no" name="tariff_1_e7" value="false" {{ ($tariff_1_e7 == "false") ? "checked" : "" }} />
                            <label for="tariff_1_e7_radio_no"> No </label>
                        </div>
                    </div>
                    
                    <div id="section_tariff_1_current_tariff">
                        <span id="tariff_1_current_tariff_error" class="form-error-message text-danger"></span>
                        <p class="question-heading">What is the name of your current tariff?</p>
                        <div class="form-group">
                            <select id="tariff_1_current_tariff" name="tariff_1_current_tariff" style="width: 100%; margin-bottom: 10px;" value="{{ $tariff_1_current_tariff }}" >
                                <option class="initial-values" value="" disabled selected hidden></option>
                            </select>
                            <input type="checkbox" id="tariff_1_current_tariff_not_listed" name="tariff_1_current_tariff_not_listed" class="initial-values" value="notListed" {{ ($tariff_1_e7 == "notListed") ? "checked" : "" }} />
                            <label id="tariff_1_current_tariff_not_listed_label" for="tariff_1_current_tariff_not_listed">Not listed/Not sure</label>
                            <br />
                            <p id="tariff_1_current_tariff_not_listed_message" style="display: none;">That's okay. We will compare against your supplier's most popular default tariff to bring you the best deals.</p>
                            <p id="tariff_1_current_tariff_no_content" style="display: none;">Sorry, but we could not find any tariffs from the data you provided. Please check your input above.</p>
                            <p id="tariff_1_current_tariff_error_message" style="display: none;">Sorry, but we could not find any tariffs from the data you provided. Please check your input above.</p>
                            {{-- <p id="tariff_1_current_tariff_error_message" style="display: none;">Sorry, but there was a problem processing your data. Please check your information above, or try again later.</p> --}}
                        </div>
                    </div>
                </div>
                

                {{-- Electric Suppliers --}}
                
                <div id="section_electric_supplier" style="display: none;">
                    <span id="electric_supplier_error" class="form-error-message text-danger"></span>
                    <p class="question-heading"> Who is your current electricity supplier? <span class="scroll-text">{{ $logo_drag_text }}</span></p>
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
                                        <input type="radio" class="radio-hidden electric_supplier_radio" name="electric_supplier_radio" value="<?= $main_electric_supplier["id"] ?>" {{ ($electric_supplier_radio == $main_electric_supplier["id"]) ? "selected" : "" }} />
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
                    <select id="electric_supplier_dropdown" name="electric_supplier" value="{{ $electric_supplier }}">
                        <option value=""></option>
                        @foreach ($supplier_data["electric_suppliers"] as $electric_supplier)
                            <option value="{{ $electric_supplier["id"] }}">{{ $electric_supplier["name"] }}</option>
                        @endforeach
                    </select>
                </div>
                
                
                {{-- Tariff Details 2 --}}

                <div id="section_tariff_2" style="display: none;">
                    <div id="section_tariff_2_payment_method">
                        <span id="tariff_2_payment_method_error" class="form-error-message text-danger"></span>
                        <p class="question-heading"> How do you pay for your energy? </p>
                        <div class="btn-group btn-group-4 flex-wrap" role="group">
                            <input type="radio" class="radio-hidden tariff_2_payment_method_radio" id="tariff_2_payment_method_monthlyDirectDebit" name="tariff_2_payment_method" value="MDD" {{ ($tariff_2_payment_method == "MDD" || $tariff_2_payment_method == "") ? "checked" : "" }} />
                            <label for="tariff_2_payment_method_monthlyDirectDebit"> Monthly Direct Debit </label>
                            <input type="radio" class="radio-hidden tariff_2_payment_method_radio" id="tariff_2_payment_method_quarterlyDirectDebit" name="tariff_2_payment_method" value="QDD" {{ ($tariff_2_payment_method == "QDD") ? "checked" : "" }} />
                            <label for="tariff_2_payment_method_quarterlyDirectDebit"> Quarterly Direct Debit </label>
                            <input type="radio" class="radio-hidden tariff_2_payment_method_radio" id="tariff_2_payment_method_cashCheque" name="tariff_2_payment_method" value="CAC" {{ ($tariff_2_payment_method == "CAC") ? "checked" : "" }} />
                            <label for="tariff_2_payment_method_cashCheque"> Cash / Cheque </label>
                            <input type="radio" class="radio-hidden tariff_2_payment_method_radio" id="tariff_2_payment_method_prepayment" name="tariff_2_payment_method" value="PRE" {{ ($tariff_2_payment_method == "PRE") ? "checked" : "" }} />
                            <label for="tariff_2_payment_method_prepayment"> Prepayment Meter </label>
                        </div>
                    </div>
                    
                    <div id="section_tariff_2_e7">
                        <span id="tariff_2_e7_error" class="form-error-message text-danger"></span>
                        <p class="question-heading"> Do you have Economy 7? </p>
                        <div class="btn-group btn-group-2 flex-wrap" role="group">
                            <input type="radio" class="radio-hidden tariff_2_e7_radio" id="tariff_2_e7_radio_yes" name="tariff_2_e7" value="true" {{ ($tariff_2_e7 == "true") ? "checked" : "" }} />
                            <label for="tariff_2_e7_radio_yes"> Yes </label>
                            <input type="radio" class="radio-hidden tariff_2_e7_radio" id="tariff_2_e7_radio_no" name="tariff_2_e7" value="false" {{ ($tariff_2_e7 == "false") ? "checked" : "" }} />
                            <label for="tariff_2_e7_radio_no"> No </label>
                        </div>
                    </div>
                    
                    <div id="section_tariff_2_current_tariff">
                        <span id="tariff_2_current_tariff_error" class="form-error-message text-danger"></span>
                        <p class="question-heading">What is the name of your current tariff?</p>
                        <div class="form-group">
                            <select id="tariff_2_current_tariff" name="tariff_2_current_tariff" style="width: 100%; margin-bottom: 10px;" value="{{ $tariff_2_current_tariff }}">
                                <option class="initial-values" value="" disabled selected hidden></option>
                            </select>
                            <input type="checkbox" id="tariff_2_current_tariff_not_listed" name="tariff_2_current_tariff_not_listed" class="initial-values" value="notListed" {{ ($tariff_2_current_tariff_not_listed == "notListed") ? "checked" : "" }} />
                            <label id="tariff_2_current_tariff_not_listed_label" for="tariff_2_current_tariff_not_listed">Not listed/Not sure</label>
                            <br />
                            <p id="tariff_2_current_tariff_not_listed_message" style="display: none;">That's okay. We will compare against your supplier's most popular default tariff to bring you the best deals.</p>
                            <p id="tariff_2_current_tariff_no_content" style="display: none;">Sorry, but we could not find any tariffs from the data you provided. Please check your input above.</p>
                            <p id="tariff_2_current_tariff_error_message" style="display: none;">Sorry, but we could not find any tariffs from the data you provided. Please check your input above.</p>
                            {{-- <p id="tariff_2_current_tariff_error_message" style="display: none;">Sorry, but there was a problem processing your data. Please check your information above, or try again later.</p> --}}
                        </div>
                    </div>
                </div>
                
                <div id="section_your_usage" style="display: none;">
                    <p class="question-heading">Your Usage</p>
                    <div id="section_consumption_figures">
                        <div class="row btn-group" style="text-align: center;">
                            <div class="col-12 col-md-6 col-lg-4">
                                <input type="radio" class="radio-hidden consumption_figures_radio" name="consumption_figures" id="consumption_figures_radio_pounds" value="pound" />
                                <label for="consumption_figures_radio_pounds">I Know How Much I Spend</label>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <input type="radio" class="radio-hidden consumption_figures_radio" name="consumption_figures" id="consumption_figures_radio_kwh" value="kwh" checked="true" />
                                <label for="consumption_figures_radio_kwh">I Know How Much I Use</label>
                            </div>
                            <div class="col-3 d-none d-md-block d-lg-none"></div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <input type="radio" class="radio-hidden consumption_figures_radio" name="consumption_figures" id="consumption_figures_radio_estimate" value="estimate" />
                                <label for="consumption_figures_radio_estimate">I Dont Know Either</label>
                            </div>
                            <div class="col-3 d-none d-md-block d-lg-none"></div>
                        </div>
                    </div>
                    <div id="section_your_gas_usage" style="display: none;">
                        <p class="question-heading">Your Gas Usage</p>
                        <div class="row section_your_usage_pound" style="text-align: center; display: none;">
                            <span id="your_gas_usage_pound_error" class="form-error-message text-danger" style="display: block;"></span>
                            <div class="col-12 col-md-6 col-lg-4"><label class="your-usage-label" for="your_gas_usage_pound">Gas spend &pound;</label></div>
                            <div class="col-12 col-md-6 col-lg-4"><input class="form-control" type="number" pattern="[0-9]*" name="your_gas_usage_pound" id="your_gas_usage_pound" style="margin-bottom: 1em;" /></div>
                            <div class="col-6 d-none d-md-block d-lg-none"></div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <select class="form-control" id="your_gas_usage_pound_length" name="your_gas_usage_pound_length"></div>
                                    <option value="Month">Per Month</option>
                                    <option value="Quarter">Per Quarter</option>
                                    <option value="Year" selected>Per Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="row section_your_usage_kwh" style="text-align: center;">
                            <span id="your_gas_usage_kwh_error" class="form-error-message text-danger" style="display: block;"></span>
                            <div class="col-12 col-md-6 col-lg-4"><label class="your-usage-label" for="your_gas_usage_kwh">Gas spend kwh</label></div>
                            <div class="col-12 col-md-6 col-lg-4"><input class="form-control" type="number" pattern="[0-9]*" name="your_gas_usage_kwh" id="your_gas_usage_kwh" style="margin-bottom: 1em;" value="{{ (isset($dmq) && is_numeric($dmq) && $dmq > 0) ? $dmq : "" }}" /></div>
                            <div class="col-6 d-none d-md-block d-lg-none"></div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <select class="form-control" id="your_gas_usage_kwh_length" name="your_gas_usage_kwh_length"></div>
                                    <option value="Month">Per Month</option>
                                    <option value="Quarter">Per Quarter</option>
                                    <option value="Year" selected>Per Year</option>
                                </select>
                            </div>
                            @if (isset($dmq) && is_numeric($dmq) && $dmq > 0)
                                <p>Our systems tell us that your gas usage is {{ $dmq }} kwh per year. If this is wrong, please change the value above.</p>
                            @endif
                        </div>
                        <div class="row btn-group section_your_usage_estimate" style="text-align: center; display: none;">
                            <span id="your_gas_usage_estimate_error" class="form-error-message text-danger" style="display: block;"></span>
                            <div class="col-12 col-md-4">
                                <input type="radio" class="radio-hidden your_gas_usage_estimate_radio" name="your_gas_usage_estimate" id="your_gas_usage_estimate_radio_low" value="8000" />
                                <label for="your_gas_usage_estimate_radio_low">Low</label>
                            </div>
                            <div class="col-12 col-md-4">
                                <input type="radio" class="radio-hidden your_gas_usage_estimate_radio" name="your_gas_usage_estimate" id="your_gas_usage_estimate_radio_medium" value="12000" />
                                <label for="your_gas_usage_estimate_radio_medium">Medium</label>
                            </div>
                            <div class="col-12 col-md-4">
                                <input type="radio" class="radio-hidden your_gas_usage_estimate_radio" name="your_gas_usage_estimate" id="your_gas_usage_estimate_radio_high" value="17000" />
                                <label for="your_gas_usage_estimate_radio_high">High</label>
                            </div>
                        </div>
                    </div>
                    
                    <div id="section_your_electric_usage" style="display: none;">
                        <p class="question-heading">Your Electricity Usage</p>
                        <div class="row section_your_usage_pound" style="text-align: center; display: none;">
                            <span id="your_electric_usage_pound_error" class="form-error-message text-danger" style="display: block;"></span>
                            <div class="col-12 col-md-6 col-lg-4"><label class="your-usage-label" for="your_electric_usage_pound">Electricity spend &pound;</label></div>
                            <div class="col-12 col-md-6 col-lg-4"><input class="form-control" type="number" pattern="[0-9]*" name="your_electric_usage_pound" id="your_electric_usage_pound" style="margin-bottom: 1em;" /></div>
                            <div class="col-6 d-none d-md-block d-lg-none"></div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <select class="form-control" id="your_electric_usage_pound_length" name="your_electric_usage_pound_length"></div>
                                    <option value="Month">Per Month</option>
                                    <option value="Quarter">Per Quarter</option>
                                    <option value="Year" selected>Per Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="row section_your_usage_kwh" style="text-align: center;">
                            <span id="your_electric_usage_kwh_error" class="form-error-message text-danger" style="display: block;"></span>
                            <div class="col-12 col-md-6 col-lg-4"><label class="your-usage-label" for="your_electric_usage_kwh">Electricity spend kwh</label></div>
                            <div class="col-12 col-md-6 col-lg-4"><input class="form-control" type="number" pattern="[0-9]*" name="your_electric_usage_kwh" id="your_electric_usage_kwh" style="margin-bottom: 1em;" /></div>
                            <div class="col-6 d-none d-md-block d-lg-none"></div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <select class="form-control" id="your_electric_usage_kwh_length" name="your_electric_usage_kwh_length"></div>
                                    <option value="Month">Per Month</option>
                                    <option value="Quarter">Per Quarter</option>
                                    <option value="Year" selected>Per Year</option>
                                </select>
                            </div>
                        </div>
                        <span id="your_electric_usage_estimate_error" class="form-error-message text-danger" style="display: block;"></span>
                        <div class="row btn-group section_your_usage_estimate" style="text-align: center; display: none;">
                            <div class="col-12 col-md-4">
                                <input type="radio" class="radio-hidden your_electric_usage_estimate_radio" name="your_electric_usage_estimate" id="your_electric_usage_estimate_radio_low" value="1800" />
                                <label for="your_electric_usage_estimate_radio_low">Low</label>
                            </div>
                            <div class="col-12 col-md-4">
                                <input type="radio" class="radio-hidden your_electric_usage_estimate_radio" name="your_electric_usage_estimate" id="your_electric_usage_estimate_radio_medium" value="2900" />
                                <label for="your_electric_usage_estimate_radio_medium">Medium</label>
                            </div>
                            <div class="col-12 col-md-4">
                                <input type="radio" class="radio-hidden your_electric_usage_estimate_radio" name="your_electric_usage_estimate" id="your_electric_usage_estimate_radio_high" value="4300" />
                                <label for="your_electric_usage_estimate_radio_high">High</label>
                            </div>
                        </div>
                    </div>
                    
                    <div id="section_your_electric_e7" style="display: none;">
                        <p class="question-heading">Your Economy 7 Usage</p>
                        <div style="text-align: center;">
                            <table class="your-usage-table">
                                <tr>
                                    <td></td>
                                    <td><span id="your_electric_e7_error" class="form-error-message text-danger"></span></td>
                                </tr>
                                <tr>
                                    <td><label for="your_electric_e7_input">% Economy 7 Usage</label></td>
                                    <td><input type="number" class="form-control" id="your_electric_e7_input" name="your_electric_e7_input" style="text-align: left;" value="42" min="0" max="99" /></td>
                                </tr>
                                <tr><td colspan="2">Please tell us how much of your energy is used at night. Your bill will detail this on a separate line. Leave the default value if you don't know.</td></tr>
                            </table>
                        </div>
                    </div>
                    
                    <br />
                    <input type="submit" id="form_submit_button" class="big-blue-button" value="Submit" style="width: 100%; padding: 30px 0px;" />
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
                    "section": $("#section_your_usage"),
                    "poundSections": $(".section_your_usage_pound"),
                    "kwhSections": $(".section_your_usage_kwh"),
                    "estimateSections": $(".section_your_usage_estimate")
                },
                consumption_figures:
                {
                    "radio": $(".consumption_figures_radio"),
                    "pound": $("#consumption_figures_radio_pounds"),
                    "kwh": $("#consumption_figures_radio_kwh"),
                    "estimate": $("#consumption_figures_radio_estimate"),
                    sections:
                    {
                        "pound": $(".section_your_usage_pound"),
                        "kwh": $(".section_your_usage_kwh"),
                        "estimate": $(".section_your_usage_estimate")
                    }
                },
                your_gas_usage:
                {
                    "section": $("#section_your_gas_usage"),
                    pound:
                    {
                        "error": $("#your_gas_usage_pound_error"),
                        "pound": $("#your_gas_usage_pound"),
                        "length": $("#your_gas_usage_pound_length")
                    },
                    kwh:
                    {
                        "error": $("#your_gas_usage_kwh_error"),
                        "kwh": $("#your_gas_usage_kwh"),
                        "length": $("#your_gas_usage_kwh_length")
                    },
                    estimate:
                    {
                        "error": $("#your_gas_usage_estimate_error"),
                        "radio": $(".your_gas_usage_estimate_radio"),
                        "radioLow": $("#your_gas_usage_estimate_radio_low"),
                        "radioMedium": $("#your_gas_usage_estimate_radio_medium"),
                        "radioHigh": $("#your_gas_usage_estimate_radio_high")
                    }
                },
                your_electric_usage:
                {
                    "section": $("#section_your_electric_usage"),
                    pound:
                    {
                        "error": $("#your_electric_usage_pound_error"),
                        "pound": $("#your_electric_usage_pound"),
                        "length": $("#your_electric_usage_pound_length")
                    },
                    kwh:
                    {
                        "error": $("#your_electric_usage_kwh_error"),
                        "kwh": $("#your_electric_usage_kwh"),
                        "length": $("#your_electric_usage_kwh_length")
                    },
                    estimate:
                    {
                        "error": $("#your_electric_usage_estimate_error"),
                        "radio": $(".your_electric_usage_estimate_radio"),
                        "radioLow": $("#your_electric_usage_estimate_radio_low"),
                        "radioMedium": $("#your_electric_usage_estimate_radio_medium"),
                        "radioHigh": $("#your_electric_usage_estimate_radio_high")
                    },
                    e7:
                    {
                        "section": $("#section_your_electric_e7"),
                        "error": $("#your_electric_e7_error"),
                        "input": $("#your_electric_e7_input")
                    }
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
                        sections.your_electric_usage.e7.section.hide();
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
                sections.tariff_1.e7.section.show();
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
                sections.tariff_1.e7.section.hide();
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
                
                if (e.target.value == "true" && sections.fuel_type != "gas") sections.your_electric_usage.e7.section.show();
                else sections.your_electric_usage.e7.section.hide();
                
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
                
                if (e.target.value == "true" && sections.fuel_type != "gas") sections.your_electric_usage.e7.section.show();
                else sections.your_electric_usage.e7.section.hide();
                
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

            sections.consumption_figures.radio.change(function(e)
            {
                sections.post_data.consumption_figures = e.target.value;

                switch (e.target.value)
                {
                    case "pound":
                        sections.consumption_figures.sections.pound.show();
                        sections.consumption_figures.sections.kwh.hide();
                        sections.consumption_figures.sections.estimate.hide();
                        break;
                    case "kwh":
                        sections.consumption_figures.sections.pound.hide();
                        sections.consumption_figures.sections.kwh.show();
                        sections.consumption_figures.sections.estimate.hide();
                        break;
                    case "estimate":
                        sections.consumption_figures.sections.pound.hide();
                        sections.consumption_figures.sections.kwh.hide();
                        sections.consumption_figures.sections.estimate.show();
                        break;
                }
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
                if (!e7) e7 = "false";

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
                        dropdown.val("");
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
                if (!e7) e7 = "false";

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
                        dropdown.val("");
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
                        success: success,
                        error: error
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
                
                var consumption_figures = sections.consumption_figures.radio.filter(":checked").val();
                var e7_percent = sections.your_electric_usage.e7.input.val();
                
                var checkDual = false; var checkGas = false; var checkElectric = false;
                
                if (!fuel_type) { ShowError("fuel_type", "Please select a fuel type to compare."); e.preventDefault(); return; }
                switch (fuel_type)
                {
                    case "dual":
                        if (!same_fuel_supplier) { ShowError("same_fuel_supplier", "Please select an option."); e.preventDefault(); return; }
                        if (same_fuel_supplier == "yes")
                        {
                            checkDual = true;
                            if (!dual_supplier) { ShowError("dual_supplier", "Please select a supplier."); e.preventDefault(); return; }
                        }
                        else
                        {
                            checkGas = true; checkElectric = true;
                            if (!gas_supplier) { ShowError("gas_supplier", "Please select a gas supplier."); e.preventDefault(); return; }
                            if (!electric_supplier) { ShowError("electric_supplier", "Please selecte an electricity supplier."); e.preventDefault(); return; }
                        }
                        break;
                    case "gas":
                        checkGas = true;
                        if (!gas_supplier) { ShowError("gas_supplier", "Please select a gas supplier."); e.preventDefault(); return; }
                        break;
                    case "electric":
                        checkElectric = true;
                        if (!electric_supplier) { ShowError("electric_supplier", "Please selecte an electricity supplier."); e.preventDefault(); return; }
                        break;
                }

                if (checkDual || checkGas)
                {
                    if (!tariff_1_payment_method) { ShowErrorSubsection("tariff_1", "payment_method", "Please select a payment method."); e.preventDefault(); return; }
                    if (!tariff_1_current_tariff && !tariff_1_current_tariff_not_listed) { ShowErrorSubsection("tariff_1", "current_tariff", "Please select a tariff."); e.preventDefault(); return; }
                }
                if (checkDual && same_fuel_supplier === "true")
                {
                    if (!tariff_1_e7) { ShowErrorSubsection("tariff_1", "e7", "Please select yes or no."); e.preventDefault(); return; }
                }

                if (checkElectric)
                {
                    if (!tariff_2_payment_method) { ShowErrorSubsection("tariff_2", "payment_method", "Please select a payment method."); e.preventDefault(); return; }
                    if (!tariff_2_e7) { ShowErrorSubsection("tariff_2", "e7", "Please select yes or no."); e.preventDefault(); return; }
                    if (!tariff_2_current_tariff && !tariff_2_current_tariff_not_listed) { ShowErrorSubsection("tariff_2", "current_tariff", "Please select a tariff."); e.preventDefault(); return; }
                }
                
                var your_electric_usage_e7_percent = sections.your_electric_usage.e7.input.val();
                if (!checkGas)
                {
                    if (!your_electric_usage_e7_percent) { sections.your_electric_usage.e7.error.show().text("Please enter a % economy 7 usage. If you are not sure, use the leave it at the average, 42."); e.preventDefault(); return; }
                    if (!isFinite(your_electric_usage_e7_percent) && your_electric_usage_e7_percent < 0 && your_electric_usage_e7_percent > 99) { sections.your_electric_usage.e7.error.show().text("The % economy 7 usage must be a number between 0 and 99."); e.preventDefault(); return; }
                }
                
                switch (consumption_figures)
                {
                    case "pound":
                        if (checkDual || checkGas)
                        {
                            var your_gas_usage = sections.your_gas_usage.pound.pound.val();
                            var your_gas_usage_length = sections.your_gas_usage.pound.length.val();
                            if (!your_gas_usage) { sections.your_gas_usage.pound.error.show().html("Please enter your gas bill in &pound;."); e.preventDefault(); return; }
                            if (!your_gas_usage_length) { sections.your_gas_usage.pound.error.show().text("Please select the term length of your gas bill."); e.preventDefault(); return; }
                        }
                        if (checkDual || checkElectric)
                        {
                            var your_electric_usage = sections.your_electric_usage.pound.pound.val();
                            var your_electric_usage_length = sections.your_electric_usage.pound.length.val();
                            if (!your_electric_usage) { sections.your_electric_usage.pound.error.show().html("Please enter your electricity bill in &pound;."); e.preventDefault(); return; }
                            if (!your_electric_usage_length) { sections.your_electric_usage.pound.error.show().text("Please select the term length of your electricity bill."); e.preventDefault(); return; }
                        }
                        break;
                    case "kwh":
                        if (checkDual || checkGas)
                        {
                            var your_gas_usage = sections.your_gas_usage.kwh.pound.val();
                            var your_gas_usage_length = sections.your_gas_usage.kwh.length.val();
                            if (!your_gas_usage) { sections.your_gas_usage.kwh.error.show().text("Please enter your used gas units."); e.preventDefault(); return; }
                            if (!your_gas_usage_length) { sections.your_gas_usage.kwh.error.show().text("Please select a length of time."); e.preventDefault(); return; }
                        }
                        if (checkDual || checkElectric)
                        {
                            var your_electric_usage = sections.your_electric_usage.kwh.pound.val();
                            var your_electric_usage_length = sections.your_electric_usage.kwh.length.val();
                            if (!your_electric_usage) { sections.your_electric_usage.kwh.error.show().text("Please enter your used electricity units."); e.preventDefault(); return; }
                            if (!your_electric_usage_length) { sections.your_electric_usage.kwh.error.show().text("Please select a length of time."); e.preventDefault(); return; }
                        }
                        break;
                    case "estimate":
                        if (checkDual || checkGas)
                        {
                            var your_gas_usage = sections.your_gas_usage.estimate.radio.filter(":checked").val();
                            if (!your_gas_usage) { sections.your_gas_usage.estimate.error.show().text("Please select an option."); e.preventDefault(); return; }
                        }
                        if (checkDual || checkElectric)
                        {
                            var your_electric_usage = sections.your_electric_usage.estimate.radio.filter(":checked").val();
                            if (!your_electric_usage) { sections.your_electric_usage.estimate.error.show().text("Please select an option."); e.preventDefault(); return; }
                        }
                        break;
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