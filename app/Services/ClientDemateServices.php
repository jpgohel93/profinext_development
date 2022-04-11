<?php

namespace App\Services;

use App\Models\Client;
use App\Models\ClientDemat;
use App\Models\ClientPayment;
use App\Models\financeManagementModel\financeManagementIncomesModel;
use App\Models\Screenshots;
use App\Models\RenewDemat;
use App\Services\financeManagementServices\bankServices;

class ClientDemateServices{
    function __construct(){

    }
    public static function active(){
        return ClientDemat::where("account_status","normal")->whereNull("problem")->with(["withClient"])->leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->select('client_demat.*', 'clients.name')->get();
        //return ClientDemat::where("trader_id", auth()->user()->id)->where("account_status","normal")->whereNull("problem")->with(["withClient"])->leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->select('client_demat.*', 'clients.name')->get();
        //  ClientDemat::where("trader_id", auth()->user()->id)->where("account_status","normal")->whereNull("problem")->with(["withClient"])->get();
    }
    public static function toRenews(){
       return RenewDemat::
        leftJoin('client_demat', 'renewal_account.client_demat_id', '=', 'client_demat.id')->
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("renewal_account.status", "to_renew")->
        select('clients.name','clients.number','client_demat.serial_number','client_demat.st_sg','client_demat.client_id','client_demat.holder_name','client_demat.available_balance','renewal_account.*')
            ->get();
    }
    public static function problemAccounts(){
        //return ClientDemat::where("trader_id", auth()->user()->id)->whereNotNull("problem")->where('account_status','!=','terminated')->with(["withClient"])->get();
        return ClientDemat::whereNotNull("problem")->where('account_status','!=','terminated')->with(["withClient"])->get();
    }
    public static function allAccounts(){
        $clients = ClientDemat::where("trader_id",auth()->user()->id)->leftJoin('clients as c', function ($join) {
            $join->on('client_demat.client_id', '=', 'c.id')
                ->where('c.client_type', '=', 1);
        })->select('client_demat.*', 'c.name', 'c.number','c.deleted_at')->whereNull("c.deleted_at")->get();
        // count demat accounts
        $client_id =[];
        foreach ($clients as $key => $client){
            if(!in_array($client->client_id,$client_id)){
                $count = ClientDemat::where("client_id",$client->client_id)->count();
                $clients[$key]["total_demats"] = $count;
                array_push($client_id,$client->client_id);
            }
        }
        return $clients;
    }
    public static function terminatedAccounts(){
        //return ClientDemat::where("trader_id", auth()->user()->id)->where("account_status","terminated")->with(["withClient"])->withTrashed()->get();
        return ClientDemat::where("account_status","terminated")->with(["withClient"])->withTrashed()->get();
    }
    public static function getAccountByDemateId($id){
        return ClientDemat::where("id",$id)->with(["withClient", "withPayment"])->first();
    }
    public static function terminateAccountByDemateId($id){
        return ClientDemat::where("id",$id)->update(["account_status"=>"terminated"]);
    }
    public static function updatePL($request){
        $pl['account_status']="to_renew";
        $pl['pl']=$request->pl;
        $pl['final_pl']=$request->total_profit;
        $pl['end_date']=date('Y-m-d');
        return ClientDemat::where("id",$request->id)->update($pl);
    }
    public static function markAsProblem($request){
        $request->validate([
            "demat_id"=>"required|exists:client_demat,id"
        ],[
            "demat_id.required" =>"Invalid Demat ID",
            "demat_id.exists" =>"Demat account not found",
        ]);
        $json = json_encode($request->except(["_token", "demat_id"]));
        return ClientDemat::where("id", $request->demat_id)->update(["mark_as_problem"=>$json]);
    }
    public static function ProblemSolved($request){
        $request->validate([
            "demat_id"=>"required|exists:client_demat,id"
        ],[
            "demat_id.required" =>"Invalid Demat ID",
            "demat_id.exists" =>"Demat account not found",
        ]);
        $json = json_encode($request->except(["_token", "demat_id"]));
        if($request->has("problem") && ($request->problem!='' || $request->problem!=null)){
            return ClientDemat::where("id", $request->demat_id)->update(["problem" => $request->problem]);
        }else{
            return ClientDemat::where("id", $request->demat_id)->update(["mark_as_problem"=>$json]);
        }
    }

