<?php

namespace App\Services;

use App\Models\ClientDemat;
use App\Models\financeManagementModel\BankModel;
use App\Models\financeManagementModel\financeManagementIncomesModel;
use App\Models\renewalAccountImagesModal;
use App\Models\RenewDemat;
use App\Models\RenewExpensesModal;
use App\Models\User;
use App\Services\financeManagementServices\bankServices;
use Illuminate\Support\Facades\Auth;

class ClientDemateServices{
    public static function active(){
        $demates = ClientDemat::where("account_status","normal")->whereNull("problem")->with(["withClient"])->leftJoin('clients', 'client_demat.client_id', '=', 'clients.id');
        $user = Auth::user();
        if($user->user_type=="3"){
            $demates->where("client_demat.created_by",$user->id);
        }
        return $demates->select('client_demat.*', 'clients.name')->get();
    }
    public static function toRenews(){
       $demats = RenewDemat::
        leftJoin('client_demat', 'renewal_account.client_demat_id', '=', 'client_demat.id')->
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("renewal_account.status", "to_renew");
        $user = Auth::user();
        if($user->user_type=="3"){
            $demats->where("client_demat.created_by",$user->id);
        }
        return $demats->select('clients.name','clients.number','client_demat.serial_number','client_demat.st_sg','client_demat.client_id','client_demat.holder_name','client_demat.available_balance','renewal_account.*')
        ->get();
    }
    public static function problemAccounts(){
        $demats = ClientDemat::where(function($q) {
                $q->whereNotNull("problem")
                ->orWhere('account_status','=','problem');
        })->where('account_status','!=','terminated');
        $user = Auth::user();
        if($user->user_type=="3"){
            $demats->where("created_by",$user->id);
        }
        return $demats->with(["withClient"])->get();
    }
    public static function allAccounts(){
        $clients = ClientDemat::leftJoin('clients as c', function ($join) {
            $join->on('client_demat.client_id', '=', 'c.id')
                ->where('c.client_type', '=', 1);
        });
        $user = Auth::user();
        if($user->user_type=="3"){
            $clients->where("client_demat.created_by",Auth::id());
        }
        $clients = $clients->select('client_demat.*', 'c.name', 'c.number','c.deleted_at')->get();

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
         $data = RenewDemat::leftJoin('finance_management_banks', 'renewal_account.bank_id', '=', 'finance_management_banks.id')-> select('renewal_account.*','finance_management_banks.ifsc_code','finance_management_banks.account_no','finance_management_banks.pan_number','finance_management_banks.account_name','finance_management_banks.title')->where("bank_id",$bank_id)->where("renewal_account.status","to_renew")->where("renewal_account.created_at",">=",$startDate)->where("renewal_account.created_at","<=",$endDate)->get();

         if(!empty($data)){
            $data = $data->toArray();
          }

          return $data;

    }

    public static function blockAmountList($startDate,$endDate){

          $data = RenewDemat::leftJoin('finance_management_banks', 'renewal_account.bank_id', '=', 'finance_management_banks.id')->
        leftJoin('client_demat', 'renewal_account.client_demat_id', '=', 'client_demat.id')->
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        leftJoin('users', 'renewal_account.created_by', '=', 'users.id')->
          select('renewal_account.*','finance_management_banks.ifsc_code','finance_management_banks.account_no','finance_management_banks.pan_number','finance_management_banks.account_name','finance_management_banks.title','clients.name','client_demat.serial_number','client_demat.st_sg','users.name')->where("renewal_account.status","to_renew")->where("renewal_account.created_at",">=",$startDate)->where("renewal_account.created_at","<=",$endDate)->get();

          if(!empty($data)){
            $data = $data->toArray();
          }

          return $data;

    }

    public static function renewData($id){
        return RenewDemat::where("id",$id)->first()->toArray();
    }

