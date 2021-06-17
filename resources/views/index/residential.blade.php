@extends('layouts.master')

@section('stylesheets')
    <style>
        .white-box-infographics
        {
            align-items: center;
            justify-content: center;
            margin: auto;
            height: auto;
            padding: 20px 0;
        }

        .white-box-infographics-inner
        {
            background-color: white;;
            border-radius: 20px;
            width: 325px;
            height: 425px;
            padding: 20px;
            margin: auto;
            max-width: 100%;
        }

        .infographics-header
        {
            margin-top: 50px;
            font-size: 26px;
            font-weight: 700;
        }
        #section01
        {
            position: relative;
        }

        #scroll-down-link
        {
            position: absolute;
            bottom: 80px;
            left: 50%;
            z-index: 2;
            display: inline-block;
            -webkit-transform: translateX(0, -50%);
            transform: translateX(-50%);
            color: #f3f2f1;
            font: normal 400 20px/1 'Josefin Sans', sans-serif;
            letter-spacing: .1em;
            text-decoration: none;
            opacity: 0.8;
            transition: opacity 0.3s;
        }
        #scroll-down-link:hover
        {
            opacity: 0.5;
        }
        #section01 #scroll-down-link
        {
            padding-top: 70px;
        }
        #section01 #scroll-down-link span
        {
            position: absolute;
            top: 80px;
            left: 50%;
            width: 24px;
            height: 24px;
            margin-left: -12px;
            border-left: 1px solid #f3f2f1;
            border-bottom: 1px solid #f3f2f1;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            -webkit-animation: sdb05 3s infinite;
            animation: sdb05 3s infinite;
            box-sizing: border-box;
        }

        @-webkit-keyframes sdb05
        {
            0%
            {
                -webkit-transform: rotate(-45deg) translate(0, 0);
                opacity: 0;
            }
            50%
            {
                opacity: 1;
            }
            100%
            {
                -webkit-transform: rotate(-45deg) translate(-20px, 20px);
                opacity: 0;
            }
        }
        @keyframes sdb05
        {
            0%
            {
                transform: rotate(-45deg) translate(0, 0);
                opacity: 0;
            }
            50%
            {
                opacity: 1;
            }
            100%
            {
                transform: rotate(-45deg) translate(-20px, 20px);
                opacity: 0;
            }
        }

        @media (max-width: 991px)
        {
            .bottom-padding-image-md
            {
                padding-bottom: 30px !important;
            }
        }
    </style>
@endsection