    public static function renewAccountList($bank_id,$startDate,$endDate){
         return RenewDemat::where("bank_id",$bank_id)->where("status","to_renew")->where("created_at",">=",$startDate)->where("created_at","<=",$endDate)->with(["bank_name"])->get()->toArray();

    }

    public static function renewData($id){
        return RenewDemat::where("id",$id)->first()->toArray();
    }

    public static function renewDataById($id){
        return RenewDemat::
        leftJoin('client_demat', 'renewal_account.client_demat_id', '=', 'client_demat.id')->
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        leftJoin('finance_management_banks', 'renewal_account.bank_id', '=', 'finance_management_banks.id')->
        select('finance_management_banks.pan_number','finance_management_banks.account_name','finance_management_banks.title','clients.name','clients.number','client_demat.serial_number','client_demat.st_sg','client_demat.client_id','client_demat.holder_name','client_demat.available_balance','client_demat.pan_number_text','client_demat.address','client_demat.mobile','client_demat.email_id','client_demat.service_type','renewal_account.*')
            ->first();
    }

    public static function demateFeesPayment($request){
        $data['is_pay_fee']=1;
        $data['bank_id']=$request->fees_bank_id;

        $renewData = RenewDemat::where("id",$request->fees_payment_id)->first()->toArray();
        $clientDematData = ClientDemat::where("id", $renewData['client_demat_id'])->first()->toArray();
        $forIncomes = bankServices::getBankAccountById($request->fees_bank_id);
        $data['part_payment']=$forIncomes['invoice_code'];

        $income['date']=date('Y-m-d');
        $income['sub_heading']="AMS Fees";
        $income['mode']="1";
        $income['bank']=$request->fees_bank_id;
        $income['income_form']=$clientDematData['st_sg'];
        if($clientDematData['st_sg'] == "ST"){
            $income['st_amount']=$request->fees_amount;
        }elseif ($clientDematData['st_sg'] == "SG"){
            $income['sg_amount']=$request->fees_amount;
        }
        $income['amount']=$request->fees_amount;
        $income['renewal_account_id']=$request->fees_payment_id;
        $income['created_by']=auth()->user()->id;

        financeManagementIncomesModel::create($income);

        $totalPayment = $renewData['part_payment'] + $request->fees_amount;
        if($renewData['final_amount'] <= $totalPayment){
            //if full payment done
            $data['part_payment']=$totalPayment;
            $data['status']="renew";

            $clientDemat['account_status'] = "normal";
            $clientDemat['is_new'] = 3;
            ClientDemat::where("id", $renewData['client_demat_id'])->update($clientDemat);
        }else{
            $data['part_payment']=$totalPayment;
        }

        return RenewDemat::where("id",$request->fees_payment_id)->update($data);
    }

    public static function demateProfitSharing($request){
        $data['is_pay_profit_sharing']=1;
        $data['bank_id']=$request->profit_bank_id;

        $renewData = RenewDemat::where("id",$request->profit_sharing_payment_id)->first()->toArray();
        $clientDematData = ClientDemat::where("id", $renewData['client_demat_id'])->first()->toArray();
        $forIncomes = bankServices::getBankAccountById($request->profit_bank_id);
        $data['part_payment']=$forIncomes['invoice_code'];

        if($clientDematData['service_type'] == 1){
            $income['sub_heading']="Prime Profit Sharing";
        }elseif ($clientDematData['service_type'] == 2){
            $income['sub_heading']="AMS Profit Sharing";
        }
        $income['date']=date('Y-m-d');
        $income['mode']="1";
        $income['bank']=$request->profit_bank_id;
        $income['income_form']=$clientDematData['st_sg'];
        if($clientDematData['st_sg'] == "ST"){
            $income['st_amount']=$request->profit_amount;
        }elseif ($clientDematData['st_sg'] == "SG"){
            $income['sg_amount']=$request->profit_amount;
        }
        $income['amount']=$request->profit_amount;
        $income['renewal_account_id']=$request->profit_sharing_payment_id;
        $income['created_by']=auth()->user()->id;

        financeManagementIncomesModel::create($income);

        $totalPayment = $renewData['part_payment'] + $request->profit_amount;
        if($renewData['final_amount'] <= $totalPayment){
            //if full payment done
            $data['part_payment']=$totalPayment;
            $data['status']="renew";

            $clientDemat['account_status'] = "normal";
            $clientDemat['is_new'] = 3;
            ClientDemat::where("id", $renewData['client_demat_id'])->update($clientDemat);
        }else{
            $data['part_payment']=$totalPayment;
        }

        return RenewDemat::where("id",$request->profit_sharing_payment_id)->update($data);
    }

