<?php

namespace App\Http\Controllers\financeManagementControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\financeManagementServices\renewalStatusService;
use App\Services\ClientDemateServices;
use Illuminate\Support\Facades\Redirect;
class renewalStatusController extends Controller
{
    public function view(){
        $renewalStatus = renewalStatusService::view();
        $preRenewAccounts = renewalStatusService::preRenewAccounts();
        $toRenewAccounts = renewalStatusService::toRenewAccounts();
        $renewedAccounts = renewalStatusService::renewedAccounts();
        $newAccounts = renewalStatusService::newAccounts();
        return view("financeManagement.renewal-status",compact("renewalStatus", "preRenewAccounts", "toRenewAccounts", "renewedAccounts", "newAccounts"));
    }
    public function clientDematView($id){
        $demateDetails = ClientDemateServices::getAccountByDemateId($id);
        return view("financeManagement.clientDemateView",compact("demateDetails"));
    }
    public function updatePL(Request $request){
        ClientDemateServices::updatePL($request);
        return Redirect::route("renewal_status")->with("info","PL Updated");
    }
}