    public static function renewDataById($id){
        return RenewDemat::
        leftJoin('client_demat', 'renewal_account.client_demat_id', '=', 'client_demat.id')->
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        leftJoin('finance_management_banks', 'renewal_account.bank_id', '=', 'finance_management_banks.id')->
        select('finance_management_banks.ifsc_code','finance_management_banks.account_no','finance_management_banks.pan_number','finance_management_banks.account_name','finance_management_banks.title','clients.name','clients.number','client_demat.serial_number','client_demat.st_sg','client_demat.client_id','client_demat.holder_name','client_demat.available_balance','client_demat.pan_number_text','client_demat.address','client_demat.mobile','client_demat.email_id','client_demat.service_type','renewal_account.*')
        ->where("renewal_account.id",$id)->first();
    }

    public static function demateFeesPayment($request){

        $request->validate([
            "renew_fees_date" => "required|date",
            "fees_amount" => "required",
            "fees_bank_id" => "required"
        ]);

        $data['is_pay_fee']=1;
        $data['bank_id']=$request->fees_bank_id;
        $data['fees_pay_date']=date("Y-m-d",strtotime($request->renew_fees_date));

        $renewData = RenewDemat::where("id",$request->fees_payment_id)->first()->toArray();
        $clientDematData = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("client_demat.id", $renewData['client_demat_id'])->select('client_demat.*','clients.channel_partner_id')->first()->toArray();
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

        // add balance in available balance
        if($request->fees_bank_id != '') {
            $toBankData = bankServices::getBankAccountById($request->fees_bank_id);

            if (!empty($toBankData)) {
                $addBalance['available_balance'] = $toBankData['available_balance'] +  $request->fees_amount;
                BankModel::where("id", $request->fees_bank_id)->update($addBalance);
            }
        }

        //channel Partner
        if ($clientDematData['service_type'] == 2 && isset($clientDematData['channel_partner_id']) && $clientDematData['channel_partner_id'] != '' && $clientDematData['channel_partner_id'] != 0) {
            $channelPartnerData = User::where("id",$clientDematData['channel_partner_id'])->first();

            $channelPartnerAmount = $channelPartnerData->ams_renewal_client_percentage*$renewData['renewal_fees']/100;
            $expensesData['percentage'] = $channelPartnerData->ams_new_client_percentage;

            $expensesData['user_id'] = $clientDematData['channel_partner_id'];
            $expensesData['renewal_account_id'] = $clientDematData['id'];
            $expensesData['amount'] =$channelPartnerAmount;
            $expensesData['firm'] =$clientDematData['st_sg'];
            $expensesData['created_by']=auth()->user()->id;
            $expensesData['date'] = date("Y-m-d");
            $expensesData['description'] = "RENEWAL FEES";
            $expensesData['total_amount'] = $renewData['renewal_fees'];
            RenewExpensesModal::create($expensesData);
        }

        //freelancer
        if ($clientDematData['service_type'] == 2 && isset($clientDematData['freelancer_id']) && $clientDematData['freelancer_id'] != '' && $clientDematData['freelancer_id'] != 0) {
            $freelancerData = User::where("id",$clientDematData['freelancer_id'])->first();
            $freelancerAmount = $freelancerData->fees_percentage*$renewData['renewal_fees']/100;
            $expensesData['user_id'] = $clientDematData['freelancer_id'];
            $expensesData['renewal_account_id'] = $clientDematData['id'];
            $expensesData['amount'] =$freelancerAmount;
            $expensesData['firm'] =$clientDematData['st_sg'];
            $expensesData['created_by']=auth()->user()->id;
            $expensesData['date'] = date("Y-m-d");
            $expensesData['description'] = "RENEWAL FEES";
            $expensesData['total_amount'] = $renewData['renewal_fees'];
            $expensesData['percentage'] = $freelancerData->fees_percentage;
            RenewExpensesModal::create($expensesData);
        }


        if($renewData['is_pay_profit_sharing'] == 1){
            //if full payment done
            $data['part_payment']=$totalPayment;
            $data['status']="renew";
            $data['payment_date']=date("Y-m-d",strtotime($request->renew_fees_date));

            $clientDemat['account_status'] = "normal";
            $clientDemat['is_new'] = 3;
            $clientDemat['joining_date'] = date('Y-m-d');
            ClientDemat::where("id", $renewData['client_demat_id'])->update($clientDemat);

            //after renew account remove the screenshots
            $imageData = renewalAccountImagesModal::where("renewal_account_id",$request->fees_payment_id)->get();
            if(!empty($imageData)) {
                $destinationPath = public_path('renewal_account_images/');
                foreach ($imageData as $image) {
                    if ($image->image_url != '') {
                        if (file_exists($destinationPath . $image->image_url)) {
                            unlink($destinationPath . $image->image_url);
                        }
                    }
                }
            }
        }else{
            $data['part_payment']=$totalPayment;
        }

        return RenewDemat::where("id",$request->fees_payment_id)->update($data);
    }

