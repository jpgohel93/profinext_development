<?php

namespace App\Http\Controllers\financeManagementControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\financeManagementServices\accountingServices;
use App\Services\financeManagementServices\financeManagementIncomesServices;
use Illuminate\Support\Facades\Redirect;
class AccountingController extends Controller
{
    public function financeManagementAccounting(){
        $headings = accountingServices::financeManagementHeadings();
        $incomeBanks = accountingServices::getIncomeBanks();
        $incomeRecords = financeManagementIncomesServices::getAllIncomeRows();
        return view("financeManagement.accounting", compact("headings", "incomeBanks", "incomeRecords"));
    }
    // heading
    public function financeManagementHeadings(){
        $headings = accountingServices::financeManagementHeadings();
        return view("financeManagement.headings",compact("headings"));
    }
    public function financeManagementAddHeadings(Request $request){
        accountingServices::financeManagementAddHeadings($request);
        return Redirect::route("financeManagementHeadings")->with("info", "Sub heading created");
    }
    public function financeManagementEditHeadings(Request $request){
        accountingServices::financeManagementEditHeadings($request);
        return Redirect::route("financeManagementHeadings")->with("info", "Sub heading updated");
    }
    public function activateDeactivateHeadingFinanceManagementAccounting(Request $request){
        $status = accountingServices::activateDeactivateHeadingFinanceManagementAccounting($request);
        $heading = accountingServices::getHeadingById($request->id);
        return response(["info" => "Sub heading " . $status,"label_type"=> $heading->label_type], 200, ["Content-Type" => "Application/json"]);        
    }
    public function getHeadingById(Request $request){
        $heading = accountingServices::getHeadingById($request->id);
        return response($heading,200, ["Content-Type" => "Application/json"]);
    }
    // income
    public function financeManagementAddIncome(Request $request){
        financeManagementIncomesServices::financeManagementAddIncome($request);
        return Redirect::route("financeManagementAccounting")->with("info", "new income recorded");
    }
}
