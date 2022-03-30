<?php

namespace App\Http\Controllers\financeManagementControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\financeManagementServices\accountingServices;
use App\Services\financeManagementServices\financeManagementIncomesServices;
use App\Services\financeManagementServices\financeManagementExpensesServices;
use App\Services\financeManagementServices\financeManagementTransferServices;
use App\Services\financeManagementServices\financeManagementLoanServices;
use App\Services\UserServices;
use Illuminate\Support\Facades\Redirect;
class AccountingController extends Controller
{
    public function financeManagementAccounting(){
        $headings = accountingServices::financeManagementHeadings();
        $incomeBanks = accountingServices::getIncomeBanks();
        $incomeRecords = financeManagementIncomesServices::getAllIncomeRows();
        $expensRecords = financeManagementExpensesServices::getAllExpenseRows();
        $transferRecords = financeManagementTransferServices::getAllTransferRows();
        $loanRecords = financeManagementLoanServices::getAllLoanRows();
        $users = UserServices::all();
        $all = array_merge($incomeBanks->toArray(), $expensRecords->toArray(), $transferRecords->toArray(), $loanRecords->toArray());
        return view("financeManagement.accounting", compact("headings", "incomeBanks", "incomeRecords", "expensRecords", "transferRecords","loanRecords", "users" ,"all"));
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
    // expenses
    public function financeManagementAddExpense(Request $request){
        financeManagementExpensesServices::financeManagementAddExpense($request);
        return Redirect::route("financeManagementAccounting")->with("info", "new Expense recorded");
    }
    // transfer
    public function financeManagementAddTransfer(Request $request){
        financeManagementTransferServices::financeManagementAddTransfer($request);
        return Redirect::route("financeManagementAccounting")->with("info", "new Transfer recorded");
    }
    public function financeManagementTransferGetUsersBank(Request $request){
        $banks = financeManagementTransferServices::getTransferBanks($request);
        return response($banks,200, ["Content-Type" => "Application/json"]);
    }
    // loan
    public function financeManagementAddLoan(Request $request){
        financeManagementLoanServices::financeManagementAddLoan($request);
        return Redirect::route("financeManagementAccounting")->with("info", "new Loan recorded");
    }
}
