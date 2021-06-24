<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ResidentialApiRepository as Repository;

use Illuminate\Http\Client\Response;

class ResidentialApiController extends Controller
{
    public static function addresses($postcode)
    {
        // $obj = json_decode('[{"mpan":"1610013330640","address":"41 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"41"},{"mpan":"1610013330631","address":"39 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"39"},{"mpan":"1610013330622","address":"37 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"37"},{"mpan":"1610013330613","address":"35 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"35"},{"mpan":"1610013330604","address":"33 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"33"},{"mpan":"1610013330599","address":"31 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"31"},{"mpan":"1610013330580","address":"29 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"29"},{"mpan":"1610013330570","address":"27 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"27"},{"mpan":"1610013330561","address":"25 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"25"},{"mpan":"1610013330552","address":"23 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"23"},{"mpan":"1610013330543","address":"21 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"21"},{"mpan":"1610013330534","address":"19 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"19"},{"mpan":"1610013330525","address":"17 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"17"},{"mpan":"1610013330516","address":"15 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"15"},{"mpan":"1610013330507","address":"13 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"13"},{"mpan":"1610013330491","address":"9 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"9"},{"mpan":"1610013330482","address":"7 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"7"},{"mpan":"1610013330473","address":"5 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"5"},{"mpan":"1610013330464","address":"3 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"3"},{"mpan":"1610013330455","address":"4 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"4"},{"mpan":"1610013330446","address":"6 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"6"},{"mpan":"1610013330437","address":"8 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"8"},{"mpan":"1610013330428","address":"10 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"10"},{"mpan":"1610013330419","address":"12 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"12"},{"mpan":"1610013330400","address":"14 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"14"},{"mpan":"1610013330394","address":"20 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"20"},{"mpan":"1610013330385","address":"22 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"22"},{"mpan":"1610013330376","address":"24 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"24"},{"mpan":"1610013330367","address":"26 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"26"},{"mpan":"1610013330358","address":"28 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"28"},{"mpan":"1610013330349","address":"30 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"30"},{"mpan":"1610013330330","address":"32 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"32"},{"mpan":"1610013330320","address":"34 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"34"},{"mpan":"1610013330311","address":"36 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"36"},{"mpan":"1610013330302","address":"38 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"38"},{"mpan":"1610013330297","address":"42 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"42"},{"mpan":"1610013330288","address":"44 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"44"},{"mpan":"1610013330279","address":"46 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"46"},{"mpan":"1610013330260","address":"48 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"48"},{"mpan":"1610013330250","address":"50 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"50"},{"mpan":"1610013330241","address":"52 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"52"},{"mpan":"1610013330232","address":"54 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"54"},{"mpan":"1610013330223","address":"56 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"56"},{"mpan":"1610013330214","address":"58 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"58"},{"mpan":"1610013330205","address":"60 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"60"},{"mpan":"1610013330190","address":"62 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"62"},{"mpan":"1610013330180","address":"66 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"66"},{"mpan":"1610013330171","address":"68 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"68"},{"mpan":"1610013330162","address":"64 TOWER GREEN FULWOOD PRESTON LANCASHIRE ","houseNo":"64"}]');
        // return response() -> json($obj);
        
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
                    'mpan' => $row -> mpan,
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

    public static function suppliersByRegion($regionId)
    {
        $result = Repository::suppliersByRegion($regionId, $status);
        return response() -> json($result, $status);
    }

    public static function paymentMethods_suppliers($supplierId, $serviceType)
    {
        $result = Repository::paymentMethods_suppliers($supplierId, $serviceType, $status);
        return response() -> json($result, $status);
    }

    public static function tariffs_forASuppllier($supplierId, $regionId, $serviceType, $paymentMethod, $e7)
    {
        $result = Repository::tariffs_forASuppllier($supplierId, $regionId, $serviceType, $paymentMethod, $e7, $statusLive, $statusPresereved);
        return response() -> json($result, $statusLive);
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
