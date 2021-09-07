<?php

namespace App\Repository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ResidentialAPICompletedDataRepository
{
    public static function Insert($requestObj, $current_timestamp, $api_key_used, $reference_number, $swapmyenergy_opt_in, $affiliateToken)
    {
        try
        {
            $user = $requestObj['user'];
            $payment = $requestObj['payment'];

            $previous_address = isset($user['previousAddress']) && $user['previousAddress']['postcode'] != "";
            $previous_address_2 = isset($user['previousAddressTwo']) && $user['previousAddressTwo']['postcode'] != "";

            return DB::select('call Insert_ResidentialAPICompletedData(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                $affiliateToken,
                (!Auth::guest()) ? Auth::user() -> name : null,
                (!Auth::guest()) ? Auth::user() -> email : null,
                $api_key_used,
                $reference_number,
                $current_timestamp,
                0, // ($swapmyenergy_opt_in) ? 1 : 0,

                $user['title'],
                $user['firstName'],
                $user['lastName'],
                $user['telephoneNo'],
                (isset($user['mobileNo'])) ? $user['mobileNo'] : null,
                $user['email'],
                ($user['smartMeter']) ? 1 : 0,

                $user['currentAddress']['bldNumber'],
                $user['currentAddress']['postcode'],
                $user['currentAddress']['line1'],
                $user['currentAddress']['line2'],
                $user['currentAddress']['throughfare'],
                $user['currentAddress']['town'],
                (isset($user['currentAddress']['county'])) ? $user['currentAddress']['county'] : "",
                $user['currentAddress']['yearsAtResidence'],
                $user['currentAddress']['monthsAtResidence'],
                $user['currentAddress']['mprn'],
                $user['currentAddress']['mpanNumber'],

                ($user['sameCurrentAddress']) ? 1 : 0,
                $user['billingAddress']['bldNumber'],
                $user['billingAddress']['postcode'],
                $user['billingAddress']['line1'],
                (isset($user['billingAddress']['line2'])) ? $user['billingAddress']['line2'] : "",
                $user['billingAddress']['throughfare'],
                $user['billingAddress']['town'],
                (isset($user['billingAddress']['county'])) ? $user['billingAddress']['county'] : "",

                ($previous_address) ? $user['previousAddress']['bldNumber'] : null,
                ($previous_address) ? $user['previousAddress']['postcode'] : null,
                ($previous_address) ? $user['previousAddress']['line1'] : null,
                ($previous_address) ? $user['previousAddress']['line2'] : null,
                ($previous_address) ? $user['previousAddress']['throughfare'] : null,
                ($previous_address) ? $user['previousAddress']['town'] : null,
                ($previous_address) ? $user['previousAddress']['county'] : null,
                ($previous_address) ? $user['previousAddress']['yearsAtResidence'] : null,
                ($previous_address) ? $user['previousAddress']['monthsAtResidence'] : null,

                ($previous_address_2) ? $user['previousAddressTwo']['bldNumber'] : null,
                ($previous_address_2) ? $user['previousAddressTwo']['postcode'] : null,
                ($previous_address_2) ? $user['previousAddressTwo']['line1'] : null,
                ($previous_address_2) ? $user['previousAddressTwo']['line2'] : null,
                ($previous_address_2) ? $user['previousAddressTwo']['throughfare'] : null,
                ($previous_address_2) ? $user['previousAddressTwo']['town'] : null,
                ($previous_address_2) ? $user['previousAddressTwo']['county'] : null,
                ($previous_address_2) ? $user['previousAddressTwo']['yearsAtResidence'] : null,
                ($previous_address_2) ? $user['previousAddressTwo']['monthsAtResidence'] : null,

                $user['serviceTypeToCompare'],
                (isset($user['gasSupplier'])) ? $user['gasSupplier'] : null,
                (isset($user['gasTariffId'])) ? $user['gasTariffId'] : null,
                (isset($user['gasPayment'])) ? $user['gasPayment'] : null,
                (isset($user['currentTariffGasBill'])) ? $user['currentTariffGasBill'] : null,
                (isset($user['currentTariffGasConsumption'])) ? $user['currentTariffGasConsumption'] : null,
                (isset($user['elecSupplier'])) ? $user['elecSupplier'] : null,
                (isset($user['elecTariffId'])) ? $user['elecTariffId'] : null,
                (isset($user['elecPayment'])) ? $user['elecPayment'] : null,
                (isset($user['currentTariffElecBill'])) ? $user['currentTariffElecBill'] : null,
                (isset($user['currentTariffElecConsumption'])) ? $user['currentTariffElecConsumption'] : null,
                ($user['E7']) ? 1 : 0,
                $user['e7Usage'],

                $user['newSupplierName'],
                $user['tariffId'],
                $user['tariffPosition'],
                $user['bill'],
                ($user['billGas'] > 0) ? $user['billGas'] : null,
                ($user['billElec'] > 0) ? $user['billElec'] : null,
                $user['saving'],
                $user['savingPercentage'],

                $payment['paymentMethod'],
                $payment['receiveBills'],
                $payment['supplierOptIn'] ? 1 : 0,
                $payment['supplierLetterOptIn'] ? 1 : 0,
                $payment['supplierPhoneOptIn'] ? 1 : 0,
                $payment['supplierTextOptIn'] ? 1 : 0,
                $payment['specialNeeds'] ? 1 : 0
            ]);
        }
        catch (Throwable $th)
        {
            report($th);
            $error_message = $th -> getMessage();
            Log::channel('energy-comparison/get-switching-post') -> error('ResidentialAPICompletedDataRepository -> Insert(), try catch DB, Error saving the data to the database  -:-  ' . $th -> getMessage(), compact('requestObj', 'current_timestamp', 'result_mode', 'result_str', 'swapmyenergy_opt_in', 'affiliateToken', 'th', 'error_message'));
        }
    }
}
