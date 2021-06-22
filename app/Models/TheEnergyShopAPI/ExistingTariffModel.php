<?php

namespace App\Models\TheEnergyShopAPI;

use TariffModel;
use NewTariffModel;

class ExistingTariffModel
{
    public function __construct(array $request)
    {
        if (isset($request["region_id"])) $this -> region_id = $request["region_id"];
        if (isset($request["fuel_type"])) $this -> fuel_type = $request["fuel_type"];
        if (isset($request["same_fuel_supplier"])) $this -> same_fuel_supplier = $request["same_fuel_supplier"];
        
        switch ($this -> fuel_type)
        {
            case "dual":
                if ($this -> same_fuel_supplier == "yes")
                {
                    if (isset($request["dual_supplier"])) $this -> supplier_1 = $request["dual_supplier"];
                }
                else
                {
                    if (isset($request["gas_supplier"])) $this -> supplier_1 = $request["gas_supplier"];
                    if (isset($request["electric_supplier"])) $this -> supplier_2 = $request["electric_supplier"];
                }
                break;
            case "gas":
                if (isset($request["gas_supplier"])) $this -> supplier_1 = $request["gas_supplier"];
                break;
            case "electric":
                if (isset($request["electric_supplier"])) $this -> supplier_2 = $request["electric_supplier"];
                break;
        }

        if (isset($request["tariff_1_payment_method"])) $this -> tariff_1_payment_method = $request["tariff_1_payment_method"];
        if (isset($request["tariff_1_e7"])) $this -> tariff_1_e7 = $request["tariff_1_e7"];
        if (isset($request["tariff_1_current_tariff"])) $this -> tariff_1_current_tariff = $request["tariff_1_current_tariff"];
        else if (isset($request["tariff_1_current_tariff_not_listed"])) $this -> tariff_1_current_tariff = $request["tariff_1_current_tariff_not_listed"];
        
        if (isset($request["tariff_2_payment_method"])) $this -> tariff_2_payment_method = $request["tariff_2_payment_method"];
        if (isset($request["tariff_2_e7"])) $this -> tariff_2_e7 = $request["tariff_2_e7"];
        if (isset($request["tariff_2_current_tariff"])) $this -> tariff_2_current_tariff = $request["tariff_2_current_tariff"];
        else if (isset($request["tariff_2_current_tariff_not_listed"])) $this -> tariff_2_current_tariff = $request["tariff_2_current_tariff_not_listed"];
        
        if (isset($request["your_gas_usage_kwh"])) $this -> your_gas_usage_kwh = $request["your_gas_usage_kwh"];
        if (isset($request["your_gas_usage_length"])) $this -> your_gas_usage_length = $request["your_gas_usage_length"];
        if (isset($request["your_electric_usage_kwh"])) $this -> your_electric_usage_kwh = $request["your_electric_usage_kwh"];
        if (isset($request["your_electric_usage_length"])) $this -> your_electric_usage_length = $request["your_electric_usage_length"];
    }
    
    public int $region_id; // 7
    public string $fuel_type; // "dual","gas","electric"
    public string $same_fuel_supplier; // "yes","no"
    public int $supplier_1; // 5
    public int $supplier_2; // 5
    public string $tariff_1_payment_method; // "MDD","QDD","CAC","PRE"
    public string $tariff_1_e7; // "true","false"
    public int $tariff_1_current_tariff; // "1623849" or "notListed"
    public string $tariff_2_payment_method; // "MDD","QDD","CAC","PRE"
    public string $tariff_2_e7; // "true","false"
    public int $tariff_2_current_tariff; // "1619803" or "notListed"
    public int $your_gas_usage_kwh; // 2000
    public string $your_gas_usage_length; // "Month"
    public int $your_electric_usage_kwh; // 3000
    public string $your_electric_usage_length; // "Month","Quarter","Year"
}