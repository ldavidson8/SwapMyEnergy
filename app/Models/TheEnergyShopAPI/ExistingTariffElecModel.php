<?php

namespace App\Models\TheEnergyShopAPI;

class ExistingTariffElecModel
{
    public function __construct(array $request)
    {
        $this -> fuel_type_char = "E";
        $this -> fuel_type_str = "ng";
        $this -> fuel_type = $request["fuel_type"];

        $this -> region_id = (int) $request["region_id"];
        $this -> supplier = (int) $request["electric_supplier"];
        
        $this -> payment_method = $request["tariff_2_payment_method"];
        $this -> e7 = $request["tariff_2_e7"];
        if (isset($request["tariff_2_current_tariff"])) $this -> current_tariff = $request["tariff_2_current_tariff"];
        else if (isset($request["tariff_2_current_tariff_not_listed"])) $this -> current_tariff_not_listed = $request["tariff_2_current_tariff_not_listed"];
        
        if ($this -> e7 == "true") $this -> e7_percent = $request["your_electric_e7_input"];
        else $this -> e7_percent = 0;
        
        $this -> consumption_figures = $request["consumption_figures"];
        switch ($this -> consumption_figures)
        {
            case "pound":
                $this -> elec = (int) $request["your_electric_usage_pound"];
                $this -> elec_length = $request["your_electric_usage_pound_length"];
                switch ($this -> elec_length)
                {
                    case "Month": (int) $this -> elec *= 12; break;
                    case "Quarter": (int) $this -> elec *= 4; break;
                }
                break;
            case "kwh":
                $this -> elec = (int) $request["your_electric_usage_kwh"];
                $this -> elec_length = $request["your_electric_usage_kwh_length"];
                switch ($this -> elec_length)
                {
                    case "Month": (int) $this -> elec *= 12; break;
                    case "Quarter": (int) $this -> elec *= 4; break;
                }
                break;
            case "estimate":
                $this -> elec = (int) $request["your_electric_usage_estimate"];
                break;
        }
    }
    
    public $fuel_type_char; // "E"
    public $fuel_type_str; // "ng"
    public $fuel_type; // "dual","gas","electric"
    
    public $region_id; // 7
    public $supplier; // 5
    
    public $payment_method; // "MDD","QDD","CAC","PRE"
    public $e7; // "true","false"
    public $current_tariff; // "1623849"
    public $current_tariff_not_listed; // "notListed"
    
    public $consumption_figures; // "kwh", "pound", "estimate"
    public $elec_kwh; // 3000
    public $elec_length; // "Month","Quarter","Year"
    public $e7_percent; // 42
}