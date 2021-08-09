<?php

namespace App\Models\TheEnergyShopAPI;

class ExistingTariffGasModel
{
    public function __construct(array $request)
    {
        $this -> fuel_type_char = "G";
        $this -> fuel_type_str = "ne";
        $this -> fuel_type = $request["fuel_type"];

        $this -> region_id = (int) $request["region_id"];
        $this -> supplier = (int) $request["gas_supplier"];

        $this -> payment_method = $request["tariff_1_payment_method"];
        $this -> e7 = false;
        if (isset($request["tariff_1_current_tariff"])) $this -> current_tariff = $request["tariff_1_current_tariff"];
        else if (isset($request["tariff_1_current_tariff_not_listed"])) $this -> current_tariff_not_listed = $request["tariff_1_current_tariff_not_listed"];

        $this -> e7_percent = 0;

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
                break;
            case "kwh":
                $this -> gas = (int) $request["your_gas_usage_kwh"];
                $this -> gas_length = $request["your_gas_usage_kwh_length"];
                switch ($this -> gas_length)
                {
                    case "Month": (int) $this -> gas *= 12; break;
                    case "Quarter": (int) $this -> gas *= 4; break;
                }
                break;
            case "estimate":
                $this -> gas = (int) $request["your_gas_usage_estimate"];
                break;
        }
    }

    public $fuel_type_char; // "G"
    public $fuel_type_str; // "ne"
    public $fuel_type; // "dual","gas","electric"

    public $region_id; // 7
    public $supplier; // 5

    public $payment_method; // "MDD","QDD","CAC","PRE"
    public $e7; // "true","false"
    public $current_tariff; // "1623849"
    public $current_tariff_not_listed; // "notListed"

    public $e7_percent; // 0

    public $consumption_figures; // "kwh", "pound", "estimate"
    public $gas; // 3000
    public $gas_length; // "Month","Quarter","Year"
}
