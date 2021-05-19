@extends('layouts.master')

@section('stylesheets')
    <style>
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
            color: #202020;
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
            border-left: 1px solid #202020;
            border-bottom: 1px solid #202020;
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
        <div class="row flex-grow-1 no-padding background-image-docks">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12 left-column-content">
                <h1>Don't fall victim to rising energy prices</h1>
                <p>Too many energy brokers promise savings that don’t stick. These promises are made on estimates, which aren’t always respective of the energy that you use. At Swap My Energy, we give you savings based on facts, not estimates, providing you with the transparency you deserve when it comes to your bills.</p>
            </div>
            <div class="col-xl-6 col-lg-5 col-md-2 d-none d-md-block">
                <a id="scroll-down-link" class="d-md-inline d-none" href="#HowItWorks"><span></span>How It Works</a>
            </div>
        </div>
    </div>
    <hr/>
    <div id="HowItWorks" class="full-size-50 container-fluid d-flex flex-column">
        <div class="row flex-grow-1 no-padding" style="background-color: #f3f2f1;">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-4 col-lg-5 col-md-8 col-12 left-column-content align-items-center mobile-only-padding-30" style="text-align: left;">
                <div>
                    <h2> How it works </h2>
                    <p style="padding-top: 15px">Other energy brokers promise false savings based on their estimates, which can fall short of your actual usage, which can result in steep final bills and hassle that you just don't need. Our savings are calculated based on the unit price, which means that a lower unit price plan will result in savings for you or some room for more brews or a new TV to binge-watch Netflix on. </p>
                </div>
            </div>
            <div class="col-2 d-lg-none d-block"></div>
            <div class="col-2 d-lg-none d-block"></div>
            <div class="col-xl-6 col-lg-5 col-md-12 center-content text-center">
                <img class="bottom-padding-image-md" src="{{ asset('img/usage-graph.png') }}" style="width: auto; max-width: 100%; height: auto;" />
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
            <div class="col-12 left-column-content-no-padding align-items-center" style="text-align: left;">
                <div class="faq padding-20px">
                    <h2>Frequently Asked Questions</h2>
                    <button class="faq-accordion">How is the service free?</button>
                    <div class="faq-panel">
                        <p>Lorem ipsum...</p>
                    </div>
                    <button class="faq-accordion">Will you always get me a better deal?</button>
                    <div class="faq-panel">
                        <p>Lorem ipsum...</p>
                    </div>

                    <button class="faq-accordion">How will I know when you've switched me?</button>
                    <div class="faq-panel">
                        <p>Lorem ipsum...</p>
                    </div>
                    <button class="faq-accordion">Can i opt-out at any time?</button>
                    <div class="faq-panel">
                        <p>Lorem ipsum...</p>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <div class="d-flex flex-column background-image-preston-behind" style="min-height: 250px; padding-bottom: 10px;">
        <div class="row flex-grow-1 background-image-preston background-image-bottom preload" style="align-content: center;">
            <div class="center-content" style="width: 600px; max-width: 100%; text-align: center">
                <p style="font-weight: bold; font-size: 30px; color: #f3f2f1;"> Still need Help?</p>
                <a href="{{ route('residential.support') }}" class="btn big-blue-button btn-lg" role="button">Contact Us</a>             
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