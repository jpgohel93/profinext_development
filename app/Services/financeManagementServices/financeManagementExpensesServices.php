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
                "amount" => "required"
            ]);
            $expense['sg_amount'] = $request->amount;
        } else if ($request->income_form == "sg") {
            $request->validate([
                "amount" => "required"
            ]);
            $expense['sg_amount'] = $request->amount;
        } else {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "income_form" => ["invalid income form"]
            ]);
            throw $error;
        }
        $expense['text_box'] = $request->text_box;
        $expense['narration'] = $request->narration;
        $expense['created_by'] = auth()->user()->id;
        if(isset($request->id)){
            $expense['updated_by'] = $request->updated_by;
            return financeManagementExpensesModel::where("id",$request->id)->update($expense);
        }
        return financeManagementExpensesModel::create($expense);
    }
    public static function financeManagementRemoveExpense($id){
        return financeManagementExpensesModel::where("id", $id)->update(["deleted_by"=>auth()->user()->id,"deleted_at"=>date("Y-m-d H:i:s")]);
    }
    public static function getRowById($id){
        return financeManagementExpensesModel::where("id", $id)->with(["bank_name"])->first();
    }
    public static function getAllExpenseRows()
    {
        return financeManagementExpensesModel::with(["bank_name"])->orderBy('id', 'DESC')->get();
    }
    public static function get($current_month = true){
        if($current_month){
            return financeManagementExpensesModel::whereYear("date", date("Y"))->whereMonth("date", date("m"))->with(["bank_name"])->get();
        }
        return financeManagementExpensesModel::with(["bank_name"])->get();
    }
}
