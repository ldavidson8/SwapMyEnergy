<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ResidentialApiRepository extends Controller
{
    // TODO: Cleaned - uncomment
    protected static function _apiUrl() { return env("API_URL"); }
    protected static function _apiKey() { return env("API_KEY"); }


    /// Addresses ///

    public static function addresses($postcode, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . 'addresses?postcode=' . $postcode);
        return self::getOneObject($response, $status);
    }

    public static function addresses_byHouseNo($postcode, $houseNo, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . 'addresses?postcode=' . $postcode . '&houseNo=' . $houseNo);
        return self::getOneObject($response, $status);
    }

    public static function addresses_mpandetails($mpan, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "addresses/mpandetails?mpan=$mpan");
        return self::getOneObject($response, $status);
    }

    public static function addresses_mprn($postcode, $houseNo, $houseName = null, &$status = 200)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "addresses/mprn?postcode=$postcode&houseNo=$houseNo&houseName=$houseName");
        return self::getOneObject($response, $status);
    }

    public static function addresses_mprndetails($mprn, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "addresses/mprndetails?mprn=$mprn");
        return self::getOneObject($response, $status);
    }


    /// Regions ///

    public static function regionsByPostcode($postcode, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "regions/postcode?postcode=$postcode");
        return self::getManyObjects($response, $status);
    }

    public static function regionsByPostcodeAndMpan($postcode, $mpan, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "regions/postcode?postcode=$postcode&mpan=$mpan");
        return self::getManyObjects($response, $status);
    }


    /// Suppliers ///

    public static function suppliers(&$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "suppliers");
        $suppliers = self::getManyObjects($response, $status);
        return $suppliers;
    }

    public static function supplierById($supplierId, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "suppliers/$supplierId");
        return self::getOneObject($response, $status);
    }

    public static function suppliersByRegion($regionId, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "suppliers/region/$regionId");
        $suppliers = self::getManyObjects($response, $status);
        return $suppliers;
    }

    public static function paymentMethods_suppliers($supplierId, $serviceType, $e7, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "paymentMethods/suppliers/$supplierId?serviceType=$serviceType&e7=$e7");
        return self::getManyObjects($response, $status);
    }


    /// Tarrifs ///

    public static function tariffs_info_by_id($tariffId, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "tariffs/$tariffId/info");
        return self::getOneObject($response, $status);
    }

    public static function tariffs_defaultForASupplier($supplierId, $serviceType, $paymentMethod, $e7, $regionId, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "tariffs/suppliers/{$supplierId}/default?serviceType=$serviceType&paymentMethod=$paymentMethod&e7=$e7&regionId=$regionId");
        return self::getOneObject($response, $status);
    }

    public static function tariffs_forASuppllier($supplierId, $regionId, $serviceType, $paymentMethod, $e7, &$statusLive, &$statusPreserved)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "tariffs/suppliers/$supplierId?regionId=$regionId&serviceType=$serviceType&paymentMethod=$paymentMethod&e7=$e7");
        $object = self::getManyObjects($response, $statusLive);
        return $object;
    }

    public static function tariffs_current($gas_tariff, $electricity_tariff, $fuel_type_char, $fuel_type_str, $consumption_figures, $gas, $elec, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> post(self::_apiUrl() . "tariffs/current", array(
            "currentGasTariff" => $gas_tariff,
            "currentElectricityTariff" => $electricity_tariff,
            "serviceTypeToCompare" => $fuel_type_char,
            "currentServiceType" => $fuel_type_str,
            "energyUsage" =>
            [
                "consumptionFigures" => $consumption_figures,
                "annualGasConsumption" => $gas,
                "annualElecConsumption" => $elec
            ]
        ));
        return self::getOneObject($response, $status);
    }

    public static function tariffs_results($gas_tariff, $electricity_tariff, $fuel_type_char, $fuel_type_str, $consumption_figures, $gas, $elec, $e7_usage, $home_mover, $preferred_payment_method, $show_only_apply_tariff, $features, $postcode, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> post(self::_apiUrl() . "tariffs/results", array(
            "currentGasTariff" => $gas_tariff,
            "currentElectricityTariff" => $electricity_tariff,
            "serviceTypeToCompare" => $fuel_type_char,
            "currentServiceType" => $fuel_type_str,
            "energyUsage" =>
            [
                "consumptionFigures" => $consumption_figures,
                "annualGasConsumption" => $gas,
                "annualElecConsumption" => $elec,
                "e7Usage" => $e7_usage
            ],
            "homeMover" => $home_mover,
            "preferredPaymentMethod" => $preferred_payment_method,
            "showOnlyApplyTariff" => $show_only_apply_tariff,
            "features" => $features,
            "postcode" => $postcode
        ));
        return self::getManyObjects($response, $status);
    }


    /// Features ///

    public static function features(&$status)
    {
        $response = Http::withHeaders(['Authorization' => self::_apiKey()]) -> get(self::_apiUrl() . "features");
        return self::getOneObject($response, $status);
    }

    public static function features_by_tariff_ids(array $tariff_ids, &$status)
    {
        $ids_string = "";
        for ($i = 0; $i < count($tariff_ids); $i++)
        {
            if ($i > 0) $ids_string .= ",";
            $ids_string .= $tariff_ids[$i];
        }
        $response = Http::withHeaders(['Authorization' => self::_apiKey()]) -> get(self::_apiUrl() . "features/tariffs?tariffIds=" . $ids_string);
        return self::getOneObject($response, $status);
    }



    /// Process an Application ///

    public static function applications_processapplication($data, &$status)
    {
        $response = Http::withHeaders(['Authorization' => self::_apiKey()]) -> post(self::_apiUrl() . "applications/processapplication", $data);
        return $response;
        return self::getOneObject($response, $status);
    }


    public static function getOneObject(Response $response, &$status)
    {
        $status = $response -> status();
        if ($response -> successful())
        {
            $object = $response -> object();
            if (isset($object)) return $object;
            return null;
        }
        return null;
    }

    public static function getManyObjects(Response $response, &$status)
    {
        if ($response -> successful())
        {
            $results = $response -> collect() -> toArray();
            if (isset($results) && count($results) > 0)
            {
                $status = $response -> status();
                return $results;
            }

            $status = 204;
            return null;
        }

        $status = $response -> status();
        return null;
    }
}
