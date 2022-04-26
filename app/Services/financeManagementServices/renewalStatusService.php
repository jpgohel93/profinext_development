<?php

namespace App\Services\financeManagementServices;

use App\Models\AccountTypesModel;
use App\Models\ClientDemat;
use App\Models\RenewDemat;
use App\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use App\Services\financeManagementServices\bankServices;
use App\Services\LogServices;
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
        leftJoin('client_demat', 'renewal_account.client_demat_id', '=', 'client_demat.id')
            ->where("renewal_account.status", "to_renew")
            ->where("renewal_account.is_part_payment", 0)
            ->select('client_demat.serial_number','client_demat.service_type','client_demat.st_sg','client_demat.client_id','client_demat.holder_name','client_demat.available_balance','renewal_account.*')
            ->get();
    }
    public static function partPaymentData()
    {
        return RenewDemat::
        leftJoin('client_demat', 'renewal_account.client_demat_id', '=', 'client_demat.id')
            ->leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')
            ->where("renewal_account.status", "to_renew")
            ->where("renewal_account.is_part_payment", 1)
            ->select('clients.name','client_demat.serial_number','client_demat.service_type','client_demat.st_sg','client_demat.client_id','client_demat.holder_name','client_demat.available_balance','renewal_account.*')
            ->get();
    }
    public static function renewedAccounts()
    {
        return RenewDemat::
        leftJoin('client_demat', 'renewal_account.client_demat_id', '=', 'client_demat.id')
            ->leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')
            ->where("renewal_account.status", "renew")
            ->select('clients.name','client_demat.serial_number','client_demat.final_pl','client_demat.service_type','client_demat.st_sg','client_demat.client_id','client_demat.holder_name','client_demat.available_balance','renewal_account.*')
            ->get();
    }
    public static function newAccounts()
    {
        return ClientDemat::where("is_new",1)->orWhere("is_new",2)->whereNull("mark_as_problem")->get();
    }

    public static function createRenewal($request){
        $forIncomes = bankServices::getBankAccountById($request->payment_bank_id);

        if(date("m") >= 4){
            $currentYear = date("y");
            $lastYear = (date("y")+1);

            $startDate = date("Y")."-04-01";
            $endDate = (date("Y")+1)."-03-31";
        }else{
            $currentYear = (date("y") - 1);
            $lastYear = date("y");

            $startDate = (date("Y") - 1)."-04-01";
            $endDate = (date("Y")+1)."-03-31";
        }

        $getInvoiceCode = RenewDemat::where('bank_id',$request->payment_bank_id)->where("created_at",">=",$startDate)->where("created_at","<=",$endDate)->orderBy("id", "DESC")->first();

        if(!empty($getInvoiceCode)) {
            $invoiceCode = $getInvoiceCode->invoice_code;
            $orderId = $getInvoiceCode->order_id;
        } else {
            $invoiceCode = 0;
            $orderId = 0;
        }

        $request_data['created_by'] = Auth::id();
        $request_data['bank_code'] = isset($forIncomes['invoice_code'])?$forIncomes['invoice_code']:"";
        $request_data['financial_year'] = $currentYear."-".$lastYear;
        $request_data['invoice_code'] = sprintf('%04d',($invoiceCode+1));
        $request_data['order_id'] = sprintf('%04d',($orderId+1));
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
            $id = RenewDemat::create($request_data);
            $user_name = auth()->user()->name;
            if($id){
                LogServices::logEvent(["desc"=>"renewal $id->id created by $user_name"]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to create renewal by $user_name","data"=>$request_data]);
            }
        } catch (\Throwable $th) {
            LogServices::logEvent(["desc"=>"Unable to create renewal by $user_name","data"=>$request_data]);
            CommonService::throwError("Unable to create renew demat datass".$th);
        }
    }
}
