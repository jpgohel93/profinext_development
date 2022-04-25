<?php

namespace App\Http\Controllers\financeManagementControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\financeManagementServices\bankServices;
use App\Services\financeManagementServices\financeManagementIncomesServices;
use  App\Services\ClientDemateServices;
use Illuminate\Support\Facades\Redirect;
class BankControllers extends Controller
{
    public function financeManagementBank(){
        $forIncomes = bankServices::getForIncomeAccounts();
        $forSalaries = bankServices::getForSalaryAccounts();
        $forCashes = bankServices::getForCashAccounts();

         if(date("m") >= 4){
            $currentYear = date("Y");
            $lastYear = (date("Y")+1);
        }else{
            $currentYear = (date("Y") - 1);
            $lastYear = date("Y");
        }

        $startDate = $currentYear."-04-01";
        $endDate = $lastYear."-03-31";

        foreach($forIncomes  as $key => $data){

            $incomeRecords = financeManagementIncomesServices::getAllIncomeRowsById($data->id,$startDate,$endDate);
            $incomeRecordsBlockAmount = ClientDemateServices::renewAccountList($data->id,$startDate,$endDate);
            $bankData = bankServices::getBankAccountById($data->id);


            $sumOfIncome = !empty($incomeRecords) ? array_sum(array_column($incomeRecords, 'amount')) : 0;
            $sumOfBlockIncome = !empty($incomeRecordsBlockAmount) ? array_sum(array_column($incomeRecordsBlockAmount, 'final_amount')) : 0;

           $total = ($sumOfIncome+$sumOfBlockIncome);

            $per_limit_utilize = 0;
            if($bankData['target'] != '' && $bankData['target'] != 0){
                $per_limit_utilize = $total * 100 / $bankData['target'];
                $per_limit_utilize = number_format($per_limit_utilize,0);
            }

           $forIncomes[$key]['per_limit_utilize'] = $per_limit_utilize; 
           $forIncomes[$key]['limit_utilize'] = ($sumOfIncome+$sumOfBlockIncome); 
           $forIncomes[$key]['block_amount'] = $sumOfBlockIncome; 

        }

        $blockAmountlist = ClientDemateServices::blockAmountList($startDate,$endDate);

        return view("financeManagement.bank",compact("forIncomes", "forSalaries", "forCashes","blockAmountlist"));
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
