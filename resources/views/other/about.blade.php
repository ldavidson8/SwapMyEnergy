@extends('layouts.master')

@section('before-header')
    <div class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr />
        <div class="row flex-grow-1 no-padding">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12 left-column-content">
                <h1>What We Do</h1>
                <p>We provide businesses and people like YOU with the opportunity to save on their energy bills. With our no nonsense approach, what you see is what you get. 
                At Swap My Energy, we give you savings based on facts, not estimates. 
                By finding you a cheaper unique cost you will have the opportunity to save money. 
                The more you use, the more you pay and vice versa. 
                You may end up paying more but that will only happen because you used more, not because the cost of usage is higher.</p>    
            </div>
            <div class="col-xl-6 col-lg-5 col-md-2 d-none d-md-block"></div>
        </div>
    </div>
    <hr/>
    <div class="full-size-50 container-fluid d-flex flex-column">
        <div class="row flex-grow-1 no-padding" style="background-color: wh#f3f2f1ite;">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-4 col-lg-5 col-md-8 col-12 left-column-content align-items-center mobile-only-padding-30" style="text-align: left;">
                <div>
                    <h2> Our home </h2>
                    <p style="padding-top: 15px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
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
    <div class="d-flex flex-column" style="background-color: darkslategrey; height: 30vw; min-height: 300px;">
        <div class="row flex-grow-1" sytle="align-content: center;">
            <div style="align-items: center; justify-content: center; margin: auto; width: 600px; max-width: 100%; text-align: center">
                <p style="font-weight: bold; font-size: 30px; color: #f3f2f1;">Need Help?</p>
                <a href="{{ route('support') }}" class="btn big-blue-button btn-lg" role="button">Contact Us</a>             
            </div>
        </div>
    </div>
    <div class="full-size-50 container-fluid d-flex flex-column">
        <div class="row flex-grow-1 no-padding" style="background-color: #f3f2f1;">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-4 col-lg-5 col-md-8 col-12 left-column-content align-items-center mobile-only-padding-30" style="text-align: left;">
                <div>
                    <h2> Our team </h2>
                    <p style="padding-top: 15px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                </div>
            </div>
        </div>
    </div>
@endsection