@extends('_emails.layouts.master')

@section('main-content')
    <style>
        body { font-size: 16px; }
        td { font-weight: normal; }
    </style>

    <h1>The Energy Shop API - Energy Swap Engaged</h1>
    <p>{{ $api_key_used }}</p>
    <p>The reference is: {{ $result_str }}</p>

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
                <th>City:</th>
                <td>{{ $user["currentAddress"]["town"] }}</td>
            </tr>
            <tr>
                <th>County:</th>
                <td>{{ $user["currentAddress"]["county"] }}</td>
            </tr>
        </tbody>
    </table>
    
    <h2>Billing Address</h2>
    <table>
        <tbody>
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
                <th>City:</th>
                <td>{{ $user["billingAddress"]["town"] }}</td>
            </tr>
            <tr>
                <th>County:</th>
                <td>{{ $user["billingAddress"]["county"] }}</td>
            </tr>
        </tbody>
    </table>
    
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
                <th>Total Bill:</th>
                <td>&pound;{{ $user["bill"] }}</td>
            </tr>
            <tr>
                <th>Gas Bill:</th>
                <td>&pound;{{ $user["billGas"] }}</td>
            </tr>
            <tr>
                <th>Electric Bill:</th>
                <td>&pound;{{ $user["billElec"] }}</td>
            </tr>
            <tr>
                <th>Saving:</th>
                <td>&pound;{{ $user["saving"] }} ({{ $user["savingPercentage"] }}%)</td>
            </tr>
        </tbody>
    </table>
@endsection