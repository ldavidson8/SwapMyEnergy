<?php

namespace App\Models\TheEnergyShopAPI;

class ExistingTariffElecModel
{
    public function __construct(array $request)
    {
        $this -> fuel_type_char = "E";
        $this -> fuel_type_str = "ng";

        $this -> region_id = (int) $request["region_id"];
        $this -> supplier = (int) $request["electric_supplier"];
        
        $this -> payment_method = $request["tariff_2_payment_method"];
        $this -> e7 = $request["tariff_2_e7"];
        if (isset($request["tariff_2_current_tariff"]))
        {
            $this -> current_tariff = $request["tariff_2_current_tariff"];
        }
        else if (isset($request["tariff_2_current_tariff_not_listed"]))
        {
            $this -> current_tariff_not_listed = $request["tariff_2_current_tariff_not_listed"];
        }
        
        $this -> your_electric_usage_kwh = $request["your_electric_usage_kwh"];
        $this -> your_electric_usage_length = $request["your_electric_usage_length"];
    }
    
    public $fuel_type_char; // "E"
    public $fuel_type_str; // "ng"
    
    public $region_id; // 7
    public $supplier; // 5
    
    public $payment_method; // "MDD","QDD","CAC","PRE"
    public $e7; // "true","false"
    public $current_tariff; // "1623849"
    public $current_tariff_not_listed; // "notListed"
    
    public $kwh; // 3000
    public $length; // "Month","Quarter","Year"
}