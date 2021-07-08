@extends('layouts.master')

@section('stylesheets')
    <style>
        ul{
            list-style: none;
        }
        p{
            font-weight: normal;   
        }
        .line-height{
            line-height: 2.5;
        }
        .anchor-default:link, .anchor-default:visited{
            color: #00aeb6;
            outline: none;
        }
        .anchor-default:hover, .anchor-default:active{
            color: #fdae36;
            outline: none;
            text-decoration: none;
        }
        h1{
            background: #00C2CB;
            padding: 10px 10px 10px 20px;
            border-radius: 25px;
        }
        .font-weight-bold{
            background: #00C2CB;
            padding: 2.5mm;
            margin-right: 2cm;
            border-radius: 25px; 
            text-align: center;
        }
        @media (max-width: 521px)
        {
            .section-title
            {
                font-size: 6.5vmin;
            }
        }
        @media (max-width: 334px)
        {
            .font-weight-bold
            {
                margin-right: 5px;
            }
        }
    </style>
@endsection

@section('main-content')
    <main class="col-md-12">
        <div class="container">
            <div class="title">
                <br />
                <h1 class="section-title"> SwapMyEnergy.co.uk Sitemap</h1>
                <br />
                <div>
                    <p>Welcome to our Sitemap page. For easy access you can find a list of visitable pages on our website below.<br /> <br />Don't fall victim to rising energy prices. Swap My Energy aims to bring you great deals by giving you easy access to the best commerical energy tariffs on the market. With our market leading commerical energy calculator, you can quickly find the best energy prices available to you. </p>
                    <br />
                </div>
            </div>   
            <div class="row">
                <div class="col-lg-6">
                    <p class="font-weight-bold">SwapMyEnergy information:</p>
                    <ul class="line-height">
                        <li>
                            <p><a class="anchor-default" href="{{route('business.about')}}">About Us</a></p>
                            {{--<p><a class="anchor-default" href="https://linktr.ee/swapmyenergy" rel="external">Our Social Media</a></p>--}}
                            <p><a class="anchor-default" href="{{route('business.t&c')}}">Terms and Conditions</a></p>
                            <p><a class="anchor-default" href="{{route('business.privacy policy')}}">Privacy Policy</a></p>
                            <p><a class="anchor-default" href="{{route('business.cookie policy')}}">Our Cookie policy</a></p>
                            {{--<p><a class="anchor-default" href="https://www.znergi.co.uk/">Znergi.co.uk</a></p>--}}
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <p class="font-weight-bold">Services & Support:</p>
                    <ul class="line-height">
                        <li>
                            <p><a class="anchor-default" href="{{route('business.home')}}">Business</a></p>
                            <p><a class="anchor-default" href="{{route('residential.home')}}">Residential</a></p>
                            <p><a class="anchor-default" href="{{route('business.partners and affiliates')}}">Our Affiliate Program</a></p>
                            <p><a class="anchor-default" href="{{route('business.contact')}}">Contact Us</a></p>
                            <p><a class="anchor-default" href="{{route('business.contact')}}#support">Raise a Support Request</a></p>
                            {{--<p><a class="anchor-default" href="route('residential.#')">Frequently Asked Questions</a></p>--}}
                        </li>
                    </ul>   
                </div>
                {{--<div class="col-lg-6">
                    <p class="font-weight-bold">SwapMyEnergy Residential:</p>
                    <ul class="line-height">
                        <li>
                            <p><a class="anchor-default" href="{{route('residential.home')}}">Residential Home Page</a></p>
                            <p><a class="anchor-default" href="route('residential.#')">Frequently Asked Questions</a></p>
                        </li>
                    </ul>
                    <br />
                    <p class="font-weight-bold">SwapMyEnergy Business:</p>
                    <ul class="line-height">
                        <li>
                            <p><a class="anchor-default" href="{{route('business.home')}}"> Business Home Page</a></p>
                            <p><a class="anchor-default" href="{{route('business.partners and affiliates')}}">Our Affiliate Program</a></p>
                            <p><a class="anchor-default" href="route('business.#')">Our Suppliers</a></p>
                        </li>
                    </ul>   
                </div>--}}
            </div>
        </div>
    </main>
    <br /><br /><br />    
@endsection()