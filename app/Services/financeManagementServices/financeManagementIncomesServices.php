<?php

namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\financeManagementIncomesModel;
class financeManagementIncomesServices{

    public static function financeManagementAddIncome($request){
        $income = $request->validate([
            "date"=> "required|date",
            "sub_heading"=> "required",
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
                "amount" => "required",
            ]);
            $income['amount'] = $request->amount;
        }else if($request->income_form==="sg"){
            $request->validate([
                "amount" => "required",
            ]);
            $income['amount'] = $request->amount;
        }else{
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "income_form"=>["invalid income form"]
            ]);
            throw $error;
        }
        $income['text_box']=$request->text_box;
        $income['narration']=$request->narration;
        if(isset($request->id)){
            $income['updated_by']= auth()->user()->id;
            return financeManagementIncomesModel::where("id",$request->id)->update($income);
        }else{
            $income['created_by']= auth()->user()->id;
            return financeManagementIncomesModel::create($income);
        }
    }
    public static function financeManagementRemoveIncome($id){
        return financeManagementIncomesModel::where("id", $id)->update(["deleted_by"=>auth()->user()->id,"deleted_at"=>date("Y-m-d H:i:s")]);
    }
    public static function getAllIncomeRows(){
        return financeManagementIncomesModel::with(["bank_name"])->orderBy('id', 'DESC')->get();
    }
    public static function getRowById($id){
        return financeManagementIncomesModel::where("id", $id)->with(["bank_name"])->first();
    }

    public static function getAllIncomeRowsById($bank_id,$startDate,$endDate){
        $data = financeManagementIncomesModel::where("bank",$bank_id)->where("date",">=",$startDate)->where("date","<=",$endDate)->with(["bank_name"])->get();
        if(!empty($data)){
            $data =$data->toArray();
        }
        return $data;
    }

    public static function get($current_month = true){
        if($current_month){
            return financeManagementIncomesModel::whereYear("date", date("Y"))->whereMonth("date",date("m"))->with(["bank_name"])->get();
        }
        return financeManagementIncomesModel::with(["bank_name"])->get();
    }

    public static function getLastTransaction($bank_id){
        $data = financeManagementIncomesModel::where("bank",$bank_id)->orderBy('date','DESC')->take(1)->with(["bank_name"])->first();
        if(!empty($data)){
            $data =$data->toArray();
        }
        return $data;
    }
}
