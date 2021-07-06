<?php

namespace App\Http\Controllers;

use Throwable;

use App\Http\Controllers\API\ResidentialApiRepository as Repository;
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
                $existing_tariff -> gas_kwh, 0,
                $status);
            
            $tariff_results = Repository::tariffs_results(
                $current_tariffs -> G, null,
                $existing_tariff -> fuel_type_char, $existing_tariff -> fuel_type_str,
                $existing_tariff -> gas_kwh, 0, 0.0,
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
            $existing_tariff = Session::get('ResidentialAPI.existing_tariff');
            $new_tariffs = Session::get('ResidentialAPI.new_tariffs');
            $tariff_position = $request -> input('tariffPosition');
            $selected_tariff = $new_tariffs[$tariff_position - 1];
            Session::put('ResidentialAPI.selected_tariff', $selected_tariff);
            
            $selected_payment_methods = Repository::paymentMethods_suppliers($selected_tariff["supplierId"], $existing_tariff -> fuel_type_char, $existing_tariff -> e7);
            Session::put('ResidentialAPI.selected_payment_methods', $selected_payment_methods);
            
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
            $selected_payment_methods = Session::get('ResidentialAPI.selected_payment_methods');

            if (!isset($user_address) || !isset($mprn) || !isset($region) || !isset($existing_tariff) || !isset($current_tariffs) || !isset($selected_tariff) || !isset($selected_payment_methods))
            {
                return $this -> BackTo3BrowseDeals();
            }
            
            $page_title = "Get Switching - Energy Swap";
            $params = compact('page_title', 'user_address', 'mprn', 'region', 'existing_tariff', 'current_tariffs', 'selected_tariff', 'selected_payment_methods');
            return view('energy-comparison.4-get-switching', $params);
        }
        catch (Throwable $th)
        {
            throw $th;
            report($th);
            return $this -> BackTo3BrowseDeals();
        }
    }


    protected const agentId = "333-7TDfpTnZOo";
    
    public function getSwitchingPost(Request $request)
    {
        try
        {
            // return $this -> BackTo4GetSwitching();
            // return response() -> json($request -> all());
            $validator = Validator::make($request -> all(),
            [
                'postcode' => 'required|string',
                'address_line_1' => 'required|string',
                'address_line_2' => 'nullable|string',
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
                'bankName' => 'required|string',
                'preferredDay' => 'required|integer|min:1|max:28',
                'direct_debit_confirmation' => 'accepted',
                'receiveBills' => 'required|string|in:Email',
                'title' => 'required|string',
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'telephone' => 'required|numeric|starts_with:0',
                'mobile' => 'nullable|numeric|starts_with:0',
                'emailAddress' => 'required|email',
                'dob' => 'required|date'
            ]);
            $validator -> validate();
            

            $telephone = $request -> input('telephone');
            if (strlen($telephone) != 11) return $this -> BackTo4GetSwitching($validator -> errors([ '' => 'The telephone must be 11 digits long.' ]));
            if ($request -> has('mobile'))
            {
                $mobile = $request -> input('mobile');
                if (strlen($mobile) > 0 && strlen($request -> input('mobile')) != 11) return $this -> BackTo4GetSwitching($validator -> errors([ '' => 'The telephone must be 11 digits long.' ]));
            }
            if (!$request -> input('direct_debit_confirmation')) return $this -> BackTo4GetSwitching([ '' => 'You must confirm that you are the account holder and the only person required to authorise Direct Debits from your bank account.' ]);
            
            $supplier_opt_in = $request -> has('supplier_opt_in') && (in_array($request -> input('supplier_opt_in'), [ true, 1, '1' ], true) || strtolower($request -> input('supplier_opt_in')) == 'on');
            $billing_address = null;
            $same_current_address = $request -> has('same_current_address') && (in_array($request -> input('same_current_address'), [ true, 1, '1' ], true) || strtolower($request -> input('same_current_address')) == 'on');
            if (!$same_current_address)
            {
                $validator = Validator::make($request -> all(),
                [
                    'billing_postcode' => 'required|string',
                    'billing_address_line_1' => 'required|string',
                    'billing_address_line_2' => 'nullable|string',
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
                    "county" => $request -> input('billing_county'),
                    "postcode" => $request -> input('billing_postcode'),
                    "bldNumber" => "1",
                    "bldName" => "",
                    "subBld" => "",
                    "throughfare" => "",
                    "dependantThroughFare" => ""
                ];
            }
            
            $user_address = Session::get('ResidentialAPI.user_address');
            $mprn = Session::get('ResidentialAPI.mprn');
            $existing_tariff = Session::get('ResidentialAPI.existing_tariff');
            $current_tariffs = Session::get('ResidentialAPI.current_tariffs');
            $selected_tariff = Session::get('ResidentialAPI.selected_tariff');
            
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
            
            // $addresses_mprn = Repository::addresses_mprn($mprn -> postcode, $mprn -> house_number);
            // return response() -> json($addresses_mprn);
            
            if (!isset($user_address) || !isset($mprn) || !isset($existing_tariff) || !isset($current_tariffs) || !isset($selected_tariff))
            {
                return $this -> BackTo4GetSwitching();
            }

            // return response() -> json(compact('user_address', 'mprn', 'existing_tariff', 'current_tariffs', 'selected_tariff'));
            
            // $mpandetails = Repository::addresses_mpandetails($user_address["mpan"], $status);
            // return response() -> json($mpandetails, $status);
            
            $address_line_2 = $request -> input("address_line_2");
            $county = $request -> input("county");
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
                "e7Usage" => 0,
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
                    "bldNumber" => "1",
                    "bldName" => "",
                    "subBld" => "",
                    "throughfare" => "",
                    "dependantThroughFare" => "",
                    "yearsAtResidence" => 3,
                    "monthsAtResidence" => 6,
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
                //     "bldNumber" => "1",
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
                "bankName" => $request -> input("bankName"),
                "preferredDay" => (int)$request -> input("preferredDay"),
                "ddAuthorisation" => (bool)$request -> input("direct_debit_confirmation"),
                "receiveBills" => $request -> input("receiveBills"),
                "supplierOptIn" => $supplier_opt_in,
                "supplierLetterOptIn" => $supplier_opt_in,
                "supplierPhoneOptIn" => $supplier_opt_in,
                "supplierTextOptIn" => $supplier_opt_in,
                "specialNeeds" => false
            ]);
            
            if (in_array($existing_tariff -> fuel_type_char, [ "D", "G" ]))
            {
                $requestObj["user"]["gasSupplier"] = (int)$current_tariffs -> G -> supplierId;
                $requestObj["user"]["gasTariffId"] = (int)$current_tariffs -> G -> tariffId;
                $requestObj["user"]["gasPayment"] = $current_tariffs -> G -> paymentMethod;
                $requestObj["user"]["currentTariffGasConsumption"] = (double)$current_tariffs -> G -> units;
                $requestObj["user"]["currentTariffGasBill"] = (double)$current_tariffs -> G -> bill;
                
                // if (!isset($requestObj["user"]["billGas"]) || $requestObj["user"]["billGas"] == 0)
                // {
                //     $requestObj["user"]["billGas"] = (double)(($selected_tariff["tariff_info"] -> price1Gas * $current_tariffs -> G -> units) + $selected_tariff["tariff_info"] -> standingChargeGas);
                //     return response() -> json(
                //         [
                //         'gas_units' => $selected_tariff["tariff_info"] -> price1Gas * $current_tariffs -> G -> units,
                //         'standingCharge' => $selected_tariff["tariff_info"] -> standingChargeGas
                //     ]);
                // }
            }

            if (in_array($existing_tariff -> fuel_type_char, [ "D", "E" ]))
            {
                $requestObj["user"]["elecSupplier"] = (int)$current_tariffs -> E -> supplierId;
                $requestObj["user"]["elecTariffId"] = (int)$current_tariffs -> E -> tariffId;
                $requestObj["user"]["elecPayment"] = $current_tariffs -> E -> paymentMethod;
                $requestObj["user"]["currentTariffElecConsumption"] = (double)$current_tariffs -> E -> units;
                $requestObj["user"]["currentTariffElecBill"] = (double)$current_tariffs -> E -> bill;
                
                // if (!isset($requestObj["user"]["billElec"]) || $requestObj["user"]["billElec"] == 0)
                // {
                //     $requestObj["user"]["billElec"] = (double)(($selected_tariff["tariff_info"] -> price1Elec * $current_tariffs -> E -> units) + $selected_tariff["tariff_info"] -> standingChargeElec);
                //     return response() -> json(
                //     [
                //         'bill' => $selected_tariff["bill"],
                //         'info_bill' => $selected_tariff["tariff_info"] -> bill,
                //         'elec_subtotal' => $selected_tariff["tariff_info"] -> price1Elec * $current_tariffs -> E -> units / 100,
                //         'elec_price' => $selected_tariff["tariff_info"] -> price1Elec,
                //         'elec_units' => $current_tariffs -> E -> units,
                //         'standingCharge' => $selected_tariff["tariff_info"] -> standingChargeElec / 100
                //     ]);
                // }
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
            return response() -> json($requestObj);
            // TODO: remove this if statement for the live site
            if ($requestObj["email"] != "testingthefinalapicall@testing.co.uk")
            {
                $result_str = Repository::applications_processapplication($requestObj, $status) -> body();
                if (str_starts_with($result_str, "{"))
                {
                    // The api returned an error
                    Log::channel("energy-comparison/get-switching-post") -> critical("The API returned an error.");
                    return $this -> BackTo4GetSwitching();
                }
                Log::channel("energy-comparison/get-switching-post") -> info("The API succeeded.");
            }
            else $result_str = "Testing123Testing";

            Session::put('ResidentialAPI.reference', $result_str);
            
            $to_email = env('MAIL_TO_ADDRESS');
            Mail::to($to_email) -> queue(new ResidentialAPINotificationEmail($requestObj, date("Y-m-d H:i:s"), "Test API Key", $result_str));

            Mail::to($request -> input("emailAddress")) -> queue(new ResidentialAPINotificationCustomerConfirmationEmail($requestObj, $result_str), $result_str);

            return redirect() -> route('residential.energy-comparison.success');
        }
        catch (Throwable $th)
        {
            throw $th;
            report($th);
            return $this -> BackTo4GetSwitching();
        }
    }

    public function success()
    {
        $selected_tariff = Session::get('ResidentialAPI.selected_tariff');
        $reference = Session::get('ResidentialAPI.reference');
        if (!isset($selected_tariff) || !isset($reference)) return $this -> BackTo4GetSwitching();

        $page_title = "Compare Energy Prices - Success";
        return view('energy-comparison.success', compact('page_title', 'selected_tariff', 'reference'));
    }

    

    public function BackTo1FindAddress($errors = [ '' => "Something went wrong. Please check your input and try again." ])
    {
        return redirect() -> route('residential.energy-comparison.1-address') -> withErrors($errors) -> withInput();
    }

    public function BackTo2ExistingTariff($errors = [ '' => "Something went wrong. Please check your input and try again." ])
    {
        return redirect() -> route('residential.energy-comparison.2-existing-tariff') -> withErrors($errors) -> withInput();
    }

    public function BackTo3BrowseDeals($errors = [ '' => "Something went wrong. Please try again later." ])
    {
        return redirect() -> route('residential.energy-comparison.3-browse-deals') -> withErrors($errors) -> withInput();
    }

    public function BackTo4GetSwitching($errors = [ '' => "Something went wrong. Please check your input and try again." ])
    {
        return redirect() -> route('residential.energy-comparison.4-get-switching') -> withErrors($errors) -> withInput();
    }
}