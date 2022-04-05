<?php

namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\financeManagementExpensesModel;
class financeManagementExpensesServices
{
    public static function financeManagementAddExpense($request)
    {
        $expense = $request->validate([
            "date" => "required|date",
            "sub_heading" => "required",
            "amount" => "required",
            "income_form" => "required"
        ]);
        if (isset($request->mode) && $request->mode == 1) {
            $request->validate([
                "bank" => "required|exists:finance_management_banks,id",
            ]);
            $expense['mode'] = 1;
            $expense['bank'] = $request->bank;
        } else {
            $expense['mode'] = 0;
        }
        if ($request->income_form === "both") {
            $request->validate([
                "st_amount" => "required",
                "sg_amount" => "required",
            ]);
            $expense['st_amount'] = $request->st_amount;
            $expense['sg_amount'] = $request->sg_amount;
        } else if ($request->income_form === "st") {
            $request->validate([
                "st_amount" => "required"
            ]);
            $expense['sg_amount'] = $request->st_amount;
        } else if ($request->income_form == "sg") {
            $request->validate([
                "sg_amount" => "required"
            ]);
            $expense['sg_amount'] = $request->sg_amount;
        } else {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "income_form" => ["invalid income form"]
            ]);
            throw $error;
        }
        $expense['text_box'] = $request->text_box;
        $expense['created_by'] = auth()->user()->id;
        return financeManagementExpensesModel::create($expense);
    }
    public static function getAllExpenseRows()
    {
        return financeManagementExpensesModel::with(["bank_name"])->get();
    }
    public static function get($current_month = true){
        if($current_month){
            return financeManagementExpensesModel::whereYear("date", date("Y"))->whereMonth("date", date("m"))->with(["bank_name"])->get();
        }
        return financeManagementExpensesModel::with(["bank_name"])->get();
    }
}
