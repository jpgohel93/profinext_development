<?php


namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\financeManagementTransferModel;
use App\Models\User;
use App\Models\financeManagementModel\BankModel;
use App\Services\LogServices;
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
        if(stripos($transfer['to'],"user")){
            $transfer['to'] = str_replace("user_","",$request->to);
            $transfer['bank_type'] = "user";
        }else{
            $transfer['to'] = str_replace("bank_","",$request->to);
            $transfer['bank_type'] = "bank";
        }
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

        $from = explode("_",$transfer['from']);
        $transfer['from'] = $from[0];
        $transfer['from_bank_id'] = $from[1];

        if($transfer['to'] == $from[1]){
            $transfer['transfer_type'] = "no transfer";
        }else{
            $transfer['transfer_type'] = "transfer";
        }

        $transfer['narration'] = $request->narration;
        $transfer['created_by'] = auth()->user()->id;
        $user_name = auth()->user()->name;
        if(isset($request->id)){
            $transfer['updated_by'] = auth()->user()->id;
            $data = financeManagementTransferModel::where("id",$request->id)->first();
            $status = financeManagementTransferModel::where("id",$request->id)->update($transfer);
            if($status){
                LogServices::logEvent(["desc"=>"Transfer $request->id updated by $user_name","data"=>$data]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to update Transfer $request->id by $user_name","data"=>$transfer]);
            }
        }
        $id = financeManagementTransferModel::create($transfer);
        if($id){
            LogServices::logEvent(["desc"=>"Transfer $id->id created by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Transfer by $user_name","data"=>$transfer]);
        }
        return $id;
    }
    public static function financeManagementRemoveTransfer($id){
        $user_name = auth()->user()->name;
        $status = financeManagementTransferModel::where("id", $id)->update(["deleted_by"=>auth()->user()->id,"deleted_at"=>date("Y-m-d H:i:s")]);
        if($status){
            LogServices::logEvent(["desc"=>"Transfer $id deleted by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to delete Transfer $id by $user_name"]);
        }
        return $status;
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
            $banks = User::where("user_type",1)->whereNotNull("bank_name")->select('bank_name','id','created_at as user')->get()->toArray();
            if(!empty($banks)){
                $banks =  $banks->toArray();
            }
            return $banks;
        }elseif($request->purpose == "Cash Conversion" || $request->purpose== "cash conversion"){
            $banks = User::whereNotNull("bank_name")->select('bank_name','id','created_at as user')->get()->toArray();
            $forSalaryBanks = BankModel::where("type",2)->whereNotNull("title")->select('title as bank_name','id','created_at as bank')->get()->toArray();

            if(!empty($forSalaryBanks)){
                $forSalaryBanks =  $forSalaryBanks->toArray();
            }

            if(!empty($banks)){
                $banks =  $banks->toArray();
            }

            return array_merge($banks,$forSalaryBanks);
        }elseif($request->purpose == "Reserve Balance" || $request->purpose== "reserve balance"){
            $banks = BankModel::whereNotNull("title")->select('title as bank_name','id','created_at as bank')->get();
            if(!empty($banks)){
                $banks =  $banks->toArray();
            }
            return $banks;
        }
        return BankModel::where("type", 2)->whereNotNull("title")->select('title','id','created_at as bank')->get()->toArray();
    }

    public static function getAllTransferRowsByPurpose($purpose,$bank_id)
    {
        $banks = financeManagementTransferModel::where("to",$bank_id)->where('purpose',$purpose)->orderBy('id', 'DESC')->get();
        if(!empty($banks)){
            $banks =  $banks->toArray();
        }
        return $banks;
    }

    public static function getAllTransferByPurpose($purpose,$idArray)
    {
        $banks = financeManagementTransferModel::whereIn('to', $idArray)->where('purpose',$purpose)->orderBy('id', 'DESC')->get();
        if(!empty($banks)){
            $banks =  $banks->toArray();
        }
        return $banks;
    }
}
