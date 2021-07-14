<?php

namespace App\Models\TheEnergyShopAPI;

class ExistingTariffDualFuelTwoModel
{
    public function __construct(array $request)
    {
        $this -> fuel_type_char = "D";
        $this -> fuel_type_str = "dfs";
        $this -> fuel_type = $request["fuel_type"];
        $this -> same_fuel_supplier = $request["same_fuel_supplier"];
        
        $this -> region_id = (int) $request["region_id"];
        $this -> supplier_1 = (int) $request["gas_supplier"];
        $this -> supplier_2 = (int) $request["electric_supplier"];
        
        $this -> payment_method_1 = $request["tariff_1_payment_method"];
        if (isset($request["tariff_1_current_tariff"])) $this -> current_tariff_1 = $request["tariff_1_current_tariff"];
        else if (isset($request["tariff_1_current_tariff_not_listed"])) $this -> current_tariff_1_not_listed = $request["tariff_1_current_tariff_not_listed"];

        $this -> payment_method_2 = $request["tariff_2_payment_method"];
        $this -> e7_2 = $request["tariff_2_e7"];
        if (isset($request["tariff_2_current_tariff"])) $this -> current_tariff_2 = $request["tariff_2_current_tariff"];
        else if (isset($request["tariff_2_current_tariff_not_listed"])) $this -> current_tariff_2_not_listed = $request["tariff_2_current_tariff_not_listed"];
        
        if ($this -> e7_2 == "true") $this -> e7_percent = $request["your_electric_e7_input"];
        else $this -> e7_percent = 0;
        
        $this -> consumption_figures = $request["consumption_figures"];
        switch ($this -> consumption_figures)
        {
            case "pound":
                $this -> gas = (int) $request["your_gas_usage_pound"];
                $this -> gas_length = $request["your_gas_usage_pound_length"];
                switch ($this -> gas_length)
                {
                    case "Month": (int) $this -> gas *= 12; break;
                    case "Quarter": (int) $this -> gas *= 4; break;
                }
                
                $this -> elec = (int) $request["your_electric_usage_pound"];
                $this -> elec_length = $request["your_electric_usage_pound_length"];
                switch ($this -> elec_length)
                {
                    case "Month": (int) $this -> elec *= 12; break;
                    case "Quarter": (int) $this -> elec *= 4; break;
                }
                break;
            case "kwh":
                $this -> gas = (int) $request["your_gas_usage_kwh"];
                $this -> gas_length = $request["your_gas_usage_kwh_length"];
                switch ($this -> gas_length)
                {
                    case "Month": (int) $this -> gas *= 12; break;
                    case "Quarter": (int) $this -> gas *= 4; break;
                }
                
                $this -> elec = (int) $request["your_electric_usage_kwh"];
                $this -> elec_length = $request["your_electric_usage_kwh_length"];
                switch ($this -> elec_length)
                {
                    case "Month": (int) $this -> elec *= 12; break;
                    case "Quarter": (int) $this -> elec *= 4; break;
                }
                break;
            case "estimate":
                $this -> gas = (int) $request["your_gas_usage_estimate"];
                $this -> elec = (int) $request["your_electric_usage_estimate"];
                break;
        }
    }
    
    public $fuel_type_char; // "D"
    public $fuel_type_str; // "dfs"
    public $fuel_type; // "dual","gas","electric"
    public $same_fuel_supplier; // "yes","no"
    
    public $region_id; // 7
    public $supplier; // 5
    
    public $payment_method_1; // "MDD","QDD","CAC","PRE"
    public $current_tariff_1; // "1623849"
    public $current_tariff_1_not_listed; // "notListed"

    public $payment_method_2; // "MDD","QDD","CAC","PRE"
    public $e7_2; // "true","false"
    public $current_tariff_2; // "1623849"
    public $current_tariff_2_not_listed; // "notListed"
    
    public $consumption_figures; // "kwh", "pound", "estimate"
    public $gas; // 3000, "low", "medium", "high"
    public $gas_length; // "Month","Quarter","Year"
    public $elec; // 3000, "low", "medium", "high"
    public $elec_length; // "Month","Quarter","Year"

    public $e7_percent; // 42
}