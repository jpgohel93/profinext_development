<?php

namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\financeManagementLoanModel;

class financeManagementLoanServices{

    public static function financeManagementAddLoan($request)
    {
        $expense = $request->validate([
            "date" => "required|date",
            "sub_heading" => "required",
            "amount" => "required",
            "interest" => "required",
            "user" => "required",
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
        $expense['narration'] = $request->text_box;
        $expense['created_by'] = auth()->user()->id;
        return financeManagementLoanModel::create($expense);
    }
    public static function getAllLoanRows()
    {
        return financeManagementLoanModel::with(["bank_name", "user_name"])->get();
    }
    
}
