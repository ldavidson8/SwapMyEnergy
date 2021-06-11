<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ResidentialApiRepository;
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

        $page_title = 'Compare Your Energy - SwapMyEnergy';
        return view('energy-comparison.1-get-address', compact('page_title'));
    }
    
    public function findAddressPost(Request $request)
    {
        $validator = Validator::make($request -> only([ 'postcode', 'houseNo' ]),
        [
            'postcode' => 'required',
            'houseNo' => 'required'
        ]);
        if ($validator -> fails()) { return redirect() -> back() -> withErrors($validator -> errors() /*[ 'error' => 'An error occurred.' ]*/) -> withInput(); }
        // TODO: add logging
        Log::channel('energy-comparison/find-address-post') -> info('ContactController -> raiseSupportRequest(), Form Validated Successfully');
        
        $obj = json_decode('{"address_id":"6005872275","house_name":"","house_number":"3","country":"GB","county":"LA","current_supplier_id":"OCT","delivery_point_alias":"","dependent_street":"","dmq":17609,"double_dependent_locality":"","gas_transport_id":"Cadent Gas Limited","ldz_id":"NW","meter_capacity":"2","meter_mechanism_code":"CR","meter_serial_number":"719502","mpaq":"17609","mprn":"1558776604","ndmq":"17178","po_box_number":"","post_town":"PRESTON","postcode":"PR2 9UU","smart_equipment_technical_code":"","street":"TOWER GREEN","sub_building_name":"","supplierId":104,"supplierName":"Octopus Energy"}');
        return response() -> json($obj);

        $response = ResidentialApiRepository::addresses_mprn($request -> input('postcode'), $request -> input('houseNo'));

        if (!$response -> successful())
        {
            Log::channel('energy-comparison/find-address-post') -> info('ResidentialComparisonController -> findAddressPost(), ResidentialApiRepository::addresses_mprn returned unsuccessful response');
            return redirect() -> back() -> withErrors([ 'error' => 'An error occured, please try again later.' ]) -> withInput();
        }

        $jsonArray = $response -> json();
        if (!isset($jsonArray) || count($jsonArray) == 0)
        {
            // api request returned no data
            Log::channel('energy-comparison/find-address-post') -> info('ContactController -> raiseSupportRequest(), ResidentialApiRepository::addresses_mprn returned no data');
            return redirect() -> back() -> withErrors([ 'error' => 'An error occured, please try again later.' ]) -> withInput();
        }
        
        // TODO: DB

        return response() -> json($jsonArray, $response -> status());
    }

    public function setExistingTariff()
    {
        ModeSession::setResidential();
        
        $page_title = 'Compare Your Energy - SwapMyEnergy';
        return view('energy-comparison.2-set-existing-tariff');
    }

    public function setExistingTariffPost()
    {
    }
}