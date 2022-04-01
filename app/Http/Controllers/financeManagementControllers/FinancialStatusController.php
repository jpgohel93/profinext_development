<?php

namespace App\Http\Controllers\financeManagementControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\financeManagementServices\financialStatusServices;
class FinancialStatusController extends Controller
{
    public function financialStatus(){
        // firm
        $firmTab = financialStatusServices::getFirmsDetails();
        // banktab
        $banksTab = financialStatusServices::getBanksDetails();
        // usertab
        $usersTab = financialStatusServices::getUsersDetails();
        // servicetab
        $servicesTab = financialStatusServices::getServicesDetails();
        return view("financeManagement.financialStatus.index",compact("firmTab","banksTab", "usersTab", "servicesTab"));
    }
    public function viewMoreSt(){
        return financialStatusServices::viewMoreSt();
    }
    public function viewMoreSg(){
        return financialStatusServices::viewMoreSt();
    }
    public function dematDetailsFinancialStatus(Request $request){
        $demats = financialStatusServices::dematDetailsFinancialStatus($request);
        return response($demats,200, ["Content-Type" => "Application/json"]);
    }
}
