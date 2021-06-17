@extends('layouts.master')

@section('stylesheets')
<style>

    .rounded-blue-button
    {
        background-color: #00d2db;
        border: none;
        width: 300px;
        border-radius: 18px;
        padding: 20px;
        font-size: 27px;
        font-weight: bold;
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
        background-color: #00c2cb;
        z-index: 11;
        color: #f3f2f1;
        padding: 20px 30px;
    }

    .white-rounded-container
    {
        background-color: #f3f2f1;
        z-index: 10;
        color: #202020;
        padding: 50px;
        border-bottom: solid 2px #202020;
        border-left: solid 2px #202020;
        border-right: solid 2px #202020;
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
        /* background: url('{{ asset('img/bottom-border-white.png') }}') bottom repeat-x; */
        background-color: #00c2cb;
        border-radius: 35px 35px 0 0;
    }

    .form-top-img
    {
        background-color: #f3f2f1; 
        padding: 35px;
        border-radius: 0 35px 0 0;
        border-radius: 0 35px 0 35px;
        width: 200px;
        text-align: center;
    }
    .form-top-img img
    {
        max-width: 100%;
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

    .table-current-tariff
    {
        display: inline-block;
    }

    .table-current-tariff td
    {
        padding: 10px;
    }

    .table-choose-tariff
    {
        display: inline-block;
        border-collapse: separate;
    }

    .row-spacer
    {
        border-top: 100px solid transparent; 
    }

    .table-choose-tariff td
    {
        padding: 10px;
    }

    .black-progress-bar
    {
        width:350px;
        height:50px; 
        background-color: #202020; 
        border: 3px solid #f3f2f1;
        border-radius: 10px;
        color: #f3f2f1;
        text-align: center;
        z-index: 18;
        position: relative;
    }

    .black-progress-bar-text
    {
        z-index: 22;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        padding: 5px;
    }

    .black-progress-bar-bordered
    {
        width:350px;
        height:50px; 
        background-color: #202020; 
        border-radius: 10px;
        border: 2px solid #202020;
        color: #f3f2f1;
        text-align: center;
        z-index: 18;
        position: relative;
    }

    .black-progress-bar-bordered-text
    {
        z-index: 22;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        padding: 5px;
    }

    /* .black-progress-bar
    {
        height: 100%; 
        background-color: #202020; 
        border-radius: 7px;
        text-align: center;
        font-size: 24px;
        color: #00c2cb;
        padding: 5px 0;
        position: absolute;
        top: 0;
        z-index: 20;
    } */

    .blue-progress-bar
    {
        height: 100%; 
        background-color: #00c2cb; 
        border-radius: 7px;
        text-align: center;
        font-size: 24px;
        color: #00c2cb;
        padding: 5px 0;
        position: absolute;
        top: 0;
        z-index: 20;
    }

    @media (max-width: 767px)
    {
        .form-top-left-border-sm
        {
            border-radius: 35px 35px 0 0;
        }
        .form-top-img-border-sm
        {
            border-radius: 0 0 0 35px;
        }

        .table-current-tariff
        {
            width: 100%;
        }

        .table-current-tariff tbody,
        .table-current-tariff tr,
        .table-current-tariff td
        {
            display: block;
            width: 100%;
            max-width: 100%;
        }

        .table-choose-tariff
        {
            width: 100%;
        }

        .table-choose-tariff tbody,
        .table-choose-tariff tr,
        .table-choose-tariff td
        {
            display: block;
            width: 100%;
            max-width: 100%;
        }

        .black-progress-bar
        {
            width: 100%;
            max-width: 100%;
        }
        .black-progress-bar-bordered
        {
            width: 100%;
            max-width: 100%;
        }
        .blue-progress-bar
        {
            width: 100%;
            max-width: 100%;
        }
    }

</style>
@endsection

@section('before-header')
    <div id="section01" class="container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="background-image-wind-turbines flex-fill">
            <div class="col-12 padding-20px center-content">
                <div class="container outer-rounded-container no-padding flex-row">  
                    <div class="row form-top-outer">
                        <div class="col-12 col-md-4 form-top-heading form-top-left-heading form-top-left-border-sm">
                            <table class="form-table"><tr><td>Step 4 | Get Switching</td></tr></table>
                        </div>
                        <div class="flex-fill form-top-heading form-top-middle-heading">
                            <table class="form-table"><tr><td>Current Tariff</td></tr></table>
                        </div>
                        <div class="no-padding form-top-img form-top-img-border-sm">
                            <table class="form-table"><tr><td><img src="{{ asset('img/supplier-logos/utilita.png') }}" height="auto" width="auto" /></td></tr></table>
                        </div>
                    </div>
                    <div class="container rounded-container blue-rounded-container">
                        <table class="form-table">
                            <tr>
                                <td>
                                    <div class="row no-padding">
                                        <div class="col-lg-8 col-12 no-padding">
                                            <table class="table-current-tariff" style=" vertical-align: bottom;">
                                                <tr>
                                                    <td>
                                                        Unit Rate:
                                                    </td>
                                                    <td>
                                                        <div class="black-progress-bar">
                                                            <div class="black-progress-bar-text">12p*</div>
                                                            <div class="blue-progress-bar" style="width: 80%;"></div>  
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Standing Charge:
                                                    </td>
                                                    <td>
                                                        <div class="black-progress-bar">
                                                            <div class="black-progress-bar-text">2p*</div>
                                                            <div class="blue-progress-bar" style="width: 30%"></div>  
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-4 col-12 no-padding">
                                            <table class="form-table" style="width: auto; float: right;">
                                                <tr>
                                                    <td style="vertical-align: bottom;">
                                                        <p style="text-align: center; border-right: solid 2px #f3f2f1; line-height: ">
                                                            <span style="font-size: 34px;">£81.76</span> 
                                                            <br /> 
                                                            per month
                                                        </p>
                                                    </td>
                                                    <td style="vertical-align: bottom; text-align: right;">
                                                        <p style="font-size: 20px;"> 24 month<br />contract </p>  
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style="position: relative;">
                        <div class="white-rounded-container-positioned"></div>
                        <div class="container rounded-container white-rounded-container">
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>

@endsection