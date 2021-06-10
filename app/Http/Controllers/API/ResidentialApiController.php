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
        //return '[{"address":"41TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"41"},{"address":"39TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"39"},{"address":"37TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"37"},{"address":"35TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"35"},{"address":"33TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"33"},{"address":"31TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"31"},{"address":"29TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"29"},{"address":"27TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"27"},{"address":"25TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"25"},{"address":"23TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"23"},{"address":"21TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"21"},{"address":"19TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"19"},{"address":"17TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"17"},{"address":"15TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"15"},{"address":"13TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"13"},{"address":"9TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"9"},{"address":"7TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"7"},{"address":"5TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"5"},{"address":"3TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"3"},{"address":"4TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"4"},{"address":"6TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"6"},{"address":"8TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"8"},{"address":"10TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"10"},{"address":"12TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"12"},{"address":"14TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"14"},{"address":"20TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"20"},{"address":"22TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"22"},{"address":"24TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"24"},{"address":"26TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"26"},{"address":"28TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"28"},{"address":"30TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"30"},{"address":"32TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"32"},{"address":"34TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"34"},{"address":"36TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"36"},{"address":"38TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"38"},{"address":"42TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"42"},{"address":"44TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"44"},{"address":"46TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"46"},{"address":"48TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"48"},{"address":"50TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"50"},{"address":"52TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"52"},{"address":"54TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"54"},{"address":"56TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"56"},{"address":"58TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"58"},{"address":"60TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"60"},{"address":"62TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"62"},{"address":"66TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"66"},{"address":"68TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"68"},{"address":"64TOWER GREENFULWOODPRESTONLANCASHIRE","houseNo":"64"}]';
        
        $response = Repository::addresses($postcode);

        if ($response -> successful())
        {
            $jsonArray = $response -> object();
            if (isset($jsonArray) && count($jsonArray) > 0)
            {
                $json = [];

                foreach ($jsonArray as $row)
                {
                    $lines = [];
                    if ($row -> line1 != "") $lines[] = $row -> line1;
                    if ($row -> line2 != "") $lines[] = $row -> line2;
                    if ($row -> line3 != "") $lines[] = $row -> line3;
                    if ($row -> line4 != "") $lines[] = $row -> line4;
                    if ($row -> line5 != "") $lines[] = $row -> line5;
                    if ($row -> line6 != "") $lines[] = $row -> line6;
                    if ($row -> line7 != "") $lines[] = $row -> line7;
                    if ($row -> line8 != "") $lines[] = $row -> line8;
                    if ($row -> line9 != "") $lines[] = $row -> line9;

                    $addressStr = "";
                    $houseNo = "";
                    foreach ($lines as $line)
                    {
                        $addressStr .= "$line ";
                        if ($houseNo == "" && is_numeric($line)) $houseNo = $line;
                    }

                    $json[] = 
                    [
                        'address' => $addressStr,
                        'houseNo' => $houseNo
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
