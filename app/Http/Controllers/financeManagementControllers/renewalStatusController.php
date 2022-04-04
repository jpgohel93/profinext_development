<?php

namespace App\Http\Controllers\financeManagementControllers;

use App\Http\Controllers\Controller;
use App\Services\financeManagementServices\bankServices;
use App\Services\financeManagementServices\financeManagementIncomesServices;
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
        $primary_bank = bankServices::getPrimaryBankAccounts(1);
        $bankAccountList = array();
        $bankPerData = array();
        if(empty($primary_bank)){
            $forIncomes = bankServices::getForIncomeAccounts();
            $countPer = array();
            $tempBank = array();
            foreach ($forIncomes as $incomeBank){
                $incomeRecords = financeManagementIncomesServices::getAllIncomeRowsById($incomeBank['id']);
                if(!empty($incomeRecords)){
                    $sumOfIncome = array_sum(array_column($incomeRecords,'amount'));
                    if(count($forIncomes) <= 3) {
                        $bankAccountList[] = $incomeBank;
                    }else{
                        if($incomeBank['target'] > 0) {
                            $per = $sumOfIncome * 100 / $incomeBank['target'];
                            $countPer[$incomeBank['id']] = $per;
                            $tempBank[$incomeBank['id']] = $incomeBank;
                        }
                    }
                }
            }
            if(!empty($countPer)){
                if(count($countPer) <= 3) {
                    arsort($countPer);
                    $lastThreeIndex = array_slice($countPer, -3, 3, true);
                    foreach ($lastThreeIndex as $key => $bankPer) {
                        $bankAccountList[] = $tempBank[$key];
                    }
                }else{
                    $bankAccountList[] = array_slice($forIncomes, -3, 3, true);;
                }
            }
        }
        $demateDetails = ClientDemateServices::getAccountByDemateId($id);
        return view("financeManagement.clientDemateView",compact("demateDetails","primary_bank","bankAccountList"));
    }
    public function clientDematTerminate($id){
        ClientDemateServices::terminateAccountByDemateId($id);
        return Redirect::back()->with("info","Account Terminated");
    }
    public function updatePL(Request $request){
        ClientDemateServices::updatePL($request);
        return Redirect::route("renewal_status")->with("info","PL Updated");
    }
    public function mark_as_problem(Request $request){
        ClientDemateServices::markAsProblem($request);
        return Redirect::back()->with("info", "Account marked");
    }
    public function ProblemSolved(Request $request){
        ClientDemateServices::ProblemSolved($request);
        return Redirect::route("renewal_status")->with("info", "Account Problem Solved");
    }
}
