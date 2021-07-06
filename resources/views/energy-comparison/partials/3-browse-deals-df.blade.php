<?php
    $current_gas_price_per_unit = $current_tariffs -> G -> pricePerUnit;
    $current_gas_standing_charge_daily = $current_tariffs -> G -> standingChargeDaily;
    $current_elec_price_per_unit = $current_tariffs -> E -> pricePerUnit;
    $current_elec_standing_charge_daily = $current_tariffs -> E -> standingChargeDaily;

    $current_estimated_bill = $current_tariffs -> G -> bill + $current_tariffs -> E -> bill;
?>

<div class="row form-top-outer">
    <div class="col-12 col-lg-4 form-top-heading form-top-left-heading form-top-left-border-md">
        <table class="form-table"><tr><td>Step 3 | Browse Deals</td></tr></table>
    </div>
    <div class="flex-fill form-top-heading form-top-middle-heading">
        <table class="form-table"><tr><td>Current Tariff</td></tr></table>
    </div>
    <div class="no-padding form-top-img form-top-img-border-sm form-top-img-border-md" style="color: #202020;">
        <table class="form-table"><tr><td><img src="{{ asset('img/supplier-logos/' . $current_tariffs -> G -> supplierName . '.png') }}" alt="{{ $current_tariffs -> G -> supplierName }}" height="auto" width="auto" /></td></tr></table>
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
                    <div class="col-lg-8 col-12 no-padding">
                        <table class="table-tariff table-block-on-mobile" style=" vertical-align: bottom;">
                            <tr><th>Gas</th></tr>
                            <tr>
                                <td>Estimated Monthly Usage:</td>
                                <td>
                                    <div class="white-progress-bar">
                                        <div class="white-progress-bar-text" style="color: #202020;">{{ number_format($current_tariffs -> G -> units / 12) }}kwh*</div>
                                        <div class="blue-progress-bar" style="width: 100%;"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Unit Rate:</td>
                                <td>
                                    <div class="white-progress-bar">
                                        <div class="white-progress-bar-text" style="color: #202020;">{{ number_format($current_gas_price_per_unit, 2) }}p*</div>
                                        <div class="blue-progress-bar" style="width: 100%;"></div>  
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Standing Charge:</td>
                                <td>
                                    <div class="white-progress-bar">
                                        <div class="white-progress-bar-text" style="color: #202020;">{{ number_format($current_gas_standing_charge_daily, 2) }}p per day*</div>
                                        <div class="blue-progress-bar" style="width: 100%"></div>  
                                    </div>
                                </td>
                            </tr>
                            <tr><th style="padding-top: 15px;">Electricity</th></tr>
                            <tr>
                                <td>Estimated Monthly Usage:</td>
                                <td>
                                    <div class="white-progress-bar">
                                        <div class="white-progress-bar-text" style="color: #202020;">{{ number_format($current_tariffs -> E -> units / 12) }}kwh*</div>
                                        <div class="blue-progress-bar" style="width: 100%;"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Unit Rate:</td>
                                <td>
                                    <div class="white-progress-bar">
                                        <div class="white-progress-bar-text" style="color: #202020;">{{ number_format($current_elec_price_per_unit, 2) }}p*</div>
                                        <div class="blue-progress-bar" style="width: 100%;"></div>  
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Standing Charge:</td>
                                <td>
                                    <div class="white-progress-bar">
                                        <div class="white-progress-bar-text" style="color: #202020;">{{ number_format($current_elec_standing_charge_daily, 2) }}p per day*</div>
                                        <div class="blue-progress-bar" style="width: 100%"></div>  
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4 col-12 no-padding">
                        <table class="form-table pricing-text" style="width: 100%;"">
                            {{-- <tr>
                                <td colspan="2" style="vertical-align: bottom;">
                                    <p style="font-size: 16px;">*compared to regional averages</p>
                                </td>
                            </tr> --}}
                            <tr style="height: 100%;"></tr>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <p style="font-size: 20px; text-align: center; border-right: solid 2px #f3f2f1;">
                                        <span style="font-size: 34px;">&pound;{{ number_format($current_estimated_bill / 12, 2) }}</span> 
                                        <br />
                                        per month
                                    </p>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <p style="font-size: 20px;">
                                        @if ($current_tariffs -> G -> contractLength > 0)
                                            {{ $current_tariffs -> G -> contractLength }} month contract
                                        @else
                                            variable length<br />contract
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        </table>
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
            <div class="container rounded-container white-rounded-container">
                <div class="row">
                    <div class="col-12 col-lg-3 no-padding" style="font-size: 16px; padding: 0px 10px 0px 0px !important;">
                        <img class="new-supplier-logo" src="{{ asset('img/supplier-logos/' . $row['imageName']) }}" alt="{{ $row['supplierName'] }}" height="auto" width="auto" /><br />
                        <p>{{ $row["tariffName"] }}</p>
                        <p style="border-bottom: solid 2px black; padding: 5px;">
                            <span style="font-size: 34px;">&pound;{{ number_format($row["bill"] / 12, 2) }}* </span><br />per month
                        </p>
                        <p>Estimated Annual Saving: &pound;{{ number_format($row["saving"], 2) }}*</p>
                        <p class="no-padding">
                            @if ($row["contractLength"] > 0)
                                {{ $current_tariffs -> G -> contractLength }} month contract
                            @else
                                variable length<br />contract
                            @endif
                        </p>
                        @if (strlen($row["tariff_info"] -> features) > 0)
                            <p style="border-top: solid 2px black;">
                                @foreach (explode(",", $row["tariff_info"] -> features) as $feature)
                                    <div>{{ $feature }}</div>
                                @endforeach
                            </p>
                        @endif
                    </div>
                    <div class="col-12 col-lg-9 no-padding">
                        <table class="form-table table-block-on-mobile">
                            <tr>
                                <td colspan="2">
                                    <table class="table-tariff table-block-on-mobile">
                                        <tr><th>Gas</th></tr>
                                        <tr>
                                            <td>Unit Rate:</td>
                                            <td>
                                                <div class="white-progress-bar-border">
                                                    <div class="white-progress-bar-border-text">{{ $row["tariff_info"] -> price1Gas }}p</div>
                                                    <div class="blue-progress-bar" style="width: {{ number_format($unit_rate_gas_percent, 2) }}%;"></div>  
                                                </div> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Standing Charge:</td>
                                            <td>
                                                <div class="white-progress-bar-border">
                                                    <div class="white-progress-bar-border-text">{{ number_format($row["tariff_info"] -> standingChargeGas / 365, 2) }}p per day</div>
                                                    <div class="blue-progress-bar" style="width: {{ number_format($new_gas_standing_charge_daily_percent, 2) }}%;"></div>
                                                </div> 
                                            </td>
                                        </tr>
                                        <tr><th style="padding-top: 15px;">Electricity</th></tr>
                                        <tr>
                                            <td>Unit Rate:</td>
                                            <td>
                                                <div class="white-progress-bar-border">
                                                    <div class="white-progress-bar-border-text">{{ $row["tariff_info"] -> price1Elec }}p</div>
                                                    <div class="blue-progress-bar" style="width: {{ number_format($unit_rate_elec_percent, 2) }}%;"></div>  
                                                </div> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Standing Charge:</td>
                                            <td>
                                                <div class="white-progress-bar-border">
                                                    <div class="white-progress-bar-border-text">{{ number_format($row["tariff_info"] -> standingChargeElec / 365, 2) }}p per day</div>
                                                    <div class="blue-progress-bar" style="width: {{ number_format($new_elec_standing_charge_daily_percent, 2) }}%;"></div>
                                                </div> 
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    &pound;{{ $row["exitPenaltyAmount"] }} exit fee <br />
                                    <span style="font-size: 16px">*calculated based on your existing usage </span>
                                </td>
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