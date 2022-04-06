<?php

namespace App\Services;

use App\Models\Client;
use App\Models\ClientDemat;
use App\Models\ClientPayment;
use App\Models\Screenshots;
use App\Models\PancardImageModel;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonService;
use App\Services\financeManagementServices\financeManagementIncomesServices;
use App\Services\financeManagementServices\financeManagementExpensesServices;
use PDF;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
class ClientServices
{
    public static function create($request)
    {
        $request->session()->put("password", $request->password);
        $client = $request->validate([
            "name"=>"required|alpha_spaces",
            "number"=>"required",
            "communication_with"=>"required|alpha_spaces",
            "profession"=>"required|alpha_spaces",
            "client_type"=>"required|min:1|max:3",
        ],[
            "client_type.required" =>"Invalid Client Type",
            "client_type.min" =>"Invalid Client Type",
            "client_type.max" =>"Invalid Client Type",
        ]);
        if(!isset($request->wpsameascontact) || $request->wpsameascontact!=1){
            $request->validate([
                "wp_number"=>"required|numeric",
            ]);
            $client['wp_number']=$request->wp_number;
        }else{
            $client['wp_number']=$client['number'];
        }
        $client['created_by'] = Auth::id();
        $client['channel_partner_id'] = ($request->channel_partner_id != '') ? $request->channel_partner_id : 0;

        if ($request->client_type == 1) {
            $demat = $request->validate(
                [
                    "st_sg.*" => "required|alpha_spaces",
                    "serial_number.*" => "required",
                    "service_type.*" => "required|numeric",
                    "pan_number.*" => "required",
                    "holder_name.*" => "required|alpha_spaces",
                    "broker.*" => "required|alpha_spaces",
                    "user_id.*" => "required",
                    "password.*" => "required",
                    "mpin.*" => "required",
                    "capital.*" => "required",
                ],
                [
                    "st_sg.*.required" => "Smart ID is required",
                    "serial_number.*.required" => "Serial Number is required",
                    "service_type.*.required" => "Service Type is required",
                    "pan_number.*.required" => "PAN Number is required",
                    "holder_name.*.required" => "Demat Holder's Name is required",
                    "holder_name.*.alpha_spaces" => "Demat Holder's Name Shold contain alphabate and spaces only",
                    "broker.*.required" => "Broker is required",
                    "user_id.*.required" => "User ID is required",
                    "password.*.required" => "Password is required",
                    "mpin.*.required" => "Mpin is required",
                    "capital.*.required" => "Capital is required",
                ]
            );

            $demat['client_id'] = array();

            // hash all passwords
            foreach ($request->password as $key => $password) {
                $demat["password"][$key] = $password;
                $demat["mpin"][$key] = $request->mpin[$key];
                array_push($demat['client_id'], 0);
            }

            // insert one by one and get id
            $demat_ids = array();
            foreach ($demat['st_sg'] as $key => $value) {
                $array = array();
                $panCards = array();
                $screenshots = array();

                $array = array();
                $array['st_sg'] = $demat['st_sg'][$key];
                $array['serial_number'] = $demat['serial_number'][$key];
                $array['service_type'] = $demat['service_type'][$key];
                $array['holder_name'] = $demat['holder_name'][$key];
                $array['broker'] = $demat['broker'][$key];
                $array['user_id'] = $demat['user_id'][$key];
                $array['password'] = $demat['password'][$key];
                $array['mpin'] = $demat['mpin'][$key];
                $array['capital'] = $demat['capital'][$key];
                $array['client_id'] = $demat['client_id'][$key];
                $array['available_balance'] = $demat['capital'][$key];
                $array['pl'] = "0";
                $array['is_make_as_preferred'] = 0;
                $array['pan_number'] = null;
                $array['is_new'] = 1;
                $array['joining_date'] = date('Y-m-d');
                $array['created_by'] = auth()->user()->id;

                // insert payment

                if ($request->mode[$key] == "2") {
                    $payment = $request->validate(
                        [
                            "bank.*" => "required|alpha_spaces",
                            "mode.*" => "required|numeric",
                            "joining_date" => "required",
                            "pending_payment.*" => "required|numeric",
                        ],
                        [
                            "bank.*.alpha_spaces" => "Invalid Bank",
                            "bank.*.required" => "Payment bank is required",
                            "joining_date.required" => "Joining Date is Required",
                            "pending_payment.*.numeric" => "Invalid Pending Payment Mark",
                        ]
                    );
                    
                    if ($request->pending_payment[$key] == "0") {
                        $payment = $request->validate(
                            [
                                "fees" => "required",
                            ],
                            [
                                "fees.required" => "Fees is required",
                            ]
                        );
                    }
                    $payment['joining_date'] = $request->joining_date[$key];
                    $payment['bank'] = $request->bank[$key];
                    $payment['fees'] = $request->fees[$key];
                    $payment['mode'] = $request->mode[$key];
                    $payment['pending_payment'] = $request->pending_payment[$key];
                    $payment['updated_by'] = Auth::id();
                    $payment['updated_at'] = date("Y-m-d H:i:s");
                    $payment['client_id'] = 0;
                    $payment['demat_id'] = "0";
                    $payment['created_by'] = auth()->user()->id;

                    $payment_id = ClientPayment::create($payment);
                } else {
                    $payment = $request->validate([
                        "mode.*" => "required|numeric",
                    ]);

                    $payment['mode'] = $request->mode[$key];
                    $payment['updated_by'] = Auth::id();
                    $payment['updated_at'] = date("Y-m-d H:i:s");
                    $payment['client_id'] = 0;
                    $payment['created_by'] = auth()->user()->id;
                    $payment['demat_id'] = "0";
                    $payment_id = ClientPayment::create($payment);
                }

                if (null !== $request->pan_number) {
                    // pan card image upload
                    foreach ($request->pan_number as $index => $file) {
                        if (is_array($file)) {
                            foreach ($file as $f) {
                                $newName = CommonService::uploadfile($f, config()->get('constants.UPLOADS.PANCARDS'));
                                if ($newName['status']) {
                                    $panCardId = PancardImageModel::create(["client_demat_id" => 0, "file" => $newName['data']['filename'], "mime_type" => $newName['data']['mimeType']]);
                                }
                            }
                        } else {
                            $newName = CommonService::uploadfile($file, config()->get('constants.UPLOADS.PANCARDS'));
                            if ($newName['status']) {
                                $panCardId = PancardImageModel::create(["client_demat_id" => 0, "file" => $newName['data']['filename'], "mime_type" => $newName['data']['mimeType']]);
                            }
                        }
                        array_push($panCards,$panCardId->id);
                    }
                }

                // file upload
                if ($request->mode[$key] == "2" && $request->pending_payment[$key] != "1" && isset($request->screenshot[$key]) && !empty($request->screenshot[$key])) {
                    foreach ($request->screenshot[$key] as $index => $file) {
                        if (is_array($file)) {
                            foreach ($file as $f) {
                                $newName = CommonService::uploadfile($f, config()->get('constants.UPLOADS.SCREENSHOTS'));
                                if ($newName['status']) {
                                    $screenshotId = Screenshots::create(["client_payment_id" => $payment_id->id, "file" => $newName['data']['filename'], "mime_type" => $newName['data']['mimeType']]);
                                }
                            }
                        } else {
                            $newName = CommonService::uploadfile($file, config()->get('constants.UPLOADS.SCREENSHOTS'));
                            if ($newName['status']) {
                                $screenshotId = Screenshots::create(["client_payment_id" => $payment_id->id, "file" => $newName['data']['filename'], "mime_type" => $newName['data']['mimeType']]);
                            }
                        }
                        array_push($screenshots, $screenshotId->id);
                    }
                }
                // create demat
                $demat_id = ClientDemat::create($array);
                array_push($demat_ids,["ss"=>$screenshots,"pan"=>$panCards,"demat"=>$demat_id,"payment"=> $payment_id->id]);
            }
            // create client
            $client = Client::create($client);
            foreach ($demat_ids as $key => $demat_id){
                // update pancard and payment screenshot id
                foreach ($demat_ids[$key]['pan'] as $index => $panCardId) {
                    PancardImageModel::where("id", $panCardId)->update(["client_demat_id" => $demat_id]);
                }
                foreach($demat_ids[$key]['ss'] as $index => $screenshotId) {
                    Screenshots::where("id", $screenshotId)->update(["client_payment_id" => $demat_ids[$key]['payment']]);
                }
                // update client id to demat id
                ClientDemat::where("id", $demat_id)->update(["client_id" => $client->id]);
                // update demat id to payment id
                ClientPayment::where("id", $demat_ids[$key]['payment'])->update(["demat_id" => $demat_id, "client_id" => $client->id]);
            }
        }else{
            // create client
            $client = Client::create($client);
        }

        return $client->id?$client->id: CommonService::throwError("Unable to create client");
    }
    public static function all(){
        return Client::with('clientDemat')->get();
    }
    public static function active(){
        return Client::where("created_by",auth()->user()->id)->where("status", "1")->with('clientDemat')->get();
    }
    public static function get($id){
        $client = Client::with(['clientDemat','clientPayment','clientPayment.Screenshots', 'clientDemat.Pancards'])->where("id",$id)->first();
        if (!$client)
            CommonService::throwError("Client not found");
        return $client;
    }
    public static function update($request,$id){
        $request->session()->put("password", $request->password);
        $client = $request->validate([
            "name"=>"required|alpha_spaces",
            "number"=>"required",
            "communication_with"=>"required|alpha_spaces",
            "profession"=>"required|alpha_spaces",
        ]);
        if(!isset($request->wpsameascontact) || $request->wpsameascontact!=1){
            $request->validate([
                "wp_number"=>"required|numeric",
            ]);
            $client['wp_number']=$request->wp_number;
        }else{
            $client['wp_number']=$client['number'];
        }
        $client['updated_by'] = Auth::id();
        $client['status'] = 0;
        $client['channel_partner_id'] = ($request->channel_partner_id != '') ? $request->channel_partner_id : 0;
        if(isset($request->payment_verified) && $request->payment_verified=="1"){
            $auth_user = Auth::user();
            if($auth_user->hasRole([8,1])){
                $client['status']=1;
            }
        }
        $user = Client::where("id",$id)->update($client);

        $demat = $request->validate([
            "st_sg.*"=>"required|alpha_spaces",
            "serial_number.*"=>"required",
            "service_type.*"=>"required|numeric",
            "holder_name.*"=>"required|alpha_spaces",
            "broker.*"=>"required|alpha_spaces",
            "user_id.*"=>"required",
            "password.*"=>"required",
            "mpin.*"=>"required",
            "capital.*"=>"required",
        ],
        [
            "st_sg.*.required"=>"Smart ID is required",
            "serial_number.*.required"=>"Serial Number is required",
            "service_type.*.required"=>"Service Type is required",
            "holder_name.*.required"=>"Demat Holder's Name is required",
            "holder_name.*.alpha_spaces"=>"Demat Holder's Name Shold contain alphabate and spaces only",
            "broker.*.required"=>"Broker is required",
            "user_id.*.required"=>"User ID is required",
            "password.*.required"=>"Password is required",
            "mpin.*.required"=>"Mpin is required",
            "capital.*.required"=>"Capital is required",
        ]
        );
        $demat['client_id'] = array();

        // remove all existing accounts
        ClientDemat::where("client_id",$id)->delete();
        // remove all existing payments
        ClientPayment::where("client_id",$id)->delete();

        // insert one by one
        foreach($demat['st_sg'] as $key => $value){

            $array = array();
            $array['st_sg']=$demat['st_sg'][$key];
            $array['serial_number']=$demat['serial_number'][$key];
            $array['service_type']=$demat['service_type'][$key];
            // $array['pan_number']=$demat['pan_number'][$key];
            $array['holder_name']=$demat['holder_name'][$key];
            $array['broker']=$demat['broker'][$key];
            $array['user_id']=$demat['user_id'][$key];
            $array['password']=$demat['password'][$key];
            $array['mpin']=$demat['mpin'][$key];
            $array['capital']=$demat['capital'][$key];
            $array['client_id']=$id;
            $array['updated_by']=Auth::id();
            $array['updated_at']=date("Y-m-d H:i:s");
            $demate_id = ClientDemat::create($array);
            if(null !== $request->pan_number){
                // pan card image upload
                foreach ($request->pan_number as $index => $file) {
                    $newName = CommonService::uploadfile($file, config()->get('constants.UPLOADS.PANCARDS'));
                    if ($newName['status']) {
                        PancardImageModel::create(["client_demat_id" => $demate_id->id, "file" => $newName['data']['filename'], "mime_type" => $newName['data']['mimeType']]);
                    }
                }
            }
        }
        foreach($request->mode as $key => $mode){
            if($request->mode[$key]=="2"){
                $request->validate([
                    "bank.*"=>"required|alpha_spaces",
                    "mode.*"=>"required|numeric",
                    "joining_date"=>"required",
                    "pending_payment.*"=>"required|numeric",
                ],
                [
                    "bank.*.required"=>"Please select Bank",
                    "bank.*.alpha_spaces"=>"Invalid Bank",
                    "mode.*.required"=>"Invalid Payment mode",
                    "joining_date.required"=>"Joining Date is Required",
                    "pending_payment.*.required"=>"Invalid Pending Payment Mark",
                    "pending_payment.*.numeric"=>"Invalid Pending Payment Mark",
                ]);
                if($request->pending_payment[$key]=="0"){
                    $request->validate([
                        "fees"=>"required",
                    ],
                    [
                        "fees.required"=>"Fees is required",
                    ]);
                }
                $payment['joining_date']=$request->joining_date[$key];
                $payment['bank']=$request->bank[$key];
                $payment['fees']=$request->fees[$key];
                $payment['mode']=$request->mode[$key];
                $payment['pending_payment']=$request->pending_payment[$key];
                $payment['updated_by']=Auth::id();
                $payment['updated_at']=date("Y-m-d H:i:s");
                $payment['client_id']=$id;
                $payment_id = ClientPayment::create($payment);
            }else{
                $request->validate([
                    "mode.*"=>"required|numeric",
                ]);
                $payment['mode']=$request->mode[$key];
                $payment['updated_by']=Auth::id();
                $payment['updated_at']=date("Y-m-d H:i:s");
                $payment['client_id']=$id;
                $payment_id = ClientPayment::create($payment);
            }

            // file upload
            if($request->mode[$key]=="2" && $request->pending_payment[$key]!="1" && isset($request->screenshot[$key]) && !empty($request->screenshot[$key])){
                foreach($request->screenshot[$key] as $index => $file){
                    $newName = CommonService::uploadfile($file, config()->get('constants.UPLOADS.SCREENSHOTS'));
                    if($newName['status']){
                        Screenshots::create(["client_payment_id"=>$payment_id->id,"file"=>$newName['data']['filename'],"mime_type"=>$newName['data']['mimeType']]);
                    }
                }
            }
        }
        return Client::with(['clientDemat','clientPayment',"clientPayment.Screenshots"])->where("id",$id)->first();
    }
    public static function remove($id){
        return client::where("id",$id)->delete();
    }
    public static function removePaymentScreenshot($ss){
        return Screenshots::where("id",$ss)->delete();
    }
    public static function removeDematePancard($id){
        return PancardImageModel::where("id",$id)->delete();
    }

