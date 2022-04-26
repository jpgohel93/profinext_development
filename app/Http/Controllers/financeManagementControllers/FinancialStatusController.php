<?php

namespace App\Http\Controllers\financeManagementControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserServices;
use App\Services\financeManagementServices\financialStatusServices;
use App\Services\financeManagementServices\financeManagementTransferServices;
use App\Services\financeManagementServices\bankServices;
class FinancialStatusController extends Controller
{
    public function financialStatus(){
        // firm
        $firmTab = financialStatusServices::getFirmsDetails();
        // banktab
        $banksTab = financialStatusServices::getBanksDetails();
        // servicetab
        $servicesTab = financialStatusServices::getServicesDetails();
        // balancetab
        $balanceTab = financialStatusServices::getBalanceDetails();

        $incomeBankData = bankServices::getBankAccounts(1);
        $salaryBankData = bankServices::getBankAccounts(2);

        $incomeBankIdArray = !empty($incomeBankData) ? array_column($incomeBankData, 'id') : array();
        $salaryBankIdArray = !empty($salaryBankData) ? array_column($salaryBankData, 'id') : array();

        $income = financeManagementTransferServices::getAllTransferByPurpose("Reserve Balance",$incomeBankIdArray);
        $reserveBalance['income'] = !empty($income) ? array_sum(array_column($income, 'amount')) : 0;
        $salary = financeManagementTransferServices::getAllTransferByPurpose("Reserve Balance",$salaryBankIdArray);
        $reserveBalance['salary'] = !empty($salary) ? array_sum(array_column($salary, 'amount')) : 0;

        $availableBalance['income'] = !empty($incomeBankData) ? array_sum(array_column($incomeBankData, 'available_balance')) : 0;
        $availableBalance['salary'] = !empty($salaryBankData) ? array_sum(array_column($salaryBankData, 'available_balance')) : 0;
        $availableBalance['income_total'] = !empty($incomeBankData) ? array_sum(array_column($incomeBankData, 'available_balance')) : 0;
        $availableBalance['salary_total'] = !empty($salaryBankData) ? array_sum(array_column($salaryBankData, 'available_balance')) : 0;

        $availableBalance['income'] = $availableBalance['income'] - $reserveBalance['income'];
        $availableBalance['salary'] = $availableBalance['salary'] - $reserveBalance['salary'];


        return view("financeManagement.financialStatus.index",compact("firmTab","banksTab",  "servicesTab", "balanceTab","reserveBalance","availableBalance"));
    }
    public function usersTab(Request $request){
        // usertab
        $usersTab = financialStatusServices::getUsersDetails($request);
        if($request->ajax()){
            return response($usersTab,200, ["Content-Type" => "Application/json"]);
        }
        abort(403);
        // return view("financeManagement.financialStatus.index",compact("usersTab"));
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
    public function viewMoreCash(){
        return view("financeManagement.financialStatus.cash");
    }
    public function viewMoreIncome(){
        $figures = financialStatusServices::viewMoreIncomeFigures();
        return view("financeManagement.financialStatus.income",compact("figures"));
    }
    public function viewMoreSalary(){
        $figures = financialStatusServices::viewMoreSalary();
        return view("financeManagement.financialStatus.salary",compact("figures"));
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
    public function transactionDetailsFinancialStatus(Request $request){
        $transactions = financialStatusServices::transactionDetailsFinancialStatus($request);
        $user_id = $request->user_id;
        $user = UserServices::user($user_id);
        if($request->ajax()){
            return response($transactions,200, ["Content-Type" => "Application/json"]);
        }
        return view("financeManagement.financialStatus.user2",compact("transactions","user_id","user"));
    }
}
