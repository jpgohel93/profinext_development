<?php
namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\BankModel;
use App\Models\ClientPayment;
use App\Services\LogServices;

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
//            $forIncome = $request->validate([
//                "available_balance"=> "required"
//            ],[
//                "available_balance.required" =>"For income Available balance is required"
//            ]);
            $bank['available_balance'] = $request->available_balance;
            $bank['limit_utilize'] = 0;
        }elseif($request->type==2){
            // for salary
//            $forSalary = $request->validate([
//                "reserve_balance" => "required"
//            ],[
//                "reserve_balance.required" =>"For Salary reserve balance is required"
//            ]);
            $bank['reserve_balance'] = $request->reserve_balance;
        }else{
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'type' => ['Invalid Account type'],
            ]);
            throw $error;
        }
        $bank['invoice_code'] = $request->invoice_code;
        $bank['pan_number'] = (isset($request->pan_number) && $request->pan_number != '')  ? strtoupper($request->pan_number) : '';
        $bank['created_by'] = auth()->user()->id;
        $id = BankModel::create($bank);
        $user_name = auth()->user()->name;
        if($id){
            LogServices::logEvent(["desc"=>"Bank $request->title created by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Bank $request->title by $user_name"]);
        }
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
//            $forIncome = $request->validate([
//                "available_balance" => "required",
//                "limit_utilize" => "required"
//            ], [
//                "available_balance.required" => "For income Available balance is required",
//                "limit_utilize.required" => "For income limit utilize is required"
//            ]);
            $bank['available_balance'] = $request->available_balance;
        } elseif ($request->type == 2) {
            // for salary
//            $forSalary = $request->validate([
//                "reserve_balance" => "required"
//            ], [
//                "reserve_balance.required" => "For Salary reserve balance is required"
//            ]);
            $bank['reserve_balance'] = $request->reserve_balance;
        } else {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'type' => ['Invalid Account type'],
            ]);
            throw $error;;
        }
        $bank['invoice_code'] = $request->invoice_code;
        $bank['pan_number'] = (isset($request->pan_number) && $request->pan_number != '')  ? strtoupper($request->pan_number) : '';


        $bank['updated_by'] = auth()->user()->id;
        $data = BankModel::where("id", $request->id)->first();
        $status = BankModel::where("id", $request->id)->update($bank);
        $user_name = auth()->user()->name;
        if($status){
            LogServices::logEvent(["desc"=>"Bank $request->title updated by $user_name","data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to update Bank $data->title by $user_name","data"=>$bank]);
        }
    }
    public static function getForIncomeAccounts(){
        return BankModel::where(["type"=>1])->get();
    }
    public static function getForSalaryAccounts(){
        return BankModel::where(["type" => 2])->get();
    }
    public static function getForCashAccounts(){
        $accounts = ClientPayment::leftJoin("client_demat", "client_payment.demat_id","=","client_demat.id")->join("clients","client_demat.client_id","=","clients.id")->join("users","clients.created_by","=","users.id")->whereYear("client_demat.joining_date",date("Y"))->select("users.name as receivedBy","clients.name as clientName", "client_demat.capital", "client_demat.joining_date", "client_demat.joining_date", "client_payment.*")->get();
        return $accounts;
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
        $data = BankModel::where("id", $request->id)->first();
        $user_name = auth()->user()->name;
        $status = BankModel::where("id", $request->id)->update($bank);
        if($status){
            logServices::logEvent(["desc"=>"Target for Bank $data->title updated by $user_name","data"=>$data]);
        }else{
            logServices::logEvent(["desc"=>"Unable to update target for Bank $data->title by $user_name","data"=>$bank]);
        }
        return $status;
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
        $data = BankModel::where("is_primary",1)->first();
        $user_name = auth()->user()->name;
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
        LogServices::logEvent(["desc"=>"Primary bank changed by $user_name","data"=>$data]);
        return $query;
    }
    public static function activateDeactivateAccountFinanceManagementBank($request){
        $user_name = auth()->user()->name;
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
        $data = BankModel::where("id", $request->id)->first();
        $status = BankModel::where("id", $request->id)->update(["is_active"=>$request->status,"updated_by"=>auth()->user()->id]);
        if($status){
            if($request->status){
                LogServices::logEvent(["desc"=>"Bank $data->title activated by $user_name"]);
                return "Activated";
            }
        }
        LogServices::logEvent(["desc"=>"Bank $data->title Deactivated by $user_name"]);
        return "Deactivated";
    }
    public static function getPrimaryBankAccounts($type){
        return BankModel::where("type",$type)->where("is_primary",1)->where("is_active",1)->first();
    }

    public static function getForIncomeAccountsArray(){
        return BankModel::where("type",1)->where("is_primary","!=",1)->where("is_active",1)->get()->toArray();
    }

    public static function getBankAccountById($id){
        $bank = BankModel::where("id",$id)->first();
        if($bank){
            return $bank->toArray();
        }
        return $bank;
    }

    public static function getBankAccounts($type){
        $bank = BankModel::where("type",$type)->get();
        if($bank){
            return $bank->toArray();
        }
        return $bank;
    }
    public static function financeManagementGetBankByInvoiceCode($code){
        $bank = BankModel::where("invoice_code",$code)->first();
        if(!$bank){
            return null;
        }
        return $bank->toJson();
    }
    public static function financeManagementGetBankByAccountNo($account_no,$type){
        $bank = BankModel::where("account_no",$account_no)->where("type",$type)->first();
        if(!$bank){
            return null;
        }
        return $bank->toJson();
    }
}
