@extends('layouts.master')

@section('before-header')
    <div class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="row flex-grow-1" style="padding: 0px;">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12 left-column-content">
                <h1>Empower your business to overcome rising energy prices</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac lectus mi. Etiam vel neque eleifend, maximus est a, pellentesque orci. Sed egestas tortor id lorem vulputate aliquam. Praesent ornare massa vitae velit interdum, eu iaculis magna condimentum. Nam tincidunt diam nisi. Sed in lacus ullamcorper, luctus urna sit amet, accumsan justo. Aliquam pellentesque, nunc et congue ullamcorper, leo odio elementum metus, vitae consequat quam ligula ut lorem. Pellentesque ex nulla, vehicula id quam sed, ultricies elementum diam. Morbi faucibus augue eget purus consequat laoreet. Aliquam erat volutpat. Pellentesque et cursus magna.</p>
            </div>
            <div class="col-xl-6 col-lg-5 col-md-2 d-none d-md-block"></div>
        </div>
    </div>
    <hr/>
    <div class="full-size-50 container-fluid d-flex flex-column">
        <div class="row flex-grow-1" style="padding: 0px;">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-4 col-lg-5 col-md-8 col-12 left-column-content align-items-center" style="text-align: left;">
                <div>
                    <h2> How it works </h2>
                    <p style="padding-top: 15px">Other energy brokers promise false savings based on their estimates, which can fall short of your actual usage, which can result in steep final bills and hassle that you just don't need. Our savings are calculated based on the unit price, which means that a lower unit price plan will result in savings for you or some room for more brews or a new TV to binge-watch Netflix on. </p>
                </div>
            </div>
            <div class="col-2 d-lg-none d-block"></div>
            <div class="col-2 d-lg-none d-block"></div>
            <div class="col-xl-6 col-lg-5 col-md-8" style="align-items: center; justify-content: center; margin: auto; padding: 0px;">
                <img class="gallery-logo" src="{{ asset('img/bluesquare.png') }}" width="100%" height="200" />
            </div>
            <div class="col-2 col-lg-1 d-block"></div>
        </div>
    </div>
        <div class="full-size-50 container-fluid d-flex flex-column" style="background-color: darkslategrey;">
            <div class="row flex-grow-1" style="padding: 20px;">
                <div style="align-items: center; justify-content: center; margin: auto; width: 600px; max-width: 100%;">
                    <p style="color: white;">Geoff "saved" £100 on his energy bill with another energy broker only to find out he had hidden fees to pay at the end of the year.</p>
                    <p style="font-weight: bold; font-size: 35px; color: white;">Sound familiar?</p>
                </div>
            </div>
        </div>
    </div>
@endsection