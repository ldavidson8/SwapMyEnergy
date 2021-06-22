<?php

namespace App\Models\TheEnergyShopAPI\PostRequests;

class CurrentTariffPostRequestTariffModel
{
    public function __construct($regionId, $supplierId, $paymentMethod)
    {
        $this -> regionId = $regionId;
        $this -> supplierId = $supplierId;
        $this -> paymentMethod = $paymentMethod;
    }

    public int $regionId;
    public int $supplierId;
    public string $paymentMethod;
}
