<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ResidentialApiRepository as Repository;
use Throwable;

class ResidentialApiController extends Controller
{
    public static function addresses($postcode)
    {
        try
        {
            // TODO: Cleaned uncomment
            $result = Repository::addresses($postcode, $status);

            // TODO: Cleaned comment
            // $status = 200;
            // $result = json_decode('[{"line1":"","line2":"","line3":"3","line4":"","line5":"TOWER GREEN","line6":"","line6":"FULWOOD","line7":"PRESTON","line8":"","line9":"LANCASHIRE","mpan":12345678},{"line1":"","line2":"","line3":"5","line4":"","line5":"TOWER GREEN","line6":"","line6":"FULWOOD","line7":"PRESTON","line8":"","line9":"LANCASHIRE","mpan":12345678},{"line1":"","line2":"","line3":"6","line4":"","line5":"TOWER GREEN","line6":"","line6":"FULWOOD","line7":"PRESTON","line8":"","line9":"LANCASHIRE","mpan":12345678},{"line1":"","line2":"","line3":"7","line4":"","line5":"TOWER GREEN","line6":"","line6":"FULWOOD","line7":"PRESTON","line8":"","line9":"LANCASHIRE","mpan":12345678},{"line1":"","line2":"","line3":"8","line4":"","line5":"TOWER GREEN","line6":"","line6":"FULWOOD","line7":"PRESTON","line8":"","line9":"LANCASHIRE","mpan":12345678},{"line1":"","line2":"","line3":"2","line4":"","line5":"TOWER GREEN","line6":"","line6":"FULWOOD","line7":"PRESTON","line8":"","line9":"LANCASHIRE","mpan":12345678},{"line1":"","line2":"","line3":"20","line4":"","line5":"TOWER GREEN","line6":"","line6":"FULWOOD","line7":"PRESTON","line8":"","line9":"LANCASHIRE","mpan":12345678},{"line1":"","line2":"","line3":"10","line4":"","line5":"TOWER GREEN","line6":"","line6":"FULWOOD","line7":"PRESTON","line8":"","line9":"LANCASHIRE","mpan":12345678},{"line1":"","line2":"","line3":"56","line4":"","line5":"TOWER GREEN","line6":"","line6":"FULWOOD","line7":"PRESTON","line8":"","line9":"LANCASHIRE","mpan":12345678},{"line1":"","line2":"","line3":"64","line4":"","line5":"TOWER GREEN","line6":"","line6":"FULWOOD","line7":"PRESTON","line8":"","line9":"LANCASHIRE","mpan":12345678}]');

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

            try
            {
                usort($responseArray, function($a, $b) { return strnatcmp($a["address"], $b["address"]); });
            }
            catch (Throwable $th)
            {
                report($th);
            }

            return response() -> json($responseArray, $status);
        }
        catch (Throwable $th)
        {
            report($th);
            throw($th);
        }
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

    public static function paymentMethods_suppliers($supplierId, $serviceType, $e7)
    {
        $result = Repository::paymentMethods_suppliers($supplierId, $serviceType, $e7, $status);
        return response() -> json($result, $status);
    }

    public static function tariffs_forASuppllier($supplierId, $regionId, $serviceType, $paymentMethod, $e7)
    {
        $result = Repository::tariffs_forASuppllier($supplierId, $regionId, $serviceType, $paymentMethod, $e7, $statusLive, $statusPresereved);
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
