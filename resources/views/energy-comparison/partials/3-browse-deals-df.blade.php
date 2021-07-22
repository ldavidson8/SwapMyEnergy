{{-- One Supplier --}}
<?php
    $current_estimated_bill = $current_tariffs -> G -> bill + $current_tariffs -> E -> bill;
?>

<div class="row form-top-outer" style="border-right: 2px solid #202020; border-left: 2px solid #202020; border-top: 2px solid #202020;">
    <div class="col-12 col-lg-4 form-top-heading form-top-left-heading form-top-left-border-md">
        <table class="form-table"><tr><td>Step 3 | Browse Deals</td></tr></table>
    </div>
    <div class="flex-fill form-top-heading form-top-middle-heading" style="border-left: none;">
        <table class="form-table"><tr><td>Current Tariff</td></tr></table>
    </div>
</div>
<div class="blue-rounded-container" style="text-align: center;">
    @if (count($new_tariffs) > 0 && $new_tariffs[0]["saving"] > 0)
        <p class="estimated-annual-energy-costs-banner-white">Switching with us today, you will save up to &pound;{{ number_format($new_tariffs[0]["saving"], 2) }} per year!</p>
    @endif
    <p class="estimated-annual-energy-costs-banner">
        Your estimated annual energy costs for the past 12 months are &pound;{{ number_format($current_estimated_bill, 2) }}
    </p>
</div>
<div id="sticky-toggle-marker-close"></div>
<div id="sticky-existing-tariff" class="container rounded-container blue-rounded-container" style="z-index: 10;">
    <div class="row no-padding">
        <div class="col-lg-6 col-12">
            <table class="form-table table-tariff table-block-on-mobile" style="vertical-align: bottom;">
                <tr>
                    <th rowspan="3">Gas</th>
                    <td>Estimated Monthly Usage:</td>
                    <td><div>{{ number_format($current_tariffs -> G -> units / 12) }}kwh</div></td>
                </tr>
                <tr>
                    <td>Unit Rate:</td>
                    <td>{{ number_format($current_tariffs -> G -> pricePerUnit, 2) }}p</td>
                </tr>
                <tr>
                    <td>Standing Charge:</td>
                    <td>{{ number_format($current_tariffs -> G -> standingChargeDaily, 2) }}p per day</td>
                </tr>
                <tr>
                    <th rowspan="4">Electrictiy</th>
                    <td>Estimated Monthly Usage:</td>
                    <td>{{ number_format($current_tariffs -> E -> units / 12) }}kwh</td>
                </tr>
                <tr>
                    <td>Unit Rate:</td>
                    <td>{{ number_format($current_tariffs -> E -> pricePerUnit, 2) }}p</td>
                </tr>
                @if ($current_tariffs -> E -> e7 == true)
                    <tr>
                        <td>E7 Unit Rate:</td>
                        <td>{{ number_format($current_tariffs -> E -> priceE7PerUnit, 2) }}p</td>
                    </tr>
                @else
                    <tr><td style="padding: 0px;"></td><td style="padding: 0px;"></td></tr>
                @endif
                <tr>
                    <td>Standing Charge:</td>
                    <td>{{ number_format($current_tariffs -> E -> standingChargeDaily, 2) }}p per day</td>
                </tr>
            </table>
        </div>
        <div class="col-lg-4 col-12 d-flex flex-row flex-lg-column align-items-center justify-content-center mt-4 mt-lg-0">
            <p class="existing-tariff-monthly-bill">
                <span style="font-size: 44px;">&pound;{{ number_format($current_estimated_bill / 12, 2) }}</span> 
                <br />
                per month
            </p>
            <p class="existing-tariff-contract-length">
                @if ($current_tariffs -> G -> contractLength > 0)
                    {{ $current_tariffs -> G -> contractLength }} month contract
                @else
                    Variable length<br />contract
                @endif
            </p>
        </div>
        <div class="col-lg-2 col-12 existing-supplier-logo no-padding">
            <table class="form-table"><tr><td><img src="{{ asset('img/supplier-logos/' . $current_tariffs -> G -> supplierName . '.png') }}" alt="{{ $current_tariffs -> G -> supplierName }}" style="border-radius: 0 0 20px 0; max-width: 100%; max-height: 100%;" width="auto" height="auto"></td></tr></table>
        </div>
    </div>
    <div id="sticky-toggle-tab-close" class="sticky-toggle-tab"><span class="fas fa-angle-up"></span></div>
