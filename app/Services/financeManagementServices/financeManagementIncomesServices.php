<?php

namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\BankModel;
use App\Models\financeManagementModel\financeManagementIncomesModel;
use App\Services\LogServices;
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
        $user_name = auth()->user()->name;

        if(isset($request->id)){
            $income['updated_by']= auth()->user()->id;
            $data = financeManagementIncomesModel::where("id",$request->id)->first();
            $status = financeManagementIncomesModel::where("id",$request->id)->update($income);
            if($status){
                LogServices::logEvent(["desc"=>"Income $request->sub_heading updated by $user_name","data"=>$data]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to update Income $request->sub_heading by $user_name","data"=>$income]);
            }
            return $status;
        }else{
            if(isset($request->mode) && $request->mode==1) {
                // add balance in available balance
                if (isset($request->bank) && $request->bank != '') {
                    $toBankData = bankServices::getBankAccountById($request->bank);

                    if (!empty($toBankData)) {
                        $addBalance['available_balance'] = $toBankData['available_balance'] + $request->amount;
                        BankModel::where('id', $request->bank)->update($addBalance);
                    }
                }
            }
            $income['created_by']= auth()->user()->id;
            $id = financeManagementIncomesModel::create($income);
            if($id){
                LogServices::logEvent(["desc"=>"Income $request->sub_heading created by $user_name"]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to create Income $request->sub_heading by $user_name","data"=>$income]);
            }
            return $id;
        }
    }
    public static function financeManagementRemoveIncome($id){
        $user_name = auth()->user()->name;
        $data = financeManagementIncomesModel::where("id", $id)->first();
        if(isset($data->mode) && $data->mode==1) {
            // add balance in available balance
            if (isset($data->bank) && $data->bank != '') {
                $toBankData = bankServices::getBankAccountById($data->bank);

                if (!empty($toBankData)) {
                    $addBalance['available_balance'] = $toBankData['available_balance'] - $data->amount;
                    BankModel::where('id', $data->bank)->update($addBalance);
                }
            }
        }
        $status = financeManagementIncomesModel::where("id", $id)->update(["deleted_by"=>auth()->user()->id,"deleted_at"=>date("Y-m-d H:i:s")]);

        if($status){
            LogServices::logEvent(["desc"=>"Income $data->sub_heading deleted by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to delete Income by $user_name"]);
        }
        return $status;
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
