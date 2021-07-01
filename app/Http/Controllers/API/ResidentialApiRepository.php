<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ResidentialApiRepository extends Controller
{
    protected static function _apiUrl() { return env("API_URL"); }
    protected static function _apiKey() { return env("API_KEY"); }

    
    /// Addresses ///

    public static function addresses($postcode, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . 'addresses?postcode=' . $postcode);
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

    public static function regionsByPostcode($postcode, $mpan, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "regions/postcode?postcode=$postcode&mpan=$mpan");
        return self::getManyObjects($response, $status);
    }

    
    /// Suppliers ///
    
    public static function suppliers(&$status)
    {
        // if (Session::has('suppliers'))
        // {
        //     $suppliers = Session::get('suppliers');
        //     if (isset($suppliers) && count($suppliers) >= 0)
        //     {
        //         $status = 200;
        //         return $suppliers;
        //     }
        // }
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "suppliers");
        $suppliers = self::getManyObjects($response, $status);
        // Session::put('suppliers', $suppliers);
        return $suppliers;
    }

    public static function supplierById($supplierId, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "suppliers/$supplierId");
        return self::getOneObject($response, $status);
    }

    public static function suppliersByRegion($regionId, &$status)
    {
        // if (Session::has('suppliersByRegion'))
        // {
        //     $suppliers = Session::get('suppliersByRegion');
        //     if (isset($suppliers) && count($suppliers) >= 0)
        //     {
        //         $status = 200;
        //         return $suppliers;
        //     }
        // }
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "suppliers/region/$regionId");
        $suppliers = self::getManyObjects($response, $status);
        // Session::put('suppliersByRegion', $suppliers);
        return $suppliers;
    }

    public static function paymentMethods_suppliers($supplierId, $serviceType, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "paymentMethods/suppliers/$supplierId?serviceType=$serviceType");
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
        $response1 = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "tariffs/suppliers/$supplierId?regionId=$regionId&serviceType=$serviceType&paymentMethod=$paymentMethod&e7=$e7&preservedTariff=L");
        $response2 = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "tariffs/suppliers/$supplierId?regionId=$regionId&serviceType=$serviceType&paymentMethod=$paymentMethod&e7=$e7&preservedTariff=P");
        
        $liveObject = self::getManyObjects($response1, $statusLive);
        $preservedObject = self::getManyObjects($response2, $statusPreserved);

        if (isset($liveObject) && isset($preservedObject))
        return array_merge($liveObject, $preservedObject);
    }
    
    public static function tariffs_current($gas_tariff, $electricity_tariff, $fuel_type_char, $fuel_type_str, $gas_kwh, $elec_kwh, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> post(self::_apiUrl() . "tariffs/current", array(
            "currentGasTariff" => $gas_tariff,
            "currentElectricityTariff" => $electricity_tariff,
            "serviceTypeToCompare" => $fuel_type_char,
            "currentServiceType" => $fuel_type_str,
            "energyUsage" =>
            [
                "consumptionFigures" => "kwh",
                "annualGasConsumption" => $gas_kwh,
                "annualElecConsumption" => $elec_kwh
            ]
        ));
        return self::getOneObject($response, $status);
    }

    public static function tariffs_results($gas_tariff, $electricity_tariff, $fuel_type_char, $fuel_type_str, $gas_kwh, $elec_kwh, $e7_usage, $home_mover, $preferred_payment_method, $show_only_apply_tariff, $features, $postcode, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> post(self::_apiUrl() . "tariffs/results", array(
            "currentGasTariff" => $gas_tariff,
            "currentElectricityTariff" => $electricity_tariff,
            "serviceTypeToCompare" => $fuel_type_char,
            "currentServiceType" => $fuel_type_str,
            "energyUsage" =>
            [
                "consumptionFigures" => "kwh",
                "annualGasConsumption" => $gas_kwh,
                "annualElecConsumption" => $elec_kwh,
                "e7Usage" => $e7_usage
            ],
            "homeMover" => false,
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


    public static function testOne()
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "addresses?postcode=PR1 9UU");
    }

    public static function testMany()
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey() ]) -> get(self::_apiUrl() . "paymentMethods/suppliers/68?serviceType=G&e7=false");
        return self::getManyObjects($response, $status);
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

// TODO: make all requests post requests for csrf protection
