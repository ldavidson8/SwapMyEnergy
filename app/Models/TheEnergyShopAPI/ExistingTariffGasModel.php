<?php

namespace App\Models\TheEnergyShopAPI;

use TariffModel;
use NewTariffModel;

class ExistingTariffGasModel
{
    public function __construct(array $request)
    {
        $this -> serviceTypeToCompare = "G";
        $this -> currentServiceType = "ne";

        $this -> region_id = (int) $request["region_id"];
        $this -> fuel_type = $request["fuel_type"];
        $this -> supplier_1 = (int) $request["gas_supplier"];
        
        $this -> tariff_1_payment_method = $request["tariff_1_payment_method"];
        $this -> tariff_1_e7 = $request["tariff_1_e7"];
        if (isset($request["tariff_1_current_tariff"])) $this -> tariff_1_current_tariff = $request["tariff_1_current_tariff"];
        if (isset($request["tariff_1_current_tariff_not_listed"])) $this -> tariff_1_current_tariff_not_listed = $request["tariff_1_current_tariff_not_listed"];
        
        $this -> your_gas_usage_kwh = $request["your_gas_usage_kwh"];
        $this -> your_gas_usage_length = $request["your_gas_usage_length"];
    }

    public $current_service_type; // "D","G","E"
    public $service_type_to_compare; // "df","dfs","ng"    "ne"??

    public $region_id; // 7
    public $fuel_type; // "dual","gas","electric"
    public $supplier; // 5

    public $tariff_1_payment_method; // "MDD","QDD","CAC","PRE"
    public $tariff_1_e7; // "true","false"
    public $tariff_1_current_tariff; // "1623849"
    public $tariff_1_current_tariff_not_listed; // "notListed"

    public $your_gas_usage_kwh; // 2000
    public $your_gas_usage_length; // "Month"
}