<?php

namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\financeManagementIncomesModel;
class financeManagementIncomesServices{

    public static function financeManagementAddIncome($request){
        $income = $request->validate([
            "date"=> "required|date",
            "sub_heading"=> "required",
            "amount"=> "required"
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
        $income['text_box']=$request->text_box;
        $income['created_by']= auth()->user()->id;
        return financeManagementIncomesModel::create($income);
    }
    public static function getAllIncomeRows(){
        return financeManagementIncomesModel::get();
    }
}
