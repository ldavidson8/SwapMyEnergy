<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ResidentialApiRepository as Repository;

use Illuminate\Http\Client\Response;

class ResidentialApiController extends Controller
{
    public static function addresses($postcode)
    {
        $result = Repository::addresses($postcode, $status);
        
        if (!isset($result)) return response() -> json([ 'error' => 'An Error Occured' ], $status);
        
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
            $houseName = "";
            foreach ($lines as $line)
            {
                $addressStr .= "$line ";
                if ($houseNo == "" && is_numeric($line)) $houseNo = $line;
                if ($houseName == "" && !is_numeric($line)) $houseName .= " $line";
            }

            $responseArray[] =
            [
                'mpan' => $row -> mpan,
                'address' => $addressStr,
                'houseNo' => $houseNo,
                'houseName' => trim($houseName)
            ];
        }

        return response() -> json($responseArray, $status);
    }
    
    public static function addresses_byHouseNo($postcode, $houseNo)
    {
        $result = Repository::addresses_byHouseNo($postcode, $houseNo, $status);
        
        if (!isset($result)) return response() -> json([ 'error' => 'An Error Occured' ], $status);
        
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
            $houseName = "";
            foreach ($lines as $line)
            {
                $addressStr .= "$line ";
                if ($houseNo == "" && is_numeric($line)) $houseNo = $line;
                if ($houseName == "" && !is_numeric($line)) $houseName .= " $line";
            }

            $responseArray[] =
            [
                'mpan' => $row -> mpan,
                'address' => $addressStr,
                'houseNo' => $row -> line3,
                'houseName' => trim($houseName)
                // inputBillingStreetName.val(row[0].streetName);
                // inputBillingArea.val(row[0].area);
                // inputBillingTown.val(row[0].town);
                // inputBillingCounty.val(row[0].county);
            ];
        }

        return response() -> json($responseArray, $status);
    }
    
    public static function address($postcode, $houseNo)
    {
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
