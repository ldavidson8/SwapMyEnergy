<?php

namespace App\Http\Controllers;

use Throwable;

use App\Http\Controllers\API\ResidentialApiRepository as Repository;
use App\Http\Requests\Mode\ModeSession;
use App\Models\TheEnergyShopAPI\ExistingTariffGasModel;
use App\Models\TheEnergyShopAPI\BrowseDealsViewModel;
use App\Models\TheEnergyShopAPI\ExistingTariffDualFuelOneModel;
use App\Models\TheEnergyShopAPI\ExistingTariffDualFuelTwoModel;
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
            if ($validator -> fails()) { return redirect() -> route('residential.energy-comparison.1-address') -> withErrors($validator -> errors()) -> withInput(); }
            Log::channel('energy-comparison/find-address-post') -> info('ContactController -> raiseSupportRequest(), Form Validated Successfully');
            
            $region = Repository::regionsByPostcode($request -> input("postcode"), $request -> input("mpan"), $region_status);
            if (!isset($region))
            {
                // api request returned no data
                Log::channel('energy-comparison/find-address-post') -> info('ContactController -> raiseSupportRequest(), Repository::regionsByPostcode(), status: $region_status');
                return redirect() -> route('residential.energy-comparison.1-address') -> withErrors([ 'error' => 'An error occured, please try again later.' ]) -> withInput();
            }
            
            Session::put('ResidentialAPI.user_address', $request -> all());
            Session::put('ResidentialAPI.region', $region);
            return redirect() -> route('residential.energy-comparison.2-existing-tariff');
        }
        catch (Throwable $th)
        {
            // report($th);
            throw $th;
            return redirect() -> route('residential.energy-comparison.1-address') -> withErrors([ '' => "We were unable to process your data. Please check your input and try again later." ]) -> withInput();
        }
    }
    

    public function setExistingTariff()
    {
        try
        {
            ModeSession::setResidential();

            $user_address = Session::get('ResidentialAPI.user_address');
            if (!isset($user_address)) return $this -> BackTo1FindAddress();
            
            $region = Session::get('ResidentialAPI.region', null);
            if (!isset($region)) return redirect() -> route('residential.energy-comparison.1-address') -> withErrors([ 'error' => 'An error occured, please try again later.' ]) -> withInput();
            
            $suppliers = Repository::suppliersByRegion($region["id"], $status);
            if (!isset($suppliers) || count($suppliers) == 0) return redirect() -> route('residential.energy-comparison.1-address') -> withErrors([ 'error' => 'An error occured, please try again later.' ]) -> withInput();
            
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
            
            $mprn = Repository::addresses_mprn($user_address['postcode'], $user_address['houseNo'], $status);
            $dmq = $mprn -> dmq;
            
            $page_title = 'Compare Energy Prices - Your Tariff';
            return view('energy-comparison.2-set-existing-tariff', compact('page_title', 'supplier_data', 'region', 'dmq'));
        }
        catch (Throwable $th)
        {
            // report($th);
            throw($th);
            return redirect() -> route('residential.energy-comparison.1-address') -> withErrors([ '' => "We were unable to process your data. Please check your input and try again later." ]) -> withInput();
        }
    }

    public function setExistingTariffPost(Request $request)
    {
        // TODO: validation
        try
        {
            $user_address = Session::get('ResidentialAPI.user_address');
            if (!isset($user_address)) return $this -> BackTo1FindAddress();

            switch ($request["fuel_type"])
            {
                case "dual":
                    if ($request -> input("same_fuel_supplier") == "yes")
                    {
                        return $this -> setExistingTariffDualFuelOne($request, $user_address);
                    }
                    else
                    {
                        return $this -> setExistingTariffDualFuelTwo($request, $user_address);
                    }
                case "gas":
                    return $this -> setExistingTariffGas($request, $user_address);
                case "electric":
                    return $this -> setExistingTariffElec($request, $user_address);
            }

            return redirect() -> route("residential.energy-comparison.3-browse-deals");
        }
        catch (Throwable $th)
        {
            // report($th);
            throw $th;
            return $this -> BackTo2ExistingTariff();
        }
    }

    public function setExistingTariffGas(Request $request, $user_address)
    {
        // return response() -> json(, $status);
        // TODO: validation
        try
        {
            $existing_tariff = new ExistingTariffGasModel($request -> all());
            
            if ($existing_tariff -> current_tariff_not_listed == "notListed")
            {
                $default_tariff = Repository::tariffs_defaultForASupplier($existing_tariff -> supplier, $existing_tariff -> fuel_type_char, $existing_tariff -> payment_method, $existing_tariff -> e7, $existing_tariff -> region_id, $status);
                if (count($default_tariff) == 0) return "One"; // return $this -> BackTo2ExistingTariff();
                $tariff = Repository::tariffs_info_by_id($default_tariff[0] -> tariffId, $status);
            }
            else $tariff = Repository::tariffs_info_by_id($existing_tariff -> current_tariff, $status);
            
            $current_tariffs = Repository::tariffs_current(
                $tariff, null,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> gas_kwh, 0,
                $status);
            
            $tariff_results = Repository::tariffs_results(
                $current_tariffs -> G, null,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> gas_kwh, 0, 0.0,
                $user_address["movingHouse"], $existing_tariff -> payment_method, true, "", $user_address["postcode"],
                $status);

            // $tariff_ids = [];
            $new_tariffs = [];
            foreach ($tariff_results["tariffs"] as $row)
            {
                // $tariff_ids[] = $row["tariffId"];
                $row["tariff_info"] = Repository::tariffs_info_by_id($row["tariffId"], $status);
                $new_tariffs[] = $row;
            }
            
            // Get Features for each tariff
            // $features = Repository::features_by_tariff_ids($tariff_ids, $status);
            // return response() -> json($features, $status);
            
            Session::put('ResidentialAPI.existing_tariff', $existing_tariff);
            Session::put('ResidentialAPI.current_tariffs', $current_tariffs);
            Session::put('ResidentialAPI.new_tariffs', $new_tariffs);
            return redirect() -> route('residential.energy-comparison.3-browse-deals');
        }
        catch (Throwable $th)
        {
            // report($th);
            throw $th;
            return $this -> BackTo2ExistingTariff();
        }
    }
    
    public function setExistingTariffElec(Request $request, $user_address)
    {
        // TODO: validation
        try
        {
            $existing_tariff = new ExistingTariffElecModel($request -> all());
            
            if ($existing_tariff -> current_tariff_not_listed == "notListed")
            {
                $default_tariff = Repository::tariffs_defaultForASupplier($existing_tariff -> supplier, $existing_tariff -> fuel_type_char, $existing_tariff -> payment_method, $existing_tariff -> e7, $existing_tariff -> region_id, $status);
                if (count($default_tariff) == 0) return "Two"; // return $this -> BackTo2ExistingTariff();
                $tariff = Repository::tariffs_info_by_id($default_tariff[0] -> tariffId, $status);
            }
            else $tariff = Repository::tariffs_info_by_id($existing_tariff -> current_tariff, $status);

            $current_tariffs = Repository::tariffs_current(
                null, $tariff,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                0, $existing_tariff -> elec_kwh,
                $status);
            
            $tariff_results = Repository::tariffs_results(
                null, $current_tariffs -> E,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                null, $existing_tariff -> elec_kwh, 0.0,
                $user_address["movingHouse"], $existing_tariff -> payment_method, true, "", $user_address["postcode"],
                $status);

            // $tariff_ids = [];
            $new_tariffs = [];
            foreach ($tariff_results["tariffs"] as $row)
            {
                // $tariff_ids[] = $row["tariffId"];
                $row["tariff_info"] = Repository::tariffs_info_by_id($row["tariffId"], $status);
                $new_tariffs[] = $row;
            }
            
            // Get Features for each tariff
            // $features = Repository::features_by_tariff_ids($tariff_ids, $status);
            // return response() -> json($features, $status);
            
            Session::put('ResidentialAPI.existing_tariff', $existing_tariff);
            Session::put('ResidentialAPI.current_tariffs', $current_tariffs);
            Session::put('ResidentialAPI.new_tariffs', $new_tariffs);
            return redirect() -> route('residential.energy-comparison.3-browse-deals');
        }
        catch (Throwable $th)
        {
            // report($th);
            throw $th;
            return $this -> BackTo2ExistingTariff();
        }
    }

    public function setExistingTariffDualFuelOne(Request $request, $user_address)
    {
        // TODO: validation
        try
        {
            $existing_tariff = new ExistingTariffDualFuelOneModel($request -> all());
            
            if ($existing_tariff -> current_tariff_not_listed == "notListed")
            {
                $default_tariff = Repository::tariffs_defaultForASupplier($existing_tariff -> supplier, $existing_tariff -> fuel_type_char, $existing_tariff -> payment_method, $existing_tariff -> e7, $existing_tariff -> region_id, $status);
                if (count($default_tariff) == 0) return "Three"; // return $this -> BackTo2ExistingTariff();
                $tariff = Repository::tariffs_info_by_id($default_tariff[0] -> tariffId, $status);
            }
            else $tariff = Repository::tariffs_info_by_id($existing_tariff -> current_tariff, $status);
            
            $current_tariffs = Repository::tariffs_current(
                $tariff, $tariff,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> gas_kwh, $existing_tariff -> elec_kwh,
                $status);
            
            $tariff_results = Repository::tariffs_results(
                $current_tariffs -> G, $current_tariffs -> E,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> gas_kwh, $existing_tariff -> elec_kwh, 0.0,
                $user_address["movingHouse"], $existing_tariff -> payment_method, true, "", $user_address["postcode"],
                $status);

            // $tariff_ids = [];
            $new_tariffs = [];
            foreach ($tariff_results["tariffs"] as $row)
            {
                // $tariff_ids[] = $row["tariffId"];
                $row["tariff_info"] = Repository::tariffs_info_by_id($row["tariffId"], $status);
                $new_tariffs[] = $row;
            }
            
            // Get Features for each tariff
            // $features = Repository::features_by_tariff_ids($tariff_ids, $status);
            // return response() -> json($features, $status);
            
            Session::put('ResidentialAPI.existing_tariff', $existing_tariff);
            Session::put('ResidentialAPI.current_tariffs', $current_tariffs);
            Session::put('ResidentialAPI.new_tariffs', $new_tariffs);
            return redirect() -> route('residential.energy-comparison.3-browse-deals');
        }
        catch (Throwable $th)
        {
            // report($th);
            throw $th;
            return $this -> BackTo2ExistingTariff();
        }
    }
    
    public function setExistingTariffDualFuelTwo(Request $request, $user_address)
    {
        // TODO: validation
        try
        {
            $existing_tariff = new ExistingTariffDualFuelTwoModel($request -> all());
            
            if ($existing_tariff -> current_tariff_1_not_listed == "notListed")
            {
                $default_tariff = Repository::tariffs_defaultForASupplier($existing_tariff -> supplier_1, $existing_tariff -> fuel_type_char, $existing_tariff -> payment_method_1, $existing_tariff -> e7_1, $existing_tariff -> region_id, $status);
                if (count($default_tariff) == 0) return "Four"; // return $this -> BackTo2ExistingTariff();
                $tariff_1 = Repository::tariffs_info_by_id($default_tariff[0] -> tariffId, $status);
            }
            else $tariff_1 = Repository::tariffs_info_by_id($existing_tariff -> current_tariff_1, $status);
            if ($existing_tariff -> current_tariff_2_not_listed == "notListed")
            {
                $default_tariff = Repository::tariffs_defaultForASupplier($existing_tariff -> supplier_2, $existing_tariff -> fuel_type_char, $existing_tariff -> payment_method_2, $existing_tariff -> e7_2, $existing_tariff -> region_id, $status);
                $tariff_2 = Repository::tariffs_info_by_id($default_tariff[0] -> tariffId, $status);
            }
            else $tariff_2 = Repository::tariffs_info_by_id($existing_tariff -> current_tariff_2, $status);
            
            $current_tariffs = Repository::tariffs_current(
                $tariff_1, $tariff_2,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> gas_kwh, $existing_tariff -> elec_kwh,
                $status);
            
            $tariff_results = Repository::tariffs_results(
                $current_tariffs -> G, $current_tariffs -> E,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> gas_kwh, $existing_tariff -> elec_kwh, 0.0,
                $user_address["movingHouse"], $existing_tariff -> payment_method_1, true, "", $user_address["postcode"],
                $status);
            
            // $tariff_ids = [];
            $new_tariffs = [];
            foreach ($tariff_results["tariffs"] as $row)
            {
                // $tariff_ids[] = $row["tariffId"];
                $row["tariff_info"] = Repository::tariffs_info_by_id($row["tariffId"], $status);
                $new_tariffs[] = $row;
            }
            
            // Get Features for each tariff
            // $features = Repository::features_by_tariff_ids($tariff_ids, $status);
            
            Session::put('ResidentialAPI.existing_tariff', $existing_tariff);
            Session::put('ResidentialAPI.current_tariffs', $current_tariffs);
            Session::put('ResidentialAPI.new_tariffs', $new_tariffs);
            return redirect() -> route('residential.energy-comparison.3-browse-deals');
        }
        catch (Throwable $th)
        {
            // report($th);
            throw $th;
            return $this -> BackTo2ExistingTariff();
        }
    }


    public function browseDeals()
    {
        try
        {
            $existing_tariff = Session::get('ResidentialAPI.existing_tariff');
            $current_tariffs = Session::get('ResidentialAPI.current_tariffs');
            $new_tariffs = Session::get('ResidentialAPI.new_tariffs');
            if (!isset($existing_tariff) || !isset($current_tariffs) || !isset($new_tariffs))
            {
                return "Five";
                return $this -> BackTo2ExistingTariff();
            }
            
            /// Build the view model ///
            $params = [ "existing_tariff" => $existing_tariff, "current_tariffs" => $current_tariffs, "new_tariffs" => $new_tariffs, 'page_title' => 'Compare Energy Prices - Browse Deals' ];
            // return response() -> json($params);
            return view('energy-comparison.3-browse-deals', $params);
        }
        catch (Throwable $th)
        {
            // report($th);
            throw $th;
            return redirect() -> route('residential.energy-comparison.2-existing-tariff') -> withErrors([ '' => "We were unable to process your data. Please check your input and try again later." ]) -> withInput();
        }
    }
    
    
    public function browseDealsPost(Request $request)
    {
        try
        {
            // return response() -> json($request);
            
            // de-comment these lines when the api returns data again
            // $selected_tariff = Repository::tariffs_info_by_id($request -> input("tariffId"), $status);
            // return response() -> json($status);
            // return response() -> json($selected_tariff, $status);

            Session::put('ResidentialAPI.selected_tariff_id');

            return redirect() -> action([ self::class, 'getSwitching' ] );
        }
        catch (Throwable $th)
        {
            throw $th;
            report($th);
            return $this -> BackTo3BrowseDeals();
        }
    }
    
    public function getSwitching()
    {
        $user_address = Session::put('ResidentialAPI.user_address');
        $region = Session::put('ResidentialAPI.region');
        $existing_tariff = Session::get('ResidentialAPI.existing_tariff');
        $current_tariffs = Session::get('ResidentialAPI.current_tariffs');
        $new_tariffs = Session::get('ResidentialAPI.new_tariffs');
        $selected_tariff_id = Session::get('ResidentialAPI.selected_tariff_id');

        $params = compact('user_address', 'region', 'existing_tariff', 'current_tariffs', 'new_tariffs', 'selected_tariff_id');
        return view('energy-comparison.4-get-switching', $params);
    }
    
    public function getSwitchingPost(Request $request)
    {
        try
        {
            $selected_tariff_id = Session::get('ResidentialAPI.selected_tariff_id');
            $existing_tariff = Session::get('ResidentialAPI.existing_tariff');
            $current_tariffs = Session::get('ResidentialAPI.current_tariffs');
            $new_tariffs = Session::get('ResidentialAPI.new_tariffs');

            $requestObj = array("user" =>
            [
                "saleType" => "A",
                "agentId" => "arRyhhr",
                "serviceTypeToCompare" => $existing_tariff["fuel_type_char"],
                "gasSupplier" => 5,
                "gasTariffId" => 1562756,
                "gasPayment" => "MDD",
                "currentTariffGasConsumption" => 12000,
                "currentTariffGasBill" => 516.76,
                "elecSupplier" => 14,
                "elecTariffId" => 1503152,
                "elecPayment" => "MDD",
                "currentTariffElecConsumption" => 3100,
                "currentTariffGasBill" => 627.12,
                "E7" => false,
                "e7Usage" => 0,
                "tariffId" => 1562756,
                "tariffPosition" => 1,
                "bill" => 858.03,
                "billGas" => 339.55,
                "billElec" => 518.48,
                "saving" => 285.85,
                "savingPercentage" => 25.0,
                "title" => "Mr",
                "firstName" => "Test",
                "lastName" => "Test",
                "telephoneNo" => "01234567891",
                "mobileNo" => "07812345679",
                "email" => "test@test.com",
                "currentAddress" => [
                    "line1" => "1 Street",
                    "line2" => "Area",
                    "line3" => "",
                    "town" => "London",
                    "county" => "East London",
                    "bldNumber" => "1",
                    "bldName" => "",
                    "subBld" => "",
                    "throughfare" => "",
                    "dependantThroughFare" => "",
                    "yearsAtResidence" => 3,
                    "monthsAtResidence" => 6,
                    "mprn" => "123456789",
                    "mpanNumber" => "1234567891"
                ],
                "billingAddress" => [
                    "line1" => "1 Street",
                    "line2" => "Area",
                    "line3" => "",
                    "town" => "London",
                    "county" => "East London",
                    "bldNumber" => "1",
                    "bldName" => "",
                    "subBld" => "",
                    "throughfare" => "",
                    "dependantThroughFare" => ""
                ],
                "previousAddress" => [
                    "line1" => "1 Street",
                    "line2" => "Area",
                    "line3" => "",
                    "town" => "London",
                    "county" => "East London",
                    "bldNumber" => "1",
                    "bldName" => "",
                    "subBld" => "",
                    "throughfare" => "",
                    "dependantThroughFare" => "",
                    "yearsAtResidence" => 3,
                    "monthsAtResidence" => 6
                ],
                "previousAddressTwo" => [
                    "line1" => "1 Street",
                    "line2" => "Area",
                    "line3" => "",
                    "town" => "London",
                    "county" => "East London",
                    "bldNumber" => "1",
                    "bldName" => "",
                    "subBld" => "",
                    "throughfare" => "",
                    "dependantThroughFare" => "",
                    "yearsAtResidence" => 3,
                    "monthsAtResidence" => 6
                ],
                "smartMeter" => "Y"
            ],
            "payment" => [
                "accountName" => "Mr Test Test",
                "sortCodeOne" => "10",
                "sortCodeTwo" => "00",
                "sortCodeThree" => "00",
                "accountNumber" => "12345679",
                "bankName" => "Test Bank",
                "preferredDay" => 6,
                "ddAuthorisation" => true,
                "receiveBills" => "Email",
                "supplierOptIn" => true,
                "supplierLetterOptIn" => true,
                "supplierPhoneOptIn" => true,
                "supplierTextOptIn" => true,
                "specialNeeds" => false
            ]);
            return response() -> json($requestObj);
        }
        catch (Throwable $th)
        {
            throw $th;
            report($th);
            return $this -> BackTo3BrowseDeals();
        }
    }

    

    public function BackTo1FindAddress()
    {
        return redirect() -> route('residential.energy-comparison.1-address') -> withErrors([ '' => "Something went wrong. Please check your input and try again." ]) -> withInput();
    }

    public function BackTo2ExistingTariff()
    {
        return redirect() -> route('residential.energy-comparison.2-existing-tariff') -> withErrors([ '' => "Something went wrong. Please check your input and try again." ]) -> withInput();
    }

    public function BackTo3BrowseDeals()
    {
        return redirect() -> route('residential.energy-comparison.3-browse-deals') -> withErrors([ '' => "Something went wrong. Please try again." ]) -> withInput();
    }

    public function BackTo4GetSwitching()
    {
        return redirect() -> route('residential.energy-comparison.4-get-switching') -> withErrors([ '' => "Something went wrong. Please try again." ]) -> withInput();
    }
}