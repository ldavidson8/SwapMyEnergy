<?php $logo_drag_text = "Drag sideways to see more"; ?>

@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        #form-container
        {
            padding: 50px;
            width: 600px;
            max-width: 100%;
            margin: auto;
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

        .paragraph-margin
        {
            font-size: 28px;
            margin-top: 20px;   
        }
        
        input[type=radio]:checked + img
        {
            background-color: #00d2db;
            border-color: #07adb3;
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
            background-color: #ddd;
            padding: 12px 22px;
            font-size: 24px;
            border: 2px solid #444;
            border-radius: 4px;
            margin: 15px;
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
        
        .inline-form
        {
            display: flex;
            flex-flow: row wrap;
            align-items: center;
        }

        .inline-form input
        {
            vertical-align: middle;
            margin: 5px 20px;
            padding: 10px 5px;
            border: 1px solid #ddd;
        }
        
        .inline-form select
        {
            width: 200px;
            margin-left: 20px;
        }


        .black-text
        {
            color: black;
        }


        /* Swiper stylings */
        .swiper-container
        {
            width: 100vw;
            max-width: 100%;
            height: 160px;
            background-color: #f3f2f1;
            text-align: center;
        }

        .swiper-slide
        {
            max-width: 500px;
            height: auto;
            text-align: center;
            font-size: 18px;
        }

        .swiper-slide.radio-hidden
        {
            /* display: none; */
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

        @media (max-width: 1599px)
        {
            .swiper-container
            {
                height: 10vw;
            }
        }
        
        @media (max-width: 999px)
        {
            .swiper-container
            {
                height: 120px;
            }
        }

        @media (max-width: 400px)
        {
            #form-container
            {
                padding: 0px;
            }
        }
    </style>
@endsection

@section('before-header')
    <div id="requestCallback" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="row flex-grow-1 no-padding background-image-preston" style="color: #f3f2f1;">
            <form action="route('residential.energy-comparison.2-existing-tariff')" method="POST" id="energy_form" style="width: 100%;">
                <div class="container">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors -> all() as $error)
                                {{ $error }}<br />
                            @endforeach
                        </div>
                    @endif

                    <span id="fuel_type_error" class="text-danger"></span>
                    <p class="paragraph-margin"> What are you looking to compare? </p>
                    <div class="btn-group flex-wrap" role="group">
                        <input type="radio" class="radio-hidden fuel_type_radio" name="fuel_type" value="dual" id="fuel_type_radio_dual" value="{{ old('gas-electric-radio') }}" autocomplete="off" />
                        <label class="black-text" for="fuel_type_radio_dual">Gas & Electricity </label>
                        <input type="radio" class="radio-hidden fuel_type_radio" name="fuel_type" value="gas" id="fuel_type_radio_gas" autocomplete="off" />
                        <label class="black-text" for="fuel_type_radio_gas"> Gas </label>
                        <input type="radio" class="radio-hidden fuel_type_radio" name="fuel_type" value="electric" id="fuel_type_radio_electric" autocomplete="off" />
                        <label class="black-text" for="fuel_type_radio_electric"> Electricity </label>
                    </div>
                    
                    <div id="section_same_fuel_supplier" style="display: none;">
                        <span id="same_fuel_supplier_error" class="text-danger"></span>
                        <p class="paragraph-margin"> Do you have the same supplier for both gas and electricity? </p>
                        <div class="btn-group flex-wrap" role="group">
                            <input type="radio" class="radio-hidden same_fuel_supplier_radio" name="same_fuel_supplier" id="same_fuel_supplier_radio_yes" value="yes" autocomplete="off" />
                            <label class="black-text" for="same_fuel_supplier_radio_yes"> Yes </label>
                            <input type="radio" class="radio-hidden same_fuel_supplier_radio" name="same_fuel_supplier" id="same_fuel_supplier_radio_no" value="no" autocomplete="off" />
                            <label class="black-text" for="same_fuel_supplier_radio_no"> No </label>
                        </div>
                    </div>
                </div>
                
                <div id="section_dual_supplier" style="display: none;">
                    <div class="container">
                        <span id="dual_supplier_error" class="text-danger"></span>
                        <p class="paragraph-margin p-clear-right-mobile">Who is your current gas and electric supplier?<span class="scroll-text">{{ $logo_drag_text }}</span></p>
                    </div>
                    <!-- swiper -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($dual_suppliers as $ds)
                                <?php
                                    $image_src = "";
                                    switch ($ds["name"])
                                    {
                                        case "E.ON": $image_src = "eon.svg"; break;
                                        case "British Gas": $image_src = "british-gas.svg"; break;
                                        case "EDF Energy": $image_src = "edf.svg"; break;
                                        case "OVO energy": $image_src = "ovo.svg"; break;
                                        case "ScottishPower": $image_src = "scottish-power.svg"; break;
                                        case "Ecotricity": $image_src = "ecotricity.svg"; break;
                                        case "SSE": $image_src = "SSE.png"; break;
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <label>
                                        <input type="radio" class="radio-hidden dual_supplier_radio" name="dual_supplier_radio" value="<?= $ds["id"] ?>" autocomplete="off">
                                        <div class="img-outer">
                                            <img src='<?= asset("img/supplier-logos/$image_src") ?>' />
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="section_gas_supplier" style="display: none;">
                    <div class="container">
                        <span id="gas_supplier_error" class="text-danger"></span>
                        <p class="paragraph-margin p-clear-right-mobile">Who is your current gas supplier?<span class="scroll-text">{{ $logo_drag_text }}</span></p>
                    </div>
                    <!-- swiper -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($gas_suppliers as $ds)
                                <?php
                                    $image_src = "";
                                    switch ($ds["name"])
                                    {
                                        case "E.ON": $image_src = "eon.svg"; break;
                                        case "British Gas": $image_src = "british-gas.svg"; break;
                                        case "EDF Energy": $image_src = "edf.svg"; break;
                                        case "OVO energy": $image_src = "ovo.svg"; break;
                                        case "ScottishPower": $image_src = "scottish-power.svg"; break;
                                        case "Ecotricity": $image_src = "ecotricity.svg"; break;
                                        case "SSE": $image_src = "SSE.png"; break;
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <label>
                                        <input type="radio" class="radio-hidden gas_supplier_radio" name="gas_supplier_radio" value="<?= $ds["id"] ?>" autocomplete="off">
                                        <div class="img-outer">
                                            <img src='<?= asset("img/supplier-logos/$image_src") ?>' />
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div id="section_electric_supplier" style="display: none;">
                    <div class="container">
                        <span id="electric_supplier_error" class="text-danger"></span>
                        <p class="paragraph-margin"> Who is your current electricity supplier? <span class="scroll-text">{{ $logo_drag_text }}</span></p>
                    </div>
                    <!-- swiper -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($electric_suppliers as $ds)
                                <?php
                                    $image_src = "";
                                    switch ($ds["name"])
                                    {
                                        case "E.ON": $image_src = "eon.svg"; break;
                                        case "British Gas": $image_src = "british-gas.svg"; break;
                                        case "EDF Energy": $image_src = "edf.svg"; break;
                                        case "OVO energy": $image_src = "ovo.svg"; break;
                                        case "ScottishPower": $image_src = "scottish-power.svg"; break;
                                        case "Ecotricity": $image_src = "ecotricity.svg"; break;
                                        case "SSE": $image_src = "SSE.png"; break;
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <label>
                                        <input type="radio" class="radio-hidden electric_supplier_radio" name="electric_supplier_radio" value="<?= $ds["id"] ?>" autocomplete="off">
                                        <div class="img-outer">
                                            <img src="<?= asset("img/supplier-logos/$image_src") ?>"/>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div id="section_payment_method" style="display: none;">
                        <span id="payment_method_error" class="text-danger"></span>
                        <p class="paragraph-margin"> How do you pay for your energy? </p>
                        <div class="btn-group flex-wrap" role="group">
                            <input type="radio" class="radio-hidden payment_method_radio" name="payment_method" id="monthlyDirectDebit" autocomplete="off" />
                            <label class="black-text" for="monthlyDirectDebit"> Monthly Direct Debit </label>
                            <input type="radio" class="radio-hidden payment_method_radio" name="payment_method" id="quarterlyDirectDebit" autocomplete="off" />
                            <label class="black-text" for="quarterlyDirectDebit"> Quarterly Direct Debit </label>
                            <input type="radio" class="radio-hidden payment_method_radio" name="payment_method" id="cashCheque" autocomplete="off" />
                            <label class="black-text" for="cashCheque"> Cash / Cheque </label>
                            <input type="radio" class="radio-hidden payment_method_radio" name="payment_method" id="prepayment" autocomplete="off" />
                            <label class="black-text" for="prepayment"> Prepayment Meter </label>
                        </div>
                    </div>
                    
                    <div id="section_e7" style="display: none;">
                        <span id="e7_error" class="text-danger"></span>
                        <p class="paragraph-margin"> Do you have Economy7? </p>
                        <div class="btn-group flex-wrap" role="group">
                            <input type="radio" class="radio-hidden e7_radio" name="e7" id="e7_radio_yes" autocomplete="off" />
                            <label class="black-text" for="e7_radio_yes"> Yes </label>
                            <input type="radio" class="radio-hidden e7_radio" name="e7" id="e7_radio_no" autocomplete="off" />
                            <label class="black-text" for="e7_radio_no"> No </label>
                        </div>
                    </div>
                    
                    <div id="section_current_tariff" style="display: none;">
                        <span id="current_tariff_error" class="text-danger"></span>
                        <p class="paragraph-margin">What is the name of your current tariff?</p>
                        <div class="form-group">
                            <select name="current_tariff" id="current_tariff" class="form-control" style="width: 250px;" >
                                <option value="" disabled selected hidden></option>
                                <option value="Other"> Not listed / Not sure</option>
                                <option value="EON">E. ON</option>
                                <option value="BritishGas"> British Gas</option>
                                <option value="ScottishPower"> Scottish Power</option>
                            </select>
                        </div>
                    </div>
                    
                    <div id="section_your_usage" style="display: none;">
                        <span id="your_usage_error" class="text-danger"></span>
                        <p class="paragraph-margin"> Your Usage </p>
                        <div class="inline-form">
                            <label for="input_usage_kwh"> I use </label>
                            <input type="number" pattern="[0-9]*" name="usage_kwh" id="input_usage_kwh" />
                            <label for="input_usage_length"> kWh per </label>
                            <select name="usage_length" id="input_usage_length" class="form-control">
                                <option value="Month"> Month </option>
                                <option value="Quarter"> Quarter </option>
                                <option value="Year"> Year </option>
                            </select>
                        </div>
                        <br />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    
    <script type="text/javascript">
        document.body.onload = function()
        {
            var sections = 
            {
                post_data: { },
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
                    "radio": $(".dual_supplier_radio")
                },
                gas_supplier:
                {
                    "section": $("#section_gas_supplier"),
                    "error": $("#gas_supplier_error"),
                    "radio": $(".gas_supplier_radio")
                },
                electric_supplier:
                {
                    "section": $("#section_electric_supplier"),
                    "error": $("#electric_supplier_error"),
                    "radio": $(".electric_supplier_radio")
                },
                payment_method:
                {
                    "section": $("#section_payment_method"),
                    "error": $("#payment_method_error"),
                    "radio": $(".payment_method_radio")
                },
                e7:
                {
                    "section": $("#section_e7"),
                    "error": $("#e7_error"),
                    "radio": $(".e7_radio")
                },
                current_tariff:
                {
                    "section": $("#section_current_tariff"),
                    "error": $("#current_tariff_error"),
                    "input": $("#current_tariff")
                },
                your_usage:
                {
                    "section": $("#section_your_usage"),
                    "error": $("#your_usage_error"),
                    "input_kwh": $("#input_usage_kwh"),
                    "input_length": $("#input_usage_length")
                }
            };
            

            sections.fuel_type.radio.change(function(e)
            {
                sections.post_data.fuel_type = e.target.value;
                HideSectionsFrom("same_fuel_supplier");
                switch (e.target.value)
                {
                    case "dual":
                        ShowSection("same_fuel_supplier")
                        break;
                    case "gas":
                        ShowSection("gas_supplier");
                        break;
                    case "electric":
                        ShowSection("electric_supplier");
                        break;
                }
            });

            sections.same_fuel_supplier.radio.change(function(e)
            {
                sections.post_data.same_fuel_supplier = e.target.value;
                HideSectionsFrom("dual_supplier");
                switch (e.target.value)
                {
                    case "yes":
                        ShowSection("dual_supplier");
                        break;
                    case "no":
                        ShowSection("gas_supplier");
                        break;
                }
            });

            sections.dual_supplier.radio.change(function(e)
            {
                sections.post_data.dual_supplier = e.target.value;
                
                GetPaymentMethods(e.target.value, "D");

                HideSectionsFrom("payment_method");
                ShowSection("payment_method");
            });

            sections.gas_supplier.radio.change(function(e)
            {
                sections.post_data.gas_supplier = e.target.value;
                
                HideSectionsFrom("electric_supplier");
                if (sections.post_data.fuel_type == "dual")
                {
                    ShowSection("electric_supplier");
                }
                else
                {
                    ShowSection("payment_method");
                }
            });

            sections.electric_supplier.radio.change(function(e)
            {
                sections.post_data.electric_supplier = e.target.value;
                HideSectionsFrom("payment_method");
                ShowSection("payment_method");
            });

            sections.payment_method.radio.change(function(e)
            {
                sections.post_data.payment_method = e.target.value;
                HideSectionsFrom("e7");
                ShowSection("e7");
            });

            sections.e7.radio.change(function(e)
            {
                sections.post_data.e7 = e.target.value;
                HideSectionsFrom("current_tariff");
                ShowSection("current_tariff");
            });

            sections.current_tariff.input.change(function(e)
            {
                sections.post_data.current_tariff = e.target.value;
                HideSectionsFrom("your_usage");
                ShowSection("your_usage");
            });


            function GetPaymentMethods(supplierId, serviceType)
            {
                if (!supplierId) return;
                var url = "{{ route('residential.energy-comparison.api.paymentMethods.by-supplier-id', [ 'supplierId' => 'supplierId', 'serviceType' => 'serviceType' ]) }}";
                url = url.replace('/supplierId', '/' + supplierId);
                url = url.replace('/serviceType', '/' + serviceType);
                SendAjaxRequest(url, function(result, success, xhr)
                {
                    if (xhr != null && xhr.status == 204)
                    {
                        // no data returned
                        return;
                    }
                    
                    try
                    {
                        var rows = JSON.parse(result);
                    }
                    catch (ex)
                    {
                        // an error ocurred processing the request
                        return false;
                    }
                }, function(xhr, status, error)
                {
                    // the request failed
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


            function ShowSection(section)
            {
                var section = sections[section]
                section.section.show();
                if (section.radio) section.radio.prop("checked", false);
            }

            function HideSection(section)
            {
                sections[section].section.hide();
            }

            function HideSectionsFrom(section)
            {
                var index = 1000;

                switch (section)
                {
                    case "same_fuel_supplier": index = 2; break;
                    case "dual_supplier": index = 3; break;
                    case "gas_supplier": index = 4; break;
                    case "electric_supplier": index = 5; break;
                    case "payment_method": index = 6; break;
                    case "e7": index = 7; break;
                    case "current_tariff": index = 8; break;
                    case "your_usage": index = 9; break;
                }

                if (index <= 2) HideSection("same_fuel_supplier");
                if (index <= 3) HideSection("dual_supplier");
                if (index <= 4) HideSection("gas_supplier");
                if (index <= 5) HideSection("electric_supplier");
                if (index <= 6) HideSection("payment_method");
                if (index <= 7) HideSection("e7");
                if (index <= 8) HideSection("current_tariff");
                if (index <= 9) HideSection("your_usage");
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
        };
    </script>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".swiper-container",
        {
            slideToClickedSlide: true,
            direction: 'horizontal',
            spaceBetween: 30,
            breakpoints:
            {
                0:
                {
                    slidesPerView: 2
                },
                400:
                {
                    slidesPerView: 3
                },
                900:
                {
                    slidesPerView: 4
                },
                1200:
                {
                    slidesPerView: 5
                },
                1600:
                {
                    slidesPerView: 6
                }
            }
        });
    </script>
@endsection