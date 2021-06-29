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
            $fields = $request -> all();
            $validator = Validator::make($fields,
            [
                'postcode' => 'required',
                'mpan' => 'required'
            ]);
            if ($validator -> fails()) { return redirect() -> route('residential.energy-comparison.1-address') -> withErrors($validator -> errors()) -> withInput(); }
            Log::channel('energy-comparison/find-address-post') -> info('ContactController -> raiseSupportRequest(), Form Validated Successfully');
            
            $status = 200;
            $mprn = Repository::addresses_mprn($fields['postcode'], $fields['houseNo'], $fields['houseName'], $status);
            
            $region = Repository::regionsByPostcode($request -> input("postcode"), $request -> input("mpan"), $region_status);
            if (!isset($region))
            {
                // api request returned no data
                Log::channel('energy-comparison/find-address-post') -> info('ContactController -> raiseSupportRequest(), Repository::regionsByPostcode(), status: $region_status');
                return redirect() -> route('residential.energy-comparison.1-address') -> withErrors([ 'error' => 'An error occured, please try again later.' ]) -> withInput();
            }
            
            if (!isset($fields["movingHouse"])) $fields["movingHouse"] = false;
            Session::put('ResidentialAPI.user_address', $fields);
            Session::put('ResidentialAPI.region', $region);
            
            $suppliers = Repository::suppliersByRegion($region["id"], $status);
            if (!isset($suppliers) || count($suppliers) == 0) return $this -> BackTo1FindAddress();
            
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
            
            $supplier_data = compact('dual_suppliers', 'gas_suppliers', 'electric_suppliers', 'main_dual_suppliers', 'main_gas_suppliers', 'main_electric_suppliers', 'region', 'mprn');
            Session::put('ResidentialAPI.supplier_data', $supplier_data);
            Session::put('ResidentialAPI.mprn', $mprn);

            return redirect() -> route('residential.energy-comparison.2-existing-tariff');
        }
        catch (Throwable $th)
        {
            throw $th;
            report($th);
            return redirect() -> route('residential.energy-comparison.1-address') -> withErrors([ '' => "We were unable to process your data. Please check your input and try again later." ]) -> withInput();
        }
    }
    

    public function setExistingTariff()
    {
        try
        {
            ModeSession::setResidential();

            $supplier_data = Session::get('ResidentialAPI.supplier_data');
            if (!isset($supplier_data)) return $this -> BackTo1FindAddress();
            // return response() -> json($supplier_data);
            
            $page_title = 'Compare Energy Prices - Your Tariff';
            return view('energy-comparison.2-set-existing-tariff', compact('page_title', 'supplier_data'));
        }
        catch (Throwable $th)
        {
            throw($th);
            report($th);
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
                // TODO: find a better way
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
                // TODO: find a better way
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
                // TODO: find a better way
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
                // TODO: find a better way
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
            $new_tariffs = Session::get('ResidentialAPI.new_tariffs');
            $tariff_position = $request -> input('tariffPosition');
            $selected_tariff = $new_tariffs[$tariff_position];
            Session::put('ResidentialAPI.selected_tariff', $selected_tariff);

            return redirect() -> action([ self::class, 'getSwitching' ]);
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
        try
        {
            $user_address = Session::get('ResidentialAPI.user_address');
            $mprn = Session::get('ResidentialAPI.mprn');
            $region = Session::get('ResidentialAPI.region');
            $existing_tariff = Session::get('ResidentialAPI.existing_tariff');
            $current_tariffs = Session::get('ResidentialAPI.current_tariffs');
            $selected_tariff = Session::get('ResidentialAPI.selected_tariff');

            if (!isset($user_address) || !isset($mprn) || !isset($region) || !isset($existing_tariff) || !isset($current_tariffs) || !isset($selected_tariff))
            {
                return $this -> BackTo3BrowseDeals();
            }
            
            $page_title = "Get Switching - Energy Swap";
            $params = compact('page_title', 'user_address', 'region', 'existing_tariff', 'current_tariffs', 'selected_tariff', 'mprn');
            // return response() -> json($params);
            return view('energy-comparison.4-get-switching', $params);
        }
        catch (Throwable $th)
        {
            throw $th;
            report($th);
            return $this -> BackTo3BrowseDeals();
        }
    }
    
    public function getSwitchingPost(Request $request)
    {
        try
        {
            $validator = Validator::make($request -> all(),
            [
                'postcode' => 'required|string',
                'address_line_1' => 'required|string',
                'address_line_2' => 'nullable|string',
                'town' => 'required|string',
                'smartMeter' => 'required|string|in:Y,N,doNotKnow',
                'gas_meter_number' => 'required|numeric',
                'elec_meter_number' => 'required|numeric',
                'accountName' => 'required|string',
                'sortCode1' => 'required|numeric|digits:2',
                'sortCode2' => 'required|numeric|digits:2',
                'sortCode3' => 'required|numeric|digits:2',
                'accountNumber' => 'required|string',
                'preferredDay' => 'required|integer|min:1|max:28',
                'receiveBills' => 'required|string|in:Email',
                'title' => 'required|string',
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'telephone' => 'required|numeric|starts_with:0',
                'mobile' => 'nullable|numeric|starts_with:0',
                'emailAddress' => 'required|email'
            ]);
            if (!$validator -> validate()) return $this -> BackTo4GetSwitching($validator -> errors());
            
            $telephone = $request -> input('telephone');
            if (strlen($telephone) != 11) return $this -> BackTo4GetSwitching($validator -> errors([ '' => 'The telephone must be 11 digits long.' ]));
            if ($request -> has('mobile'))
            {
                if (strlen($request -> input('mobile')) != 11) return $this -> BackTo4GetSwitching($validator -> errors([ '' => 'The telephone must be 11 digits long.' ]));
            }

            // return response() -> json($request -> all());
            
            $user_address = Session::get('ResidentialAPI.user_address');
            $mprn = Session::get('ResidentialAPI.mprn');
            $existing_tariff = Session::get('ResidentialAPI.existing_tariff');
            $current_tariffs = Session::get('ResidentialAPI.current_tariffs');
            $selected_tariff = Session::get('ResidentialAPI.selected_tariff');
            
            // $addresses_mprn = Repository::addresses_mprn($mprn -> postcode, $mprn -> house_number);
            // return response() -> json($addresses_mprn);
            
            if (!isset($user_address) || !isset($mprn) || !isset($existing_tariff) || !isset($current_tariffs) || !isset($selected_tariff))
            {
                return $this -> BackTo4GetSwitching();
            }
            
            $address_line_2 = $request -> input("address_line_2");
            $county = $request -> input("county");
            $billingAddress = $request -> input("billingAddress");
            $requestObj = array("user" =>
            [
                "saleType" => "A",
                "agentId" => "arRyhhr",
                "serviceTypeToCompare" => $existing_tariff -> fuel_type_char,
                "E7" => (bool)$selected_tariff["e7"],
                "e7Usage" => 0,
                "tariffId" => (int)$selected_tariff["tariffId"],
                "tariffPosition" => (int)$selected_tariff["tariffPosition"],
                "bill" => (double)$selected_tariff["bill"],
                "billGas" => (double)$selected_tariff["billGas"],
                "billElec" => (double)$selected_tariff["billElec"],
                "saving" => (double)$selected_tariff["saving"],
                "savingPercentage" => (double)$selected_tariff["savingPercentage"],
                "title" => $request -> input("title"),
                "firstName" => $request -> input("firstName"),
                "lastName" => $request -> input("lastName"),
                "telephoneNo" => $telephone,
                "mobileNo" => $request -> input("mobile"),
                "email" => $request -> input("emailAddress"),
                "currentAddress" => [
                    "line1" => $request -> input("address_line_1"),
                    "line2" => (isset($address_line_2)) ? $address_line_2 : "",
                    "line3" => "",
                    "town" => $request -> input("town"),
                    "county" => (isset($county)) ? $county : "",
                    // "bldNumber" => "",
                    // "bldName" => "",
                    // "subBld" => "",
                    // "throughfare" => "",
                    // "dependantThroughFare" => "",
                    // "yearsAtResidence" => 3,
                    // "monthsAtResidence" => 6,
                    "mprn" => $mprn -> mprn,
                    "mpanNumber" => $user_address["mpan"]
                ],
                "billingAddress" => (isset($billingAddress) && $billingAddress == "true") ?
                [
                    "line1" => "1 Street",
                    "line2" => "Area",
                    "line3" => "",
                    "town" => "London",
                    "county" => "East London",
                    // "bldNumber" => "1",
                    // "bldName" => "",
                    // "subBld" => "",
                    // "throughfare" => "",
                    // "dependantThroughFare" => ""
                ] : null,
                "previousAddress" => null,
                // [
                //     "line1" => "1 Street",
                //     "line2" => "Area",
                //     "line3" => "",
                //     "town" => "London",
                //     "county" => "East London",
                //     "bldNumber" => "1",
                //     "bldName" => "",
                //     "subBld" => "",
                //     "throughfare" => "",
                //     "dependantThroughFare" => "",
                //     "yearsAtResidence" => 3,
                //     "monthsAtResidence" => 6
                // ],
                "previousAddressTwo" => null,
                // [
                //     "line1" => "1 Street",
                //     "line2" => "Area",
                //     "line3" => "",
                //     "town" => "London",
                //     "county" => "East London",
                //     "bldNumber" => "1",
                //     "bldName" => "",
                //     "subBld" => "",
                //     "throughfare" => "",
                //     "dependantThroughFare" => "",
                //     "yearsAtResidence" => 3,
                //     "monthsAtResidence" => 6
                // ],
                "smartMeter" => $request -> input("smartMeter")
            ],
            "payment" => [
                "accountName" => $request -> input("accountName"),
                "sortCodeOne" => $request -> input("sortCode1"),
                "sortCodeTwo" => $request -> input("sortCode2"),
                "sortCodeThree" => $request -> input("sortCode3"),
                "accountNumber" => $request -> input("accountNumber"),
                "bankName" => $request -> input("bankName"),
                "preferredDay" => (int)$request -> input("preferredDay"),
                "ddAuthorisation" => (bool)$request -> input("direct_debit_confirmation"),
                "receiveBills" => $request -> input("receiveBills"),
                "supplierOptIn" => false,
                "supplierLetterOptIn" => false,
                "supplierPhoneOptIn" => false,
                "supplierTextOptIn" => false,
                "specialNeeds" => false
            ]);
            
            if (in_array($existing_tariff -> fuel_type_char, [ "D", "G" ]))
            {
                $requestObj["user"]["gasSupplier"] = (int)$current_tariffs -> G -> supplierId;
                $requestObj["user"]["gasTariffId"] = (int)$current_tariffs -> G -> tariffId;
                $requestObj["user"]["gasPayment"] = $current_tariffs -> G -> paymentMethod;
                $requestObj["user"]["currentTariffGasConsumption"] = (double)$current_tariffs -> G -> units;
                $requestObj["user"]["currentTariffGasBill"] = (double)$current_tariffs -> G -> bill;
            }
            
            if (in_array($existing_tariff -> fuel_type_char, [ "D", "E" ]))
            {
                $requestObj["user"]["elecSupplier"] = (int)$current_tariffs -> E -> supplierId;
                $requestObj["user"]["elecTariffId"] = (int)$current_tariffs -> E -> tariffId;
                $requestObj["user"]["elecPayment"] = $current_tariffs -> E -> paymentMethod;
                $requestObj["user"]["currentTariffElecConsumption"] = (double)$current_tariffs -> E -> units;
                $requestObj["user"]["currentTariffGasBill"] = (double)$current_tariffs -> E -> bill;
            }
            
            return response() -> json($requestObj);

            // Repository::applications_processapplication($requestObj, $status);
            // return response() -> json($requestObj, $status);
        }
        catch (Throwable $th)
        {
            throw $th;
            report($th);
            return $this -> BackTo4GetSwitching();
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

    public function BackTo4GetSwitching($errors = [ '' => "Something went wrong. Please try again." ])
    {
        return redirect() -> route('residential.energy-comparison.4-get-switching') -> withErrors($errors) -> withInput();
    }
}