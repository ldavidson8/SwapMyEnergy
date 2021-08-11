-------------------------------------------------
--- The Energy Shop API - Energy Swap Engaged ---
-------------------------------------------------
@auth

Staff Member: {{ Auth::user() -> name }}
@endauth

{{ $api_key_used }}

The reference is: {{ $result_str }}

The Timestamp is: {{ $dateTime }}


--- Customer Information ---

Title:      {{ $user["title"] }}
First Name: {{ $user["firstName"] }}
Last Name:  {{ $user["lastName"] }}
Telephone:  {{ $user["telephoneNo"] }}
Mobile:     {{ (isset($user["mobileNo"])) ? $user["mobileNo"] : "N/A" }}
Email:      {{ $user["email"] }}
Smart Meter: {{ $user["smartMeter"] }}

--- Customer Address ---
Building Number: {{ $user["currentAddress"]["bldNumber"] }}
Postcode:        {{ $user["currentAddress"]["postcode"] }}
Address Line 1:  {{ $user["currentAddress"]["line1"] }}
Address Line 2:  {{ $user["currentAddress"]["line2"] }}
Road Name:       {{ $user["currentAddress"]["throughfare"] }}
City:            {{ $user["currentAddress"]["town"] }}
County:          {{ $user["currentAddress"]["county"] }}
Years at Residence:  {{ $user["currentAddress"]["yearsAtResidence"] }}
Months at Residence: {{ $user["currentAddress"]["monthsAtResidence"] }}
MPRN:        {{ $user["currentAddress"]["mprn"] }}
MPAN Number: {{ $user["currentAddress"]["mpanNumber"] }}

--- Billing Address ---
Building Number: {{ $user["billingAddress"]["bldNumber"] }}
Postcode:        {{ $user["billingAddress"]["postcode"] }}
Address Line 1:  {{ $user["billingAddress"]["line1"] }}
Address Line 2:  {{ $user["billingAddress"]["line2"] }}
Road Name:       {{ $user["billingAddress"]["throughfare"] }}
City:            {{ $user["billingAddress"]["town"] }}
County:          {{ $user["billingAddress"]["county"] }}

@if (isset($user["previousAddress"]) && $user["previousAddress"]["postcode"] != "")
    --- Previous Address 1 ---
    Building Number: {{ $user["previousAddress"]["bldNumber"] }}
    Postcode:        {{ $user["previousAddress"]["postcode"] }}
    Address Line 1:  {{ $user["previousAddress"]["line1"] }}
    Address Line 2:  {{ $user["previousAddress"]["line2"] }}
    Road Name:       {{ $user["previousAddress"]["throughfare"] }}
    City:            {{ $user["previousAddress"]["town"] }}
    County:          {{ $user["previousAddress"]["county"] }}
    Years at Residence:  {{ $user["previousAddress"]["yearsAtResidence"] }}
    Months at Residence: {{ $user["previousAddress"]["monthsAtResidence"] }}
@endif

@if (isset($user["previousAddressTwo"]) && $user["previousAddressTwo"]["postcode"] != "")
    --- Previous Address 2 ---
    Building Number: {{ $user["previousAddressTwo"]["bldNumber"] }}
    Postcode: {{ $user["previousAddressTwo"]["postcode"] }}
    Address Line 1: {{ $user["previousAddressTwo"]["line1"] }}
    Address Line 2: {{ $user["previousAddressTwo"]["line2"] }}
    Road Name:       {{ $user["previousAddressTwo"]["throughfare"] }}
    City: {{ $user["previousAddressTwo"]["town"] }}
    County: {{ $user["previousAddressTwo"]["county"] }}
    Years at Residence: {{ $user["previousAddressTwo"]["yearsAtResidence"] }}
    Months at Residence: {{ $user["previousAddressTwo"]["monthsAtResidence"] }}
@endif


--- Previous Tariff ---

Service Type: {{ $user["serviceTypeToCompare"] }}

Gas Supplier:          {{ (isset($user["gasSupplier"])) ? $user["gasSupplier"] : 'N/A' }}
Gas Tariff Id:         {{ (isset($user["gasTariffId"])) ? $user["gasTariffId"] : 'N/A' }}
Gas Payment Method:    {{ (isset($user["gasPayment"])) ? $user["gasPayment"] : 'N/A' }}
Gas Comsumption (kwh): {{ (isset($user["currentTariffGasConsumption"])) ? $user["currentTariffGasConsumption"] : 'N/A' }}
Gas Bill:              {{ (isset($user["currentTariffGasBill"])) ? $user["currentTariffGasBill"] : 'N/A' }}

Electric Supplier:          {{ (isset($user["elecSupplier"])) ? $user["elecSupplier"] : 'N/A' }}
Electric Tariff Id:         {{ (isset($user["elecTariffId"])) ? $user["elecTariffId"] : 'N/A' }}
Electric Payment Method:    {{ (isset($user["elecPayment"])) ? $user["elecPayment"] : 'N/A' }}
Electric Comsumption (kwh): {{ (isset($user["currentTariffElecConsumption"])) ? $user["currentTariffElecConsumption"] : 'N/A' }}
Electric Bill:              {{ (isset($user["currentTariffElecBill"])) ? $user["currentTariffElecBill"] : 'N/A' }}

E7:             {{ $user["E7"] }}
E7 Usage (kwh): {{ $user["e7Usage"] }}


--- New Tariff ---

Supplier Name: {{ $user["newSupplierName"] }}
Tariff Id:     {{ $user["tariffId"] }}
Total Bill:    £{{ $user["bill"] }}
Gas Bill:      £{{ $user["billGas"] }}
Electric Bill: £{{ $user["billElec"] }}
Saving:        £{{ $user["saving"] }} ({{ $user["savingPercentage"] }}%)

--- Payment ---
Payment Method: {{ $payment["paymentMethod"] }}
Receive Bills: {{ $payment["receiveBills"] }}
Supplier Email Opt In: {{ ($payment["supplierOptIn"]) ? "True" : "False" }}
Supplier Letter Opt In: {{ ($payment["supplierLetterOptIn"]) ? "True" : "False" }}
Supplier Phone Opt In: {{ ($payment["supplierPhoneOptIn"]) ? "True" : "False" }}
Supplier Text Opt In: {{ ($payment["supplierTextOptIn"]) ? "True" : "False" }}
Special Needs / Priority Services Register (PSR) Opt In: {{ ($payment["specialNeeds"]) ? "True" : "False" }}
