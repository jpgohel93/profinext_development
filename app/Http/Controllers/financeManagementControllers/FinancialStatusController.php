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
        // balancetab
        $balanceTab = financialStatusServices::getBalanceDetails();
        return view("financeManagement.financialStatus.index",compact("firmTab","banksTab", "usersTab", "servicesTab", "balanceTab"));
    }
    public function serviceTabFilter(Request $request){
        $servicesTab = financialStatusServices::serviceTabFilter($request);
        return response($servicesTab,200, ["Content-Type" => "Application/json"]);
    }
    public function viewMoreSt(){
        return financialStatusServices::viewMoreSt();
    }
    public function viewMoreSg(){
        return financialStatusServices::viewMoreSg();
    }
    public function viewMore(Request $request){
        return financialStatusServices::viewMore($request);
    }
    public function incomeExpenseDetailsFinancialStatus(Request $request){
        $incomeExpense = financialStatusServices::incomeExpenseDetailsFinancialStatus($request);
        return response($incomeExpense,200, ["Content-Type" => "Application/json"]);
    }
    public function cashConversionDetailsFinancialStatus(Request $request){
        $cashConversion = financialStatusServices::cashConversionDetailsFinancialStatus($request);
        return response($cashConversion,200, ["Content-Type" => "Application/json"]);
    }
    public function viewMoreCash(Request $request){
        return view("financeManagement.financialStatus.cash");
    }
    public function dematDetailsFinancialStatus(Request $request){
        $demats = financialStatusServices::dematDetailsFinancialStatus($request);
        return response($demats,200, ["Content-Type" => "Application/json"]);
    }
    public function plDetailsFinancialStatus(Request $request){
        $demats = financialStatusServices::plDetailsFinancialStatus($request);
        return response($demats,200, ["Content-Type" => "Application/json"]);
    }
    public function distributionDetailsFinancialStatus(Request $request){
        $demats = financialStatusServices::distributionDetailsFinancialStatus($request);
        return response($demats,200, ["Content-Type" => "Application/json"]);
    }
    public function loanDetailsFinancialStatus(Request $request){
        $demats = financialStatusServices::loanDetailsFinancialStatus($request);
        return response($demats,200, ["Content-Type" => "Application/json"]);
    }
    public function bankDetailsFinancialStatus(Request $request){
        $demats = financialStatusServices::bankDetailsFinancialStatus($request);
        return response($demats,200, ["Content-Type" => "Application/json"]);
    }
    public function serviceDetailsFinancialStatus(Request $request){
        $demats = financialStatusServices::serviceDetailsFinancialStatus($request);
        return response($demats,200, ["Content-Type" => "Application/json"]);
    }
}
