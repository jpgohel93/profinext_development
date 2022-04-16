<?php


namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\financeManagementTransferModel;
use App\Models\User;
use App\Models\financeManagementModel\BankModel;
class financeManagementTransferServices
{
    public static function financeManagementAddTransfer($request)
    {
        $transfer = $request->validate([
            "date" => "required|date",
            "from" => "required",
            "purpose" => "required",
            "to" => "required",
            "amount" => "required",
            "income_form" => "required"
        ]);
        if ($request->income_form === "both") {
            $request->validate([
                "st_amount" => "required",
                "sg_amount" => "required",
            ]);
            $transfer['st_amount'] = $request->st_amount;
            $transfer['sg_amount'] = $request->sg_amount;
        } else if ($request->income_form === "st") {
            $request->validate([
                "amount" => "required"
            ]);
            $transfer['amount'] = $request->amount;
        } else if ($request->income_form == "sg") {
            $request->validate([
                "amount" => "required"
            ]);
            $transfer['amount'] = $request->amount;
        } else {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "income_form" => ["invalid income form"]
            ]);
            throw $error;
        }
        $transfer['narration'] = $request->narration;
        $transfer['created_by'] = auth()->user()->id;
        return financeManagementTransferModel::create($transfer);
    }
    public static function financeManagementRemoveTransfer($id){
        return financeManagementTransferModel::where("id", $id)->update(["deleted_by"=>auth()->user()->id,"deleted_at"=>date("Y-m-d H:i:s")]);
    }
    public static function getRowById($id){
        return financeManagementTransferModel::where("id", $id)->first();
    }
    public static function getAllTransferRows()
    {
        return financeManagementTransferModel::orderBy('id', 'DESC')->get();
    }
    public static function getTransferBanks($request){
        if($request->purpose== "Distribution" || $request->purpose== "distribution"){
            return User::where("user_type",1)->whereNotNull("bank_name")->get()->pluck('bank_name')->toArray();
        }elseif($request->purpose == "Cash Conversion" || $request->purpose== "cash conversion"){
            $banks = User::where("bank_name","!=",null)->get()->pluck('bank_name')->toArray();
            $forSalaryBanks = BankModel::where("type",2)->whereNotNull("title")->get()->pluck('title')->toArray();
            return array_merge($banks,$forSalaryBanks);
        }
        return BankModel::where("type", 2)->whereNotNull("title")->get()->pluck('title')->toArray();
    }
}
