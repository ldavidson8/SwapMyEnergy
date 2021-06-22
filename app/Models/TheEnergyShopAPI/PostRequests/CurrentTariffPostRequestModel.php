<?php

namespace App\Models\TheEnergyShopAPI\PostRequests;

class CurrentTariffPostRequestModel
{
    public function __construct($currentGasTariff, $currentElectricityTariff, $energyUsage, $serviceTypeToCompare, $currentServiceType)
    {
        $this -> currentGasTariff = $currentGasTariff;
        $this -> currentElectricityTariff = $currentElectricityTariff;
        $this -> energyUsage = $energyUsage;
        $this -> serviceTypeToCompare = $serviceTypeToCompare;
        $this -> currentServiceType = $currentServiceType;
    }

    public CurrentTariffPostRequestTariffModel $currentGasTariff;
    public CurrentTariffPostRequestTariffModel $currentElectricityTariff;
    
    public CurrentTariffPostRequestEnergyUsageModel $energyUsage;

    public string $serviceTypeToCompare;
    public string $currentServiceType;
}