    public static function partPayment($request){
        $data['is_part_payment']=1;
        $data['bank_id']=$request->part_bank_id;

        $renewData = RenewDemat::where("id",$request->part_payment_id)->first()->toArray();
        $clientDematData = ClientDemat::where("id", $renewData['client_demat_id'])->first()->toArray();
        $forIncomes = bankServices::getBankAccountById($request->part_bank_id);
        $data['part_payment']=$forIncomes['invoice_code'];

        if($clientDematData['service_type'] == 1){
            $income['sub_heading']="Prime Profit Sharing";
        }elseif ($clientDematData['service_type'] == 2){
            $income['sub_heading']="AMS Profit Sharing";
        }
        $income['date']=date('Y-m-d');
        $income['mode']="1";
        $income['bank']=$request->part_bank_id;
        $income['income_form']=$clientDematData['st_sg'];
        if($clientDematData['st_sg'] == "ST"){
            $income['st_amount']=$request->part_amount;
        }elseif ($clientDematData['st_sg'] == "SG"){
            $income['sg_amount']=$request->part_amount;
        }
        $income['amount']=$request->part_amount;
        $income['renewal_account_id']=$request->part_payment_id;
        $income['created_by']=auth()->user()->id;

        financeManagementIncomesModel::create($income);

        $totalPayment = $renewData['part_payment'] + $request->part_amount;
        if($renewData['final_amount'] <= $totalPayment){
            //if full payment done
            $data['part_payment']=$totalPayment;
            $data['status']="renew";
            $data['is_pay_fee']=1;
            $data['is_pay_profit_sharing']=1;
            $data['is_part_payment']=0;

            $clientDemat['account_status'] = "normal";
            $clientDemat['is_new'] = 3;
            ClientDemat::where("id", $renewData['client_demat_id'])->update($clientDemat);
        }else{
            $data['part_payment']=$totalPayment;
        }

        return RenewDemat::where("id",$request->part_payment_id)->update($data);
    }

    public static function fullPayment($request){
        $data['is_pay_fee']=1;
        $data['is_pay_profit_sharing']=1;

        $renewData = RenewDemat::where("id",$request->full_payment_id)->first()->toArray();
        $clientDematData = ClientDemat::where("id", $renewData['client_demat_id'])->first()->toArray();
        $forIncomes = bankServices::getBankAccountById($request->full_bank_id);
        $data['part_payment']=$forIncomes['invoice_code'];

        $income['date']=date('Y-m-d');
        $income['sub_heading']="AMS Fees & Profit Sharing";
        $income['mode']="1";
        $income['bank']=$request->full_bank_id;
        $income['income_form']=$clientDematData['st_sg'];
        if($clientDematData['st_sg'] == "ST"){
            $income['st_amount']=$request->full_amount;
        }elseif ($clientDematData['st_sg'] == "SG"){
            $income['sg_amount']=$request->full_amount;
        }
        $income['amount']=$request->full_amount;
        $income['renewal_account_id']=$request->full_payment_id;
        $income['created_by']=auth()->user()->id;

        financeManagementIncomesModel::create($income);

        //if full payment done
        $data['part_payment'] = $request->full_amount;
        $data['status'] = "renew";
        $data['bank_id'] = $request->full_bank_id;

        $clientDemat['account_status'] = "normal";
        $clientDemat['is_new'] = 3;
        ClientDemat::where("id", $renewData['client_demat_id'])->update($clientDemat);


        return RenewDemat::where("id",$request->full_payment_id)->update($data);
    }

    public static function viewPartPaymentHistory($id){
        return financeManagementIncomesModel::where("renewal_account_id",$id)->get()->toArray();
    }
}
