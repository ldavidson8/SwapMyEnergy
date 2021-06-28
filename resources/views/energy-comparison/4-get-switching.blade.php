@extends('layouts.master')

@section('stylesheets')
<style>
    
    .switchButton
    {
        width: 300px;
        padding: 20px;
        background-color: white;
        border-radius: 6px;
        position: relative;
        overflow: hidden;
        float: right;
        text-transform: uppercase;
        font-weight: 700;
    }

    .switchButton span
    {
        color: black;
        position: relative;
        z-index: 1;
        transition: color 0.6s cubic-bezier(0.53, 0.21, 0, 1);
    }

    .switchButton::before
    {
        content: 'SUBMIT';
        padding: 20px;
        text-transform: uppercase;
        font-weight: 700;
        position: absolute;
        top: 50%;
        left: 0;
        border-radius: 6px;
        transform: translate(-100%, -50%);
        width: 100%;
        height: 100%;
        background-color: #00c2cb;
        transition: transform 0.6s cubic-bezier(0.53, 0.21, 0, 1);
    }

    .switchButton:hover span
    {
        color: white;
    }

    .switchButton:hover::before
    {
        transform: translate(0, -50%);
    }


    .outer-rounded-container
    {
        border-radius: 35px;
        z-index: 11;
        font-weight: 700;
        font-size: 24px;
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
        border-radius: 33px 0 0 0;
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
        border-radius: 33px 33px 0 0;
    }

    .form-top-img
    {
        background-color: #f3f2f1; 
        padding: 35px;
        /* border-radius: 0 35px 0 0; */
        border-radius: 0 33px 0 0;
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

    .form-check
    {
        position: relative;
        display: block;
    }

    .form-check-input
    {
        position: absolute;
        margin-top: 10px;
    }

    .table-tariff
    {
        display: inline-block;
    }

    .table-tariff td
    {
        padding: 10px;
    }

    .white-progress-bar
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

    .white-progress-bar-text
    {
        z-index: 22;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        padding: 5px;
    }

    .white-progress-bar-border
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

    .white-progress-bar-border-text
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

    .form-outer-box
    {
        padding: 20px 0;
    }

    .collapse-table
    {
        border: none;
        outline: none !important;
        font-weight: 700;
        padding: 20px 0;
        margin: 0 0 30px 0;
        border-bottom: solid 3px #00c2cb;
        width: 100%;
        text-align:left;
        background: none;
    }

    #tariff-info
    {
        text-transform: uppercase;
    }

    #tariff-info tr:not(:last-child)
    {
        border-bottom: solid 2px #202020;
    }

    #tariff-info td
    {
       padding: 10px 0;
       width: 50%;
    }

    #tariff-info tbody:before
    {
        line-height: 20px
        content:"_";
        color: #f3f2f1;
        display:block;
    }

    #tariff-info td:nth-of-type(2n+1)
    {
       border-right: solid 2px #202020;
    }
    
    label
    {
        font-weight: bold;
    }

    input
    {
        display: block;
        width: 100%;
        max-width: 100%;
    }

    @media (min-width: 768px) and (max-width: 991px)
    {
        .form-top-left-border-md
        {
            border-radius: 33px 33px 0 0;
        }

        .form-top-img-border-md
        {
            border-radius: 0;
        }
    }


    @media (max-width: 767px)
    {

        .container, .container-fluid
        {
            max-width: 100% !important;
            width: 100%;
            padding: 0;
            border-radius: 0px !important;
        }

        .white-rounded-container
        {
            padding-bottom: 20px;
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
        .table-tariff td
        {
            display: block;
            width: 100%;
            max-width: 100%;
        }

        .white-progress-bar
        {
            width: 100%;
            max-width: 100%;
        }
        .white-progress-bar-border
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

    hr.thin-line
    {
        border-top: none;
    }
</style>
@endsection

@section('before-header')
    <div id="section01" class="container-fluid no-padding d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr />
        <div class="background-image-wind-turbines background-image-contain flex-fill">
            <div class="col-12 center-content form-outer-box">
                <div class="container outer-rounded-container no-padding flex-row" style="border: solid 2px #202020;">
                    <div class="row form-top-outer">
                        <div class="col-12 col-lg-4 form-top-heading form-top-left-heading form-top-left-border-md">
                            <table class="form-table"><tr><td>Step 4 | Get Switching </td></tr></table>
                        </div>
                        <div class="flex-fill form-top-heading form-top-middle-heading">
                            <table class="form-table"><tr><td>Selected Tariff</td></tr></table>
                        </div>
                        <div class="no-padding form-top-img form-top-img-border-sm form-top-img-border-md">
                            <table class="form-table"><tr><td><img src="{{ asset('img/supplier-logos/edf.png') }}" height="auto" width="auto" /></td></tr></table>
                        </div>
                    </div>
                    {{-- <div class="container rounded-container blue-rounded-container">
                        <table class="form-table">
                            <tr>
                                <td>
                                    <div class="row no-padding">
                                        <div class="col-lg-8 col-12 no-padding">
                                            <table class="table-tariff table-block-on-mobile" style=" vertical-align: bottom;">
                                                <tr>
                                                    <td>
                                                        Unit Rate:
                                                    </td>
                                                    <td>
                                                        <div class="white-progress-bar">
                                                            <div class="white-progress-bar-text">12p*</div>
                                                            <div class="blue-progress-bar" style="width: 80%;"></div>  
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Standing Charge:
                                                    </td>
                                                    <td>
                                                        <div class="white-progress-bar">
                                                            <div class="white-progress-bar-text">2p*</div>
                                                            <div class="blue-progress-bar" style="width: 30%"></div>  
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-4 col-12 no-padding">
                                            <table class="form-table" style="">
                                                <tr style="height: 100%;"></tr>
                                                <tr>
                                                    <td style="vertical-align: bottom; width: 50%; text-align: center;">
                                                        <p style="font-size: 20px; text-align: center; border-right: solid 2px #f3f2f1;">
                                                            <span style="font-size: 34px;">£81.76</span> 
                                                            <br /> 
                                                            per month
                                                        </p>
                                                    </td>
                                                    <td style="vertical-align: bottom; width: 50%; text-align: center;">
                                                        <p style="font-size: 20px;"> 24 month<br />contract </p>  
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div> --}}
                    <div style="position: relative; font-size; 22px; font-weight: normal;">
                        <div class="white-rounded-container-positioned"></div>
                        <div class="container rounded-container white-rounded-container">
                            <button class="collapse-table" id="tariff-info-toggle" role="button"> TARIFF INFORMATION </button>
                            <table id="tariff-info" style="width: 100%;">
                                <tr><td>Supplier</td><td></td></tr>
                                <tr><td>Tariff Name</td><td></td></tr>
                                <tr><td>Tariff Type</td><td></td></tr>
                                <tr><td>Payment method</td><td></td></tr>
                                <tr><td>Unit rate</td><td></td></tr>
                                <tr><td>Standing charge</td><td></td></tr>
                                <tr><td>Tariff ends On</td><td></td></tr>
                                <tr><td>Price guaranteed until</td><td></td></tr>
                                <tr><td>VAT</td><td></td></tr>
                            </table>
                            
                            <br />
                            <form action="{{ route('residential.energy-comparison.4-get-switching') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="postcode">Postcode</label>
                                    <input type="text" id="postcode" name="postcode" value="{{ "" /*$user_address['postcode']*/ }}" />
                                </div>
                                <div class="form-group">
                                    <label for="address_line_1">Address Line 1<span class="text-danger">*</span></label>
                                    <input type="text" id="address_line_1" name="address_line_1" value="" required />
                                </div>
                                <div class="form-group">
                                    <label for="address_line_2">Address Line 2</label>
                                    <input type="text" id="address_line_2" name="address_line_2" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="town">Town<span class="text-danger">*</span></label>
                                    <input type="text" id="town" name="town" value="" required />
                                </div>
                                <div class="form-group">
                                    <label for="county">County</label>
                                    <input type="text" id="county" name="county" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="county">Do you already have a smart meter installed at your home?<span class="text-danger">*</span></label>
                                    <select id="county" name="county" value="">
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        <option value="doNotKnow">Don't Know</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gas_meter_number">Gas meter number<span class="text-danger">*</span></label>
                                    <p><input type="text" id="gas_meter_number" name="gas_meter_number" value="" required /></p>
                                    <p>Your gas meter number is also known as a Meter Point Reference Number (MPRN). Please enter the number as you find it on your gas bill. If you are unable to find this information on your energy bill, you can get it by calling the National Grid on 0870 608 1524 (press 2 then 1).</p>
                                    <p>Or click here to find this information online. Enter your postcode first and then your house number.</p>
                                </div>
                                <div class="form-group">
                                    <label for="elec_meter_number">Electricity meter number<span class="text-danger">*</span></label>
                                    <p><input type="text" id="elec_meter_number" name="elec_meter_number" value="" /></p>
                                    <p>Your electricity meter number is also known as a Supply (S) Number or MPAN. Please enter the bottom row of numbers as you find them on your electricity bill without spaces as highlighted in the example below.</p>
                                    <img alt="Example of an Electricity Number" src="" />
                                </div>
                                <br />

                                <hr class="thin-line" />
                                <br />
                                
                                <h2>Your Direct Debit Details</h2>
                                <p><b>You will pay {{ "" }} per month to {{ "" }}</b></p>
                                <p>Even after you have submitted this application you still have 14 days from today to cancel your contract if you change your mind.</p>
                                
                                <div class="form-group">
                                    <label for="accountName" class="font-weight-bold">Account Holder Name<span class="text-danger">*</span></label> 
                                    <input type="text" id="accountName" name="accountName" value="" class="form-control" />
                                </div>
                                <div class="row no-margin">
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label for="sortCode1 sortCode2 sortCode3" class="font-weight-bold d-block">Sort Code<span class="text-danger">*</span></label>
                                            <input id="sortCode1" name="sortCodeOne" inputmode="tel" maxlength="2" type="text" class="form-control w-25 d-inline text-center"> 
                                            <input id="sortCode2" name="sortCode2" inputmode="tel" maxlength="2" type="text" class="form-control w-25 d-inline text-center"> 
                                            <input id="sortCode3" name="sortCode3" inputmode="tel" maxlength="2" type="text" class="form-control w-25 d-inline text-center">
                                        </div>
                                    </div> 
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="accountNumber" class="font-weight-bold">Account Number<span class="text-danger">*</span></label> 
                                            <input id="accountNumber" name="accountNumber" inputmode="tel" maxlength="8" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-margin">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="preferredDay" class="font-weight-bold">Select your payment date<span class="text-danger">*</span></label>
                                            <select id="preferredDay" name="preferredDay" class="form-control w-25 custom-select d-block">
                                                <option value=""></option> 
                                                <option value="1">1</option> 
                                                <option value="2">2</option> 
                                                <option value="3">3</option> 
                                                <option value="4">4</option> 
                                                <option value="5">5</option> 
                                                <option value="6">6</option> 
                                                <option value="7">7</option> 
                                                <option value="8">8</option> 
                                                <option value="9">9</option> 
                                                <option value="10">10</option> 
                                                <option value="11">11</option> 
                                                <option value="12">12</option> 
                                                <option value="13">13</option> 
                                                <option value="14">14</option> 
                                                <option value="15">15</option> 
                                                <option value="16">16</option> 
                                                <option value="17">17</option> 
                                                <option value="18">18</option> 
                                                <option value="19">19</option> 
                                                <option value="20">20</option> 
                                                <option value="21">21</option> 
                                                <option value="22">22</option> 
                                                <option value="23">23</option> 
                                                <option value="24">24</option> 
                                                <option value="25">25</option> 
                                                <option value="26">26</option> 
                                                <option value="27">27</option> 
                                                <option value="28">28</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check"><input id="ddConfirmation" name="ddConfirmation" type="checkbox" class="form-check-input"> 
                                    <label for="ddConfirmation" class="form-check-label">
                                    I confirm I am the account holder and am the only person required to authorise Direct Debits from my bank account.
                                    </label>
                                </div>
                                <div class="row no-margin mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="receiveBills" class="font-weight-bold">
                                                How would you like to receive all communications from <!-- insert name of selected tariff here -->? An electronic preference means <!-- "they" will be name of selected tariff -->they will
                                                communicate with you electronically wherever possible.<span class="text-danger">*</span>
                                            </label> 
                                            <select id="receiveBills" name="receiveBills" class="form-control w-75 custom-select d-block">
                                                <option value=""></option> 
                                                <option value="Email">Electronically</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="switchButton">GET SWITCHING</button>
                            </form>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>

@endsection

@section('script')
    <script>
    $('#tariff-info-toggle').click(function() {
        $('#tariff-info').fadeToggle(750);
    });
    </script>
@endsection