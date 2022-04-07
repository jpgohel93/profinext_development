<?php

namespace App\Services\financeManagementServices;

use App\Models\AccountTypesModel;
use App\Models\ClientDemat;
use App\Models\RenewDemat;
use App\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use App\Services\ClientDemateServices;

class renewalStatusService
{
    public static function view()
    {
        return AccountTypesModel::get(['id', 'account_type']);
    }
    public static function preRenewAccounts()
    {
        return ClientDemat::where("account_status", "renew")->get();
    }
    public static function toRenewAccounts()
    {
        return RenewDemat::
        leftJoin('client_demat', 'renewal_account.client_demat_id', '=', 'client_demat.id')->where("renewal_account.status", "to_renew")
        ->select('client_demat.serial_number','client_demat.st_sg','client_demat.client_id','client_demat.holder_name','client_demat.available_balance','renewal_account.*')
            ->get();
    }
    public static function renewedAccounts()
    {
        return ClientDemat::where("account_status", "renewed")->get();
    }
    public static function newAccounts()
    {
        return ClientDemat::where("is_new",1)->orWhere("is_new",2)->whereNull("mark_as_problem")->get();
    }
    public static function create($request)
    {
        $type = $request->validate([
            "account_type" => "required|alpha_spaces|unique:user_account_types,account_type"
        ]);
        $type['created_by'] = Auth::id();
        return AccountTypesModel::create($type);
    }
    public static function remove($id)
    {
        return AccountTypesModel::where("id", $id)->delete();
    }
    public static function get($id)
    {
        return AccountTypesModel::where("id", $id)->first(["id", "account_type"]);
    }
    public static function edit($request)
    {
        $type = $request->validate([
            "account_type" => "required|alpha_spaces|unique:user_account_types,account_type"
        ]);
        return AccountTypesModel::where("id", $request->id)->update($type);
    }
    public static function clientDematView($id){
        $demate = ClientDemateServices::getAccountByDemateId($id);
    }
    public static function createRenewal($request){
        $request_data['created_by'] = Auth::id();
        $request_data['created_at'] = date("Y-m-d");
        $request_data['client_demat_id'] =  $request->id;
        $request_data['joining_date'] =  $request->joining_date;
        $request_data['end_date'] =  $request->end_date;
        $request_data['pl'] =  $request->pl;
        $request_data['status'] =  "to_renew";
        $request_data['bank_id'] =  $request->payment_bank_id;
        $request_data['total_profit'] =  isset($request->total_profit) ? $request->total_profit : '';
        $request_data['promised_profit'] = isset($request->promised_profit) ? $request->promised_profit : '';
        $request_data['profit_sharing'] =  isset($request->profit_sharing) ? $request->profit_sharing : '';
        $request_data['access_profit'] =  isset($request->access_profit) ? $request->access_profit : '';
        $request_data['total_payment'] =  isset($request->total_payment) ? $request->total_payment : '';
        $request_data['renewal_fees'] =  isset($request->renewal_fees) ? $request->renewal_fees : '';
        $request_data['round_of_amount'] =  isset($request->round_of_amount) ? $request->round_of_amount : '';
        $request_data['round_of_amount_type'] =  isset($request->round_of_amount_type) ? $request->round_of_amount_type : '';
        if($request->round_of_amount_type == "add"){
            $request_data['final_amount'] = $request->total_payment + $request->round_of_amount;
        }elseif ($request->round_of_amount_type == "minus"){
            $request_data['final_amount'] = $request->total_payment - $request->round_of_amount;
        }else{
            $request_data['final_amount'] = $request->total_payment;
        }
        try {
            RenewDemat::create($request_data);
            return true;
        } catch (\Throwable $th) {
            CommonService::throwError("Unable to create renew demat datass".$th);
        }
    }
}
