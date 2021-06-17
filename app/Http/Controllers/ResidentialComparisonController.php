<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ResidentialApiRepository;
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
        $validator = Validator::make($request -> only([ 'postcode', 'houseNo' ]),
        [
            'postcode' => 'required',
            'houseNo' => 'required'
        ]);
        if ($validator -> fails()) { return redirect() -> back() -> withErrors($validator -> errors()) -> withInput(); }
        // TODO: add logging
        Log::channel('energy-comparison/find-address-post') -> info('ContactController -> raiseSupportRequest(), Form Validated Successfully');
        
        $data = json_decode('{"address_id":"6005872391","house_name":"","house_number":"10","country":"GB","county":"LA","current_supplier_id":"BGT","delivery_point_alias":"","dependent_street":"","dmq":12754,"double_dependent_locality":"","gas_transport_id":"Cadent Gas Limited","ldz_id":"NW","meter_capacity":"1","meter_mechanism_code":"CR","meter_serial_number":"G4W00505841826","mpaq":"12754","mprn":"1558777303","ndmq":"12754","po_box_number":"","post_town":"PRESTON","postcode":"PR2 9UU","smart_equipment_technical_code":"","street":"TOWER GREEN","sub_building_name":"","supplierId":5,"supplierName":"British Gas"}');
        
        $data = ResidentialApiRepository::addresses_mprn($request -> input('postcode'), $request -> input('houseNo'));
        
        if (!isset($data))
        {
            // api request returned no data
            Log::channel('energy-comparison/find-address-post') -> info('ContactController -> raiseSupportRequest(), ResidentialApiRepository::addresses_mprn returned no data');
            return redirect() -> back() -> withErrors([ 'error' => 'An error occured, please try again later.' ]) -> withInput();
        }
        
        Session::put('address_mprn', $data);
        return redirect() -> route('residential.energy-comparison.2-existing-tariff');
    }

    public function setExistingTariff()
    {
        ModeSession::setResidential();

        $suppliers = ResidentialApiRepository::suppliers($status);
        $all_dual_suppliers = $suppliers["D"];
        $all_gas_suppliers = $suppliers["G"];
        $all_electric_suppliers = $suppliers["E"];
        
        $our_suppliers = [ "E.ON", "British Gas", "EDF Energy", "OVO energy", "ScottishPower", "Ecotricity", "SSE" ];
        $dual_suppliers = [];
        $gas_suppliers = [];
        $electric_suppliers = [];
        foreach ($our_suppliers as $os)
        {
            // foreach ($all_dual_suppliers as $ds) if (stripos($ds["name"], $os) !== false) $dual_suppliers[] = $ds;
            // foreach ($all_gas_suppliers as $gs) if (stripos($gs["name"], $os) !== false) $gas_suppliers[] = $gs;
            // foreach ($all_electric_suppliers as $es) if (stripos($es["name"], $os) !== false) $electric_suppliers[] = $es;
            foreach ($all_dual_suppliers as $ds) if ($ds["name"] == $os) $dual_suppliers[] = $ds;
            foreach ($all_gas_suppliers as $gs) if ($gs["name"] == $os) $gas_suppliers[] = $gs;
            foreach ($all_electric_suppliers as $es) if ($es["name"] == $os) $electric_suppliers[] = $es;
        }
        // return response() -> json(compact('dual_suppliers', 'gas_suppliers', 'electric_suppliers'), $status);

        if ($status != 200)
        {
            return redirect() -> route('residential.energy-comparison.1-address') -> withErrors([ 'error' => 'An error occured, please try again later.' ]);
        }
        
        $page_title = 'Compare Energy Prices - Your Tariff';
        return view('energy-comparison.2-set-existing-tariff', compact('page_title', 'dual_suppliers', 'gas_suppliers', 'electric_suppliers'));
    }

    public function setExistingTariffPost()
    {
    }
}