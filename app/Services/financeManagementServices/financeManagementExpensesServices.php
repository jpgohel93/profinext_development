<?php

namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\BankModel;
use App\Models\financeManagementModel\financeManagementExpensesModel;
use App\Services\LogServices;
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
        $user_name = auth()->user()->name;
        if(isset($request->id)){
            $expense['updated_by'] = $request->updated_by;
            $data = financeManagementExpensesModel::where("id",$request->id)->first();
            $status = financeManagementExpensesModel::where("id",$request->id)->update($expense);
            if($status){
                LogServices::logEvent(["desc"=>"Expense $request->sub_heading updated by $user_name","data"=>$data]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to update Expense $request->sub_heading by $user_name","data"=>$expense]);
            }
        }else {
            $id = financeManagementExpensesModel::create($expense);

            if(isset($request->mode) && $request->mode==1) {
                // add balance in available balance
                if (isset($request->bank) && $request->bank != '') {
                    $toBankData = bankServices::getBankAccountById($request->bank);

                    if (!empty($toBankData)) {
                        $addBalance['available_balance'] = $toBankData['available_balance'] - $request->amount;
                        $logStatus = BankModel::where('id', $request->bank)->update($addBalance);

                        $user_name = auth()->user()->name;
                        if($logStatus){
                            LogServices::logEvent(["desc"=>"Add balance in".$toBankData['title']." by $user_name","data"=>$addBalance]);
                        }else{
                            LogServices::logEvent(["desc"=>"Unable to update the balance by $user_name in ".$toBankData['title']." bank","data"=>$addBalance]);
                        }
                    }
                }
            }
        }
        if($id){
            LogServices::logEvent(["desc"=>"Expense $request->sub_heading created by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Expense $request->sub_heading by $user_name","data"=>$expense]);
        }
        return $id;
    }
    public static function financeManagementRemoveExpense($id){
        $user_name = auth()->user()->name;
        $data = financeManagementExpensesModel::where("id", $id)->first();
        $status = financeManagementExpensesModel::where("id", $id)->update(["deleted_by"=>auth()->user()->id,"deleted_at"=>date("Y-m-d H:i:s")]);
        if(isset($data->mode) && $data->mode==1) {
            // add balance in available balance
            if (isset($data->bank) && $data->bank != '') {
                $toBankData = bankServices::getBankAccountById($data->bank);

                if (!empty($toBankData)) {
                    $addBalance['available_balance'] = $toBankData['available_balance'] + $data->amount;
                    BankModel::where('id', $data->bank)->update($addBalance);
                }
            }
        }
        if($status){
            LogServices::logEvent(["desc"=>"Expense $data->sub_heading deleted by $user_name","data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to delete Expense $data->sub_heading by $user_name"]);
        }
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
