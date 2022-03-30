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
            "amount" => "required"
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
        $expense['text_box'] = $request->text_box;
        $expense['created_by'] = auth()->user()->id;
        return financeManagementExpensesModel::create($expense);
    }
    public static function getAllExpenseRows()
    {
        return financeManagementExpensesModel::with(["bank_name"])->get();
    }
}
