<?php

namespace App\Models\TheEnergyShopAPI\PostRequests;

class CurrentTariffPostRequestEnergyUsageModel
{
    public function __construct($consumptionFigures, $annualGasConsumption, $annualElecConsumption)
    {
        $this -> consumptionFigures = $consumptionFigures;
        $this -> annualGasConsumption = $annualGasConsumption;
        $this -> annualElecConsumption = $annualElecConsumption;
    }

    public string $consumptionFigures;
    public string $annualGasConsumption;
    public string $annualElecConsumption;
}
