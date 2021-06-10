<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ResidentialApiRepository as Repository;
use App\Models\API\AddressBasic;

use Illuminate\Http\Client\Response;

class ResidentialApiController extends Controller implements IResidentialAPI
{
    public static function addresses($postcode)
    {
        return '[{"mpan":"1610013330162","address":"64 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330171","address":"68 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330180","address":"66 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330190","address":"62 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330205","address":"60 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330214","address":"58 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330223","address":"56 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330232","address":"54 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330241","address":"52 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330250","address":"50 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330260","address":"48 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330279","address":"46 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330288","address":"44 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330297","address":"42 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330302","address":"38 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330311","address":"36 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330320","address":"34 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330330","address":"32 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330349","address":"30 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330358","address":"28 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330367","address":"26 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330376","address":"24 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330385","address":"22 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330394","address":"20 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330400","address":"14 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330419","address":"12 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330428","address":"10 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330437","address":"8 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330446","address":"6 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330455","address":"4 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330464","address":"3 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330473","address":"5 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330482","address":"7 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330491","address":"9 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330507","address":"13 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330516","address":"15 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330525","address":"17 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330534","address":"19 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330543","address":"21 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330552","address":"23 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330561","address":"25 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330570","address":"27 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330580","address":"29 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330599","address":"31 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330604","address":"33 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330613","address":"35 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330622","address":"37 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330631","address":"39 TOWER GREEN FULWOOD PRESTON LANCASHIRE "},{"mpan":"1610013330640","address":"41 TOWER GREEN FULWOOD PRESTON LANCASHIRE "}]';
        
        $response = Repository::addresses($postcode);

        if ($response -> successful())
        {
            $jsonArray = $response -> object();
            if (isset($jsonArray) && count($jsonArray) > 0)
            {
                $json = [];

                foreach ($jsonArray as $row)
                {
                    $addressStr = "";
                    if ($row -> line1 != "") $addressStr .= $row -> line1 . " ";
                    if ($row -> line2 != "") $addressStr .= $row -> line2 . " ";
                    if ($row -> line3 != "") $addressStr .= $row -> line3 . " ";
                    if ($row -> line4 != "") $addressStr .= $row -> line4 . " ";
                    if ($row -> line5 != "") $addressStr .= $row -> line5 . " ";
                    if ($row -> line6 != "") $addressStr .= $row -> line6 . " ";
                    if ($row -> line7 != "") $addressStr .= $row -> line7 . " ";
                    if ($row -> line8 != "") $addressStr .= $row -> line8 . " ";
                    if ($row -> line9 != "") $addressStr .= $row -> line9 . " ";
                    $json[] = 
                    [
                        'mpan' => $row -> mpan,
                        'address' => $addressStr
                    ];
                }

                return response() -> json($json, $response -> status());
            }
            return response() -> json([ 'message' => 'No Content' ], status: 204);
        }
        return response() -> json([ 'error' => 'An Error Occured' ], $response -> status());
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
