<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ResidentialApiRepository as Repository;
use Illuminate\Http\Client\Response;

class ResidentialApiController extends Controller implements IResidentialAPI
{
    public static function addresses($postcode)
    {
        $response = Repository::addresses($postcode);
        return self::getMany($response);
    }
    
    public static function addresses_mprn($postcode, $houseNo, $houseName = null)
    {
        $response = Repository::addresses_mprn($postcode, $houseNo, $houseName);
        return self::getOne($response);
    }
    
    public static function addresses_mprndetails($mprn)
    {
        $response = Repository::addresses_mprndetails($mprn);
        return self::getOne($response);
    }

    public static function suppliers()
    {
        $response = Repository::suppliers();
        return self::getMany($response);
    }

    public static function supplierById($supplierId)
    {
        $response = Repository::supplierById($supplierId);
        return self::getOne($response);
    }


    public static function testOne()
    {
        $response = Repository::testOne();
        return self::getOne($response);
    }

    public static function testMany()
    {
        $response = Repository::testMany();
        return self::getMany($response);
    }
    

    public static function getOne(Response $response)
    {
        if ($response -> successful())
        {
            $jsonArray = $response -> json();
            if (isset($jsonArray))
            {
                return response() -> json($jsonArray, $response -> status());
            }
            return response() -> json([ 'message' => 'No Content' ], status: 204);
        }
        return response() -> json([ 'error' => 'An Error Occured' ], $response -> status());
    }

    public static function getMany(Response $response)
    {
        if ($response -> successful())
        {
            $jsonArray = $response -> json();
            if (isset($jsonArray) && count($jsonArray) > 0)
            {
                return response() -> json($jsonArray, $response -> status());
            }
            return response() -> json([ 'message' => 'No Content' ], status: 204);
        }
        return response() -> json([ 'error' => 'An Error Occured' ], $response -> status());
    }
}

// return response() -> json(
// [
//     'successful' => $response -> successful(),
//     'ok' => $response -> ok(),
//     'redirect' => $response -> redirect(),
//     'failed' => $response -> failed(),
//     'clientError' => $response -> clientError(),
//     'serverError' => $response -> serverError(),
//     'json' => $response -> json()
// ]);

// TODO: make all requests post requests for csrf protection
