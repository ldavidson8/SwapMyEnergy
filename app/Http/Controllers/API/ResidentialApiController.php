<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ResidentialApiRepository as Repository;

use Illuminate\Http\Client\Response;

class ResidentialApiController extends Controller
{
    public static function addresses($postcode)
    {
        $obj = json_decode('[{"address":"64 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"64"},{"address":"68 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"68"},{"address":"66 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"66"},{"address":"62 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"62"},{"address":"60 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"60"},{"address":"58 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"58"},{"address":"56 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"56"},{"address":"54 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"54"},{"address":"52 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"52"},{"address":"50 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"50"},{"address":"48 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"48"},{"address":"46 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"46"},{"address":"44 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"44"},{"address":"42 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"42"},{"address":"38 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"38"},{"address":"36 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"36"},{"address":"34 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"34"},{"address":"32 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"32"},{"address":"30 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"30"},{"address":"28 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"28"},{"address":"26 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"26"},{"address":"24 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"24"},{"address":"22 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"22"},{"address":"20 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"20"},{"address":"14 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"14"},{"address":"12 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"12"},{"address":"10 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"10"},{"address":"8 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"8"},{"address":"6 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"6"},{"address":"4 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"4"},{"address":"3 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"3"},{"address":"5 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"5"},{"address":"7 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"7"},{"address":"9 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"9"},{"address":"13 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"13"},{"address":"15 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"15"},{"address":"17 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"17"},{"address":"19 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"19"},{"address":"21 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"21"},{"address":"23 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"23"},{"address":"25 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"25"},{"address":"27 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"27"},{"address":"29 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"29"},{"address":"31 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"31"},{"address":"33 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"33"},{"address":"35 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"35"},{"address":"37 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"37"},{"address":"39 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"39"},{"address":"41 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"41"}]');
        return response() -> json($obj);
        
        $result = Repository::addresses($postcode, $status);

        if (isset($result))
        {
            $responseArray = [];

            foreach ($result as $row)
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

                $responseArray[] =
                [
                    'address' => $addressStr,
                    'houseNo' => $houseNo
                ];
            }

            return response() -> json($responseArray, $status);
        }
        return response() -> json([ 'error' => 'An Error Occured' ], $status);
    }
    
    public static function addresses_mprn($postcode, $houseNo, $houseName = null)
    {
        $result = Repository::addresses_mprn($postcode, $houseNo, $houseName, $status);
        return response() -> json($result, $status);
    }
    
    public static function addresses_mprndetails($mprn)
    {
        $result = Repository::addresses_mprndetails($mprn, $status);
        return response() -> json($result, $status);
    }

    public static function suppliers()
    {
        $result = Repository::suppliers($status);
        return response() -> json($result, $status);
    }

    public static function supplierById($supplierId)
    {
        $result = Repository::supplierById($supplierId, $status);
        return response() -> json($result, $status);
    }

    public static function paymentMethods_suppliers($supplierId, $serviceType)
    {
        $result = Repository::paymentMethods_suppliers($supplierId, $serviceType, $status);
        return response() -> json($result, $status);
    }
    

    public static function testOne()
    {
        $result = Repository::testOne();
        return response() -> json($result);
    }

    public static function testMany()
    {
        $result = Repository::testMany();
        return response() -> json($result);
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
