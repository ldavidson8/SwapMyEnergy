<?php

namespace App\Http\Controllers;

use Throwable;

use App\Http\Controllers\API\ResidentialApiRepository as Repository;
use App\Http\Requests\Mode\ModeSession;
use App\Models\TheEnergyShopAPI\ExistingTariffGasModel;
use App\Models\TheEnergyShopAPI\BrowseDealsViewModel;
use App\Models\TheEnergyShopAPI\ExistingTariffElecModel;
use App\Models\TheEnergyShopAPI\TariffModel;
use App\Models\TheEnergyShopAPI\NewTariffModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ResidentialComparisonController extends Controller
{
    public function findAddress()
    {
        ModeSession::setResidential();

        $page_title = 'Compare Energy Prices - Find Address';
        return view('energy-comparison.1-get-address', compact('page_title'));
    }
    
    public function findAddressPost(Request $request)
    {
        try
        {
            $validator = Validator::make($request -> all(),
            [
                'postcode' => 'required',
                'houseNo' => 'required',
                'mpan' => 'required'
            ]);
            if ($validator -> fails()) { return redirect() -> back() -> withErrors($validator -> errors()) -> withInput(); }
            Log::channel('energy-comparison/find-address-post') -> info('ContactController -> raiseSupportRequest(), Form Validated Successfully');
            
            // $data = json_decode('{"address_id":"6005872391","house_name":"","house_number":"10","country":"GB","county":"LA","current_supplier_id":"BGT","delivery_point_alias":"","dependent_street":"","dmq":12754,"double_dependent_locality":"","gas_transport_id":"Cadent Gas Limited","ldz_id":"NW","meter_capacity":"1","meter_mechanism_code":"CR","meter_serial_number":"G4W00505841826","mpaq":"12754","mprn":"1558777303","ndmq":"12754","po_box_number":"","post_town":"PRESTON","postcode":"PR2 9UU","smart_equipment_technical_code":"","street":"TOWER GREEN","sub_building_name":"","supplierId":5,"supplierName":"British Gas"}');
            // $data = Repository::addresses_mprn($request -> input('postcode'), $request -> input('houseNo'));

            $region = Repository::regionsByPostcode($request -> input("postcode"), $request -> input("mpan"), $region_status);
            if (!isset($region))
            {
                // api request returned no data
                Log::channel('energy-comparison/find-address-post') -> info('ContactController -> raiseSupportRequest(), Repository::regionsByPostcode(), status: $region_status');
                return redirect() -> back() -> withErrors([ 'error' => 'An error occured, please try again later.' ]) -> withInput();
            }
            
            Session::put('user_address', $request -> all());
            Session::put('region', $region);
            return redirect() -> route('residential.energy-comparison.2-existing-tariff');
        }
        catch (Throwable $th)
        {
            report($th);
            return redirect() -> back() -> withErrors([ '' => "We were unable to process your data. Please check your input and try again later." ]) -> withInput();
        }
    }
    

    public function setExistingTariff()
    {
        try
        {
            ModeSession::setResidential();

            // DEBUG: returns a full list of suppliers in json format
            // return response() -> json(Repository::suppliers($status), $status);
            
            $region = Session::get('region', null);
            if (!isset($region)) return redirect() -> back() -> withErrors([ 'error' => 'An error occured, please try again later.' ]) -> withInput();
            
            $suppliers = Repository::suppliersByRegion($region["id"], $status);
            if (!isset($suppliers) || count($suppliers) == 0) return redirect() -> back() -> withErrors([ 'error' => 'An error occured, please try again later.' ]) -> withInput();
            // DEBUG: returns a list of suppliers based on the region, in json format
            // return response() -> json($suppliers);

            $dual_suppliers = []; $gas_suppliers = []; $electric_suppliers = [];
            foreach ($suppliers as $supplier)
            {
                if ($supplier["supplyGas"]) $gas_suppliers[] = $supplier;
                if ($supplier["supplyElec"]) $electric_suppliers[] = $supplier;
                if ($supplier["supplyDf"]) $dual_suppliers[] = $supplier;
            }
            
            $main_suppliers = [ "Bristol Energy", "British Gas", "EDF Energy", "E.ON", "OVO energy", "ScottishPower", "SSE", "Utilita" ];
            $main_dual_suppliers = [];
            $main_gas_suppliers = [];
            $main_electric_suppliers = [];
            foreach ($main_suppliers as $main_supplier)
            {
                foreach ($dual_suppliers as $dual_supplier) if ($dual_supplier["name"] == $main_supplier) $main_dual_suppliers[] = $dual_supplier;
                foreach ($gas_suppliers as $gas_supplier) if ($gas_supplier["name"] == $main_supplier) $main_gas_suppliers[] = $gas_supplier;
                foreach ($electric_suppliers as $electric_supplier) if ($electric_supplier["name"] == $main_supplier) $main_electric_suppliers[] = $electric_supplier;
            }

            if ($status != 200)
            {
                return redirect() -> route('residential.energy-comparison.1-address') -> withErrors([ 'error' => 'An error occured, please try again later.' ]);
            }

            $supplier_data = compact('dual_suppliers', 'gas_suppliers', 'electric_suppliers', 'main_dual_suppliers', 'main_gas_suppliers', 'main_electric_suppliers');
            // DEBUG: returns lists of all suppliers by fuel type, and suppliers we have a logo for by fuel type
            // return response() -> json($supplier_data);
            
            $page_title = 'Compare Energy Prices - Your Tariff';
            return view('energy-comparison.2-set-existing-tariff', compact('page_title', 'supplier_data', 'region'));
        }
        catch (Throwable $th)
        {
            report($th);
            return redirect() -> back() -> withErrors([ '' => "We were unable to process your data. Please check your input and try again later." ]) -> withInput();
        }
    }

    public function setExistingTariffPost(Request $request)
    {
        // TODO: validation
        try
        {
            switch ($request["fuel_type"])
            {
                case "dual":
                    if ($this -> same_fuel_supplier == "yes")
                    {
                        return;
                    }
                    else
                    {
                        return;
                    }
                case "gas":
                    return $this -> setExistingTariffGas($request);
                case "electric":
                    return $this -> setExistingTariffElec($request);
            }

            return redirect() -> route("residential.energy-comparison.3-browse-deals");
        }
        catch (Throwable $th)
        {
            report($th);
            throw $th;
            return redirect() -> back() -> withErrors([ '' => "We were unable to process your data. Please check your input and try again later." ]) -> withInput();
        }
    }

    public function setExistingTariffGas(Request $request)
    {
        // TODO: validation
        try
        {
            $existing_tariff = new ExistingTariffGasModel($request -> all());
            return response() -> json($existing_tariff); // DEBUG: returns the data posted to the page in a model
        }
        catch (Throwable $th)
        {
            report($th);
            throw $th;
            return redirect() -> back() -> withErrors([ '' => "We were unable to process your data. Please check your input and try again later." ]) -> withInput();
        }
    }
    
    public function setExistingTariffElec(Request $request)
    {
        // TODO: validation
        try
        {
            $existing_tariff = new ExistingTariffElecModel($request -> all());
            // return response() -> json($existing_tariff); // DEBUG: returns the data posted to the page in a model

            if (isset($existing_tariff -> current_tariff))
            {
                $tariff = Repository::tariffs_info_by_id($existing_tariff -> current_tariff, $tariff_status);
            }
            else if (isset($existing_tariff -> current_tariff_not_listed))
            {
                $tariff = Repository::tariffs_defaultForASupplier(
                    $existing_tariff -> current_tariff,
                    $existing_tariff -> fuel_type_char,
                    $existing_tariff -> payment_method,
                    $existing_tariff -> e7,
                    $existing_tariff -> region_id,
                    $tariff_status);
            }
            // return response() -> json($tariff, $tariff_status);

            $tariff_results = Repository::tariffs_results(array(
                "currentElectricityTariff" =>
                [
                    "servicePart" => $tariff -> serviceType,
                    "serviceType" => $tariff -> serviceType,
                    "regionId" => $existing_tariff -> region_id,
                    "tariffId" => $tariff -> tariffId,
                    "tariffName" => $tariff -> tariffName,
                    "tariffType" => $tariff -> tariffType,
                    "supplierId" => $tariff -> supplierId,
                    "supplierName" => $tariff -> supplierName,
                    "supplierTilName" => null,
                    "paymentMethod" => $tariff -> paymentMethod,
                    "paymentMethodName" => $tariff -> paymentMethodName,
                    "e7" => $tariff -> e7,
                    "bill" => $tariff -> bill,
                    "units" => $tariff -> units,
                    "tariffEndDateType" => $tariff -> tariffEndDateType,
                    "tariffEndDatePeriodFixed" => $tariff -> tariffEndDatePeriodFixed,
                    "contractLength" => $tariff -> contractLength,
                    "exitPenaltyAmount" => $tariff -> exitPenaltyAmount,
                    "exitPenaltyEndDate" => $tariff -> exitPenaltyEndDate,
                    "pricePerUnit" => 0.0,
                    "priceE7PerUnit" => 0.0,
                    "standingCharge" => $tariff -> standingChargeElec,
                    "standingChargeDaily" => 0.0,
                    "tariffEndDate" => $tariff -> tariffEndDate,
                    "discountAmount" => $tariff -> discountAmountElec,
                    "discountAmountDualFuel" => $tariff -> discountAmountDf,
                    "tcr" => $tariff -> tcrElec
                ]
            ), $tariff_results_status);
            return $tariff_results;
            return response() -> json($tariff_results, $tariff_results_status);
            
            if (is_numeric($existing_tariff -> tariff_1_current_tariff))
            {
                $existing_tariff -> tariff_1 = Repository::tariffs_forASuppllier(
                    $existing_tariff -> supplier_1,
                    $existing_tariff -> region_id,
                    $existing_tariff -> current_service_type,
                    $existing_tariff -> tariff_1_payment_method,
                    $existing_tariff -> tariff_1_e7,
                    $statusLive, $statusPreserved);
            }

            $result = Repository::tariffs_defaultForASupplier($this -> supplier_1, $this -> current_service_type, $this -> tariff_1_payment_method, $this -> tariff_1_e7, $this -> region_id, $status);

            $result = Repository::features_by_tariff_ids($existing_tariff -> tariff_1_current_tariff);
            return $result;
            return response() -> json($result);
            
            if (!isset($existing_tariff -> current_service_type) || !isset($existing_tariff -> service_type_to_compare))
            {
                return response() -> json("false");
                return redirect() -> back() -> withErrors([ '' => "We were unable to process your data. Please check your input and try again later." ]) -> withInput();
            }

            // $currentTariffRequest = 
            // [
            //     "currentGasTariff" => new CurrentTariffPostRequestTariffModel(0, 0, ""),
            //     "currentElectricityTariff" => new CurrentTariffPostRequestTariffModel(0, 0, ""),
            //     "energyUsage" => new CurrentTariffPostRequestEnergyUsageModel("kwh", 0, 0),
            //     "serviceTypeToCompare" => $service_type_to_compare,
            //     "currentServiceType" => $current_service_type
            // ];

            // $result = Repository::supplierById($existing_tariff -> supplier_1, $status);
            // return response() -> json($result, $status);

            $currentTariffRequest =
            [
                "currentGasTariff" =>
                [
                    "regionId" => null,
                    "supplierId" => null,
                    "paymentMethod" => null
                ],
                "currentElectricityTariff" =>
                [
                    "regionId" => null,
                    "supplierId" => null,
                    "paymentMethod" => null
                ],
                "energyUsage" =>
                [
                    "consumptionFigures" => "kwh",
                    "annualGasConsumption" => null,
                    "annualElecConsumption" => null
                ],
                "serviceTypeToCompare" => $service_type_to_compare,
                "currentServiceType" => $current_service_type
            ];
            // $currentTariffRequest = json_decode('[{"currentGasTariff":{"regionId":0,"supplierId":0,"paymentMethod":""},"currentElectricityTariff":{"regionId":0,"supplierId":0,"paymentMethod":""},"energyUsage":{"consumptionFigures":"kwh","annualGasConsumption":0,"annualElecConsumption":0},"serviceTypeToCompare":"","currentServiceType":""}]');

            // return response() -> json($existing_tariff); // DEBUG: returns the data posted to the page in a model

            if ($service_type_to_compare == "df") $dual_supplier_id = $existing_tariff -> supplier_1;
            if ($current_service_type == "D" || $current_service_type == "G")
            {
                $currentTariffRequest["currentGasTariff"] =
                [
                    "regionId" => $existing_tariff -> region_id,
                    "supplierId" => (isset($dual_supplier_id)) ? $dual_supplier_id : $existing_tariff -> supplier_1,
                    "paymentMethod" => $existing_tariff -> tariff_1_payment_method
                ];
                $your_gas_multiplier = 1;
                switch ($existing_tariff -> your_gas_usage_length)
                {
                    case "Month": $your_gas_multiplier = 12; break;
                    case "Quarter": $your_gas_multiplier = 4; break;
                }
                $currentTariffRequest["energyUsage"]["annualGasConsumption"] = $existing_tariff -> your_gas_usage_kwh * $your_gas_multiplier;
            }
            if ($current_service_type == "D" || $current_service_type == "E")
            {
                $currentTariffRequest["currentElectricityTariff"] =
                [
                    "regionId" => $existing_tariff -> region_id,
                    "supplierId" => (isset($dual_supplier_id)) ? $dual_supplier_id : $existing_tariff -> supplier_2,
                    "paymentMethod" => $existing_tariff -> tariff_2_payment_method
                ];
                $your_electric_multiplier = 1;
                switch ($existing_tariff -> your_electric_usage_length)
                {
                    case "Month": $your_electric_multiplier = 12; break;
                    case "Quarter": $your_electric_multiplier = 4; break;
                }
                $currentTariffRequest["energyUsage"]["annualElecConsumption"] = $existing_tariff -> your_electric_usage_kwh * $your_electric_multiplier;
            }
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.theenergyshop.co.uk/api/v1/tariffs/results");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($currentTariffRequest));
            curl_setopt($ch, CURLOPT_HTTPHEADER,
            [
                'Authorization: 0468AFBE-AB78-4A23-BBB7-CD6597B8EE5E',
                'Content-Type: application/json'
            ]);
            $server_output = curl_exec($ch);
            curl_close($ch);

            return $server_output;

            // $currentTariffRequest =
            // [
            //     "currentGasTariff" =>
            //     [
            //         "regionId" => 11,
            //         "supplierId" => 16,
            //         "paymentMethod" => "CAC"
            //     ],
            //     "currentElectricityTariff" =>
            //     [
            //         "regionId" => 11,
            //         "supplierId" => 16,
            //         "paymentMethod" => "CAC"
            //     ],
            //     "energyUsage" =>
            //     [
            //         "consumptionFigures" => "kwh",
            //         "annualGasConsumption" => 12500,
            //         "annualElecConsumption" => 3111
            //     ],
            //     "serviceTypeToCompare" => "D",
            //     "currentServiceType" => "df"
            // ];
            $tariff_1 = Repository::tariffs_info_by_id($existing_tariff -> tariff_1_current_tariff, $status);
            // $tariff_2 = Repository::tariffs_info_by_id($existing_tariff -> tariff_2_current_tariff, $status);
            $payment_methods = Repository::paymentMethods_suppliers($existing_tariff -> supplier_1, $current_service_type, $status);
            // return response() -> json($tariff_1);
            $tariffs_results =
            [
                "currentGasTariff" =>
                [
                    "servicePart" => null,
                    "serviceType" => $tariff_1 -> serviceType,
                    "regionId" => $existing_tariff -> region_id,
                    "tariffId" => $tariff_1 -> tariffId,
                    "tariffName" => $tariff_1 -> tariffName,
                    "tariffType" => $tariff_1 -> tariffType,
                    "supplierId" => $tariff_1 -> supplierId,
                    "supplierName" => $tariff_1 -> tariffName,
                    "supplierTilName" => null,
                    "paymentMethod" => "CAC",
                    "paymentMethodName" => null,
                    "e7" => "",
                    "bill" => $tariff_1 -> billGas,
                    "units" => 0,
                    "tariffEndDateType" => null,
                    "tariffEndDatePeriodFixed" => null,
                    "contractLength" => 0,
                    "exitPenaltyAmount" => 0.0,
                    "exitPenaltyEndDate" => null,
                    "pricePerUnit" => 0.0,
                    "priceE7PerUnit" => 0.0,
                    "standingCharge" => $tariff_1 -> standingChargeGas,
                    "standingChargeDaily" => 0.0,
                    "tariffEndDate" => $tariff_1 -> tariffEndDate,
                    "discountAmount" => $tariff_1 -> discountAmountGas,
                    "discountAmountDualFuel" => $tariff_1 -> discountTypeDf,
                    "tcr" => $tariff_1 -> tcrGas
                ],
                "currentElectricityTariff" =>
                [
                    "servicePart" => null,
                    "serviceType" => $tariff_1 -> serviceType,
                    "regionId" => $existing_tariff -> region_id,
                    "tariffId" => $tariff_1 -> tariffId,
                    "tariffName" => $tariff_1 -> tariffName,
                    "tariffType" => $tariff_1 -> tariffType,
                    "supplierId" => $tariff_1 -> supplierId,
                    "supplierName" => $tariff_1 -> tariffName,
                    "supplierTilName" => null,
                    "paymentMethod" => "CAC",
                    "paymentMethodName" => null,
                    "e7" => "",
                    "bill" => $tariff_1 -> billGas,
                    "units" => 0,
                    "tariffEndDateType" => null,
                    "tariffEndDatePeriodFixed" => null,
                    "contractLength" => 0,
                    "exitPenaltyAmount" => 0.0,
                    "exitPenaltyEndDate" => null,
                    "pricePerUnit" => 0.0,
                    "priceE7PerUnit" => 0.0,
                    "standingCharge" => $tariff_1 -> standingChargeGas,
                    "standingChargeDaily" => 0.0,
                    "tariffEndDate" => $tariff_1 -> tariffEndDate,
                    "discountAmount" => $tariff_1 -> discountAmountGas,
                    "discountAmountDualFuel" => $tariff_1 -> discountTypeDf,
                    "tcr" => $tariff_1 -> tcrGas
                ],
                "serviceTypeToCompare" => "D",
                "currentServiceType" => "df",
                "energyUsage" =>
                [
                    "consumptionFigures" => "kwh",
                    "annualGasConsumption" => 12500.0,
                    "annualElecConsumption" => 3100.0,
                    "e7Usage" => 0.0
                ],
                "homeMover" => false,
                "preferredPaymentMethod" => "MDD",
                "showOnlyApplyTariff" => false,
                "features" => [],
                "postcode" => "W5 2DZ"
            ];
            return response() -> json(Repository::tariffs_results($tariffs_results, $status));
            // return response() -> json(Repository::tariffs_forASuppllier("16", "11", "D", "CAC", "false", $statusLive, $statusPreserved));
            $result = Repository::tariffs_current($currentTariffRequest, $status);
            return $result;
            return response() -> json([ "request" => $currentTariffRequest, "response" => $result, "status" => $status ], $status);
            return response() -> json($result, $status);
        }
        catch (Throwable $th)
        {
            report($th);
            throw $th;
            return redirect() -> back() -> withErrors([ '' => "We were unable to process your data. Please check your input and try again later." ]) -> withInput();
        }
    }


    public function browseDeals()
    {
    }
    
    
    public function browseDealsPost(Request $request)
    {
    }
    
    public function getSwitching()
    {
    }
    
    public function getSwitchingPost(Request $request)
    {
    }
}