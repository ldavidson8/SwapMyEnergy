@extends('layouts.master')

@section('stylesheets')
    <style>
        body
        {
            background: #83aec8;
        }

        h2
        {
            font-size: 26px;
            color: #202020;
        }

        td
        {
            padding: 0px;
        }

        .sticky
        {
            position: sticky;
            top: 0px;
        }
        
        .current-supplier-logo td
        {
            width: 100% !important;
        }

        .estimated-annual-energy-costs-banner
        {
            font-size: 22px;
            font-weight: normal;
            background-color: #f3f2f1;
            color: #202020;
            border-radius: 100px;
            display: inline-block;
            padding: 2px 25px;
            marg-bottom: 15px;
        }

        .uppercase-white-text
        {
            text-transform: uppercase;
            color: #f3f2f1;
            font-size: 24px;
        } 
        
        .outer-rounded-container
        {
            border-radius: 35px;
            z-index: 11;
            font-weight: 700;
            font-size: 26px;
            color: #f3f2f1;
        }

        .rounded-container
        {
            border-radius: 0 0 35px 35px !important;
        }
        .blue-rounded-container
        {
            background-color: rgba(0, 194, 203, 1);
            z-index: 11;
            color: #202020;
            padding: 15px 30px 20px;
            border: solid 2px #202020;
            border-top: none;
        }
        .blue-rounded-container:not(.rounded-container)
        {
            border-bottom: 0px;
            padding-bottom: 0px;
        }

        .white-rounded-container
        {
            background-color: rgba(243, 242, 241, 0.35);
            z-index: 10;
            color: #202020;
            padding: 20px 30px;
            border-bottom: solid 2px #202020;
            border-left: solid 2px #202020;
            border-right: solid 2px #202020;
        }

        .switch-form-button
        {
            display:inline-block; 
            background:#00c2cb; 
            text-align: center;
            color: #f3f2f1;
            font-weight: 700; 
            -webkit-appearance:button; 
            padding:10px 20px; 
            position:relative; 
            cursor:context-menu; 
            margin: 0.5em 0; 
            border-radius: 8px;
            border: none;
        }

        .white-rounded-container-positioned
        {
            z-index: -1;
            position: absolute;
            left: 0;
            right: 0;
            top: -50px;
            width: 100%;
            height: 50px;
            background-color: #f3f2f1;
            border-left: solid 2px #202020;
            border-right: solid 2px #202020;
        }

        .inverted-rounded-corner-1,
        .inverted-rounded-corner-2
        {
            z-index: -1;
            position: absolute;
            top: -35px;
            width: 35px;
            height: 35px;
            background-color: rgba(243, 242, 241, 0.35);
            border-left: solid 2px #202020;
            border-right: solid 2px #202020;
        }
        .inverted-rounded-corner-1
        {
            left: 0;
            -webkit-mask-image: radial-gradient(circle 35px at top right, transparent 0, transparent 35px, black 35px);
        }
        .inverted-rounded-corner-2
        {
            right: 0;
            -webkit-mask-image: radial-gradient(circle 35px at top left, transparent 0, transparent 35px, black 35px);
        }

        .form-top-heading
        {
            padding: 30px;
            text-transform: uppercase;
        }

        .form-top-left-heading
        {
            background-color: #202020;
            border-radius: 35px 0 0 0;
            border-radius: 35px 0 35px 0;
            text-align: center;
            display: inline-block;
            z-index: 2;
            position: relative;
        }
        
        .form-top-middle-heading
        {
            text-align: left;
        }

        .form-top-outer
        {
            background-color: rgba(0, 194, 203, 1);
            border-radius: 35px 35px 0 0;
        }

        .form-top-img
        {
            background-color: #f3f2f1; 
            padding: 35px;
            /* border-radius: 0 35px 0 0; */
            border-radius: 0 35px 0 35px;
            width: 200px;
            text-align: center;
        }
        .form-top-img img
        {
            max-width: 80%;
            max-height: 100px;
        }

        .form-table
        {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            display: inline-table;
        }

        .bottom-right
        {
            position: absolute;
            bottom: 10px;
            right: 30px;
            width: 50%;
            text-align: right;
        }

        .table-tariff
        {
            display: inline-table;
            font-size: 20px;
        }

        .table-tariff th
        {
            padding: 3px;
            vertical-align: top;
        }

        .table-tariff td
        {
            padding: 3px;
            padding-left: 15px;
            font-weight: normal;
        }
        
        .tariff-feature
        {
            display:inline-block; 
            background:#00c2cb; 
            width: 100%; 
            text-align: center; 
            color: #f3f2f1; 
            -webkit-appearance:button; 
            padding:3px 8px 3px 8px; 
            font-size:16px; 
            position:relative; 
            cursor:context-menu; 
            margin: 0.5em 0; 
            border-radius: 8px;
        }
        .form-outer-box
        {
            padding: 20px 0;
        }

        .new-supplier-logo
        {
            max-width: 100%;
            max-height: 100px;
            background-color: white;
            border-radius: 3px;
        }

        .new-tariff-estimated-cost
        {
            border-left: 2px solid #202020;
            border-right: 2px solid #202020;
        }

        @media (min-width: 768px) and (max-width: 991px)
        {
            .form-top-left-border-md
            {
                border-radius: 35px 35px 0 0;
            }

            .form-top-img-border-md
            {
                border-radius: 0 0 0 35px;
            }
            .form-top-middle-heading
            {
                border-left: solid 2px #202020;
            }
        }

        @media (max-width: 991px)
        {
            .new-tariff-estimated-cost
            {
                border: none;
            }
        }

        @media (max-width: 767px) or (max-height: 767px)
        {
            .sticky
            {
                position: static;
                top: auto;
            }
        }

        @media (max-width: 767px)
        {
            .inverted-rounded-corner-1,
            .inverted-rounded-corner-2
            {
                display: none;
            }
            
            .estimated-annual-energy-costs-banner
            {
                border-radius: 0;
                border: none;
            }

            .container, .container-fluid
            {
                max-width: 100% !important;
                width: 100%;
                padding: 0;
                border-radius: 0px !important;
            }

            .form-top-outer
            {
                border: none !important;
            }
            .white-rounded-container
            {
                padding: 10px;
                padding-bottom: 20px;
                border-width: 0px 0px 2px;
                border-bottom: solid 2px #202020;
                border-radius: 0;
            }
            .blue-rounded-container
            {
                border-width: 0px 0px 2px;
                padding: 0px;
            }

            .form-outer-box
            {
                padding: 0;
            }

            .form-top-left-border-md
            {
                border-radius: 0;
            }
            
            .form-top-img-border-sm
            {
                border-radius: 0;
                width: 100%;
            }

            .form-top-middle-heading
            {
                text-align: center;
            }
            
            .pricing-text
            {
                float: none;
                text-align: left;
                width: 100%;
                padding-right: 10px;
            }
        }

        @media (max-width: 600px)
        {
            .table-block-on-mobile
            {
                width: 100%;
            }
            
            .table-block-on-mobile tbody,
            .table-block-on-mobile tr,
            .table-block-on-mobile td
            {
                display: block;
                width: 100%;
                max-width: 100%;
            }
            
            .table-tariff
            {
                width: 100%;
            }
            
            .table-tariff tbody,
            .table-tariff tr,
            .table-tariff th,
            .table-tariff td
            {
                display: block;
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
@endsection

@section('before-header')
    <div id="section01" class="container-fluid no-padding d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="background-image-wind-turbines background-image-top background-image-contain background-image-no-mobile flex-fill">
            <div class="col-12 center-content form-outer-box">
                <div class="container outer-rounded-container no-padding flex-row">
                    <span style="font-size: 20px;">
                        @if (Session::has('fail') && Session::get('fail') == 'session_expired')
                            {{-- <div class="alert alert-danger post-error">
                                Sorry, your session expired. Please try again.
                            </div> --}}
                        @elseif (count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors -> all() as $error)
                                    {{ $error }}<br />
                                @endforeach
                            </div>
                        @endif
                    </span>
                    @switch($existing_tariff -> fuel_type_str)
                        @case("dfs") @include('energy-comparison.partials.3-browse-deals-dfs') @break
                        @case("df") @include('energy-comparison.partials.3-browse-deals-df') @break
                        @case("ng") @include('energy-comparison.partials.3-browse-deals-elec') @break
                        @default @include('energy-comparison.partials.3-browse-deals-gas') @break
                    @endswitch
                </div>
            </div>
        </div>
    </div>
    
@endsection