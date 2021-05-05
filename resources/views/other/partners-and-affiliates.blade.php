@extends('layouts.master')

@section('stylesheets')
    <style>
        img.gallery-logo
        {
            display: inline-block;
            margin: 20px;
        }

        @media (max-width: 787px)
        {
            img.gallery-logo
            {
                width: 45%;
                margin: 2%;
            }
        }
    </style>
@endsection

@section('main-content')
<div class="container-fluid" style="text-align: center;">
      <img class="gallery-logo" src="{{ asset('img/bluesquare.png') }}" width="300" height="150" />
      <img class="gallery-logo" src="{{ asset('img/redsquare.png') }}" width="300" height="150" />
      <img class="gallery-logo" src="{{ asset('img/bluesquare.png') }}" width="300" height="150" />
      <img class="gallery-logo" src="{{ asset('img/redsquare.png') }}" width="300" height="150" />
      <img class="gallery-logo" src="{{ asset('img/bluesquare.png') }}" width="300" height="150" />
      <img class="gallery-logo" src="{{ asset('img/bluesquare.png') }}" width="300" height="150" />
      <img class="gallery-logo" src="{{ asset('img/redsquare.png') }}" width="300" height="150" />
      <img class="gallery-logo" src="{{ asset('img/bluesquare.png') }}" width="300" height="150" />
      <img class="gallery-logo" src="{{ asset('img/redsquare.png') }}" width="300" height="150" />
      <img class="gallery-logo" src="{{ asset('img/bluesquare.png') }}" width="300" height="150" />
      </div>
   </div>
   <hr/>

<div class="contianer-fluid" style="background-color: white;">
    <div class="container fixed-width">
    <div class="row" style="padding: 30px 0px;">
            <div class="col-6" style="text-align: right; border-right: 3px solid black;">
                <h2> Your Benefits </h2>
                <ul style="line-height: 1.2;">
                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</li>
                    <li>Incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nostrud exercitation.</li>
                    <li>Ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit.</li>
                    <li>In voluptate velit esse cillum dolore eu fugiat nullapariatur. Excepteur sint occaecat cupidatate.</li>
                </ul>
            </div>
            <div class="col-6" style="text-align: left;">
                <h2 style="font-size: 45px;"> Join Our Family</h2>
                <button type="button" class="bigbluebutton btn-lg">Join Us</button> 
            </div>
        </div>
    </div>
    <hr/>
    
<div class="full-size container-fluid d-flex h-100 flex-column">
<main class="row flex-grow-1" style="padding: 0px;">
        <div class="md-6">
            <h2> Your Benefits </h2>
        </div>
        <div class="md-6">
        </div>
</div>
@endsection()