@section('before-header')
    <div id="section01" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="row flex-grow-1 no-padding background-image-wind-turbines">
            <div class="col-xl-2 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-3 col-lg-6 col-md-8 col-12 center-content">
                <h1>Don't fall victim to rising energy prices</h1>
                <p>Too many energy brokers promise savings that don’t stick. These promises are made on estimates, which aren’t always respective of the energy that you use. At Swap My Energy, we give you savings based on facts, not estimates, providing you with the transparency you deserve when it comes to your bills.</p>
                <a href="{{ route('residential.energy-comparison.1-address') }}" class="btn big-blue-button" role="button" style="margin-top: 10px;">Get started</a>
            </div>
            <div class="col-xl-7 col-lg-5 col-md-2 d-none d-md-block">
                <a id="scroll-down-link" class="d-md-inline d-none" href="#HowItWorks"><span></span>How It Works</a>
            </div>
        </div>
    </div>
    <hr/>
    <div class="full-size-80 container-fluid d-flex h-100 flex-column background-image-preston">
        <div class="row flex-grow-1 font-color-white">
            <div class="col-12 col-lg-4 col-md-6 white-box-infographics" style="text-align: center;">
                <div class="white-box-infographics-inner">
                    <div style="text-align: center;">
                        <img src="{{ asset('img/infographic icons/signed-form.svg') }}"/>
                        <p class="infographics-header"> Fill in our form </p>
                        <p> Our form is easy to understand and will help you get the best deals available to you </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 white-box-infographics">
                <div class="white-box-infographics-inner">
                    <div style="text-align: center;">
                        <img src="{{ asset('img/infographic icons/search-icon.svg') }}"/>
                        <p class="infographics-header"> Browse our deals </p>
                        <p> You'll have all the best deals presented to you, allowing you to easily understand which deal best suits you.  </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-lg-none"></div>
            <div class="col-12 col-lg-4 col-md-6 white-box-infographics">
                <div class="white-box-infographics-inner">
                    <div style="text-align: center;">
                        <img src="{{ asset('img/infographic icons/switch-icon.svg') }}"/>
                        <p class="infographics-header"> Get switching </p>
                        <p> Once you're sure that you got the best deal for you, toggle the switch and leave the rest up to us. </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-lg-none"></div>
        </div>
    </div>
    <div id="HowItWorks" class="full-size-50 container-fluid d-flex flex-column">
        <div class="row flex-grow-1 no-padding" style="background-color: #f3f2f1;">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-4 col-lg-5 col-md-8 col-12 left-column-content align-items-center mobile-only-padding-30" style="text-align: left;">
                <div>
                    <h2 style="font-size: 44px"> How it works </h2>
                    <p style="padding-top: 15px">Other energy brokers promise false savings based on their estimates, which can fall short of your actual usage, which can result in steep final bills and hassle that you just don't need. Our savings are calculated based on the unit price, which means that a lower unit price plan will result in savings for you or some room for more brews or a new TV to binge-watch Netflix on. </p>
                </div>
            </div>
            <div class="col-2 d-lg-none d-block"></div>
            <div class="col-2 d-lg-none d-block"></div>
            <div class="col-xl-6 col-lg-5 col-md-12 center-content text-center">
                <img class="bottom-padding-image-md" src="{{ asset('img/How-it-works-graph.png') }}" style="width: auto; max-width: 100%; height: auto;" alt="Graph comparing your actual energy usage to the estimated usage from other energy brokers" />
            </div>
            <div class="col-2 col-lg-1 col-md-2 d-block"></div>
        </div>
    </div>
    <div class="full-size-50 container-fluid d-flex flex-column background-image-preston-behind">
        <div class="row flex-grow-1 padding-20px background-image-preston background-image-bottom preload center-content">
            <div class="align-items-center" style="width: 600px; max-width: 100%; text-align: center;">
                <p style="color: #f3f2f1;">Geoff "saved" £100 on his energy bill with another energy broker only to find out he had hidden fees to pay at the end of the year.</p>
                <p style="font-weight: bold; font-size: 35px; color: #f3f2f1;">Sound familiar?</p>
            </div>
        </div>
    </div>
    <div class="container-fluid d-flex flex-column">
        <div class="row flex-grow-1 no-padding">
            <div class="col-12 align-items-center" style="padding: 0 50px;">
                <div class="faq padding-20px">
                    <h2 style="text-align: center;">Frequently Asked Questions</h2>
                    <button class="faq-accordion">Why choose Swap My Energy?</button>
                    <div class="faq-panel">
                        <p>Swap My Energy are dedicated to making switching simple. We allow you to see as much information regarding the deals available to you as possible, allowing you to gain a full understanding on why the prices are the way they are.</p>
                    </div>
                    <button class="faq-accordion">How long does it take to switch?</button>
                    <div class="faq-panel">
                        <p>Once you've decided to switch, your information will be provided to the supplier of your choice and your switching will be underway. Typically, suppliers take around 2 weeks to switch you over, this is because you have the option within the 2 weeks to stop switching.</p>
                    </div>

                    <button class="faq-accordion">Why do you need my suppliers name and my current usage?</button>
                    <div class="faq-panel">
                        <p>This helps us understand the deal you were on and to help calculate the prices of the deals based on your current usage.</p>
                    </div>
                    <button class="faq-accordion">Will you always get me a better deal?</button>
                    <div class="faq-panel">
                        <p>No. Some other energy switching companies will promise you a better deal, by "estimating" your usage for the next year. We let you know your unit price and standing charges, allowing you to understand how much it costs you per kW. Our aim to get you a better deal based on unit price and standing charges, meaning that if you get lower prices on these, then you'll end up paying less (assuming that your usage is the same). <br /> This works in a similar way to when you're putting fuel in your car. If one week you buy 50L of fuel at £1.35 per litre and then the next week at £1.25 per litre, you'll save money. But if you buy 75L of fuel at £1.25 instead, you'll end up spending more</p>
                    </div>
                    <button class="faq-accordion">Can I opt-out of switching?</button>
                    <div class="faq-panel">
                        <p>Yes you can. From initially agreeing to switch, you have up to 2 weeks to opt-out.</p>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection

@section('script')
<script defer="true">
    var faqAccordian = document.getElementsByClassName("faq-accordion");
    var i;

    for (i = 0; i < faqAccordian.length; i++)
    {
        faqAccordian[i].addEventListener("click", function()
        {
            this.classList.toggle("faq-active");
            var faqPanel = this.nextElementSibling;
            if (faqPanel.style.maxHeight)
            {
                faqPanel.style.maxHeight = null;
            }
            else
            {
                faqPanel.style.maxHeight = faqPanel.scrollHeight + "px";
            }
        });
    }
</script>
@endsection