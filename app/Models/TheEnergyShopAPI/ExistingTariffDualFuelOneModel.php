<?php

namespace App\Models\TheEnergyShopAPI;

class ExistingTariffDualFuelOneModel
{
    public function __construct(array $request)
    {
        $this -> fuel_type_char = "D";
        $this -> fuel_type_str = "df";
        $this -> fuel_type = $request["fuel_type"];
        $this -> same_fuel_supplier = $request["same_fuel_supplier"];

        $this -> region_id = (int) $request["region_id"];
        $this -> supplier = (int) $request["dual_supplier"];
        
        $this -> payment_method = $request["tariff_1_payment_method"];
        $this -> e7 = $request["tariff_1_e7"];
        if (isset($request["tariff_1_current_tariff"])) $this -> current_tariff = $request["tariff_1_current_tariff"];
        else if (isset($request["tariff_1_current_tariff_not_listed"])) $this -> current_tariff_not_listed = $request["tariff_1_current_tariff_not_listed"];

        $this -> gas_length = $request["your_gas_usage_length"];
        $this -> gas_kwh = (int) $request["your_gas_usage_kwh"];
        switch ($this -> gas_length)
        {
            case "Month": (int) $this -> gas_kwh *= 12; break;
            case "Quarter": (int) $this -> gas_kwh *= 4; break;
        }
        
        $this -> elec_length = $request["your_electric_usage_length"];
        $this -> elec_kwh = (int) $request["your_electric_usage_kwh"];
        switch ($this -> elec_length)
        {
            case "Month": (int) $this -> elec_kwh *= 12; break;
            case "Quarter": (int) $this -> elec_kwh *= 4; break;
        }
    }
    
    public $fuel_type_char; // "D"
    public $fuel_type_str; // "df"
    public $fuel_type; // "dual","gas","electric"
    public $same_fuel_supplier; // "yes","no"
    
    public $region_id; // 7
    public $supplier; // 5
    
    public $payment_method; // "MDD","QDD","CAC","PRE"
    public $e7; // "true","false"
    public $current_tariff; // "1623849"
    public $current_tariff_not_listed; // "notListed"

    public $gas_kwh; // 3000
    public $gas_length; // "Month","Quarter","Year"
    public $elec_kwh; // 3000
    public $elec_length; // "Month","Quarter","Year"
}