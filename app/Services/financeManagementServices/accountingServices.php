<?php

namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\HeadingsModel;
use App\Models\financeManagementModel\BankModel;
use Illuminate\Support\Facades\Config;
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
        return HeadingsModel::create($heading);
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
        return HeadingsModel::where("id",$request->id)->update($heading);
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
        $status = HeadingsModel::where("id", $request->id)->update(["is_active" => $request->status, "updated_by" => auth()->user()->id]);
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
        return BankModel::where("type",1)->orderBy('id', 'DESC')->get();
    }
}
