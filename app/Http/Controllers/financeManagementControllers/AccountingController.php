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
    public function financeManagementSalary(Request $request){
        $salaries = accountingServices::salaries();
        if($request->ajax()){
            return response($salaries,200,["Content-Type","Application/json"]);
        }
        return view("financeManagement.salary");
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
        if(isset($request->id)){
            return Redirect::back()->with("info","Income updated");
        }
        return Redirect::route("financeManagementAccounting")->with("info", "new income recorded");
    }
    public function financeManagementRemoveIncome($id){
        financeManagementIncomesServices::financeManagementRemoveIncome($id);
        return Redirect::back()->with("info", "income record removed");
    }
    // expenses
    public function financeManagementAddExpense(Request $request){
        financeManagementExpensesServices::financeManagementAddExpense($request);
        if(isset($request->id)){
            return Redirect::back()->with("info","Expense updated");
        }
        return Redirect::route("financeManagementAccounting")->with("info", "new Expense recorded");
    }
    public function financeManagementRemoveExpense($id){
        financeManagementExpensesServices::financeManagementRemoveExpense($id);
        return Redirect::back()->with("info", "Expense record removed");
    }
    // transfer
    public function financeManagementAddTransfer(Request $request){
        financeManagementTransferServices::financeManagementAddTransfer($request);
        if(isset($request->id)){
            return Redirect::back()->with("info","Transfer record updated");
        }
        return Redirect::route("financeManagementAccounting")->with("info", "new Transfer recorded");
    }
    public function financeManagementRemoveTransfer($id){
        financeManagementTransferServices::financeManagementRemoveTransfer($id);
        return Redirect::back()->with("info", "Transfer record removed");
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
    public function financeManagementRemoveLoan($id){
        financeManagementLoanServices::financeManagementRemoveLoan($id);
        return Redirect::back()->with("info", "Loan record removed");
    }
    public function financeManagementGetRow(Request $request){
        $type = $request->validate([
            "type" => "required",
            "id"=> "required"
        ]);
        $row = array();
        if($type['type']=="income"){
            $row = financeManagementIncomesServices::getRowById($type['id']);
        }
        else if($type['type']=="expense"){
            $row = financeManagementExpensesServices::getRowById($type['id']);
        }
        else if($type['type']=="transfer"){
            $row = financeManagementTransferServices::getRowById($type['id']);
        }
        return response($row,200, ["Content-Type" => "Application/json"]);
    }
}