    public static function updateAssignTo($id,$request)
    {
        return ClientDemat::where("id", $id)->update($request);
    }

    public static function updateClientDematAccount($id,$request)
    {
        return ClientDemat::where("id", $id)->update($request);
    }

    public static function freelancerClientList($id){
        $dematAccount = ClientDemat::
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("client_demat.freelancer_id",$id)->
        select('client_demat.*','clients.name')->get();
        return $dematAccount;
    }

    public static function channelPartnerClientList($id){

        $clientList["prime"] = Client::where("channel_partner_id",$id)
            ->leftJoin('client_demat', 'clients.id', '=', 'client_demat.client_id')
            ->where("client_demat.service_type",1)->get();

        $clientList["ams"] = Client::where("channel_partner_id",$id)
            ->leftJoin('client_demat', 'clients.id', '=', 'client_demat.client_id')
            ->where("client_demat.service_type",2)->get();

        return $clientList;
    }

    public static function allClientTypeWise(){
        $client['account_handling'] = Client::where("client_type",1)->with('clientDemat')->orderBy('created_at', 'DESC')->get();
        $client['mutual_fund'] = Client::where("client_type",2)->with('clientDemat')->orderBy('created_at', 'DESC')->get();
        $client['unlisted_shares'] = Client::where("client_type",3)->with('clientDemat')->orderBy('created_at', 'DESC')->get();
        return $client;
    }

