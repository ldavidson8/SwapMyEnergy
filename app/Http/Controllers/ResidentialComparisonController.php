<?php

namespace App\Http\Controllers;

use Throwable;

use App\Http\Controllers\Api\ResidentialApiRepository as Repository;
use App\Http\Requests\Mode\ModeSession;
use App\Mail\ResidentialAPINotificationEmail;
use App\Mail\ResidentialAPINotificationCustomerConfirmationEmail;
use App\Models\TheEnergyShopAPI\ExistingTariffGasModel;use App\Models\TheEnergyShopAPI\BrowseDealsViewModel;
use App\Models\TheEnergyShopAPI\ExistingTariffDualFuelOneModel;
use App\Models\TheEnergyShopAPI\ExistingTariffDualFuelTwoModel;
use App\Models\TheEnergyShopAPI\ExistingTariffElecModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
            Session::forget('ResidentialAPI.existing_tariff');
            Session::forget('ResidentialAPI.current_tariffs');
            Session::forget('ResidentialAPI.new_tariffs');
            Session::forget('ResidentialAPI.selected_tariff');
            Session::forget('ResidentialAPI.selected_supplier');
            Session::forget('ResidentialAPI.selected_payment_methods');
            Session::forget('ResidentialAPI.reference');

            $fields = $request -> all();
            $validator = Validator::make($fields,
            [
                'postcode' => 'required',
                'mpan' => 'required'
            ]);
            if ($validator -> fails()) { return redirect() -> route('residential.energy-comparison.1-address') -> withErrors($validator -> errors()); }
            Log::channel('energy-comparison/find-address-post') -> info('ContactController -> raiseSupportRequest(), Form Validated Successfully');

            $mprn = null;
            if ($fields["mpan"] == "notListed")
            {
                $region = Repository::regionsByPostcode($request -> input("postcode"), $region_status);
            }
            else
            {
                // $mpan = Repository::addresses_mpandetails($fields["mpan"], $status);
                $mprn = Repository::addresses_mprn($fields['postcode'], $fields['houseNo'], $fields['houseName'], $status);
                $region = Repository::regionsByPostcodeAndMpan($request -> input("postcode"), $request -> input("mpan"), $region_status);
            }
            if (!isset($region))
            {
                // api request returned no data
                Log::channel('energy-comparison/find-address-post') -> info("ContactController -> raiseSupportRequest(), Repository::regionsByPostcode(), status: $region_status");
                return $this -> BackTo1FindAddress();
            }

            if (!isset($fields["movingHouse"])) $fields["movingHouse"] = false;
            Session::put('ResidentialAPI.user_address', $fields);
            // Session::put('ResidentialAPI.mpan', $mpan);
            Session::put('ResidentialAPI.mprn', $mprn);
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

            return redirect() -> route('residential.energy-comparison.2-existing-tariff');
        }
        catch (Throwable $th)
        {
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
            if (!isset($supplier_data)) return $this -> BackTo1FindAddress([], true);

            $page_title = 'Compare Energy Prices - Your Tariff';
            return view('energy-comparison.2-set-existing-tariff', compact('page_title', 'supplier_data'));
        }
        catch (Throwable $th)
        {
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
            if (!isset($user_address)) return $this -> BackTo1FindAddress([], true);

            Session::forget('ResidentialAPI.selected_tariff');
            Session::forget('ResidentialAPI.selected_supplier');
            Session::forget('ResidentialAPI.selected_payment_methods');
            Session::forget('ResidentialAPI.reference');

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
                default:
                    return $this -> BackTo2ExistingTariff();
            }
        }
        catch (Throwable $th)
        {
            report($th);
            return $this -> BackTo2ExistingTariff();
        }
    }

    public function setExistingTariffGas(Request $request, $user_address)
    {
        // TODO: validation
        try
        {
            $existing_tariff = new ExistingTariffGasModel($request -> all());

            if ($existing_tariff -> current_tariff_not_listed == "notListed")
            {
                $default_tariff = Repository::tariffs_defaultForASupplier($existing_tariff -> supplier, $existing_tariff -> fuel_type_char, $existing_tariff -> payment_method, $existing_tariff -> e7, $existing_tariff -> region_id, $status);
                if (count($default_tariff) == 0) return $this -> BackTo2ExistingTariff();
                $tariff = Repository::tariffs_info_by_id($default_tariff[0] -> tariffId, $status);
            }
            else $tariff = Repository::tariffs_info_by_id($existing_tariff -> current_tariff, $status);

            $current_tariffs = Repository::tariffs_current(
                $tariff, null,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> consumption_figures, $existing_tariff -> gas, 0,
                $status);

            $tariff_results = Repository::tariffs_results(
                $current_tariffs -> G, null,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> consumption_figures, $existing_tariff -> gas, 0, 0.0,
                $user_address["movingHouse"], $existing_tariff -> payment_method, true, "", $user_address["postcode"],
                $status);

            $tariff_ids = [];
            $new_tariffs = [];
            foreach ($tariff_results["tariffs"] as $row)
            {
                // TODO: find a better way
                $tariff_ids[] = $row["tariffId"];
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
            report($th);
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
                if (count($default_tariff) == 0) return $this -> BackTo2ExistingTariff();
                $tariff = Repository::tariffs_info_by_id($default_tariff[0] -> tariffId, $status);
            }
            else $tariff = Repository::tariffs_info_by_id($existing_tariff -> current_tariff, $status);

            $current_tariffs = Repository::tariffs_current(
                null, $tariff,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> consumption_figures, 0, $existing_tariff -> elec,
                $status);

            $tariff_results = Repository::tariffs_results(
                null, $current_tariffs -> E,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> consumption_figures, null, $existing_tariff -> elec, $existing_tariff -> e7_percent,
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
            report($th);
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
                if (count($default_tariff) == 0) return $this -> BackTo2ExistingTariff();
                $tariff = Repository::tariffs_info_by_id($default_tariff[0] -> tariffId, $status);
            }
            else $tariff = Repository::tariffs_info_by_id($existing_tariff -> current_tariff, $status);

            $current_tariffs = Repository::tariffs_current(
                $tariff, $tariff,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> consumption_figures, $existing_tariff -> gas, $existing_tariff -> elec,
                $status);

            $tariff_results = Repository::tariffs_results(
                $current_tariffs -> G, $current_tariffs -> E,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> consumption_figures, $existing_tariff -> gas, $existing_tariff -> elec, $existing_tariff -> e7_percent,
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
            report($th);
            return $this -> BackTo2ExistingTariff();
        }
    }

    public function setExistingTariffDualFuelTwo(Request $request, $user_address)
    {
        try
        {
            $existing_tariff = new ExistingTariffDualFuelTwoModel($request -> all());

            if ($existing_tariff -> current_tariff_1_not_listed == "notListed")
            {
                $default_tariff = Repository::tariffs_defaultForASupplier($existing_tariff -> supplier_1, $existing_tariff -> fuel_type_char, $existing_tariff -> payment_method, "false", $existing_tariff -> region_id, $status);
                if (count($default_tariff) == 0) return $this -> BackTo2ExistingTariff();
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
                $existing_tariff -> consumption_figures, $existing_tariff -> gas, $existing_tariff -> elec,
                $status);

            $tariff_results = Repository::tariffs_results(
                $current_tariffs -> G, $current_tariffs -> E,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> consumption_figures, $existing_tariff -> gas, $existing_tariff -> elec, $existing_tariff -> e7_percent,
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
            report($th);
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
                return $this -> BackTo2ExistingTariff([], true);
            }

            date_default_timezone_set('Europe/London');
            $showGasExitPenalty = false;
            $gasExitPenalty = null;
            try
            {
                if (in_array($existing_tariff -> fuel_type_str, [ "dfs", "df", "ne" ]))
                {
                    Log::channel('energy-comparison.existing-tariff.exit-penalties') -> log('info', 'Electricity Exit Penalty');
                    $gasExitPenaltyAmount = number_format($current_tariffs -> G -> exitPenaltyAmount / 100, 2);
                    if ($gasExitPenaltyAmount > 0 && isset($current_tariffs -> G -> exitPenaltyEndDate))
                    {
                        $gasExitPenaltyEndDate = date_create($current_tariffs -> G -> exitPenaltyEndDate);
                        if ($gasExitPenaltyEndDate >= date_create('today'))
                        {
                            $showGasExitPenalty = true;
                            $gasExitPenalty = [ 'amount' => $gasExitPenaltyAmount, 'endDate' => date_format($gasExitPenaltyEndDate, 'jS M Y') ];
                        }
                    }
                }
            }
            catch (Throwable $th)
            {
                report($th);
            }

            $showElecExitPenalty = false;
            $elecExitPenalty = null;
            try
            {
                if (in_array($existing_tariff -> fuel_type_str, [ "dfs", "df", "ng" ]))
                {
                    Log::channel('energy-comparison.existing-tariff.exit-penalties') -> log('info', 'Electricity Exit Penalty');

                    $elecExitPenaltyAmount = number_format($current_tariffs -> E -> exitPenaltyAmount, 2);
                    if ($elecExitPenaltyAmount > 0 && isset($current_tariffs -> E -> exitPenaltyEndDate))
                    {
                        $elecExitPenaltyEndDate = date_create($current_tariffs -> E -> exitPenaltyEndDate);
                        if ($elecExitPenaltyEndDate >= date_create('today'))
                        {
                            $showElecExitPenalty = true;
                            $elecExitPenalty = [ 'amount' => $elecExitPenaltyAmount, 'endDate' => date_format($elecExitPenaltyEndDate, 'jS M Y') ];
                            Log::channel('energy-comparison.existing-tariff.exit-penalties') -> log('info', 'Electricity Exit Penalty :- Positive', $elecExitPenalty);
                        }
                    }
                }
            }
            catch (Throwable $th)
            {
                report($th);
            }

            $showExitPenalty = false;
            $exitPenalty = [ 'amount' => 0 ];
            try
            {
                if (in_array($existing_tariff -> fuel_type_str, [ "dfs", "df" ]))
                {
                    if ($showGasExitPenalty)
                    {
                        $showExitPenalty = true;
                        $exitPenalty["amount"] += $gasExitPenalty["amount"];
                        $exitPenalty["gasEndDate"] = $gasExitPenalty["endDate"];
                    }
                    if ($showElecExitPenalty)
                    {
                        $showExitPenalty = true;
                        $exitPenalty["amount"] += $elecExitPenalty["amount"];
                        $exitPenalty["elecEndDate"] = $elecExitPenalty["endDate"];
                    }
                }
            }
            catch (Throwable $th)
            {
                report($th);
            }

            /// Build the view model ///
            $page_title = 'Compare Energy Prices - Browse Deals';
            $params = compact("existing_tariff", "current_tariffs", "new_tariffs", "page_title", "showGasExitPenalty", "gasExitPenalty", "showElecExitPenalty", "elecExitPenalty", "showExitPenalty", "exitPenalty");
            // return response() -> json($params);
            return view('energy-comparison.3-browse-deals', $params);
        }
        catch (Throwable $th)
        {
            report($th);
            return $this -> BackTo2ExistingTariff();
        }
    }


    public function browseDealsPost(Request $request)
    {
        try
        {
            $existing_tariff = Session::get('ResidentialAPI.existing_tariff');
            $new_tariffs = Session::get('ResidentialAPI.new_tariffs');
            if (!isset($existing_tariff) || !isset($new_tariffs))
            {
                return $this -> BackTo2ExistingTariff([], true);
            }

            Session::forget('ResidentialAPI.reference');

            $tariff_position = $request -> input('tariffPosition');
            $selected_tariff = null;
            foreach ($new_tariffs as $tariff)
            {
                if ($tariff["tariffPosition"] == $tariff_position)
                {
                    $selected_tariff = $tariff;
                    continue;
                }
            }
            if (!isset($selected_tariff)) return $this -> BackTo2ExistingTariff();

            $selected_supplier = Repository::supplierById($selected_tariff["supplierId"], $status);
            $selected_payment_methods = Repository::paymentMethods_suppliers($selected_tariff["supplierId"], $existing_tariff -> fuel_type_char, $selected_tariff["e7"], $status);

            Session::put('ResidentialAPI.selected_supplier', $selected_supplier);
            Session::put('ResidentialAPI.selected_tariff', $selected_tariff);
            Session::put('ResidentialAPI.selected_payment_methods', $selected_payment_methods);

            return redirect() -> action([ self::class, 'getSwitching' ]);
        }
        catch (Throwable $th)
        {
            report($th);
            return $this -> BackTo3BrowseDeals();
        }
    }

    public function browseDealsFuncTariffHasPosition($tariff, $target_posistion)
    {
        return $tariff -> tariffPosition == $target_posistion;
    }


    public function getSwitching()
    {
        try
        {
            // get session variables
            // TODO: Cleaned - uncomment
            $user_address = Session::get('ResidentialAPI.user_address');
            $mprn = Session::get('ResidentialAPI.mprn');
            $region = Session::get('ResidentialAPI.region');
            $existing_tariff = Session::get('ResidentialAPI.existing_tariff');
            $current_tariffs = Session::get('ResidentialAPI.current_tariffs');
            $selected_supplier = Session::get('ResidentialAPI.selected_supplier');
            $selected_tariff = Session::get('ResidentialAPI.selected_tariff');
            $selected_payment_methods = Session::get('ResidentialAPI.selected_payment_methods');

            // TODO: Cleaned - uncomment
            if (!isset($user_address) || !isset($mprn) || !isset($region) || !isset($existing_tariff) || !isset($current_tariffs) || !isset($selected_supplier) || !isset($selected_tariff) || !isset($selected_payment_methods))
            {
                return $this -> BackTo3BrowseDeals([], true);
            }

            // check if previous addresses are required
            // TODO: Cleaned - uncomment
            $get_previous_addresses = false;
            if (in_array(strtolower($selected_tariff["supplierName"]), array('shell energy', 'goto.energy')))
            {
                $get_previous_addresses = true;
            }

            // TODO: Cleaned - uncomment
            $page_title = "Get Switching - Energy Swap";
            $params = compact('page_title', 'user_address', 'mprn', 'region', 'existing_tariff', 'current_tariffs', 'selected_tariff', 'selected_supplier', 'selected_payment_methods', 'get_previous_addresses');
            // return response() -> json($params);
            return view('energy-comparison.4-get-switching', $params);
        }
        catch (Throwable $th)
        {
            report($th);
            return $this -> BackTo3BrowseDeals();
        }
    }


    protected const agentId = "333-7TDfpTnZOo";

    public function getSwitchingPost(Request $request)
    {
        try
        {
            $user_address = Session::get('ResidentialAPI.user_address');
            $existing_tariff = Session::get('ResidentialAPI.existing_tariff');
            $current_tariffs = Session::get('ResidentialAPI.current_tariffs');
            $selected_tariff = Session::get('ResidentialAPI.selected_tariff');

            if (!isset($user_address) || !isset($existing_tariff) || !isset($current_tariffs) || !isset($selected_tariff))
            {
                return $this -> BackTo4GetSwitching([], true);
            }

            // return $this -> BackTo4GetSwitching();
            $formData = $request -> all();
            // return response() -> json($formData);
            $validator = Validator::make($formData,
            [
                'house_number' => 'nullable|integer',
                'postcode' => 'required|string',
                'address_line_1' => 'required|string',
                'address_line_2' => 'nullable|string',
                'road_name' => 'required|string',
                'town' => 'required|string',
                'county' => 'nullable|string',
                'postcode' => 'required|string',
                'smartMeter' => 'required|string|in:Y,N,DK',
                'payment_method' => 'required|in:MDD,QDD,CAC,PRE',
                'accountName' => 'required|string',
                'sortCode1' => 'required|numeric|digits:2',
                'sortCode2' => 'required|numeric|digits:2',
                'sortCode3' => 'required|numeric|digits:2',
                'accountNumber' => 'required|string',
                // 'bankName' => 'required|string',
                'preferredDay' => 'nullable|integer|min:1|max:28',
                'direct_debit_confirmation' => 'nullable',
                'receiveBills' => 'nullable|string|in:Paper,Email',
                'title' => 'required|string',
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'telephone' => 'required|numeric|starts_with:0',
                'mobile' => 'nullable|numeric|starts_with:0',
                'emailAddress' => 'required|email',
                'dob' => 'required|date'
            ]);
            $validator -> validate();

            $previous_addresses_counter = 0;
            if (isset($formData['address_length_years']))
            {
                $previous_addresses_counter++;
                $address_length_years = $formData['address_length_years'];
                $address_length_months = $formData['address_length_months'];
                Validator::validate($formData,
                [
                    'address_length_years' => 'required|numeric|min:0',
                    'address_length_months' => 'required|numeric|min:0|max:11'
                ]);

                if ($address_length_years < 3)
                {
                    $previous_addresses_counter++;
                    $prev_address_length_years = $formData['prev_addr_1_length_years'];
                    $prev_address_length_months = $formData['prev_addr_1_length_months'];
                    Validator::validate($formData,
                    [
                        'prev_addr_1_house_number' => 'nullable|integer',
                        'prev_addr_1_postcode' => 'required|string',
                        'prev_addr_1_address_line_1' => 'required|string',
                        'prev_addr_1_address_line_2' => 'nullable|string',
                        'prev_addr_1_road_name' => 'required|string',
                        'prev_addr_1_town' => 'required|string',
                        'prev_addr_1_county' => 'nullable|string',
                        'prev_addr_1_length_years' => 'required|numeric|min:0',
                        'prev_addr_1_length_months' => 'required|numeric|min:0|max:11'
                    ]);

                    $total_length_months = $address_length_months + $prev_address_length_months;
                    $total_length_years = $address_length_years + $prev_address_length_years + ($total_length_months / 12);
                    if ($total_length_years < 3)
                    {
                        $previous_addresses_counter++;
                        Validator::validate($formData,
                        [
                            'prev_addr_2_house_number' => 'nullable|integer',
                            'prev_addr_2_postcode' => 'required|string',
                            'prev_addr_2_address_line_1' => 'required|string',
                            'prev_addr_2_address_line_2' => 'nullable|string',
                            'prev_addr_2_road_name' => 'required|string',
                            'prev_addr_2_town' => 'required|string',
                            'prev_addr_2_county' => 'nullable|string',
                            'prev_addr_2_length_years' => 'required|numeric|min:0',
                            'prev_addr_2_length_months' => 'required|numeric|min:0|max:11'
                        ]);
                    }
                }
            }

            $telephone = $request -> input('telephone');
            if (strlen($telephone) != 11) return $this -> BackTo4GetSwitching($validator -> errors([ '' => 'The telephone must be 11 digits long.' ]));
            if ($request -> has('mobile'))
            {
                $mobile = $request -> input('mobile');
                if (strlen($mobile) > 0 && strlen($request -> input('mobile')) != 11) return $this -> BackTo4GetSwitching($validator -> errors([ '' => 'The telephone must be 11 digits long.' ]));
            }

            $special_needs_priority_services_register = $request -> has('special_needs_priority_services_register') && (in_array($request -> input('special_needs_priority_services_register'), [ true, 1, '1' ], true) || strtolower($request -> input('special_needs_priority_services_register')) == 'on');

            $billing_address = null;
            $same_current_address = $request -> has('same_current_address') && (in_array($request -> input('same_current_address'), [ true, 1, '1' ], true) || strtolower($request -> input('same_current_address')) == 'on');
            if (!$same_current_address)
            {
                $validator = Validator::make($formData,
                [
                    'billing_house_number' => 'nullable|integer',
                    'billing_postcode' => 'required|string',
                    'billing_address_line_1' => 'required|string',
                    'billing_address_line_2' => 'nullable|string',
                    'billing_road_name' => 'required|string',
                    'billing_town' => 'required|string',
                    'billing_county' => 'nullable|string'
                ]);
                if ($validator -> fails()) return $this -> BackTo4GetSwitching($validator -> errors());

                $billing_address =
                [
                    "line1" => $request -> input('billing_address_line_1'),
                    "line2" => $request -> input('billing_address_line_2'),
                    "line3" => "",
                    "town" => $request -> input('billing_town'),
                    "county" => $request -> has('billing_county') ? $request -> input('billing_county') : "",
                    "postcode" => $request -> input('billing_postcode'),
                    "bldNumber" => $request -> input('billing_house_number'),
                    "bldName" => "",
                    "subBld" => "",
                    "throughfare" => $request -> input('billing_road_name'),
                    "dependantThroughFare" => ""
                ];
            }

            $supplier_opt_in = $request -> has('supplier_opt_in') && (in_array($request -> input('supplier_opt_in'), [ true, 1, '1' ], true) || strtolower($request -> input('supplier_opt_in')) == 'on');
            $supplier_opt_in_email = $request -> has('supplier_partners_email') && (in_array($request -> input('supplier_partners_email'), [ true, 1, '1' ], true) || strtolower($request -> input('supplier_partners_email')) == 'on');
            $supplier_opt_in_sms = $request -> has('supplier_partners_sms') && (in_array($request -> input('supplier_partners_sms'), [ true, 1, '1' ], true) || strtolower($request -> input('supplier_partners_sms')) == 'on');
            $supplier_opt_in_telephone = $request -> has('supplier_partners_telephone') && (in_array($request -> input('supplier_partners_telephone'), [ true, 1, '1' ], true) || strtolower($request -> input('supplier_partners_telephone')) == 'on');
            $supplier_opt_in_letter = $request -> has('supplier_partners_letter') && (in_array($request -> input('supplier_partners_letter'), [ true, 1, '1' ], true) || strtolower($request -> input('supplier_partners_letter')) == 'on');
            if (!$request -> has('supplier_partners_email')) $supplier_opt_in_email = $supplier_opt_in;
            if (!$request -> has('supplier_partners_sms')) $supplier_opt_in_sms = $supplier_opt_in;
            if (!$request -> has('supplier_partners_telephone')) $supplier_opt_in_telephone = $supplier_opt_in;
            if (!$request -> has('supplier_partners_letter')) $supplier_opt_in_letter = $supplier_opt_in;

            if ($existing_tariff -> fuel_type_char == 'D' || $existing_tariff -> fuel_type_char == 'G')
            {
                if (!$request -> has('gas_meter_number') || strlen($request -> input('gas_meter_number')) <= 0)
                {
                    return $this -> BackTo4GetSwitching([ '' => 'The gas meter number is required.' ]);
                }
            }
            if ($existing_tariff -> fuel_type_char == 'D' || $existing_tariff -> fuel_type_char == 'E')
            {
                if (!$request -> has('elec_meter_number') || strlen($request -> input('elec_meter_number')) <= 0)
                {
                    return $this -> BackTo4GetSwitching([ '' => 'The electricity meter number is required.' ]);
                }
            }

            $direct_debit_confirmation = false;
            if ($request -> has("direct_debit_confirmation")) $direct_debit_confirmation = (bool)$request -> input("direct_debit_confirmation");

            $address_line_2 = $request -> input("address_line_2");
            $county = $request -> has('county') ? $request -> input('county') : "";

            $requestObj = array("user" =>
            [
                "saleType" => "A",
                "agentId" => self::agentId,
                "serviceTypeToCompare" => $existing_tariff -> fuel_type_char,
                "gasSupplier" => null,
                "gasTariffId" => null,
                "gasPayment" => null,
                "currentTariffGasConsumption" => null,
                "currentTariffGasBill" => null,
                "elecSupplier" => null,
                "elecTariffId" => null,
                "elecPayment" => null,
                "currentTariffElecConsumption" => null,
                "currentTariffElecBill" => null,
                "E7" => (bool)$selected_tariff["e7"],
                "e7Usage" => (int)$existing_tariff -> e7_percent,
                "newSupplierName" => $selected_tariff["supplierName"],
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
                "dob" => date_format(date_create($request -> input("dob")), "d/m/Y"),
                "currentAddress" => [
                    "line1" => $request -> input("address_line_1"),
                    "line2" => (isset($address_line_2)) ? $address_line_2 : "",
                    "line3" => "",
                    "town" => $request -> input("town"),
                    "county" => (isset($county)) ? $county : "",
                    "postcode" => $request -> input("postcode"),
                    "bldNumber" => $request -> input("house_number"),
                    "bldName" => "",
                    "subBld" => "",
                    "throughfare" => $request -> input("road_name"),
                    "dependantThroughFare" => "",
                    "yearsAtResidence" => 0,
                    "monthsAtResidence" => 0,
                    "mprn" => $request -> input("gas_meter_number"),
                    "mpanNumber" => $request -> input("elec_meter_number")
                ],
                "sameCurrentAddress" => $same_current_address,
                "billingAddress" => null,
                // [
                //     "line1" => "1 Street",
                //     "line2" => "Area",
                //     "line3" => "",
                //     "town" => "London",
                //     "county" => "East London",
                //     "postcode" => "E1 6AN",
                //     "bldNumber" => "",
                //     "bldName" => "",
                //     "subBld" => "",
                //     "throughfare" => "",
                //     "dependantThroughFare" => ""
                // ],
                "previousAddress" =>
                [
                    "line1" => "",
                    "line2" => "",
                    "line3" => "",
                    "town" => "",
                    "county" => "",
                    "postcode" => "",
                    "bldNumber" => "",
                    "bldName" => "",
                    "subBld" => "",
                    "throughfare" => "",
                    "dependantThroughFare" => "",
                    "yearsAtResidence" => 0,
                    "monthsAtResidence" => 0
                ],
                "previousAddressTwo" =>
                [
                    "line1" => "",
                    "line2" => "",
                    "line3" => "",
                    "town" => "",
                    "county" => "",
                    "postcode" => "",
                    "bldNumber" => "",
                    "bldName" => "",
                    "subBld" => "",
                    "throughfare" => "",
                    "dependantThroughFare" => "",
                    "yearsAtResidence" => 0,
                    "monthsAtResidence" => 0
                ],
                "smartMeter" => $request -> input("smartMeter")
            ],
            "payment" => [
                "paymentMethod" => $request -> input("payment_method"),
                "accountName" => $request -> input("accountName"),
                "sortCodeOne" => $request -> input("sortCode1"),
                "sortCodeTwo" => $request -> input("sortCode2"),
                "sortCodeThree" => $request -> input("sortCode3"),
                "accountNumber" => $request -> input("accountNumber"),
                // "bankName" => $request -> input("bankName"),
                "preferredDay" => ($request -> has("preferredDay")) ? (int)$request -> input("preferredDay") : null,
                "ddAuthorisation" => true,
                "receiveBills" => ($request -> has("receiveBills")) ? $request -> input("receiveBills") : "Paper",
                "supplierOptIn" => $supplier_opt_in_email,
                "supplierLetterOptIn" => $supplier_opt_in_letter,
                "supplierPhoneOptIn" => $supplier_opt_in_telephone,
                "supplierTextOptIn" => $supplier_opt_in_sms,
                "specialNeeds" => $special_needs_priority_services_register
            ]);

            if (in_array($existing_tariff -> fuel_type_char, [ "D", "G" ]))
            {
                $gas_unit_price = $selected_tariff["price1Gas"];
                if ($gas_unit_price == 0) $gas_unit_price = $selected_tariff['price2Gas'];
                if ($gas_unit_price == 0) $gas_unit_price = $selected_tariff['price3Gas'];
                if ($gas_unit_price == 0) $gas_unit_price = $selected_tariff['price4Gas'];

                $requestObj["user"]["gasSupplier"] = (int)$current_tariffs -> G -> supplierId;
                $requestObj["user"]["gasTariffId"] = (int)$current_tariffs -> G -> tariffId;
                $requestObj["user"]["gasPayment"] = $current_tariffs -> G -> paymentMethod;
                $requestObj["user"]["currentTariffGasConsumption"] = (double)$current_tariffs -> G -> units;
                $requestObj["user"]["currentTariffGasBill"] = (double)$current_tariffs -> G -> bill;

                if ($requestObj["user"]["billGas"] == 0)
                {
                    $gas_price = $current_tariffs -> G -> units * $gas_unit_price / 100;
                    $gas_price += $selected_tariff['standingChargeGas'] / 100;
                    $requestObj["user"]["billGas"] = (float)number_format($gas_price, 2);
                }
            }

            if (in_array($existing_tariff -> fuel_type_char, [ "D", "E" ]))
            {
                $requestObj["user"]["elecSupplier"] = (int)$current_tariffs -> E -> supplierId;
                $requestObj["user"]["elecTariffId"] = (int)$current_tariffs -> E -> tariffId;
                $requestObj["user"]["elecPayment"] = $current_tariffs -> E -> paymentMethod;
                $requestObj["user"]["currentTariffElecConsumption"] = (double)$current_tariffs -> E -> units;
                $requestObj["user"]["currentTariffElecBill"] = (double)$current_tariffs -> E -> bill;
                if ($requestObj["user"]["billElec"] == 0)
                {
                    $elec_unit_price = $selected_tariff['price1Elec'];
                    if ($elec_unit_price == 0) $elec_unit_price = $selected_tariff['price2Elec'];
                    if ($elec_unit_price == 0) $elec_unit_price = $selected_tariff['price3Elec'];
                    if ($elec_unit_price == 0) $elec_unit_price = $selected_tariff['price4Elec'];
                    $elec_e7_unit_price = $selected_tariff['priceE7'];

                    $elec_units = $current_tariffs -> E -> units;
                    $elec_no_e7_price = $elec_units * $elec_unit_price;
                    $elec_e7_price = $elec_units * $elec_e7_unit_price;
                    if ($current_tariffs -> E -> e7)
                    {
                        $elec_price = $elec_e7_price * (100 - (int)$existing_tariff -> e7_percent) / 100;
                        $elec_price += $elec_no_e7_price * ((int)$existing_tariff -> e7_percent) / 100;
                    }
                    else
                    {
                        $elec_price = $elec_no_e7_price;
                    }

                    $elec_price += $selected_tariff['standingChargeElec'];
                    $requestObj["user"]["billElec"] = (float)number_format($elec_price / 100, 2);
                    // return response() -> json(compact('elec_unit_price', 'elec_e7_unit_price', 'elec_units', 'elec_no_e7_price', 'elec_e7_price', 'elec_price'));
                }
            }

            if ($previous_addresses_counter >= 1)
            {
                $requestObj["user"]["currentAddress"]["yearsAtResidence"] = (int)$formData['address_length_years'];
                $requestObj["user"]["currentAddress"]["monthsAtResidence"] = (int)$formData['address_length_months'];

                if ($previous_addresses_counter >= 2)
                {
                    $requestObj["user"]["previousAddress"]["bldNumber"] = $formData['prev_addr_1_house_number'];
                    $requestObj["user"]["previousAddress"]["postcode"] = $formData['prev_addr_1_postcode'];
                    $requestObj["user"]["previousAddress"]["line1"] = $formData['prev_addr_1_address_line_1'];
                    $requestObj["user"]["previousAddress"]["line2"] = $formData['prev_addr_1_address_line_2'];
                    $requestObj["user"]["previousAddress"]["throughfare"] = $formData['prev_addr_1_road_name'];
                    $requestObj["user"]["previousAddress"]["town"] = $formData['prev_addr_1_town'];
                    $requestObj["user"]["previousAddress"]["county"] = $formData['prev_addr_1_county'];
                    $requestObj["user"]["previousAddress"]["yearsAtResidence"] = (int)$formData['prev_addr_1_length_years'];
                    $requestObj["user"]["previousAddress"]["monthsAtResidence"] = (int)$formData['prev_addr_1_length_months'];

                    if ($previous_addresses_counter >= 3)
                    {
                        $requestObj["user"]["previousAddressTwo"]["bldNumber"] = $formData['prev_addr_1_house_number'];
                        $requestObj["user"]["previousAddressTwo"]["postcode"] = $formData['prev_addr_1_postcode'];
                        $requestObj["user"]["previousAddressTwo"]["line1"] = $formData['prev_addr_2_address_line_1'];
                        $requestObj["user"]["previousAddressTwo"]["line2"] = $formData['prev_addr_2_address_line_2'];
                        $requestObj["user"]["previousAddressTwo"]["throughfare"] = $formData['prev_addr_1_road_name'];
                        $requestObj["user"]["previousAddressTwo"]["town"] = $formData['prev_addr_2_town'];
                        $requestObj["user"]["previousAddressTwo"]["county"] = $formData['prev_addr_2_county'];
                        $requestObj["user"]["previousAddressTwo"]["yearsAtResidence"] = (int)$formData['prev_addr_2_length_years'];
                        $requestObj["user"]["previousAddressTwo"]["monthsAtResidence"] = (int)$formData['prev_addr_2_length_months'];
                    }
                }
            }

            if (!$same_current_address)
            {
                $requestObj["user"]["billingAddress"] = $billing_address;
            }
            else
            {
                $requestObj["user"]["billingAddress"] =
                [
                    "line1" => $requestObj["user"]["currentAddress"]["line1"],
                    "line2" => $requestObj["user"]["currentAddress"]["line2"],
                    "line3" => $requestObj["user"]["currentAddress"]["line3"],
                    "town" => $requestObj["user"]["currentAddress"]["town"],
                    "county" => $requestObj["user"]["currentAddress"]["county"],
                    "postcode" => $requestObj["user"]["currentAddress"]["postcode"],
                    "bldNumber" => $requestObj["user"]["currentAddress"]["bldNumber"],
                    "bldName" => $requestObj["user"]["currentAddress"]["bldName"],
                    "subBld" => $requestObj["user"]["currentAddress"]["subBld"],
                    "throughfare" => $requestObj["user"]["currentAddress"]["throughfare"],
                    "dependantThroughFare" => $requestObj["user"]["currentAddress"]["dependantThroughFare"]
                ];
            }
            // return response() -> json($request -> all());
            // return response() -> json($requestObj);

            // TODO: Cleaned - uncomment
            $result_str = Repository::applications_processapplication($requestObj, $status) -> body();
            if (str_starts_with($result_str, "{"))
            {
                // The api returned an error
                Log::channel("energy-comparison/get-switching-post") -> critical("The API returned an error.");
                return $this -> BackTo4GetSwitching();
            }
            Log::channel("energy-comparison/get-switching-post") -> info("The API succeeded.");
            // TODO: Cleaned - comment
            //**/$result_str = "Testing123Testing";

            $swapmyenergy_opt_in = false;
            if ($request -> has("swapmyenergy_opt_in"))
            {
                $swapmyenergy_opt_in = $request -> has('swapmyenergy_opt_in') && (in_array($request -> input('swapmyenergy_opt_in'), [ true, 1, '1' ], true) || strtolower($request -> input('swapmyenergy_opt_in')) == 'on');
            }

            Session::put('ResidentialAPI.reference', $result_str);

            $to_email = env('MAIL_TO_ADDRESS');
            // TODO: Finish change "Test API Key" to "Real API Key"
            Mail::to($to_email) -> queue(new ResidentialAPINotificationEmail($requestObj, date("Y-m-d H:i:s"), "Test API Key", $result_str, $swapmyenergy_opt_in));
            Mail::to($request -> input("emailAddress")) -> queue(new ResidentialAPINotificationCustomerConfirmationEmail($requestObj, $result_str));

            return redirect() -> route('residential.energy-comparison.success');
        }
        catch (Throwable $th)
        {
            report($th);
            return $this -> BackTo4GetSwitching();
        }
    }

    public function success()
    {
        $selected_tariff = Session::get('ResidentialAPI.selected_tariff');
        $reference = Session::get('ResidentialAPI.reference');
        if (!isset($selected_tariff) || !isset($reference)) return $this -> BackTo4GetSwitching([], true);

        $page_title = "Compare Energy Prices - Success";
        return view('energy-comparison.success', compact('page_title', 'selected_tariff', 'reference'));
    }



    public function BackTo1FindAddress($errors = [ '' => "Something went wrong. Please check your input and try again." ], $sessionExpired = false)
    {
        if ($sessionExpired) return redirect() -> route('residential.energy-comparison.1-address') -> withFail('session_expired') -> withInput();
        else return redirect() -> route('residential.energy-comparison.1-address') -> withErrors($errors) -> withInput();
    }

    public function BackTo2ExistingTariff($errors = [ '' => "Something went wrong. Please check your input and try again." ], $sessionExpired = false)
    {
        if ($sessionExpired) return redirect() -> route('residential.energy-comparison.2-existing-tariff') -> withFail('session_expired') -> withInput();
        return redirect() -> route('residential.energy-comparison.2-existing-tariff') -> withErrors($errors) -> withInput();
    }

    public function BackTo3BrowseDeals($errors = [ '' => "Something went wrong. Please try again later." ], $sessionExpired = false)
    {
        if ($sessionExpired) return redirect() -> route('residential.energy-comparison.3-browse-deals') -> withFail('session_expired') -> withInput();
        return redirect() -> route('residential.energy-comparison.3-browse-deals') -> withErrors($errors) -> withInput();
    }

    public function BackTo4GetSwitching($errors = [ '' => "Something went wrong. Please check your input and try again." ], $sessionExpired = false)
    {
        if ($sessionExpired) return redirect() -> route('residential.energy-comparison.4-get-switching') -> withFail('session_expired') -> withInput();
        return redirect() -> route('residential.energy-comparison.4-get-switching') -> withErrors($errors) -> withInput();
    }
}
