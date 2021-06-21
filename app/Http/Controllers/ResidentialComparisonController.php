<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ResidentialApiRepository as Repository;
use App\Http\Controllers\Api\ResidentialApiController;
use App\Http\Requests\Mode\ModeSession;
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
    

    public function setExistingTariff()
    {
        ModeSession::setResidential();

        // DEBUG: returns a full list of suppliers in json format
        // return response() -> json(Repository::suppliers($status), $status);
        
        $region = Session::get('region', null);
        if (!isset($region)) return redirect() -> back() -> withErrors([ 'error' => 'An error occured, please try again later.' ]) -> withInput();
        //return response() -> json($region["id"]);
        
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
            // foreach ($all_dual_suppliers as $ds) if (stripos($ds["name"], $os) !== false) $dual_suppliers[] = $ds;
            // foreach ($all_gas_suppliers as $gs) if (stripos($gs["name"], $os) !== false) $gas_suppliers[] = $gs;
            // foreach ($all_electric_suppliers as $es) if (stripos($es["name"], $os) !== false) $electric_suppliers[] = $es;
            foreach ($dual_suppliers as $dual_supplier) if ($dual_supplier["name"] == $main_supplier) $main_dual_suppliers[] = $dual_supplier;
            foreach ($gas_suppliers as $gas_supplier) if ($gas_supplier["name"] == $main_supplier) $main_gas_suppliers[] = $gas_supplier;
            foreach ($electric_suppliers as $electric_supplier) if ($electric_supplier["name"] == $main_supplier) $main_electric_suppliers[] = $electric_supplier;
        }

        if ($status != 200)
        {
            return redirect() -> route('residential.energy-comparison.1-address') -> withErrors([ 'error' => 'An error occured, please try again later.' ]);
        }

        $supplier_data = compact('dual_suppliers', 'gas_suppliers', 'electric_suppliers', 'main_dual_suppliers', 'main_gas_suppliers', 'main_electric_suppliers');
        // DEBUG: returns a lists of all suppliers by fuel type, and suppliers we have a logo for by fuel type
        // return response() -> json($supplier_data);
        
        $page_title = 'Compare Energy Prices - Your Tariff';
        return view('energy-comparison.2-set-existing-tariff', compact('page_title', 'supplier_data', 'region'));
    }

    public function setExistingTariffPost()
    {
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