    public static function getClientDematAccount($filter_type = null, $filter_id = null)
	{
        $query = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')
			->select('client_demat.*','clients.name');

		if($filter_type == "freelancer") {
			$query->where("client_demat.freelancer_id", $filter_id);
		} else if($filter_type == "trader") {
			$query->where("client_demat.trader_id", $filter_id);
		}

		$dematAccount = $query->get();
        return $dematAccount;
    }
    // view mark as problem
    public static function getDemat($id)
	{
        return ClientDemat::where("id",$id)->whereNotNull("mark_as_problem")->orWhere("account_status","terminated")->orWhereNotNull("problem")->pluck("mark_as_problem")->first();
    }
    // view problem marked by accountant
    public static function issueWithDematAccount($id)
	{
        return ClientDemat::where("id",$id)->first("problem");
    }
    public static function getClientDematAccountStatus()
	{
        $dematAccount = ClientDemat::with(["withClient"])->orWhereNotNull("mark_as_problem")->orWhere("account_status", "terminated")->orWhere("account_status", "problem")->get();
        return $dematAccount;
    }
    // restore demate account
    public static function dematAccountRestore($id){
        $status =[
            "problem"=>null,
            "mark_as_problem"=>null,
            "account_status"=>"normal"
        ];
        return ClientDemat::where("id", $id)->update($status);
    }
    // activate demate account
    public static function clientDematActivated($id){
        $status =[
            "problem"=>null,
            "mark_as_problem"=>null,
            "account_status"=>"normal",
            "freelancer_id"=>0,
            "trader_id"=>0,
            "deleted_at"=>null
        ];
        return ClientDemat::withTrashed()->where("id", $id)->update($status);
    }
    // terminate client
    public static function terminateClient($request){
        if($request->status=="true"){
            $status =[
                "account_status"=>"terminated",
                "deleted_at"=> date("Y-m-d")
            ];
        }else{
            $status = [
                "account_status" => "terminated",
            ];
        }
        return ClientDemat::where("id", $request->id)->update($status);
    }

