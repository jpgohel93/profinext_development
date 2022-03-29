<?php

namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\financeManagementIncomesModel;
class financeManagementIncomesServices{

    public static function financeManagementAddIncome($request){
        $income = $request->validate([
            "date"=> "required|date",
            "sub_heading"=> "required",
            "mode"=> "required|min:0|max:1|numeric",
            "amount"=> "required"
        ]);
        if($request->paymentMode==1){
            $request->validate([
                "bank" => "required|exists:finance_management_banks,id",
            ]);
            $income['bank']=$request->bank;
        }
        $income['created_by']= auth()->user()->id;
        return financeManagementIncomesModel::create($income);
    }
    public static function getAllIncomeRows(){
        return financeManagementIncomesModel::get();
    }
}
