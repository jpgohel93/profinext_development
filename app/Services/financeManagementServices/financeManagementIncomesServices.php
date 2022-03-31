<?php

namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\financeManagementIncomesModel;
class financeManagementIncomesServices{

    public static function financeManagementAddIncome($request){
        $income = $request->validate([
            "date"=> "required|date",
            "sub_heading"=> "required",
            "amount"=> "required",
            "income_form"=> "required"
        ]);
        if(isset($request->mode) && $request->mode==1){
            $request->validate([
                "bank" => "required|exists:finance_management_banks,id",
            ]);
            $income['mode'] = 1;
            $income['bank']=$request->bank;
        }else{
            $income['mode']=0;
        }
        if($request->income_form==="both"){
            $request->validate([
                "st_amount"=> "required",
                "sg_amount"=> "required",
            ]);
            $income['st_amount'] = $request->st_amount;
            $income['sg_amount'] = $request->sg_amount;
        }else if($request->income_form==="st"){
            $request->validate([
                "st_amount" => "required"
            ]);
            $income['sg_amount'] = $request->st_amount;
        }else if($request->income_form=="sg"){
            $request->validate([
                "sg_amount" => "required"
            ]);
            $income['sg_amount'] = $request->sg_amount;
        }else{
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "income_form"=>["invalid income form"]
            ]);
            throw $error;
        }
        $income['text_box']=$request->text_box;
        $income['created_by']= auth()->user()->id;
        return financeManagementIncomesModel::create($income);
    }
    public static function getAllIncomeRows(){
        return financeManagementIncomesModel::with(["bank_name"])->get();
    }
}
