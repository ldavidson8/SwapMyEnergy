<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ResidentialApiRepository extends Controller implements IResidentialAPI
{
    protected const _apiUrl = "https://api.theenergyshop.co.uk/api/v1/";
    protected const _apiKey = "0468AFBE-AB78-4A23-BBB7-CD6597B8EE5E";


    public static function addresses($postcode)
    {
        return Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . 'addresses?postcode=' . $postcode);
    }
    
    public static function addresses_mprn($postcode, $houseNo, $houseName = null)
    {
        return Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . "addresses/mprn?postcode=$postcode&houseNo=$houseNo&houseName=$houseName");
    }
    
    public static function addresses_mprndetails($mprn)
    {
        return Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . "addresses/mprndetails?mprn=$mprn");
    }

    public static function suppliers()
    {
        return Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . "suppliers");
    }

    public static function supplierById($supplierId)
    {
        return Http::withHeaders([ 'Authorization' => self::_apiKey ]) -> get(self::_apiUrl . "suppliers/$supplierId");
    }


    public static function testOne()
    {
        return Http::withHeaders([ 'Authorization' => self::_apiKey ])
            -> get(self::_apiUrl . "addresses?postcode=PR1 9UU");
    }

    public static function testMany()
    {
        return Http::withHeaders([ 'Authorization' => self::_apiKey ])
            -> get(self::_apiUrl . "suppliers");
    }
}

// TODO: make all requests post requests for csrf protection