    public static function getClientForSetUp(){
        // return ClientDemat::with('clients')->get();

        $dematAccount['normal'] = ClientDemat::
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("client_demat.is_make_as_preferred",0)->
        where("client_demat.freelancer_id",0)->
        select('client_demat.*','clients.name')->get();

        $dematAccount['make_as_preferred'] = ClientDemat::
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("client_demat.is_make_as_preferred",1)->
        where("client_demat.freelancer_id",0)->
        select('client_demat.*','clients.name')->get();

        $dematAccount['holding'] = ClientDemat::
        joinSub('select client_demate_id,count(*) as no_of_holding from calls group by client_demate_id', 'totalCalls', 'client_demat.id', '=', 'totalCalls.client_demate_id', 'left')
        ->leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("client_demat.account_status","holding")->
        select('client_demat.*','clients.name','totalCalls.no_of_holding')->get();

        $dematAccount['all'] = ClientDemat::
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("client_demat.account_status","!=","problem")->
        where("client_demat.account_status","!=","renew")->
        where("client_demat.is_make_as_preferred",0)->
        select('client_demat.*','clients.name')->get();

        $dematAccount['trader'] = ClientDemat::
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        leftJoin('users', 'client_demat.trader_id', '=', 'users.id')->
        where("client_demat.trader_id","!=",0)->
        select('client_demat.*','clients.name','users.name as trader_name')->get();

        $dematAccount['freelancer'] = ClientDemat::
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        leftJoin('users', 'client_demat.freelancer_id', '=', 'users.id')->
        where("client_demat.freelancer_id","!=",0)->
        select('client_demat.*','clients.name','users.name as freelancer_name')->get();

        $dematAccount['unallotted'] = ClientDemat::
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("client_demat.freelancer_id","==",0)->
        where("client_demat.trader_id","==",0)->
        select('client_demat.*','clients.name')->get();

        return $dematAccount;
    }

