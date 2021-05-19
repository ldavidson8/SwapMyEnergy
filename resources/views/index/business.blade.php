@extends('layouts.master')

@section('stylesheets')
    <style>
        .larger-form
        {
            display:inline-block;
            padding: 25px 15px;
            line-height: 130%;
        }

        .upload-btn-wrapper
        {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .upload-btn-wrapper input[type=file]
        {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
        }

        .upload-btn-wrapper label
        {
            margin-bottom: 0px;
        }

        .upload-btn 
        {
            width: 250px;
            border-radius: 12px;
            padding: 10px;
            font-size: 27px;
            font-weight: bold;
        }


        .logos-container
        {
            padding: 0;
            margin: 0;
            list-style: none;
            text-align: center;
            min-height: 300px;
            display: inline;
        }

        .logos-item-outer
        {
            width: 200px;
            height: 100px;
            max-width: 100%;
            text-align: center;
            display: inline-block;
            margin: 20px;
        }

        .logos-item
        {
            max-height: 100%;
            margin: auto;
            width: auto;
            max-width: 100%;
        }


        @media (max-width: 767px)
        {
            .background-image-non-moblie { background-color: #f3f2f1; }
            .background-image-non-moblie::before { background-image: none !important; }
        }

        @media (max-width: 500px)
        {
            .border-bottom-sm
            {
                border-bottom: 3px solid #202020;
            }
        }
    </style>
@endsection

@section('before-header')
    <div id="section01" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="row flex-grow-1 no-padding background-image-preston background-image-non-moblie border-bottom-sm align-items-center">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12 left-column-content">
                <h1>Empower your business to overcome rising energy prices</h1>
                <p>Your business is important to you, so let us help
                    you find a better energy deal for your business.</p>
                <div class="upload-btn-wrapper">
                    <label for="bills-upload"><button class="big-blue-button"> Upload your bills </button></label>
                    <input type="file" id="bills-upload" name="bills-upload" />
                </div>
                <p style="padding-top: "> or request a callback </p>
                <form class="form-black" action="">
                    <div class="form-group">
                        <input type="text" class="form-control larger-form" id="fullName" name="fullName" placeholder="Full Name" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control larger-form" id="phoneNumber" name="tel-national" placeholder="Contact Number" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control larger-form" id="email" name="email" placeholder="Email (optional)" />
                    </div>
                    <button type="submit" class="big-blue-button">Call Me</button>
                </form>
            </div>
            <div class="col-xl-6 col-lg-5 col-md-2 col-12 d-md-flex d-none center-content" style="min-height: 300px;"></div>
        </div>
    </div>
    <hr/>
    <div class="full-size-40 container-fluid d-flex flex-column">
        <div class="row flex-grow-1">
            <div class="col-12 center-content" style="text-align: center;">
                <h2 style="padding-top: 30px;"> Our Suppliers</h2>
                <ul class="logos-container">
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/british-gas.svg') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/edf.svg') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/scottish-power.svg') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/ecotricity.svg') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/eon.svg') }}">
                    </li>
                    <li class="logos-item-outer">
                        <img class="logos-item" src="{{ asset('img/supplier-logos/ovo.svg') }}">
                    </li>
                </ul>
            <p> Plus more </p>
            </div>
        </div>
    </div>
      
    <div class="full-size-50 container-fluid d-flex flex-column background-image-preston-behind">
        <div class="row flex-grow-1 padding-20px background-image-preston background-image-bottom preload">
            <div class="col-12 col-lg-6 center-content">
                <div style="max-width: 100%; text-align: center;">
                    <p style="color: #f3f2f1; font-size: 50px;">Want us to do the heavy lifting?</p>
                    <p style="color: #f3f2f1;">You can upload your bill and we'll do the rest</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 center-content" style="text-align: center;">
                <div class="upload-btn-wrapper">
                    <label for="bills-upload"><button class="big-blue-button">Upload</button></label>
                    <input type="file" id="bills-upload" name="bills-upload" />
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container-fluid d-flex flex-column">
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
    </div> --}}
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