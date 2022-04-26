<?php

namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\HeadingsModel;
use App\Models\financeManagementModel\BankModel;
use App\Models\financeManagementModel\financeManagementTransferModel;
use Illuminate\Support\Facades\Config;
use App\Services\LogServices;
class accountingServices
{
    public static function financeManagementHeadings(){
        $income = HeadingsModel::where(["label_type"=>"income","is_active"=>1])->orderBy('id', 'DESC')->get();
        $expenses = HeadingsModel::where(["label_type"=> "expense","is_active"=>1])->orderBy('id', 'DESC')->get();
        $transfer = HeadingsModel::where(["label_type"=>"transfer","is_active"=>1])->orderBy('id', 'DESC')->get();
        $loan = HeadingsModel::where(["label_type"=>"loan","is_active"=>1])->orderBy('id', 'DESC')->get();
        $deactivated = HeadingsModel::where("is_active","0")->orderBy('id', 'DESC')->get();
        return ["income"=>$income, "expenses"=>$expenses,"transfer"=>$transfer,"loan"=>$loan,"deactivated"=>$deactivated];
    }
    public static function salaries(){
        $demat['data']= array();

        // current financial year
        $start = date("Y-m-d", strtotime(date("Y") . "-04-01"));
        $end = date("Y-m-d", strtotime((date("Y") + 1) . "-03-31"));

        $salaries = financeManagementTransferModel::select("finance_management_transfers.bank_type","finance_management_transfers.to","finance_management_transfers.amount","users.name","finance_management_transfers.date")
        ->whereDate('finance_management_transfers.date',">=",$start)->whereDate("finance_management_transfers.date","<=",$end)->where("finance_management_transfers.bank_type","user")->leftJoin("users","finance_management_transfers.to","=","users.id")
        ->get();

        $i=0;
        foreach($salaries as $salary){
            $arr = array();
            array_push($arr,++$i);
            array_push($arr,$salary->date);
            array_push($arr,$salary->name);
            array_push($arr,$salary->amount);
            array_push($demat['data'],$arr);
        }
        $demat["recordsTotal"]=$i;
        $demat["recordsFiltered"]=$i;
        return $demat;
    }
    public static function financeManagementAddHeadings($request){
        $heading = $request->validate([
            "label_type"=> "required",
            "sub_heading"=> "required",
        ],[
            "label_type.required" =>"Please select label type",
            "sub_heading.required" =>"Please Enter sub heading",
        ]);
        if(!in_array($request->label_type, Config::get("constants.LABEL_TYPES"))){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "label_type" => ["invalid label type"]
            ]);
            throw $error;
        }
        $heading['created_by'] = auth()->user()->id;
        $id = HeadingsModel::create($heading);
        $user_name = auth()->user()->name;
        if($id){
            return LogServices::logEvent(["desc"=>"Heading $id->id created by $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to create Heading by $user_name"]);
        }
    }
    public static function financeManagementEditHeadings($request){
        $heading = $request->validate([
            "id"=> "required|exists:finance_management_headings,id",
            "label_type"=> "required",
            "sub_heading"=> "required",
        ],[
            "id.required" =>"Invalid update request",
            "id.exists" =>"Requested heading does not exists",
            "label_type.required" =>"Please select label type",
            "sub_heading.required" =>"Please Enter sub heading",
        ]);
        if(!in_array($request->label_type, Config::get("constants.LABEL_TYPES"))){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "label_type" => ["invalid label type"]
            ]);
            throw $error;
        }
        $heading['updated_by'] = auth()->user()->id;
        $data = HeadingsModel::where("id",$request->id)->first();
        $user_name = auth()->user()->name;
        $status = HeadingsModel::where("id",$request->id)->update($heading);
        if($status){
            LogServices::logEvent(["desc"=>"Heading $request->id updated by $user_name","data"=>$data]);
        }
    }
    public static function activateDeactivateHeadingFinanceManagementAccounting($request){
        $request->validate([
            "id" => "required|exists:finance_management_headings,id|numeric",
            "status" => "required|min:0|max:1|numeric",
        ], [
            "id.required" => "Sub heading ID is required",
            "id.exists" => "Sub heading not exists",
            "id.numeric" => "invalid Sub heading id",
            "status.required" => "Current status is required",
            "status.min" => "Invalid Request",
            "status.max" => "Invalid Request",
            "status.numeric" => "Invalid Request",
        ]);
        $data = HeadingsModel::where("id", $request->id)->first();
        $user_name= auth()->user()->name;
        $status = HeadingsModel::where("id", $request->id)->update(["is_active" => $request->status, "updated_by" => auth()->user()->id]);
        LogServices::logEvent(["desc"=>"Heading updated by $user_name","data"=>$data]);
        if ($status) {
            if ($request->status) {
                return "Activated";
            }
        }
        return "Deactivated";
    }
    public static function getHeadingById($id){
        return HeadingsModel::where("id",$id)->first();
    }
    public static function getIncomeBanks(){
        return BankModel::where("type",1)->where("is_active",1)->orderBy('id', 'DESC')->get();
    }
}