    public static function demateProfitSharing($request){
        $request->validate([
            "profit_sharing_date" => "required|date",
            "profit_amount" => "required",
            "profit_bank_id" => "required"
        ]);

        $data['is_pay_profit_sharing']=1;
        $data['bank_id']=$request->profit_bank_id;
        $data['profit_sharing_pay_date']=date("Y-m-d",strtotime($request->profit_sharing_date));

        $renewData = RenewDemat::where("id",$request->profit_sharing_payment_id)->first()->toArray();
        $clientDematData = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
                            where("client_demat.id", $renewData['client_demat_id'])->select('client_demat.*','clients.channel_partner_id')->first()->toArray();
        $forIncomes = bankServices::getBankAccountById($request->profit_bank_id);
        $data['part_payment']=$forIncomes['invoice_code'];

        if($clientDematData['service_type'] == 1){
            $income['sub_heading']="Prime Profit Sharing";
        }elseif ($clientDematData['service_type'] == 2){
            $income['sub_heading']="AMS Profit Sharing";
        }elseif ($clientDematData['service_type'] == 3){
            $income['sub_heading']="Prime Next Profit Sharing";
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

        // add balance in available balance
        if($request->profit_bank_id != '') {
            $toBankData = bankServices::getBankAccountById($request->profit_bank_id);

            if (!empty($toBankData)) {
                $addBalance['available_balance'] = $toBankData['available_balance'] +  $request->profit_amount;
                BankModel::where("id", $request->profit_bank_id)->update($addBalance);
            }
        }

        if (($clientDematData['service_type'] == 1 || $clientDematData['service_type'] == 3) && isset($clientDematData['channel_partner_id']) && $clientDematData['channel_partner_id'] != '' && $clientDematData['channel_partner_id'] != 0) {
            $channelPartnerData = User::where("id",$clientDematData['channel_partner_id'])->first();
            if ($clientDematData['is_new'] == 1 || $clientDematData['is_new'] == 2) {
                $channelPartnerAmount = $channelPartnerData->prime_new_client_percentage*$renewData['profit_sharing']/100;
                $expensesData['percentage'] = $channelPartnerData->prime_new_client_percentage;
            } else {
                $channelPartnerAmount = $channelPartnerData->prime_renewal_client_percentage*$renewData['profit_sharing']/100;
                $expensesData['percentage'] = $channelPartnerData->prime_renewal_client_percentage;
            }
            $expensesData['user_id'] = $clientDematData['channel_partner_id'];
            $expensesData['renewal_account_id'] = $clientDematData['id'];
            $expensesData['amount'] =$channelPartnerAmount;
            $expensesData['firm'] =$clientDematData['st_sg'];
            $expensesData['created_by']=auth()->user()->id;
            $expensesData['date'] = date("Y-m-d");
            $expensesData['description'] = "PROFIT SHARING";
            $expensesData['total_amount'] = $renewData['profit_sharing'];
            RenewExpensesModal::create($expensesData);
        }

        if (isset($clientDematData['freelancer_id']) && $clientDematData['freelancer_id'] != '' && $clientDematData['freelancer_id'] != 0) {
            $freelancerData = User::where("id", $clientDematData['freelancer_id'])->first();
            if($clientDematData['service_type'] == 2) {
                if($renewData['profit_sharing'] > $freelancerData->ams_limit) {
                    $countAmount = $renewData['profit_sharing'] - $freelancerData->ams_limit;
                    $freelancerAmount = $freelancerData->fees_percentage * $countAmount / 100;
                    $expensesData['user_id'] = $clientDematData['freelancer_id'];
                    $expensesData['renewal_account_id'] = $clientDematData['id'];
                    $expensesData['amount'] = $freelancerAmount;
                    $expensesData['firm'] = $clientDematData['st_sg'];
                    $expensesData['created_by'] = auth()->user()->id;
                    $expensesData['date'] = date("Y-m-d");
                    $expensesData['description'] = "PROFIT SHARING";
                    $expensesData['total_amount'] = $countAmount;
                    $expensesData['percentage'] = $freelancerData->fees_percentage;
                    RenewExpensesModal::create($expensesData);
                }
            }elseif ($clientDematData['service_type'] == 1 || $clientDematData['service_type'] == 3){
                $freelancerAmount = $freelancerData->percentage * $renewData['profit_sharing'] / 100;
                $expensesData['user_id'] = $clientDematData['freelancer_id'];
                $expensesData['renewal_account_id'] = $clientDematData['id'];
                $expensesData['amount'] = $freelancerAmount;
                $expensesData['firm'] = $clientDematData['st_sg'];
                $expensesData['created_by'] = auth()->user()->id;
                $expensesData['date'] = date("Y-m-d");
                $expensesData['description'] = "PROFIT SHARING";
                $expensesData['total_amount'] = $renewData['profit_sharing'];
                $expensesData['percentage'] = $freelancerData->percentage;
                RenewExpensesModal::create($expensesData);
            }
        }

        if($renewData['is_pay_fee'] == 1 ||  $clientDematData['service_type'] == 1){
            //if full payment done
            $data['part_payment']=$totalPayment;
            $data['status']="renew";
            $data['payment_date']=date("Y-m-d",strtotime($request->profit_sharing_date));

            $clientDemat['account_status'] = "normal";
            $clientDemat['is_new'] = 3;
            $clientDemat['joining_date'] = date('Y-m-d');
            ClientDemat::where("id", $renewData['client_demat_id'])->update($clientDemat);

            //after renew account remove the screenshots
            $imageData = renewalAccountImagesModal::where("renewal_account_id",$request->profit_sharing_payment_id)->get();
            if(!empty($imageData)) {
                $destinationPath = public_path('renewal_account_images/');
                foreach ($imageData as $image) {
                    if ($image->image_url != '') {
                        if (file_exists($destinationPath . $image->image_url)) {
                            unlink($destinationPath . $image->image_url);
                        }
                    }
                }
            }
        }else{
            $data['part_payment']=$totalPayment;
        }

        return RenewDemat::where("id",$request->profit_sharing_payment_id)->update($data);
    }

    public static function partPayment($request){
        $request->validate([
            "part_amount" => "required",
            "part_bank_id" => "required"
        ]);

        $data['is_part_payment']=1;
        $data['bank_id']=$request->part_bank_id;

        $renewData = RenewDemat::where("id",$request->part_payment_id)->first()->toArray();
        $clientDematData = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
                            where("client_demat.id", $renewData['client_demat_id'])->select('client_demat.*','clients.channel_partner_id')->first()->toArray();
        $forIncomes = bankServices::getBankAccountById($request->part_bank_id);
        $data['part_payment']=$forIncomes['invoice_code'];

        if($clientDematData['service_type'] == 1){
            $income['sub_heading']="Prime Profit Sharing";
        }elseif ($clientDematData['service_type'] == 2){
            $income['sub_heading']="AMS Profit Sharing";
        }elseif ($clientDematData['service_type'] == 3){
            $income['sub_heading']="Prime Next Profit Sharing";
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

        // add balance in available balance
        if($request->part_bank_id != '') {
            $toBankData = bankServices::getBankAccountById($request->part_bank_id);

            if (!empty($toBankData)) {
                $addBalance['available_balance'] = $toBankData['available_balance'] +  $request->part_amount;
                BankModel::where("id", $request->part_bank_id)->update($addBalance);
            }
        }

        if($renewData['final_amount'] <= $totalPayment){

            //channel Partner Renewal Fees
            if ($clientDematData['service_type'] == 2 && isset($clientDematData['channel_partner_id']) && $clientDematData['channel_partner_id'] != '' && $clientDematData['channel_partner_id'] != 0) {
                $channelPartnerData = User::where("id",$clientDematData['channel_partner_id'])->first();

                $channelPartnerAmount = $channelPartnerData->ams_renewal_client_percentage*$renewData['renewal_fees']/100;
                $expensesData['percentage'] = $channelPartnerData->ams_new_client_percentage;

                $expensesData['user_id'] = $clientDematData['channel_partner_id'];
                $expensesData['renewal_account_id'] = $clientDematData['id'];
                $expensesData['amount'] =$channelPartnerAmount;
                $expensesData['firm'] =$clientDematData['st_sg'];
                $expensesData['created_by']=auth()->user()->id;
                $expensesData['date'] = date("Y-m-d");
                $expensesData['description'] = "RENEWAL FEES";
                $expensesData['total_amount'] = $renewData['renewal_fees'];
                RenewExpensesModal::create($expensesData);
            }

            //freelancer Renewal Fees
            if ($clientDematData['service_type'] == 2 && isset($clientDematData['freelancer_id']) && $clientDematData['freelancer_id'] != '' && $clientDematData['freelancer_id'] != 0) {
                $freelancerData = User::where("id",$clientDematData['freelancer_id'])->first();
                $freelancerAmount = $freelancerData->fees_percentage*$renewData['renewal_fees']/100;
                $expensesData['user_id'] = $clientDematData['freelancer_id'];
                $expensesData['renewal_account_id'] = $clientDematData['id'];
                $expensesData['amount'] =$freelancerAmount;
                $expensesData['firm'] =$clientDematData['st_sg'];
                $expensesData['created_by']=auth()->user()->id;
                $expensesData['date'] = date("Y-m-d");
                $expensesData['description'] = "RENEWAL FEES";
                $expensesData['total_amount'] = $renewData['renewal_fees'];
                $expensesData['percentage'] = $freelancerData->fees_percentage;
                RenewExpensesModal::create($expensesData);
            }

            //channel Partner Profit sharing
            if (($clientDematData['service_type'] == 1 || $clientDematData['service_type'] == 3) && isset($clientDematData['channel_partner_id']) && $clientDematData['channel_partner_id'] != '' && $clientDematData['channel_partner_id'] != 0) {
                $channelPartnerData = User::where("id",$clientDematData['channel_partner_id'])->first();
                if ($clientDematData['is_new'] == 1 || $clientDematData['is_new'] == 2) {
                    $channelPartnerAmount = $channelPartnerData->prime_new_client_percentage*$renewData['profit_sharing']/100;
                    $expensesData['percentage'] = $channelPartnerData->prime_new_client_percentage;
                } else {
                    $channelPartnerAmount = $channelPartnerData->prime_renewal_client_percentage*$renewData['profit_sharing']/100;
                    $expensesData['percentage'] = $channelPartnerData->prime_renewal_client_percentage;
                }
                $expensesData['user_id'] = $clientDematData['channel_partner_id'];
                $expensesData['renewal_account_id'] = $clientDematData['id'];
                $expensesData['amount'] =$channelPartnerAmount;
                $expensesData['firm'] =$clientDematData['st_sg'];
                $expensesData['created_by']=auth()->user()->id;
                $expensesData['date'] = date("Y-m-d");
                $expensesData['description'] = "PROFIT SHARING";
                $expensesData['total_amount'] = $renewData['profit_sharing'];
                RenewExpensesModal::create($expensesData);
            }

            //freelancer profit sharing
            if (isset($clientDematData['freelancer_id']) && $clientDematData['freelancer_id'] != '' && $clientDematData['freelancer_id'] != 0) {
                $freelancerData = User::where("id", $clientDematData['freelancer_id'])->first();
                if($clientDematData['service_type'] == 2) {
                    if($renewData['profit_sharing'] > $freelancerData->ams_limit) {
                        $countAmount = $renewData['profit_sharing'] - $freelancerData->ams_limit;
                        $freelancerAmount = $freelancerData->fees_percentage * $countAmount / 100;
                        $expensesData['user_id'] = $clientDematData['freelancer_id'];
                        $expensesData['renewal_account_id'] = $clientDematData['id'];
                        $expensesData['amount'] = $freelancerAmount;
                        $expensesData['firm'] = $clientDematData['st_sg'];
                        $expensesData['created_by'] = auth()->user()->id;
                        $expensesData['date'] = date("Y-m-d");
                        $expensesData['description'] = "PROFIT SHARING";
                        $expensesData['total_amount'] = $countAmount;
                        $expensesData['percentage'] = $freelancerData->fees_percentage;
                        RenewExpensesModal::create($expensesData);
                    }
                }elseif ($clientDematData['service_type'] == 1 || $clientDematData['service_type'] == 3){
                    $freelancerAmount = $freelancerData->percentage * $renewData['profit_sharing'] / 100;
                    $expensesData['user_id'] = $clientDematData['freelancer_id'];
                    $expensesData['renewal_account_id'] = $clientDematData['id'];
                    $expensesData['amount'] = $freelancerAmount;
                    $expensesData['firm'] = $clientDematData['st_sg'];
                    $expensesData['created_by'] = auth()->user()->id;
                    $expensesData['date'] = date("Y-m-d");
                    $expensesData['description'] = "PROFIT SHARING";
                    $expensesData['total_amount'] = $renewData['profit_sharing'];
                    $expensesData['percentage'] = $freelancerData->percentage;
                    RenewExpensesModal::create($expensesData);
                }
            }

            $data['payment_date']=date("Y-m-d");
            $data['fees_pay_date']=date("Y-m-d");
            $data['profit_sharing_pay_date']=date("Y-m-d");
            //if full payment done
            $data['part_payment']=$totalPayment;
            $data['status']="renew";
            $data['is_pay_fee']=1;
            $data['is_pay_profit_sharing']=1;
            $data['is_part_payment']=0;

            $clientDemat['account_status'] = "normal";
            $clientDemat['is_new'] = 3;
            $clientDemat['joining_date'] = date('Y-m-d');
            ClientDemat::where("id", $renewData['client_demat_id'])->update($clientDemat);

            //after renew account remove the screenshots
            $imageData = renewalAccountImagesModal::where("renewal_account_id",$request->part_payment_id)->get();
            if(!empty($imageData)) {
                $destinationPath = public_path('renewal_account_images/');
                foreach ($imageData as $image) {
                    if ($image->image_url != '') {
                        if (file_exists($destinationPath . $image->image_url)) {
                            unlink($destinationPath . $image->image_url);
                        }
                    }
                }
            }
        }else{
            $data['part_payment']=$totalPayment;
        }

        return RenewDemat::where("id",$request->part_payment_id)->update($data);
    }

    public static function fullPayment($request){

        $request->validate([
            "payment_date" => "required|date",
            "full_amount" => "required",
            "full_bank_id" => "required"
        ]);

        $data['is_pay_fee']=1;
        $data['is_pay_profit_sharing']=1;
        $data['payment_date']=date("Y-m-d",strtotime($request->payment_date));
        $data['fees_pay_date']=date("Y-m-d",strtotime($request->payment_date));
        $data['profit_sharing_pay_date']=date("Y-m-d",strtotime($request->payment_date));

        $renewData = RenewDemat::where("id",$request->full_payment_id)->first()->toArray();
        $clientDematData = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
                    where("client_demat.id", $renewData['client_demat_id'])->select('client_demat.*','clients.channel_partner_id')->first()->toArray();
        $forIncomes = bankServices::getBankAccountById($request->full_bank_id);
        $data['part_payment']=$forIncomes['invoice_code'];

        if($clientDematData['service_type'] == 1 || $clientDematData['service_type'] == 3){
            $data['is_pay_profit_sharing']=1;
        }elseif ($clientDematData['service_type'] == 2){
            $data['is_pay_fee']=1;
            $data['is_pay_profit_sharing']=1;
        }

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


        //channel Partner Renewal Fees
        if ($clientDematData['service_type'] == 2 && isset($clientDematData['channel_partner_id']) && $clientDematData['channel_partner_id'] != '' && $clientDematData['channel_partner_id'] != 0) {
            $channelPartnerData = User::where("id",$clientDematData['channel_partner_id'])->first();

            $channelPartnerAmount = $channelPartnerData->ams_renewal_client_percentage*$renewData['renewal_fees']/100;
            $expensesData['percentage'] = $channelPartnerData->ams_new_client_percentage;

            $expensesData['user_id'] = $clientDematData['channel_partner_id'];
            $expensesData['renewal_account_id'] = $clientDematData['id'];
            $expensesData['amount'] =$channelPartnerAmount;
            $expensesData['firm'] =$clientDematData['st_sg'];
            $expensesData['created_by']=auth()->user()->id;
            $expensesData['date'] = date("Y-m-d");
            $expensesData['description'] = "RENEWAL FEES";
            $expensesData['total_amount'] = $renewData['renewal_fees'];
            RenewExpensesModal::create($expensesData);
        }

        //freelancer Renewal Fees
        if ($clientDematData['service_type'] == 2 && isset($clientDematData['freelancer_id']) && $clientDematData['freelancer_id'] != '' && $clientDematData['freelancer_id'] != 0) {
            $freelancerData = User::where("id",$clientDematData['freelancer_id'])->first();
            $freelancerAmount = $freelancerData->fees_percentage*$renewData['renewal_fees']/100;
            $expensesData['user_id'] = $clientDematData['freelancer_id'];
            $expensesData['renewal_account_id'] = $clientDematData['id'];
            $expensesData['amount'] =$freelancerAmount;
            $expensesData['firm'] =$clientDematData['st_sg'];
            $expensesData['created_by']=auth()->user()->id;
            $expensesData['date'] = date("Y-m-d");
            $expensesData['description'] = "RENEWAL FEES";
            $expensesData['total_amount'] = $renewData['renewal_fees'];
            $expensesData['percentage'] = $freelancerData->fees_percentage;
            RenewExpensesModal::create($expensesData);
        }

        //channel Partner Profit sharing
        if (($clientDematData['service_type'] == 1 || $clientDematData['service_type'] == 3) && isset($clientDematData['channel_partner_id']) && $clientDematData['channel_partner_id'] != '' && $clientDematData['channel_partner_id'] != 0) {
            $channelPartnerData = User::where("id",$clientDematData['channel_partner_id'])->first();
            if ($clientDematData['is_new'] == 1 || $clientDematData['is_new'] == 2) {
                $channelPartnerAmount = $channelPartnerData->prime_new_client_percentage*$renewData['profit_sharing']/100;
                $expensesData['percentage'] = $channelPartnerData->prime_new_client_percentage;
            } else {
                $channelPartnerAmount = $channelPartnerData->prime_renewal_client_percentage*$renewData['profit_sharing']/100;
                $expensesData['percentage'] = $channelPartnerData->prime_renewal_client_percentage;
            }
            $expensesData['user_id'] = $clientDematData['channel_partner_id'];
            $expensesData['renewal_account_id'] = $clientDematData['id'];
            $expensesData['amount'] =$channelPartnerAmount;
            $expensesData['firm'] =$clientDematData['st_sg'];
            $expensesData['created_by']=auth()->user()->id;
            $expensesData['date'] = date("Y-m-d");
            $expensesData['description'] = "PROFIT SHARING";
            $expensesData['total_amount'] = $renewData['profit_sharing'];
            RenewExpensesModal::create($expensesData);
        }

        //freelancer profit sharing
        if (isset($clientDematData['freelancer_id']) && $clientDematData['freelancer_id'] != '' && $clientDematData['freelancer_id'] != 0) {
            $freelancerData = User::where("id", $clientDematData['freelancer_id'])->first();
            if($clientDematData['service_type'] == 2) {
                if($renewData['profit_sharing'] > $freelancerData->ams_limit) {
                    $countAmount = $renewData['profit_sharing'] - $freelancerData->ams_limit;
                    $freelancerAmount = $freelancerData->fees_percentage * $countAmount / 100;
                    $expensesData['user_id'] = $clientDematData['freelancer_id'];
                    $expensesData['renewal_account_id'] = $clientDematData['id'];
                    $expensesData['amount'] = $freelancerAmount;
                    $expensesData['firm'] = $clientDematData['st_sg'];
                    $expensesData['created_by'] = auth()->user()->id;
                    $expensesData['date'] = date("Y-m-d");
                    $expensesData['description'] = "PROFIT SHARING";
                    $expensesData['total_amount'] = $countAmount;
                    $expensesData['percentage'] = $freelancerData->fees_percentage;
                    RenewExpensesModal::create($expensesData);
                }
            }elseif ($clientDematData['service_type'] == 1 || $clientDematData['service_type'] == 3){
                $freelancerAmount = $freelancerData->percentage * $renewData['profit_sharing'] / 100;
                $expensesData['user_id'] = $clientDematData['freelancer_id'];
                $expensesData['renewal_account_id'] = $clientDematData['id'];
                $expensesData['amount'] = $freelancerAmount;
                $expensesData['firm'] = $clientDematData['st_sg'];
                $expensesData['created_by'] = auth()->user()->id;
                $expensesData['date'] = date("Y-m-d");
                $expensesData['description'] = "PROFIT SHARING";
                $expensesData['total_amount'] = $renewData['profit_sharing'];
                $expensesData['percentage'] = $freelancerData->percentage;
                RenewExpensesModal::create($expensesData);
            }
        }

        // add balance in available balance
        if($request->full_bank_id != '') {
            $toBankData = bankServices::getBankAccountById($request->full_bank_id);

            if (!empty($toBankData)) {
                $addBalance['available_balance'] = $toBankData['available_balance'] +  $request->full_amount;
                BankModel::where("id", $request->full_bank_id)->update($addBalance);
            }
        }


        //if full payment done
        $data['part_payment'] = $request->full_amount;
        $data['status'] = "renew";
        $data['bank_id'] = $request->full_bank_id;

        $clientDemat['account_status'] = "normal";
        $clientDemat['is_new'] = 3;
        $clientDemat['joining_date'] = date('Y-m-d');
        ClientDemat::where("id", $renewData['client_demat_id'])->update($clientDemat);

        //after renew account remove the screenshots
        $imageData = renewalAccountImagesModal::where("renewal_account_id",$request->full_payment_id)->get();
        if(!empty($imageData)) {
            $destinationPath = public_path('renewal_account_images/');
            foreach ($imageData as $image) {
                if ($image->image_url != '') {
                    if (file_exists($destinationPath . $image->image_url)) {
                        unlink($destinationPath . $image->image_url);
                    }
                }
            }
        }

        return RenewDemat::where("id",$request->full_payment_id)->update($data);
    }

    public static function setPartPaymentReminder($request){
        $request->validate([
            "reminder_date" => "required|date"
        ]);

        $data['reminder_date']=date("Y-m-d",strtotime($request->reminder_date));
        return RenewDemat::where("id",$request->part_payment_reminder_id)->update($data);
    }

    public static function viewPartPaymentHistory($id){
        return financeManagementIncomesModel::where("renewal_account_id",$id)->get()->toArray();
    }
    public static function remove($id){
        return ClientDemat::where("id",$id)->delete();
    }
}
