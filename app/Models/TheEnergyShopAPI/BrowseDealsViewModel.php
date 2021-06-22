<?php

namespace App\Models\TheEnergyShopAPI;

class BrowseDealsViewModel
{
    public function __construct($currentUsageKwh, TariffModel $existingTariff, array $newTariffs)
    {
        $this -> currentUsageKwh = $currentUsageKwh;
        $this -> $existingTariff = $existingTariff;
        $this -> newTariffs = $newTariffs;
    }
    
    public $currentUsageKwh;

    public TariffModel $existingTariff;
    public array $newTariffs;
}
