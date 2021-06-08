<?php

namespace App\Http\Controllers\API;

interface IResidentialAPI
{
    public static function addresses($postCode);
    public static function addresses_mprn($postcode, $houseNo, $houseName = null);
    public static function addresses_mprndetails($mprn);
    public static function suppliers();
    public static function supplierById($supplierId);
}