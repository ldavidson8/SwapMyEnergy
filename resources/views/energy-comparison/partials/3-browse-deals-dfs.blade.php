<?php
    $current_gas_price_per_unit = $current_tariffs -> G -> pricePerUnit;
    $current_gas_standing_charge_daily = $current_tariffs -> G -> standingChargeDaily;
    $current_elec_price_per_unit = $current_tariffs -> E -> pricePerUnit;
    $current_elec_standing_charge_daily = $current_tariffs -> E -> standingChargeDaily;

    $current_estimated_bill = $current_tariffs -> G -> bill + $current_tariffs -> E -> bill;
?>

<style type="text/css">
    .current-supplier-logo
    {
        background-color: #f3f2f1;
        color: #202020;
        text-align: center;
        width: auto;
        height: auto;
        display: inline-block;
        padding: 5px;
    }

    #currentTariffTable td.current-supplier-monthly-cost-and-length
    {
        vertical-align: middle;
        max-width: 100%;
        font-size: 20px;
        text-align: center;
    }
    
    @media (min-width: 992px)
    {
        #currentTariffTable tr td:first-child[colspan="2"]
        {
            width: 60%;
        }

        .mobile-only { display: none !important; }
    }

    @media (max-width: 991px)
    {
        #currentTariffTable
        {
            display: block;
            text-align: center;
        }
        #currentTariffTable td
        {
            display: inline-block;
            width: 49%;
            text-align: center;
        }
        #currentTariffTable td.current-supplier-monthly-cost-and-length
        {
            width: 100%;
            text-align: center;
        }

        .desktop-only { display: none !important; }
    }

    @media (max-width: 991px) and (min-width: 768px)
    {
        
    }

    @media (max-width: 600px)
    {
        #currentTariffTable
        {
            display: block;
            text-align: center;
        }
        #currentTariffTable td
        {
            display: inline-block;
            width: 100%;
        }
    }
</style>

<div class="row form-top-outer" style="border-right: 2px solid black;border-top: 2px solid black;">
    <div class="col-12 col-lg-4 form-top-heading form-top-left-heading form-top-left-border-md">
        <table class="form-table"><tr><td>Step 3 | Browse Deals</td></tr></table>
    </div>
    <div class="flex-fill form-top-heading form-top-middle-heading">
        <table class="form-table"><tr><td>Current Tariff</td></tr></table>
    </div>
</div>
<div class="container rounded-container blue-rounded-container">
    <table class="form-table">
        <tr>
            <td>
                <div style="text-align: center;">
                    <p class="estimated-annual-energy-costs-banner">
                        Your estimated annual energy costs for the past 12 months are &pound;{{ number_format($current_estimated_bill, 2) }}
                    </p>
                </div>
                <div class="row no-padding">
                    <div class="col-lg-9 col-12 no-padding">
                        <table id="currentTariffTable" class="form-table table-tariff table-block-on-mobile" style=" vertical-align: bottom;">
                            <tr>
                                <th colspan="2">Gas</th>
                                <td rowspan="4" style="vertical-align: top; padding-bottom: 20px;">
                                    <div class="current-supplier-logo">
                                        <table class="form-table"><tr><td style="padding: 0px;"><img src="{{ asset('img/supplier-logos/' . $current_tariffs -> G -> supplierName . '.png') }}" alt="{{ $current_tariffs -> G -> supplierName }}" height="auto" width="auto" /></td></tr></table>
                                    </div>
                                </td>
                            </tr>
                            </tr>
                            <tr>
                                <td>Estimated Monthly Usage:</td>
                                <td>
                                    <div>
                                        <div>{{ number_format($current_tariffs -> G -> units / 12) }}kwh*</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Unit Rate:</td>
                                <td>
                                    <div>
                                        <div>{{ number_format($current_gas_price_per_unit, 2) }}p*</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Standing Charge:</td>
                                <td>
                                    <div>
                                        <div>{{ number_format($current_gas_standing_charge_daily, 2) }}p per day*</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2">Electricity</th>
                                <td rowspan="4" style="vertical-align: bottom; padding-bottom: 20px;">
                                    <div class="current-supplier-logo">
                                        <table class="form-table"><tr><td style="padding: 0px;"><img src="{{ asset('img/supplier-logos/' . $current_tariffs -> E -> supplierName . '.png') }}" alt="{{ $current_tariffs -> E -> supplierName }}" height="auto" width="auto" /></td></tr></table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Estimated Monthly Usage:</td>
                                <td>
                                    <div>
                                        <div>{{ number_format($current_tariffs -> E -> units / 12) }}kwh*</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Unit Rate:</td>
                                <td>
                                    <div>
                                        <div>{{ number_format($current_elec_price_per_unit, 2) }}p*</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Standing Charge:</td>
                                <td>
                                    <div>
                                        <div>{{ number_format($current_elec_standing_charge_daily, 2) }}p per day*</div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-3 col-12 no-padding d-flex align-items-center justify-content-center">
                        <p style="font-size: 20px; border-right: solid 4px #202020; padding-right: 20px;">
                            <span style="font-size: 44px;">&pound;{{ number_format($current_estimated_bill / 12, 2) }}</span> 
                            <br />
                            per month
                        </p>
                        <p style="font-size: 20px; padding-left: 20px;">
                            @if ($current_tariffs -> G -> contractLength > 0)
                                {{ $current_tariffs -> G -> contractLength }} month contract
                            @else
                                Variable length<br />contract
                            @endif
                        </p>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
