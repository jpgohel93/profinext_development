<?php

namespace App\Http\Controllers\financeManagementControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\financeManagementServices\bankServices;
use Illuminate\Support\Facades\Redirect;
class BankControllers extends Controller
{
    public function financeManagementBank(){
        $forIncomes = bankServices::getForIncomeAccounts();
        $forSalaries = bankServices::getForSalaryAccounts();
        $forCashes = bankServices::getForCashAccounts();
        return view("financeManagement.bank",compact("forIncomes", "forSalaries", "forCashes"));
    }
    public function addFinanceManagementBank(Request $request){
        bankServices::addFinanceManagementBank($request);
        return Redirect::route("financeManagementBank")->with("info", "New Bank Added");
    }
    public function financeManagementGetBank(Request $request){
        $bank = bankServices::financeManagementGetBank($request);
        return response($bank,200,["Content-Type"=>"Application/json"]);
    }
    public function financeManagementEditBank($id = null){
        $bank = bankServices::financeManagementGetBank($id);
        if(!$bank){
            return Redirect::route("financeManagementBank")->with("info", "Bank account not exists");
        }
        return view("financeManagement.edit",["bank"=>json_decode($bank)]);
    }
    public function editFinanceManagementBank(Request $request){
        bankServices::editFinanceManagementBank($request);
        return Redirect::route("financeManagementBank")->with("info", "Bank account updated");
    }
    public function setTargetFinanceManagementBank(Request $request){
        bankServices::setTargetFinanceManagementBank($request);
        return Redirect::route("financeManagementBank")->with("info", "target for Bank account updated");
    }
    public function setPrimaryFinanceManagementBank(Request $request){
        bankServices::setPrimaryFinanceManagementBank($request);
        return response(["info"=> "Primary bank updated"],200,["Content-Type"=>"Application/json"]);        
    }
    public function activateDeactivateAccountFinanceManagementBank(Request $request){
        $status = bankServices::activateDeactivateAccountFinanceManagementBank($request);
        return response(["info" => "Bank account ". $status], 200, ["Content-Type" => "Application/json"]);        
    }
}
