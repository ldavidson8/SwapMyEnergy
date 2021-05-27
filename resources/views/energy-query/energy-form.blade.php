@extends('layouts.master')

@section('stylesheets')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
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

    #registration_form fieldset:not(:first-of-type) 
    {
    display: none;
    } 

    input[type=button] 
    {
        margin-top: 40px;
    }

    input[type=radio]
    {
        opacity: 0;
        position: fixed;
        width: 0;
    }

    h2
    {
        margin: 10px 0 0 1em;
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
        margin: 30px;
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

    .inline-form label 
    {
        margin: 5px 10px 5px 0;
    }

    .inline-form input 
    {
        vertical-align: middle;
        margin: 5px 10px 5px 0;
        padding: 10px;
        border: 1px solid #ddd;
    }
    
    .inline-form select 
    {
        width: 200px;
    }

    /* Swiperjs stylings */
    .swiper-slide input:checked + img 
    {
        background-color: #00d2db;
    }
    
    .swiper-container 
    {
        width: 90%;
        height: 175px;
        margin: 1em 0 40px 40px;
        /* margin-bottom: 40px;
        margin-top: 1em; */
    }

    .swiper-slide 
    {
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
</style>
@endsection

@section('before-header')
<div style="background-color: #f1f2f3;">
    <div class="full-size container-fluid background-image-preston background-bottom">

@endsection

@section('main-content')
<hr />
    <form action="" method="POST" id="registration_form">
    <fieldset class="col-12 col-lg-4 col-md-6 center-content" style="margin-top: 250px; ">
        <h3 style="font-size: 24px;"> Enter your postcode to begin... </h2>
            <input type="text" style="height: 50px;">
            <button class="square-white-button" style="display: inline-block" type="button">Search</button> 
            <select id="House-number" class="form-control" style="margin-top: 10px; height: 55px;"required>
                <option value="" disabled selected hidden></option>
                <option value="lorem">Lorem</option>
                <option value="ipsum">Ipsum</option>
                <option value="ipsum">Other</option>
            </select>
        <input type="button" name="password" class="next" value="CONTINUE"/>
    </fieldset>

    <fieldset>
        <h2> What are you looking to compare? </h2>
        <div class="btn-group flex-wrap" role="group">
            <input type="radio" class="btn-check" name="gas-electric-radio" id="Gas&Electric" autocomplete="off" checked>
            <label for="Gas&Electric">Gas & Electricity </label>
            <input type="radio" class="btn-check" name="gas-electric-radio" id="Gas" autocomplete="off">
            <label for="Gas"> Gas </label>
            <input type="radio" class="btn-check" name="gas-electric-radio" id="Electric" autocomplete="off">
            <label for="Electric"> Electricity </label>
        </div>
        

        <h2> Do you have the same supplier for both gas and electricity? </h2>
        <div class="btn-group flex-wrap" role="group">
            <input type="radio" class="btn-check" name="yes-no-radio" id="optionYes" autocomplete="off" checked>
            <label for="optionYes"> Yes </label>
            <input type="radio" class="btn-check" name="yes-no-radio" id="optionNo" autocomplete="off">
            <label for="optionNo"> No </label>
        </div>

        <h2> Who is your current gas supplier? </h2>
        <p class="float-right"> Scroll to see more </p>
        <!-- Swiper -->
        <div class="swiper-container mySwiper">
            <div class="swiper-wrapper">    
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="gas-supplier-radio" id="gasSupplierEon" autocomplete="off">
                            <img src="{{ asset('img/supplier-logos/eon.svg') }}"/>
                        </label>
                    </div>
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="gas-supplier-radio" id="gasSupplierBritishGas" autocomplete="off">
                            <img src="{{ asset('img/supplier-logos/british-gas.svg') }}"/>
                        </label>
                    </div>
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="gas-supplier-radio" id="gasSupplierEdf" autocomplete="off">
                            <img src="{{ asset('img/supplier-logos/edf.svg') }}"/>
                        </label>
                    </div>
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="gas-supplier-radio" id="gasSupplierOvo" autocomplete="off">
                            <img src="{{ asset('img/supplier-logos/ovo.svg') }}"/>
                        </label>
                    </div>
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="gas-supplier-radio" id="gasSupplierScottishPower" autocomplete="off">
                            <img src="{{ asset('img/supplier-logos/scottish-power.svg') }}"/>
                        </label>
                    </div>
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="gas-supplier-radio" id="gasSupplierEcotricity" autocomplete="off">
                            <img src="{{ asset('img/supplier-logos/ecotricity.svg') }}" style=""/>
                        </label>
                    </div>
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="gas-supplier-radio" id="gasSupplierSse" autocomplete="off">
                            <img src="{{ asset('img/partner-logos/SSE.png') }}"/>
                        </label>
                    </div>
            </div>
        </div>
      

        <h2> Who is your current electricity supplier? </h2>
        <p class="float-right"> Scroll to see more </p>
        <!-- Swiper -->
        <div class="swiper-container mySwiper">
            <div class="swiper-wrapper">    
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="electric-supplier-radio" id="electricSupplierEon" autocomplete="off">
                            <img src="{{ asset('img/supplier-logos/eon.svg') }}"/>
                        </label>
                    </div>
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="electric-supplier-radio" id="electricSupplierBritishGas" autocomplete="off" >
                            <img src="{{ asset('img/supplier-logos/british-gas.svg') }}"/>
                        </label>
                    </div>
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="electric-supplier-radio" id="electricSupplierEdf" autocomplete="off" >
                            <img src="{{ asset('img/supplier-logos/edf.svg') }}"/>
                        </label>
                    </div>
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="electric-supplier-radio" id="electricSupplierOvo" autocomplete="off" >
                            <img src="{{ asset('img/supplier-logos/ovo.svg') }}"/>
                        </label>
                    </div>
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="electric-supplier-radio" id="electricSupplierScottishPower" autocomplete="off" >
                            <img src="{{ asset('img/supplier-logos/scottish-power.svg') }}"/>
                        </label>
                    </div>
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="electric-supplier-radio" id="electricSupplierEcotricity" autocomplete="off" >
                            <img src="{{ asset('img/supplier-logos/ecotricity.svg') }}"/>
                        </label>
                    </div>
                    <div class="swiper-slide">
                        <label>
                            <input type="radio" class="btn-check" name="electric-supplier-radio" id="electricSupplierSse" autocomplete="off" >
                            <img src="{{ asset('img/partner-logos/SSE.png') }}"/>
                        </label>
                    </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    

        <h2> How do you pay for your energy </h2>
        <div class="btn-group flex-wrap" role="group">
            <input type="radio" class="btn-check" name="paymentMethodRadio" id="monthlyDirectDebit" autocomplete="off" checked>
            <label for="monthlyDirectDebit"> Monthly Direct Debit </label>
            <input type="radio" class="btn-check" name="paymentMethodRadio" id="quarterlyDirectDebit" autocomplete="off">
            <label for="quarterlyDirectDebit"> Quarterly Direct Debit </label>
            <input type="radio" class="btn-check" name="paymentMethodRadio" id="cashCheque" autocomplete="off">
            <label for="cashCheque"> Cash / Cheque </label>
            <input type="radio" class="btn-check" name="paymentMethodRadio" id="prepayment" autocomplete="off">
            <label for="prepayment"> Prepayment Meter </label>
        </div>

        <h2> Do you have Economy7? </h2>
            <div class="btn-group flex-wrap" role="group">
                <input type="radio" class="btn-check" name="Economy7Radio" id="economy7Yes" autocomplete="off" checked>
                <label for="economy7Yes"> Yes </label>
                <input type="radio" class="btn-check" name="Economy7Radio" id="economy7No" autocomplete="off">
                <label for="economy7No"> No </label>
            </div>
        <div class="form-group">
            <label for="currentTariff" style="margin: 10px 0 0 1em; font-weight: 700; font-size: 2rem;">What is the name of your current tariff? </label>
            <select name="currentTariff" id="currentTariff" class="form-control" >
                <option value="" disabled selected hidden></option>
                <option value="Other"> Not listed / Not sure</option>
                <option value="EON">E. ON</option>
                <option value="BritishGas"> British Gas</option>
                <option value="ScottishPower"> Scottish Power</option>
                </select>
        </div>
        <h2 style="margin-bottom: 1em;"> Your Usage </h2>
        <div class="inline-form">
                <label for="usageAmount"> I use </label>
                <input type="number" id="usageAmount" />
                <label for="usageAmountPer"> kWh per </label>
                <select name="usageAmountPer" id="usageAmountPer" class="form-control">
                    <option value="Month"> Month </option>
                    <option value="Quarter"> Quarter </option>
                    <option value="Year"> Year </option>
                </select>
        </div>


    
        <input type="button" name="previous" class="previous btn btn-default" value="Previous" />
        <input type="button" name="submit" class="submit btn btn-success" value="Submit" />
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
    $(".next").click(function(){
      current_step = $(this).parent();
      next_step = $(this).parent().next();
      next_step.show();
      current_step.hide();
    });
    $(".previous").click(function(){
      current_step = $(this).parent();
      next_step = $(this).parent().prev();
      next_step.show();
      current_step.hide();
    });
  });
</script>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", 
    {
    observer: true, 
    observeParents: true,
    slidesPerView: 2,
    spaceBetween: 30,
    loop: true,
    breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 2,
      spaceBetween: 20
    },
    // when window width is >= 480px
    480: {
      slidesPerView: 3,
      spaceBetween: 10
    },
    // when window width is >= 640px
    640: {
      slidesPerView: 4,
      spaceBetween: 20
    },
    // when window width is >= 1024px
    1024: {
        slidesPerView: 7,
        spacebetween: 30
    }
  }
    });
  </script>
@endsection