@if (count($new_tariffs) == 0)
    <div style="position: relative;">
        <div class="white-rounded-container-positioned"></div>
        <div class="container rounded-container white-rounded-container">
            <table class="form-table"><tr><td>Sorry, but no matching tariffs were found.</td></tr></table>
        </div>
    </div>
@else
    @foreach($new_tariffs as $row)
        <?php
            $unit_rate_gas_percent = (100 * $row["tariff_info"] -> price1Gas / $current_gas_price_per_unit) - 50;
            if ($unit_rate_gas_percent > 100) $unit_rate_gas_percent = 100;
            $unit_rate_elec_percent = (100 * $row["tariff_info"] -> price1Elec / $current_elec_price_per_unit) - 50;
            if ($unit_rate_elec_percent > 100) $unit_rate_elec_percent = 100;
            
            $new_gas_standing_charge_daily_percent = (100 * $row["tariff_info"] -> standingChargeGas / 365 / $current_gas_standing_charge_daily) - 50;
            if ($new_gas_standing_charge_daily_percent > 100) $new_gas_standing_charge_daily_percent = 100;
            $new_elec_standing_charge_daily_percent = (100 * $row["tariff_info"] -> standingChargeGas / 365 / $current_elec_standing_charge_daily) - 50;
            if ($new_elec_standing_charge_daily_percent > 100) $new_elec_standing_charge_daily_percent = 100;
        ?>
        <div style="position: relative;">
            <div class="white-rounded-container-positioned"></div>
            <div class="container rounded-container white-rounded-container no-padding">
                <div class="row">
                    <div class="col-12 col-lg-3" style="font-size: 16px; padding: 20px">
                        <img class="new-supplier-logo" src="{{ asset('img/supplier-logos/' . $row['imageName']) }}" alt="{{ $row['supplierName'] }}" height="auto" width="auto" /><br />
                        <p>{{ $row["tariffName"] }}</p>
                        <p>Estimated Annual Saving: &pound;{{ number_format($row["saving"], 2) }}*</p>
                        <p class="no-padding font-weight-normal">
                            @if ($row["contractLength"] > 0)
                                Fixed month contract: <br /><span style="color: #00c2cb; font-weight: 700;">{{ $row["contractLength"] }} months </span>
                            @else
                                variable length<br />contract
                            @endif
                        </p>
                        <p class="font-weight-normal">
                            Early exit fee: <span style="color: hsl(10, 100%, 40%); font-weight: 700;">&pound;{{ $row["exitPenaltyAmount"] }}</span>
                        </p>
                    </div>
                    <div class="col-12 col-lg-2">
                        @if (strlen($row["tariff_info"] -> features) > 0)
                            <p>
                                @foreach (explode(",", $row["tariff_info"] -> features) as $feature)
                                    <div class="tariff-feature">{{ $feature }}</div><br />
                                @endforeach
                            </p>
                        @endif
                    </div>
                    <div class="col-12 col-lg-3 d-flex justify-content-center align-items-center" style="border-left: 2px solid #202020; border-right: 2px solid #202020">
                        <div class="text-center w-100">
                            <div>Estimated cost:</div> 
                            <div style="font-size: 40px;">&pound;{{ number_format($row["bill"] / 12, 2) }}* </div>
                            <div>per month</div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <table class="form-table table-block-on-mobile">
                            <tr>
                                <td colspan="2">
                                    <table class="table-tariff table-block-on-mobile">
                                        <tr><th>Gas</th></tr>
                                        <tr>
                                            <td>Unit Rate:</td>
                                            <td>
                                                <div>
                                                    <div>{{ number_format($row["tariff_info"] -> price1Gas, 2) }}p</div>
                                                </div> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Standing Charge:</td>
                                            <td>
                                                <div>
                                                    <div>{{ number_format($row["tariff_info"] -> standingChargeGas / 365, 2) }}p per day</div>
                                                </div> 
                                            </td>
                                        </tr>
                                        <tr><th style="padding-top: 15px;">Electricity</th></tr>
                                        <tr>
                                            <td>Unit Rate:</td>
                                            <td>
                                                <div>
                                                    <div>{{ number_format($row["tariff_info"] -> price1Elec, 2) }}p</div>
                                                </div> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Standing Charge:</td>
                                            <td>
                                                <div>
                                                    <div>{{ number_format($row["tariff_info"] -> standingChargeElec / 365, 2) }}p per day</div>
                                                </div> 
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right;">
                                    @include('energy-comparison.partials.switch-form')
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif