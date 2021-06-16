<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ResidentialApiRepository extends Controller
{
    protected const _apiUrl = "https://api.theenergyshop.co.uk/api/v1/";
    protected const _apiKey = "0468AFBE-AB78-4A23-BBB7-CD6597B8EE5E";


    public static function addresses($postcode, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . 'addresses?postcode=' . $postcode);
        return self::getOneObject($response, $status);
    }
    
    public static function addresses_mprn($postcode, $houseNo, $houseName = null, &$status = 200)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . "addresses/mprn?postcode=$postcode&houseNo=$houseNo&houseName=$houseName");
        return self::getOneObject($response, $status);
    }
    
    public static function addresses_mprndetails($mprn, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . "addresses/mprndetails?mprn=$mprn");
        return self::getOneObject($response, $status);
    }

    public static function suppliers(&$status)
    {
        if (Session::has('suppliers'))
        {
            $suppliers = Session::get('suppliers');
            if (isset($suppliers) && count($suppliers) >= 0)
            {
                $status = 200;
                return $suppliers;
            }
        }
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . "suppliers");
        $suppliers = self::getManyObjects($response, $status);
        Session::put('suppliers', $suppliers);
        return $suppliers;
    }

    public static function supplierById($supplierId, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . "suppliers/$supplierId");
        return self::getOneObject($response, $status);
    }

    public static function paymentMethods_suppliers($supplierId, $serviceType, &$status)
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . "paymentMethods/suppliers/$supplierId?serviceType=$serviceType");
        return self::getManyObjects($response, $status);
    }


    public static function testOne()
    {
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . "addresses?postcode=PR1 9UU");
    }

    public static function testMany()
    {
        // $response = Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . "paymentMethods");
        $response = Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . "paymentMethods/suppliers/68?serviceType=G&e7=false");
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
