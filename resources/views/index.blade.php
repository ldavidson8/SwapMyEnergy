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
    </style>
@endsection

@section('before-header')
    <div id="section01" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="row flex-grow-1 no-padding">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12 left-column-content">
                <h1>Empower your business to overcome rising energy prices</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac lectus mi. Etiam vel neque eleifend, maximus est a, pellentesque orci. Sed egestas tortor id lorem vulputate aliquam. Praesent ornare massa vitae velit interdum, eu iaculis magna condimentum. Nam tincidunt diam nisi. Sed in lacus ullamcorper, luctus urna sit amet, accumsan justo. Aliquam pellentesque, nunc et congue ullamcorper, leo odio elementum metus, vitae consequat quam ligula ut lorem. Pellentesque ex nulla, vehicula id quam sed, ultricies elementum diam. Morbi faucibus augue eget purus consequat laoreet. Aliquam erat volutpat. Pellentesque et cursus magna.</p>
            </div>
            <div class="col-xl-6 col-lg-5 col-md-2 d-none d-md-block"></div>
        </div>
        <a id="scroll-down-link" class="d-md-inline d-none" href="#section02"><span></span>How It Works</a>
    </div>
    <hr/>
    <div id="section02" class="full-size-50 container-fluid d-flex flex-column">
        <div class="row flex-grow-1 no-padding" style="background-color: white;">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-4 col-lg-5 col-md-8 col-12 left-column-content align-items-center mobile-only-padding-30" style="text-align: left;">
                <div>
                    <h2> How it works </h2>
                    <p style="padding-top: 15px">Other energy brokers promise false savings based on their estimates, which can fall short of your actual usage, which can result in steep final bills and hassle that you just don't need. Our savings are calculated based on the unit price, which means that a lower unit price plan will result in savings for you or some room for more brews or a new TV to binge-watch Netflix on. </p>
                </div>
            </div>
            <div class="col-2 d-lg-none d-block"></div>
            <div class="col-2 d-lg-none d-block"></div>
            <div class="col-xl-6 col-lg-5 col-md-8 no-padding" style="align-items: center; justify-content: center; margin: auto;">
                <img class="gallery-logo" src="{{ asset('img/bluesquare.png') }}" width="100%" height="200" />
            </div>
            <div class="col-2 col-lg-1 d-block"></div>
        </div>
    </div>
    <div class="full-size-50 container-fluid d-flex flex-column" style="background-color: darkslategrey;">
        <div class="row flex-grow-1 padding-20px">
            <div style="align-items: center; justify-content: center; margin: auto; width: 600px; max-width: 100%;">
                <p style="color: white;">Geoff "saved" £100 on his energy bill with another energy broker only to find out he had hidden fees to pay at the end of the year.</p>
                <p style="font-weight: bold; font-size: 35px; color: white;">Sound familiar?</p>
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
    <div class="d-flex flex-column" style="background-color: darkslategrey; height: 30vw; min-height: 300px;">
        <div class="row flex-grow-1" sytle="align-content: center;">
            <div style="align-items: center; justify-content: center; margin: auto; width: 600px; max-width: 100%;">
                <p style="font-weight: bold; font-size: 30px; color: white;"> Still need Help?</p>
                <a href="{{ route('contact us') }}" class="btn big-blue-button btn-lg" role="button">Contact Us</a>             
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
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