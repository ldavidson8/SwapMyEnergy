@extends('_emails.layouts.master')

@section('main-content')
    <style>
        body { font-size: 16px; }
        td { font-weight: normal; }
    </style>

    <h1>The Energy Shop API - Energy Swap Engaged</h1>
    @auth
        <p>Staff Name: {{ Auth::user() -> name }}</p>
        <p>Staff Email: {{ Auth::user() -> email }}</p>
    @endauth
    <p>{{ $api_key_used }}</p>
    <p>The reference is: {{ $result_str }}</p>
    <p>The Timestamp is: {{ $dateTime }}</p>
    @if ($swapmyenergy_opt_in)
        <p>The user opted into SwapMyEnergy marketing.</p>
    @else
        <p>The user did NOT opt into SwapMyEnergy marketing.</p>
    @endif

    <h2>Customer Info</h2>
    <table>
        <tbody>
            <tr>
                <th>Title:</th>
                <td>{{ $user["title"] }}</td>
            </tr>
            <tr>
                <th>First Name:</th>
                <td>{{ $user["firstName"] }}</td>
            </tr>
            <tr>
                <th>Last Name:</th>
                <td>{{ $user["lastName"] }}</td>
            </tr>
            <tr>
                <th>Telephone:</th>
                <td>{{ $user["telephoneNo"] }}</td>
            </tr>
            <tr>
                <th>Mobile:</th>
                <td>{{ (isset($user["mobileNo"])) ? $user["mobileNo"] : "N/A" }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $user["email"] }}</td>
            </tr>
            <tr>
                <th>Smart Meter:</th>
                <td>{{ $user["smartMeter"] }}</td>
            </tr>
        </tbody>
    </table>

    <h2>Customer Address</h2>
    <table>
        <tbody>
            <tr>
                <th>Building Number:</th>
                <td>{{ $user["currentAddress"]["bldNumber"] }}</td>
            </tr>
            <tr>
                <th>Postcode:</th>
                <td>{{ $user["currentAddress"]["postcode"] }}</td>
            </tr>
            <tr>
                <th>Address Line 1:</th>
                <td>{{ $user["currentAddress"]["line1"] }}</td>
            </tr>
            <tr>
                <th>Address Line 2:</th>
                <td>{{ $user["currentAddress"]["line2"] }}</td>
            </tr>
            <tr>
                <th>Road Name:</th>
                <td>{{ $user["currentAddress"]["throughfare"] }}</td>
            </tr>
            <tr>
                <th>City:</th>
                <td>{{ $user["currentAddress"]["town"] }}</td>
            </tr>
            <tr>
                <th>County:</th>
                <td>{{ $user["currentAddress"]["county"] }}</td>
            </tr>
            <tr>
                <th>Years at Residence:</th>
                <td>{{ $user["currentAddress"]["yearsAtResidence"] }}</td>
            </tr>
            <tr>
                <th>Months at Residence:</th>
                <td>{{ $user["currentAddress"]["monthsAtResidence"] }}</td>
            </tr>
            <tr>
                <th>MPRN:</th>
                <td>{{ $user["currentAddress"]["mprn"] }}</td>
            </tr>
            <tr>
                <th>MPAN Number:</th>
                <td>{{ $user["currentAddress"]["mpanNumber"] }}</td>
            </tr>
        </tbody>
    </table>

    <h2>Billing Address</h2>
    @if ($user["sameCurrentAddress"])
        <p>The billing address is the same as the current address.</p>
    @else
        <p>The billing address is different to the current address.</p>
    @endif
    <table>
        <tbody>
            <tr>
                <th>Building Number:</th>
                <td>{{ $user["billingAddress"]["bldNumber"] }}</td>
            </tr>
            <tr>
                <th>Postcode:</th>
                <td>{{ $user["billingAddress"]["postcode"] }}</td>
            </tr>
            <tr>
                <th>Address Line 1:</th>
                <td>{{ $user["billingAddress"]["line1"] }}</td>
            </tr>
            <tr>
                <th>Address Line 2:</th>
                <td>{{ $user["billingAddress"]["line2"] }}</td>
            </tr>
            <tr>
                <th>Road Name:</th>
                <td>{{ $user["billingAddress"]["throughfare"] }}</td>
            </tr>
            <tr>
                <th>City:</th>
                <td>{{ $user["billingAddress"]["town"] }}</td>
            </tr>
            <tr>
                <th>County:</th>
                <td>{{ $user["billingAddress"]["county"] }}</td>
            </tr>
        </tbody>
    </table>

    {{-- previous address 1 --}}
    @if (isset($user["previousAddress"]) && $user["previousAddress"]["postcode"] != "")
        <h2>Previous Address 1</h2>
        <table>
            <tbody>
                <tr>
                    <th>Building Number:</th>
                    <td>{{ $user["previousAddress"]["bldNumber"] }}</td>
                </tr>
                <tr>
                    <th>Postcode:</th>
                    <td>{{ $user["previousAddress"]["postcode"] }}</td>
                </tr>
                <tr>
                    <th>Address Line 1:</th>
                    <td>{{ $user["previousAddress"]["line1"] }}</td>
                </tr>
                <tr>
                    <th>Address Line 2:</th>
                    <td>{{ $user["previousAddress"]["line2"] }}</td>
                </tr>
                <tr>
                    <th>Road Name:</th>
                    <td>{{ $user["previousAddress"]["throughfare"] }}</td>
                </tr>
                <tr>
                    <th>City:</th>
                    <td>{{ $user["previousAddress"]["town"] }}</td>
                </tr>
                <tr>
                    <th>County:</th>
                    <td>{{ $user["previousAddress"]["county"] }}</td>
                </tr>
                <tr>
                    <th>Years at Residence:</th>
                    <td>{{ $user["previousAddress"]["yearsAtResidence"] }}</td>
                </tr>
                <tr>
                    <th>Months at Residence:</th>
                    <td>{{ $user["previousAddress"]["monthsAtResidence"] }}</td>
                </tr>
            </tbody>
        </table>
    @endif

    {{-- previous address 2 --}}
    @if (isset($user["previousAddressTwo"]) && $user["previousAddressTwo"]["postcode"] != "")
        <h2>Previous Address 2</h2>
        <table>
            <tbody>
                <tr>
                    <th>Building Number:</th>
                    <td>{{ $user["previousAddressTwo"]["bldNumber"] }}</td>
                </tr>
                <tr>
                    <th>Postcode:</th>
                    <td>{{ $user["previousAddressTwo"]["postcode"] }}</td>
                </tr>
                <tr>
                    <th>Address Line 1:</th>
                    <td>{{ $user["previousAddressTwo"]["line1"] }}</td>
                </tr>
                <tr>
                    <th>Address Line 2:</th>
                    <td>{{ $user["previousAddressTwo"]["line2"] }}</td>
                </tr>
                <tr>
                    <th>Road Name:</th>
                    <td>{{ $user["previousAddressTwo"]["throughfare"] }}</td>
                </tr>
                <tr>
                    <th>City:</th>
                    <td>{{ $user["previousAddressTwo"]["town"] }}</td>
                </tr>
                <tr>
                    <th>County:</th>
                    <td>{{ $user["previousAddressTwo"]["county"] }}</td>
                </tr>
                <tr>
                    <th>Years at Residence:</th>
                    <td>{{ $user["previousAddressTwo"]["yearsAtResidence"] }}</td>
                </tr>
                <tr>
                    <th>Months at Residence:</th>
                    <td>{{ $user["previousAddressTwo"]["monthsAtResidence"] }}</td>
                </tr>
            </tbody>
        </table>
    @endif

    <h2>Previous Tariff</h2>
    <table>
        <tbody>
            <tr>
                <th>Service Type:</th>
                <td>{{ $user["serviceTypeToCompare"] }}</td>
            </tr>
            <tr>
                <th>Gas Supplier:</th>
                <td>{{ (isset($user["gasSupplier"])) ? $user["gasSupplier"] : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Gas Tariff Id:</th>
                <td>{{ (isset($user["gasTariffId"])) ? $user["gasTariffId"] : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Gas Payment Method:</th>
                <td>{{ (isset($user["gasPayment"])) ? $user["gasPayment"] : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Gas Comsumption (kwh):</th>
                <td>{{ (isset($user["currentTariffGasConsumption"])) ? $user["currentTariffGasConsumption"] : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Gas Bill:</th>
                <td>{{ (isset($user["currentTariffGasBill"])) ? $user["currentTariffGasBill"] : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Electric Supplier:</th>
                <td>{{ (isset($user["elecSupplier"])) ? $user["elecSupplier"] : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Electric Tariff Id:</th>
                <td>{{ (isset($user["elecTariffId"])) ? $user["elecTariffId"] : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Electric Payment Method:</th>
                <td>{{ (isset($user["elecPayment"])) ? $user["elecPayment"] : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Electric Comsumption (kwh):</th>
                <td>{{ (isset($user["currentTariffElecConsumption"])) ? $user["currentTariffElecConsumption"] : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Electric Bill:</th>
                <td>{{ (isset($user["currentTariffElecBill"])) ? $user["currentTariffElecBill"] : 'N/A' }}</td>
            </tr>
            <tr>
                <th>E7:</th>
                <td>{{ $user["E7"] }}</td>
            </tr>
            <tr>
                <th>E7 Usage (kwh):</th>
                <td>{{ $user["e7Usage"] }}</td>
            </tr>
        </tbody>
    </table>

    <h2>New Tariff</h2>
    <table>
        <tbody>
            <tr>
                <th>Supplier Name:</th>
                <td>{{ $user["newSupplierName"] }}</td>
            </tr>
            <tr>
                <th>Tariff Id:</th>
                <td>{{ $user["tariffId"] }}</td>
            </tr>
            <tr>
                <th>Tariff Position:</th>
                <td>{{ $user["tariffPosition"] }}</td>
            </tr>
            <tr>
                <th>Total Bill:</th>
                <td>&pound;{{ $user["bill"] }}</td>
            </tr>
            @if ($user["billGas"] > 0)
                <tr>
                    <th>Gas Bill:</th>
                    <td>&pound;{{ $user["billGas"] }}</td>
                </tr>
            @endif
            @if ($user["billElec"] > 0)
                <tr>
                    <th>Electric Bill:</th>
                    <td>&pound;{{ $user["billElec"] }}</td>
                </tr>
            @endif
            <tr>
                <th>Saving:</th>
                <td>&pound;{{ $user["saving"] }} ({{ $user["savingPercentage"] }}%)</td>
            </tr>
        </tbody>
    </table>

    <h2>Payment</h2>
    <table>
        <tbody>
            <tr>
                <th>Payment Method:</th>
                <td>{{ $payment["paymentMethod"] }}</td>
            </tr>
            <tr>
                <th>Receive Bills:</th>
                <td>{{ $payment["receiveBills"] }}</td>
            </tr>
            <tr>
                <th>Supplier Email Opt In:</th>
                <td>{{ ($payment["supplierOptIn"]) ? "True" : "False" }}</td>
            </tr>
            <tr>
                <th>Supplier Letter Opt In:</th>
                <td>{{ ($payment["supplierLetterOptIn"]) ? "True" : "False" }}</td>
            </tr>
            <tr>
                <th>Supplier Phone Opt In:</th>
                <td>{{ ($payment["supplierPhoneOptIn"]) ? "True" : "False" }}</td>
            </tr>
            <tr>
                <th>Supplier Text Opt In:</th>
                <td>{{ ($payment["supplierTextOptIn"]) ? "True" : "False" }}</td>
            </tr>
            <tr>
                <th>Special Needs / Priority Services Register (PSR) Opt In:</th>
                <td>{{ ($payment["specialNeeds"]) ? "True" : "False" }}</td>
            </tr>
        </tbody>
    </table>

    @include('_emails.footer')
@endsection
