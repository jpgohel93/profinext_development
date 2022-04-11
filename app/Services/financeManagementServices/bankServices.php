<?php
namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\BankModel;
class bankServices{
    public static function addFinanceManagementBank($request){
        // main fields
        $bank = $request->validate([
            "type"=> "required|min:1|max:2|numeric",
            "name"=> "required",
            "title"=> "required",
            "account_name"=> "required",
            "account_type"=> "required",
            "account_no"=> "required",
            "ifsc_code"=> "required",
        ],[
            "type.required" => "Please select account type",
            "type.min" => "Invalid account type",
            "type.max" => "Invalid account type",
            "type.numeric" => "Invalid account type",
            "name.required" => "Bank name is required",
            "title.required" => "Bank title is required",
            "account_name.required" => "Account name is required",
            "account_no.required" => "Account Number is required",
            "account_type.required" => "Account type is required",
            "ifsc_code.required" => "IFSC code is required"
        ]);
        if($request->type==1){
            // for income
            $forIncome = $request->validate([
                "available_balance"=> "required",
                "limit_utilize"=> "required"
            ],[
                "available_balance.required" =>"For income Available balance is required",
                "limit_utilize.required" => "For income limit utilize is required"
            ]);
            $bank['available_balance'] = $forIncome['available_balance'];
            $bank['limit_utilize'] = $forIncome['limit_utilize'];
        }elseif($request->type==2){
            // for salary
            $forSalary = $request->validate([
                "reserve_balance" => "required"
            ],[
                "reserve_balance.required" =>"For Salary reserve balance is required"
            ]);
            $bank['reserve_balance'] = $forSalary['reserve_balance'];
        }else{
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'type' => ['Invalid Account type'],
            ]);
            throw $error;;
        }
        $bank['invoice_code'] = $request->invoice_code;
        $bank['pan_number'] = $request->pan_number;
        $bank['created_by'] = auth()->user()->id;
        return BankModel::create($bank);
    }
    public static function editFinanceManagementBank($request){
        $request->validate([
            "id"=> "required|exists:finance_management_banks,id"
        ],[
            "id.required" =>"Bank Account ID is required",
            "id.exists" =>"Bank Account ID not exists",
        ]);
        // main fields
        $bank = $request->validate([
            "type" => "required|min:1|max:2|numeric",
            "name" => "required",
            "title" => "required",
            "account_name" => "required",
            "account_type" => "required",
            "account_no" => "required",
            "ifsc_code" => "required",
        ], [
            "type.required" => "Please select account type",
            "type.min" => "Invalid account type",
            "type.max" => "Invalid account type",
            "type.numeric" => "Invalid account type",
            "name.required" => "Bank name is required",
            "title.required" => "Bank title is required",
            "account_name.required" => "Account name is required",
            "account_no.required" => "Account Number is required",
            "account_type.required" => "Account type is required",
            "ifsc_code.required" => "IFSC code is required"
        ]);
        if ($request->type == 1) {
            // for income
            $forIncome = $request->validate([
                "available_balance" => "required",
                "limit_utilize" => "required"
            ], [
                "available_balance.required" => "For income Available balance is required",
                "limit_utilize.required" => "For income limit utilize is required"
            ]);
            $bank['available_balance'] = $forIncome['available_balance'];
            $bank['limit_utilize'] = $forIncome['limit_utilize'];
        } elseif ($request->type == 2) {
            // for salary
            $forSalary = $request->validate([
                "reserve_balance" => "required"
            ], [
                "reserve_balance.required" => "For Salary reserve balance is required"
            ]);
            $bank['reserve_balance'] = $forSalary['reserve_balance'];
        } else {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'type' => ['Invalid Account type'],
            ]);
            throw $error;;
        }
        $bank['updated_by'] = auth()->user()->id;
        return BankModel::where("id", $request->id)->update($bank);
    }
    public static function getForIncomeAccounts(){
        return BankModel::where(["type"=>1])->get();
    }
    public static function getForSalaryAccounts(){
        return BankModel::where(["type" => 2])->get();
    }
    public static function financeManagementGetBank($request){
        $bank = BankModel::where("id",isset($request->id)? $request->id:$request)->first();
        if(!$bank){
            return null;
        }
        return $bank->toJson();
    }
    public static function setTargetFinanceManagementBank($request){
        $request->validate([
            "id"=>"required|exists:finance_management_banks,id",
            "target"=> "required"
        ],[
            "id.required" =>"Bank Account ID is required",
            "id.exists" =>"Bank Account not exists",
        ]);
        $bank['target'] = $request->target;
        $bank['updated_by'] = auth()->user()->id;
        return BankModel::where("id", $request->id)->update($bank);
    }
    public static function setPrimaryFinanceManagementBank($request){
        $request->validate([
            "id" => "required|exists:finance_management_banks,id",
        ], [
            "id.required" => "Bank Account ID is required",
            "id.exists" => "Bank Account not exists",
        ]);
        // for safty store currenty primary account if query faild rollback changes
        $currentPrimaryAccountId = BankModel::where("is_primary",1)->first(['id']);
        $bank['updated_by'] = auth()->user()->id;
        $bank['is_primary'] = 1;
        if($currentPrimaryAccountId){
            BankModel::query()->update(['is_primary' => 0]);
            $query = BankModel::where("id",$request->id)->update($bank);
            if($query && $currentPrimaryAccountId->id!=$request->id){
                // query success remove previous primary account
                $query=BankModel::where("id", $currentPrimaryAccountId->id)->update(["is_primary"=>"0"]);
            }
        }else{
            $query = BankModel::where("id", $request->id)->update($bank);
        }
        return $query;
    }
    public static function activateDeactivateAccountFinanceManagementBank($request){
        $request->validate([
            "id" => "required|exists:finance_management_banks,id|numeric",
            "status" => "required|min:0|max:1|numeric",
        ], [
            "id.required" => "Bank Account ID is required",
            "id.exists" => "Bank Account not exists",
            "id.numeric" => "invalid bank account id",
            "status.required" =>"Current status is required",
            "status.min" => "Invalid account status",
            "status.max" => "Invalid account status",
            "status.numeric" => "Invalid account status",
        ]);
        $status = BankModel::where("id", $request->id)->update(["is_active"=>$request->status,"updated_by"=>auth()->user()->id]);
        if($status){
            if($request->status){
                return "Activated";
            }
        }
        return "Deactivated";
    }
    public static function getPrimaryBankAccounts($type){
        return BankModel::where("type",$type)->where("is_primary",1)->where("is_active",1)->first();
    }

    public static function getForIncomeAccountsArray(){
        return BankModel::where("type",1)->where("is_primary","!=",1)->where("is_active",1)->get()->toArray();
    }

    public static function getBankAccountById($id){
        return BankModel::where("id",$id)->first()->toArray();
    }
}
