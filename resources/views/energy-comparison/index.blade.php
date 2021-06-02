@extends('layouts.master')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />
<style>
    .square-white-button
    {
            width: 150px;
            font-size: 27px;
            padding: 5px;
            font-weight: bold;
            border: none;
            display: inline-block;
            background-color: #f1f2f3;
    }

    .form-padding-50
    {
        padding: 50px;
    }

    #registration_form fieldset:not(:first-of-type) 
    {
        display: none;
    } 

    .button-margin-top
    {
        margin-top: 40px;
    }

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

    .submit
    {
        width: 250px;
        padding: 10px;
        font-weight: bold;
    }

    .next
    {
        width: 250px;
        padding: 10px;
        font-weight: bold;
    }
    .previous
    {
        width: 250px;
        padding: 10px;
        font-weight: bold;
    }

    input[type=radio]:checked  + img
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

    /* .inline-form label 
    {
        margin: 5px 10px;
    } */

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
    @media (max-width: 400px)
    {
        .form-mobile-no-padding
        {
            padding: 0px;
        }
    }
</style>
@endsection

@section('before-header')
<div style="background-color: #f1f2f3;">
    <div class="full-size container-fluid background-image-preston background-bottom">

@endsection

@section('main-content')
<hr />
    <form action="" method="POST" id="registration_form" class="form-padding-50 form-mobile-no-padding">
        <fieldset class="col-12 col-lg-4 col-md-6 center-content" style="margin-top: 250px; ">
            <label style="font-size: 24px;"> Enter your postcode to begin... 
                <input type="text" class="form-control" style="height: 50px;">
            </label>
                <button class="square-white-button" style="display: inline-block" type="button">Search</button> 
                <select id="House-number" class="form-control" style="margin-top: 10px; height: 55px;"required>
                    <option value="" disabled selected hidden></option>
                    <option value="lorem">Lorem</option>
                    <option value="ipsum">Ipsum</option>
                    <option value="ipsum">Other</option>
                </select>
            <input type="button" name="password" class="next button-margin-top" value="CONTINUE"/>
        </fieldset>

        <fieldset class="col-sm-12">
            <p class="paragraph-margin"> What are you looking to compare? </p>
            <div class="btn-group flex-wrap" role="group">
                <input type="radio" class="radio-hidden" name="gas-electric-radio" id="Gas&Electric" autocomplete="off" checked>
                <label for="Gas&Electric">Gas & Electricity </label>
                <input type="radio" class="radio-hidden" name="gas-electric-radio" id="Gas" autocomplete="off">
                <label for="Gas"> Gas </label>
                <input type="radio" class="radio-hidden" name="gas-electric-radio" id="Electric" autocomplete="off">
                <label for="Electric"> Electricity </label>
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


        
            <input type="button" name="previous" class="previous btn btn-default button-margin-top" value="Previous" />
            <input type="submit" name="submit" class="submit btn btn-success button-margin-top" value="Submit" />
        </fieldset>
    </form>
    </div>
</div>

@endsection 

@section('script')
<script>
$(document).ready(function(){
    var current = 1,current_step,next_step,steps;
    steps = $("fieldset").length;
    $(".next").click(function()
    {
      current_step = $(this).parent();
      next_step = $(this).parent().next();
      next_step.show();
      current_step.hide();
    });
    $(".previous").click(function()
    {
      current_step = $(this).parent();
      next_step = $(this).parent().prev();
      next_step.show();
      current_step.hide();
    });
  });
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