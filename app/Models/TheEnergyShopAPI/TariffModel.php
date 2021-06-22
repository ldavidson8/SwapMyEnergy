<?php

namespace App\Models\TheEnergyShopAPI;

class TariffModel
{
    public $supplierName;
    public $supplierId;

    public $unitRate;
    public $standingCharge;
    public $cost;
    public $costLength;
    public $termLength;
}

class NewTariffModel extends TariffModel
{
    public $exitFee;
    public $tariffId;
    public $tariffName;
}