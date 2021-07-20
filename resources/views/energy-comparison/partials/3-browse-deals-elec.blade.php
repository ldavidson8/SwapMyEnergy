<?php
    $current_price_per_unit = $current_tariffs -> E -> pricePerUnit;
    $current_standing_charge_daily = $current_tariffs -> E -> standingChargeDaily;
?>

<div class="row form-top-outer" style="border-right: 2px solid #202020; border-left: 2px solid #202020;">
    <div class="col-12 col-lg-4 form-top-heading form-top-left-heading form-top-left-border-md">
        <table class="form-table"><tr><td>Step 3 | Browse Deals</td></tr></table>
    </div>
    <div class="flex-fill form-top-heading form-top-middle-heading">
        <table class="form-table"><tr><td>Current Tariff</td></tr></table>
    </div>
    <div class="no-padding form-top-img form-top-img-border-sm form-top-img-border-md" style="color: #202020;">
        <table class="form-table"><tr><td><img src="{{ asset('img/supplier-logos/' . $current_tariffs -> E -> supplierName . '.png') }}" alt="{{ $current_tariffs -> E -> supplierName }}" height="auto" width="auto" /></td></tr></table>
    </div>
</div>
<div class="container rounded-container blue-rounded-container">
    <table class="form-table">
        <tr>
            <td>
                <div style="text-align: center;">
                    <p class="estimated-annual-energy-costs-banner">
                        Your estimated annual energy costs for the past 12 months are &pound;{{ number_format($current_tariffs -> E -> bill, 2) }}
                    </p>
                </div>
                <div class="row no-padding">
                    <div class="col-lg-7 col-12">
                        <table class="table-tariff table-block-on-mobile" style=" vertical-align: bottom;">
                            <tr>
                                <td>
                                    Estimated Monthly Usage:
                                </td>
                                <td>
                                        <div>{{ number_format($current_tariffs -> E -> units / 12) }}kwh*</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Unit Rate:
                                </td>
                                <td>
                                        <div>{{ number_format($current_price_per_unit, 2) }}p*</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Standing Charge:
                                </td>
                                <td>
                                        <div>{{ number_format($current_standing_charge_daily, 2) }}p per day*</div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-5 col-12 no-padding d-flex align-items-center justify-content-center mt-5 mt-lg-0">
                        <p style="font-size: 20px; border-right: solid 4px #202020; padding-right: 20px;">
                            <span style="font-size: 44px;">&pound;{{ number_format($current_tariffs -> E -> bill / 12, 2) }}</span> 
                            <br />
                            per month
                        </p>
                        <p style="font-size: 20px; padding-left: 20px;">
                            @if ($current_tariffs -> E -> contractLength > 0)
                                {{ $current_tariffs -> E -> contractLength }} month contract
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
            $unit_rate_1_percent = (100 * $row["tariff_info"] -> price1Elec / $current_price_per_unit) - 50;
            if ($unit_rate_1_percent > 100) $unit_rate_1_percent = 100;
            
            $new_standing_charge_daily_percent = (100 * $row["tariff_info"] -> standingChargeElec / 365 / $current_standing_charge_daily) - 50;
            if ($new_standing_charge_daily_percent > 100) $new_standing_charge_daily_percent = 100;
        ?>
        <div style="position: relative;">
            <div class="inverted-rounded-corner-1"></div>
            <div class="inverted-rounded-corner-2"></div>
            <div class="container rounded-container white-rounded-container no-padding">
                <div class="row">
                    <div class="col-12 col-lg-3" style="font-size: 17px; padding: 20px;">
                        <img class="new-supplier-logo" src="{{ asset('img/supplier-logos/' . $row['imageName']) }}" alt="{{ $row['supplierName'] }}" height="auto" width="auto" /><br />
                        <p>{{ $row["tariffName"] }}</p>
                        <p>Estimated Annual Saving: &pound;{{ number_format($row["saving"], 2) }}*</p>
                        <p class="no-padding font-weight-normal">
                            @if ($row["contractLength"] > 0)
                                Fixed month contract: <br /> <span style="color: #070; font-weight: 700;">{{ $row["contractLength"] }} months </span>
                            @else
                                variable length<br />contract
                            @endif
                        </p>
                        <p class="font-weight-normal">
                            Early exit fee: <span style="color: hsl(10, 100%, 40%) font-weight: 700;">&pound;{{ $row["exitPenaltyAmount"] }}</span>
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
                    <div class="col-12 col-lg-3 d-flex justify-content-center align-items-center" style="background: #00c2cb; color: #f3f2f1;">
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
                                        <tr>
                                            <td>
                                                Unit Rate:
                                            </td>
                                            <td>
                                                    <div>{{ number_format($row["tariff_info"] -> price1Elec, 2) }}p</div>
                                                </div> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Standing Charge:
                                            </td>
                                            <td>
                                                    <div>{{ number_format($row["tariff_info"] -> standingChargeElec / 365, 2) }}p per day</div>
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