    public static function getClientUsingMobileNo($mobile_number,$client_type){
        return Client::where('number',$mobile_number)->where('client_type',$client_type)->get()->toArray();
    }
    public static function viewLedger($id){
        $demats =  ClientDemat::where("client_id",$id)->get();
        // calculate profit
        foreach($demats as $key => $demat){
            $income = financeManagementIncomesServices::get()->sum("amount");
            $expense = financeManagementExpensesServices::get()->sum("amount");
            $demats[$key]['profit'] = $income-$expense;
            $service_type = servicesTypeServices::getById($demat->service_type);
            $cutoffAmount = $service_type->cutoff;
            $cutoffProfit = 0;
            if($demats[$key]['profit']>$cutoffAmount){
                $cutoffProfit = $demats[$key]['profit']*(str_replace("%","",$service_type->sharing))/100;
            }
            $demats[$key]['fees'] += $service_type->renewal_amount+$cutoffProfit;
            $demats[$key]['net_profit'] += $demats[$key]['fees'] * (str_replace("%", "", $service_type->sharing)) / 100;
        }
        return $demats;
    }
    public static function generatePdf($id){
        $demats =  ClientDemat::where("client_id", $id)->get();
        // calculate profit
        foreach ($demats as $key => $demat) {
            $income = financeManagementIncomesServices::get()->sum("amount");
            $expense = financeManagementExpensesServices::get()->sum("amount");
            $demats[$key]['profit'] = $income - $expense;
            $service_type = servicesTypeServices::getById($demat->service_type);
            $cutoffAmount = $service_type->cutoff;
            $cutoffProfit = 0;
            if ($demats[$key]['profit'] > $cutoffAmount) {
                $cutoffProfit = $demats[$key]['profit'] * (str_replace("%", "", $service_type->sharing)) / 100;
            }
            $demats[$key]['fees'] += $service_type->renewal_amount + $cutoffProfit;
            $demats[$key]['net_profit'] += $demats[$key]['fees'] * (str_replace("%", "", $service_type->sharing)) / 100;
        }
        return $demats;
    }
}
