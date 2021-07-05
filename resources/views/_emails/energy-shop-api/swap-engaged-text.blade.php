-------------------------------------------------
--- The Energy Shop API - Energy Swap Engaged ---
-------------------------------------------------

{{ $api_key_used }}

The reference is: {{ $result_str }}


--- Customer Information ---

Title:      {{ $user["title"] }}
First Name: {{ $user["firstName"] }}
Last Name:  {{ $user["lastName"] }}
Telephone:  {{ $user["telephoneNo"] }}
Mobile:     {{ (isset($user["mobileNo"])) ? $user["mobileNo"] : "N/A" }}
Email:      {{ $user["email"] }}
Smart Meter: {{ $user["smartMeter"] }}

--- Customer Address ---
Postcode: {{ $user["currentAddress"]["postcode"] }}
Address Line 1: {{ $user["currentAddress"]["line1"] }}
Address Line 2: {{ $user["currentAddress"]["line2"] }}
City: {{ $user["currentAddress"]["town"] }}
County: {{ $user["currentAddress"]["county"] }}

--- Billing Address ---
Postcode: {{ $user["billingAddress"]["postcode"] }}
Address Line 1: {{ $user["billingAddress"]["line1"] }}
Address Line 2: {{ $user["billingAddress"]["line2"] }}
City: {{ $user["billingAddress"]["town"] }}
County: {{ $user["billingAddress"]["county"] }}


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
Total Bill:    &pound;{{ $user["bill"] }}
Gas Bill:      &pound;{{ $user["billGas"] }}
Electric Bill: &pound;{{ $user["billElec"] }}
Saving:        &pound;{{ $user["saving"] }} ({{ $user["savingPercentage"] }}%)