</div>
<div id="sticky-none" style="z-index: 9; color: #202020;">
    <div id="sticky-toggle-tab-open" class="sticky-toggle-tab"><span class="fas fa-angle-down"></span></div>
</div>
<div id="sticky-toggle-marker-open"></div>
@if (count($new_tariffs) == 0)
    <div style="position: relative;">
        <div class="white-rounded-container-positioned"></div>
        <div class="container rounded-container white-rounded-container">
            <table class="form-table"><tr><td>Sorry, but no matching tariffs were found.</td></tr></table>
        </div>
    </div>
@else
    @foreach($new_tariffs as $row)
        <div style="position: relative;">
            <div class="inverted-rounded-corner-1"></div>
            <div class="inverted-rounded-corner-2"></div>
            <div class="container rounded-container white-rounded-container no-padding">
                <div class="row">
                    <div class="col-12 col-lg-2" style="font-size: 17px; padding: 20px;">
                        <img class="new-supplier-logo" src="{{ asset('img/supplier-logos/' . $row['imageName']) }}" alt="{{ $row['supplierName'] }}" height="auto" width="auto" /><br />
                        <p>{{ $row["tariffName"] }}</p>
                        
                        @if ($row["saving"] > 0)
                            <p>Estimated Annual Saving: &pound;{{ number_format($row["saving"], 2) }}</p>
                        @endif
                        
                        <p class="no-padding font-weight-normal">
                            @if ($row["contractLength"] > 0)
                                Fixed month contract: <br /><span style="color: #070; font-weight: 700;">{{ $row["contractLength"] }} months</span>
                            @else
                                variable length<br />contract
                            @endif
                        </p>
                        <p>
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
                    <div class="col-12 col-lg-3 d-flex new-tariff-estimated-cost justify-content-center align-items-center">
                        <div class="text-center w-100">
                            @if (isset($existing_tariff -> consumption_figures) && $existing_tariff -> consumption_figures == "estimate")
                                <div style="font-size: 16px; line-height: 1.2em; font-weight: normal; padding-bottom: 7px;">
                                    This estimated cost is based on estimated figures.
                                    For more accurate results, <a href="{{ url() -> previous() }}">go back</a> and enter your bill in pounds or your energy usage in kwh.
                                </div>
                            @endif
                            <div>Estimated cost:</div>
                            <div style="font-size: 40px;">&pound;{{ number_format($row["bill"] / 12, 2) }} </div>
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
                                            <td>{{ number_format($row["tariff_info"] -> price1Gas, 2) }}p</td>
                                        </tr>
                                        <tr>
                                            <td>Standing Charge:</td>
                                            <td>{{ number_format($row["tariff_info"] -> standingChargeGas / 365, 2) }}p per day</td>
                                        </tr>
                                        <tr><th style="padding-top: 15px;">Electricity</th></tr>
                                        <tr>
                                            <td>Unit Rate:</td>
                                            <td>{{ number_format($row["tariff_info"] -> price1Elec, 2) }}p</td>
                                        </tr>
                                        @if ($row["e7"])
                                            <tr>
                                                <td>E7 Unit Rate:</td>
                                                <td>{{ number_format($row["tariff_info"] -> priceE7, 2) }}p</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Standing Charge:</td>
                                            <td>{{ number_format($row["tariff_info"] -> standingChargeElec / 365, 2) }}p per day</td>
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