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
        

        $response = ResidentialApiRepository::addresses_mprn($request -> input('postcode'), $request -> input('houseNo'));

        if ($response -> unsuccessful())
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