@extends('layouts.master')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />
<style>
    .scroll-text
    {
        float: right;
        font-size: 20px;
    }

    .radio-hidden
    {
        opacity: 0;
        position: fixed;
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
        padding: 20px 40px;
        font-size: 28px;
        border: 2px solid #444;
        border-radius: 4px;
        margin: 0 30px 30px 30px;
    }

    .btn-group label:first-of-type 
    {
        margin-left: 0; 
    }

    .btn-group label:last-of-type
    {
        margin-right: 0;
    }

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


    /* Swiperjs stylings */
    .swiper-slide input:checked + *
    {
        background-color: #00d2db;
    }
    
    .swiper-container 
    {
        width: 100%;
        height: 190px;
        margin: 1em 0 40px 40px;
    }

    .swiper-slide 
    {
        position: relative;
        text-align: center;
        font-size: 18px;
        background-color: white;

        /* Center slide text vertically */
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

    .swiper-slide img 
    {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .swiper-container 
    {
        margin-left: auto;
        margin-right: auto;
    }

    .check-image-background
    {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
    }

    @media (max-width: 919px)
    {
        .btn-group label 
        {
            display: inline-block;
            background-color: #ddd;
            padding: 30px 50px;
            font-size: 28px;
            border: 2px solid #444;
            border-radius: 4px;
            margin: 0 30px 30px 0px;
        }
    }
</style>
@endsection

@section('before-header')
    <div id="requestCallback" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="row flex-grow-1 no-padding background-image-preston center-content" style="color: #f3f2f1;">
            <form action="" method="POST" id="energy_form">
                <p class="paragraph-margin"> What are you looking to compare? </p>
                <div class="btn-group flex-wrap" role="group">
                    <input type="radio" class="radio-hidden" name="fuel_type" id="fuel_type_both" value="{{ old('gas-electric-radio') }}" autocomplete="off" checked />
                    <label for="Gas&fuel_type_both">Gas & Electricity </label>
                    <input type="radio" class="radio-hidden" name="fuel_type" id="fuel_type_gas" autocomplete="off" />
                    <label for="fuel_type_gas"> Gas </label>
                    <input type="radio" class="radio-hidden" name="fuel_type" id="fuel_type_electric" autocomplete="off" />
                    <label for="fuel_type_electric"> Electricity </label>
                </div>
                

                <p class="paragraph-margin"> Do you have the same supplier for both gas and electricity? </p>
                <div class="btn-group flex-wrap" role="group">
                    <input type="radio" class="radio-hidden" name="yes-no-radio" id="optionYes" autocomplete="off" checked>
                    <label for="optionYes"> Yes </label>
                    <input type="radio" class="radio-hidden" name="yes-no-radio" id="optionNo" autocomplete="off">
                    <label for="optionNo"> No </label>
                </div>

                <p class="paragraph-margin p-clear-right-mobile"> Who is your current gas supplier? <span class="scroll-text"> Scroll to see more </span></p>
                <!-- Swiper -->
                <div class="swiper-container mySwiper">
                    <div class="swiper-wrapper">    
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="gas-supplier-radio" value="eon" id="gasSupplierEon" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/supplier-logos/eon.svg') }}"/>
                                    </div>
                                </label>
                            </div>
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="gas-supplier-radio" value="british gas" id="gasSupplierBritishGas" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/supplier-logos/british-gas.svg') }}"/>
                                    </div>
                                </label>
                            </div>
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="gas-supplier-radio" value="edf" id="gasSupplierEdf" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/supplier-logos/edf.svg') }}"/>
                                    </div>
                                </label>
                            </div>
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="gas-supplier-radio" value="ovo" id="gasSupplierOvo" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/supplier-logos/ovo.svg') }}"/>
                                    </div>
                                </label>
                            </div>
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="gas-supplier-radio" value="scottish power" id="gasSupplierScottishPower" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/supplier-logos/scottish-power.svg') }}"/>
                                    </div>
                                </label>
                            </div>
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="gas-supplier-radio" value="ecotricity" id="gasSupplierEcotricity" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/supplier-logos/ecotricity.svg') }}"/>
                                    </div>
                                </label>
                            </div>
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="gas-supplier-radio" value="sse" id="gasSupplierSSE" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/partner-logos/SSE.png') }}"/>
                                    </div>
                                </label>
                            </div>
                    </div>
                </div>
            

                <p class="paragraph-margin"> Who is your current electricity supplier? <span class="scroll-text"> Scroll to see more </span></p>
                <!-- Swiper -->
                <div class="swiper-container mySwiper">
                    <div class="swiper-wrapper">    
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="electric-supplier-radio" id="electricSupplierEon" value="eon" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/supplier-logos/eon.svg') }}"/>
                                    </div>
                                </label>
                            </div>
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="electric-supplier-radio" id="electricSupplierBritishGas" value="british gas" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/supplier-logos/british-gas.svg') }}"/>
                                    </div>
                                </label>
                            </div>
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="electric-supplier-radio" id="electricSupplierEdf" value="edf" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/supplier-logos/edf.svg') }}"/>
                                    </div>
                                </label>
                            </div>
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="electric-supplier-radio" id="electricSupplierOvo" value="ovo" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/supplier-logos/ovo.svg') }}"/>
                                    </div>
                                </label>
                            </div>
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="electric-supplier-radio" id="electricSupplierScottishPower" value="scottish power" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/supplier-logos/scottish-power.svg') }}"/>
                                    </div>
                                </label>
                            </div>
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="electric-supplier-radio" id="electricSupplierEcotricity" value="ecotricity" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/supplier-logos/ecotricity.svg') }}"/>
                                    </div>
                                </label>
                            </div>
                            <div class="swiper-slide">
                                <label>
                                    <input type="radio" class="radio-hidden" name="electric-supplier-radio" id="electricSupplierSse" value="sse" autocomplete="off">
                                    <div class="check-image-background">
                                        <img src="{{ asset('img/partner-logos/SSE.png') }}"/>
                                    </div>
                                </label>
                            </div>
                    </div>
                </div>
            

                <p class="paragraph-margin"> How do you pay for your energy? </p>
                <div class="btn-group flex-wrap" role="group">
                    <input type="radio" class="radio-hidden" name="paymentMethodRadio" id="monthlyDirectDebit" autocomplete="off" checked>
                    <label for="monthlyDirectDebit"> Monthly Direct Debit </label>
                    <input type="radio" class="radio-hidden" name="paymentMethodRadio" id="quarterlyDirectDebit" autocomplete="off">
                    <label for="quarterlyDirectDebit"> Quarterly Direct Debit </label>
                    <input type="radio" class="radio-hidden" name="paymentMethodRadio" id="cashCheque" autocomplete="off">
                    <label for="cashCheque"> Cash / Cheque </label>
                    <input type="radio" class="radio-hidden" name="paymentMethodRadio" id="prepayment" autocomplete="off">
                    <label for="prepayment"> Prepayment Meter </label>
                </div>

                <p class="paragraph-margin"> Do you have Economy7? </p>
                    <div class="btn-group flex-wrap" role="group">
                        <input type="radio" class="radio-hidden" name="Economy7Radio" id="economy7Yes" autocomplete="off" checked>
                        <label for="economy7Yes"> Yes </label>
                        <input type="radio" class="radio-hidden" name="Economy7Radio" id="economy7No" autocomplete="off">
                        <label for="economy7No"> No </label>
                    </div>
                <div class="form-group">
                    <label for="currentTariff" style="font-weight: 700; font-size: 28px">What is the name of your current tariff? </label>
                    <select name="currentTariff" id="currentTariff" class="form-control" style="width: 250px;" >
                        <option value="" disabled selected hidden></option>
                        <option value="Other"> Not listed / Not sure</option>
                        <option value="EON">E. ON</option>
                        <option value="BritishGas"> British Gas</option>
                        <option value="ScottishPower"> Scottish Power</option>
                        </select>
                </div>
                <p class="paragraph-margin"> Your Usage </p>
                <div class="inline-form">
                    <label for="usageAmount"> I use </label>
                    <input type="number" pattern="[0-9]*" id="usageAmount" />
                    <label for="usageAmountPer"> kWh per </label>
                    <select name="usageAmountPer" id="usageAmountPer" class="form-control">
                        <option value="Month"> Month </option>
                        <option value="Quarter"> Quarter </option>
                        <option value="Year"> Year </option>
                    </select>
                </div>
            </form>
        </div>
@endsection

@section('after-footer')
    </div>
@endsection

@section('script')
    
    <script type="text/javascript">
        document.body.onload = function()
        {
            var postcodeError = $("#postcode_error");
            var inputPostcode = $("#postcode");
            var btnPostcodeSearch = $("#btn_postcode_search");

            var addressSection = $("#form_address_fields");
            var inputAddress = $("#address");
            var inputAddressValues = $("#address_values");
            
            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            btnPostcodeSearch.click(function()
            {
                HidePostcodeError();
                
                if (inputPostcode.val() == "")
                {
                    ShowPostcodeError('The postcode field is required.');
                    HideAddressSection();
                    return;
                }

                try
                {
                    var url = "{{ route('residential.energy-comparison.api.addresses', [ 'postcode' => 'postcode' ]) }}";
                    url = url.replace('/postcode', '/' + inputPostcode.val());
                    $.ajax(
                    {
                        type: 'POST',
                        url: url,
                        success: function(result, success, xhr)
                        {
                            // if nothing is returned
                            if (xhr != null && xhr.status == 204)
                            {
                                ShowPostcodeError('That postcode is invalid.')
                                HideAddressSection();
                                return;
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

                                ShowAddressSection();
                            }
                            catch (ex)
                            {
                                ShowPostcodeError()
                                HideAddressSection();
                            }
                        },
                        error: function(xhr, status, error)
                        {
                            ShowPostcodeError()
                            HideAddressSection();
                        }
                    });
                }
                catch (ex)
                {
                    ShowPostcodeError()
                    HideAddressSection();
                }
            });


            function ShowAddressSection()
            {
                addressSection.show();
            }

            function HideAddressSection()
            {
                addressSection.hide();
            }

            function ShowPostcodeError(message)
            {
                if (message == null || message == undefined) message = "An error has occured. Please try again later.";
                postcodeError.show().text(message);
            }

            function HidePostcodeError()
            {
                postcodeError.hide().text('');
            }
        };
    </script>

    <!-- Swiper JS -->
    <script type="text/javascript" src="{{ URL::asset('js/swiper-bundle.min.js') }}"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", 
        {
            observer: true, 
            observeParents: true,
            slidesPerView: 2,
            spaceBetween: 30,
            loop: true,
            breakpoints:
            {
                // when window width is >= 320px
                320:
                {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                // when window width is >= 480px
                480:
                {
                    slidesPerView: 3,
                    spaceBetween: 10
                },
                // when window width is >= 640px
                640:
                {
                    slidesPerView: 4,
                    spaceBetween: 20
                },
                // when window width is >= 1024px
                1024:
                {
                    slidesPerView: 7,
                    spacebetween: 30
                }
            }
        });
    </script>
@endsection