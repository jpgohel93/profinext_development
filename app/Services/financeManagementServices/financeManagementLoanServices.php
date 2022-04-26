<?php

namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\financeManagementLoanModel;
use App\Services\LogServices;
class financeManagementLoanServices{

    public static function financeManagementAddLoan($request)
    {
        $loan = $request->validate([
            "date" => "required|date",
            "sub_heading" => "required",
            "amount" => "required",
            "interest" => "required",
            "user" => "required",
            "income_form" => "required"
        ]);
        if($loan['sub_heading']=="Loan Taken" || $loan['sub_heading']=="loan taken" || $loan['sub_heading']=="loantaken"){
            $loan['amount'] = $loan['amount'];
        }else{
            // add interest to amount
            $loan['amount'] += round($loan['amount']*((float)$loan['interest'])/100,2);
        }
        if (isset($request->mode) && $request->mode == 1) {
            $request->validate([
                "bank" => "required|exists:finance_management_banks,id",
            ]);
            $loan['mode'] = 1;
            $loan['bank'] = $request->bank;
        } else {
            $loan['mode'] = 0;
        }
        if ($request->income_form === "both") {
            $request->validate([
                "st_amount" => "required",
                "sg_amount" => "required",
            ]);
            $loan['st_amount'] = $request->st_amount;
            $loan['sg_amount'] = $request->sg_amount;
        } else if ($request->income_form === "st") {
            $request->validate([
                "amount" => "required"
            ]);
            $loan['st_amount'] = $request->amount;
        } else if ($request->income_form == "sg") {
            $request->validate([
                "amount" => "required"
            ]);
            $loan['sg_amount'] = $request->amount;
        } else {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "income_form" => ["invalid income form"]
            ]);
            throw $error;
        }
        $loan['narration'] = $request->text_box;
        $loan['created_by'] = auth()->user()->id;
        $id = financeManagementLoanModel::create($loan);
        $user_name = auth()->user()->name;
        if($id){
            LogServices::logEvent(["desc"=>"Loan $id->id created by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Loan by $user_name","data"=>$loan]);
        }
    }
    public static function financeManagementRemoveLoan($id){
        $status = financeManagementLoanModel::where("id", $id)->update(["deleted_by"=>auth()->user()->id,"deleted_at"=>date("Y-m-d H:i:s")]);
        $user_name = auth()->user()->name;
        if($status){
            LogServices::logEvent(["desc"=>"Loan $id deleted by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to delete Loan $id by $user_name"]);
        }
    }
    public static function getAllLoanRows()
    {
        return financeManagementLoanModel::with(["bank_name", "user_name"])->orderBy('id', 'DESC')->get();
    }

}
