<?php

namespace App\Services;

use App\Models\Client;
use App\Models\ClientDemat;
use App\Models\ClientPayment;
use App\Models\Screenshots;
use App\Models\servicesTypeModel;
use App\Models\PancardImageModel;
use App\Models\User;
use App\Models\RenewExpensesModal;
use App\Models\financeManagementModel\BankModel;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonService;
use App\Services\financeManagementServices\financeManagementIncomesServices;
use App\Services\financeManagementServices\financeManagementExpensesServices;
use App\Services\ClientInvestmentServices;
use App\Services\LogServices;
use App\Services\financeManagementServices\bankServices;
class ClientServices
{
    public static function create($request)
    {
        $user_name = auth()->user()->name;
        $client = $request->validate([
            "name"=>"required|alpha_spaces",
            "number"=>"required",
            "profession"=>"required|alpha_spaces",
            "client_type"=>"required|min:1|max:4",
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
        $client['communication_with'] = $request->communication_with;
        $client['communication_with_contact_number'] = $request->communication_with_contact_number;
        $client['created_by'] = Auth::id();
        $client['channel_partner_id'] = ($request->channel_partner_id != '') ? $request->channel_partner_id : 0;

        $form_type = (isset($request->form_type) && $request->form_type == "channelPartner") ? "channelPartner" : "user";
        if($form_type == "user"){
           $client['status'] = $request->payment_verified;
        }else{
            $client['status'] = 0;
        }

        if ($request->client_type == 1) {
            $demat = $request->validate(
                [
                    "st_sg.*" => "required|alpha_spaces",
                    "serial_number.*" => "required",
                    "service_type.*" => "required|numeric",
                    "pan_number_text.*" => "required",
                    "address.*" => "required",
                    "email_id.*" => "required",
                    "mobile.*" => "required",
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
                    "pan_number_text.*.required" => "PAN Number is required",
                    "address.*.required" => "Address is required",
                    "email_id.*.required" => "Email ID is required",
                    "mobile.*.required" => "Mobile is required",
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

                $array['st_sg'] = $demat['st_sg'][$key];
                $array['serial_number'] = $demat['serial_number'][$key];
                $array['service_type'] = $demat['service_type'][$key];
                $array['pan_number_text'] = strtoupper($demat['pan_number_text'][$key]);
                $array['address'] = $demat['address'][$key];
                $array['email_id'] = $demat['email_id'][$key];
                $array['mobile'] = $demat['mobile'][$key];
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
                            "bank" => "required",
                            "mode.*" => "required|numeric",
                            "joining_date" => "required",
                            "pending_payment.*" => "required|numeric",
                        ],
                        [
                            "bank.required" => "Select Bank",
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

                if (null !== $request->pan_number[$key]) {
                    // pan card image upload
                    foreach ($request->pan_number[$key] as $index => $file) {
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

                if($form_type == "user") {
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
                    $RenewExpensesId = "0";

                    if ($request->payment_verified == "2") {
                        // add balance in available balance
                        if (isset($request->bank[$key]) && $request->bank[$key] != '') {
                            $toBankData = bankServices::getBankAccountById($request->bank[$key]);

                            if (!empty($toBankData)) {
                                $addBalance['available_balance'] = $toBankData['available_balance'] + $request->fees[$key];
                                BankModel::where('id', $request->bank[$key])->update($addBalance);
                            }
                        }
                    }
                    //channel Partner FEES
                    if ($array['service_type'] == "2" && $request->channel_partner_id != '' && $request->payment_verified == "2") {
                        $expensesData = array();
                        $channelPartnerData = User::where("id", $request->channel_partner_id)->first();
                        $serviceData = servicesTypeModel::where("name", "AMS")->first();

                        $channelPartnerAmount = $channelPartnerData->ams_new_client_percentage * $serviceData->renewal_amount / 100;
                        $expensesData['percentage'] = $channelPartnerData->ams_new_client_percentage;
                        $expensesData['user_id'] = $request->channel_partner_id;
                        $expensesData['renewal_account_id'] = 0;
                        $expensesData['amount'] = $channelPartnerAmount;
                        $expensesData['firm'] = $array['st_sg'];
                        $expensesData['created_by'] = auth()->user()->id;
                        $expensesData['date'] = date("Y-m-d");
                        $expensesData['description'] = "JOINING FEES";
                        $expensesData['total_amount'] = $serviceData->renewal_amount;
                        $RenewExpensesId = RenewExpensesModal::create($expensesData);
                    }
                }
                // create demat
                $demat_id = ClientDemat::create($array);

                array_push($demat_ids,["ss"=>$screenshots,"pan"=>$panCards,"demat"=>$demat_id->id,"payment"=> $payment_id->id,"RenewExpensesId"=>(isset($RenewExpensesId->id))?$RenewExpensesId->id:"0"]);
            }

            // create client
            $client = Client::create($client);
            if($client){
                LogServices::logEvent(["desc"=>"Client $client->id created by $user_name"]);
                foreach ($demat_ids as $key => $demat_id){
                    // update pancard and payment screenshot id
                    foreach ($demat_ids[$key]['pan'] as $index => $panCardId) {
                        PancardImageModel::where("id", $panCardId)->update(["client_demat_id" => $demat_ids[$key]['demat']]);
                    }
                    foreach($demat_ids[$key]['ss'] as $index => $screenshotId) {
                        Screenshots::where("id", $screenshotId)->update(["client_payment_id" => $demat_ids[$key]['payment']]);
                    }
                    // update client id to demat id
                    ClientDemat::where("id", $demat_ids[$key]['demat'])->update(["client_id" => $client->id]);
                    // update demat id to payment id
                    ClientPayment::where("id", $demat_ids[$key]['payment'])->update(["demat_id" => $demat_ids[$key]['demat'], "client_id" => $client->id]);
                }
            }else{
                LogServices::logEvent(["desc"=>"Unable to create Client by $user_name","data"=>["client"]]);
                foreach ($demat_ids as $key => $demat_id){
                    // delete pancard and payment screenshot id
                    foreach ($demat_ids[$key]['pan'] as $index => $panCardId) {
                        PancardImageModel::where("id", $panCardId)->delete();
                    }
                    foreach($demat_ids[$key]['ss'] as $index => $screenshotId) {
                        Screenshots::where("id", $screenshotId)->delete();
                    }
                    // delete client id to demat id
                    ClientDemat::where("id", $demat_ids[$key]['demat'])->delete();
                    // delete demat id to payment id
                    ClientPayment::where("id", $demat_ids[$key]['payment'])->delete();
                    // delete RenewExpensesId
                    RenewExpensesModal::where("id",$demat_ids[$key]['RenewExpensesId']);
                }
            }

        }else{
            // investment details
            $ids = ClientInvestmentServices::create($request);
            // create client
            $client = Client::create($client);
            if($client){
                LogServices::logEvent(["desc"=>"Client investment $client->id created by $user_name"]);
                foreach ($ids as $id){
                    // update client id
                    ClientInvestmentServices::update(["client_id" => $client->id],$id);
                }
            }else{
                LogServices::logEvent(["desc"=>"Unable to create Client investment  by $user_name","data"=>$request]);
                foreach ($ids as $id) {
                    // investment details
                    ClientInvestmentServices::forceDelete($id);
                }
            }
        }
        return $client->id?$client->id: CommonService::throwError("Unable to create client");
    }
    public static function all(){
        return Client::with('clientDemat')->get();
    }
    public static function active(){
        $user = Auth::user();
        if($user->user_type=="3"){
            return Client::where("created_by",$user->id)->where(function($q) {
                $q->where("status", "1")
                    ->orWhere("status", "2");
            })->with('clientDemat')->get();
        }
        return Client::where("status", "1")->orWhere("status", "2")->with('clientDemat')->get();
    }
    public static function get($id){
        $client = Client::where("id",$id)->with(['clientDemat','clientPayment','clientPayment.Screenshots', 'clientDemat.Pancards'])->first();
        return $client;
    }
    public static function update($request,$id){
        $request->session()->put("password", $request->password);
        $client = $request->validate([
            "name"=>"required|alpha_spaces",
            "number"=>"required",
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
        $client['communication_with'] = $request->communication_with;
        $client['communication_with_contact_number'] = $request->communication_with_contact_number;
        $client['updated_by'] = Auth::id();
        $client['channel_partner_id'] = ($request->channel_partner_id != '') ? $request->channel_partner_id : 0;
        $clientData = Client::where("id",$id)->first();
        if($clientData->status != 2){
            if(isset($request->payment_verified) && $request->payment_verified=="2"){
                $client['status'] = 2;
            }
        }
       // if($client['channel_partner_id']==0){
            $auth_user = Auth::user();
            //if($auth_user->hasRole(['super-admin','accountant'])){
//                if(isset($request->payment_verified) && ($request->payment_verified=="1" || $request->payment_verified=="0")){
//                    $client['status']=1;
//                }
//                elseif(isset($request->payment_verified) && $request->payment_verified=="2"){
//                    $client['status'] = 2;
//                }
            //}
        //}
        $client_current_status = Client::where("id",$id)->first(['status']);
        Client::where("id",$id)->update($client);
        if ($request->client_type == 1) {

            $demat = $request->validate(
                [
                    "st_sg.*" => "required|alpha_spaces",
                    "serial_number.*" => "required",
                    "service_type.*" => "required|numeric",
                    "pan_number_text.*" => "required",
                    "address.*" => "required",
                    "email_id.*" => "required",
                    "mobile.*" => "required",
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
                    "pan_number_text.*.required" => "PAN Number is required",
                    "address.*.required" => "Address is required",
                    "email_id.*.required" => "Email ID is required",
                    "mobile.*.required" => "Mobile is required",
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


            // insert one by one and get id
            $demat_ids = array();
            foreach($demat['st_sg'] as $key => $value){
                $array = array();
                $panCards = array();
                $screenshots = array();

                $array['st_sg'] = $demat['st_sg'][$key];
                $array['serial_number'] = $demat['serial_number'][$key];
                $array['service_type'] = $demat['service_type'][$key];
                $array['pan_number_text'] = strtoupper($demat['pan_number_text'][$key]);
                $array['address'] = $demat['address'][$key];
                $array['email_id'] = $demat['email_id'][$key];
                $array['mobile'] = $demat['mobile'][$key];
                $array['holder_name'] = $demat['holder_name'][$key];
                $array['broker'] = $demat['broker'][$key];
                $array['user_id'] = $demat['user_id'][$key];
                $array['password'] = $demat['password'][$key];
                $array['mpin'] = $demat['mpin'][$key];
                $array['capital'] = $demat['capital'][$key];
                $array['client_id'] = $id;
                $array['available_balance'] = $demat['capital'][$key];
                $array['pl'] = "0";
                $array['is_make_as_preferred'] = 0;
                $array['is_new'] = 1;
                $array['joining_date'] = date('Y-m-d');
                $array['created_by'] = auth()->user()->id;

                if(isset($request->demate_id[$key])){
                    ClientDemat::where("id", $request->demate_id[$key])->update($array);
                    $RenewExpensesId = "0";
                    //channel Partner FEES
                    if ($array['service_type'] == "2" && isset($request->channel_partner_id) && $request->channel_partner_id != '' && $client_current_status['status']=="0") {
                        $expensesData = array();
                        $channelPartnerData = User::where("id",$request->channel_partner_id)->first();
                        $serviceData = servicesTypeModel::where("name","AMS")->first();

                        // add balance in available balance
                        if(isset($request->bank[$key]) && $request->bank[$key] != '') {
                            $toBankData = bankServices::getBankAccountById($request->bank[$key]);

                            if (!empty($toBankData)) {
                                $addBalance['available_balance'] = $toBankData['available_balance'] +  $serviceData->renewal_amount;
                                BankModel::where('id',$request->bank[$key])->update($addBalance);
                            }
                        }

                        $channelPartnerAmount = $channelPartnerData->ams_new_client_percentage*$serviceData->renewal_amount/100;
                        $expensesData['percentage'] = $channelPartnerData->ams_new_client_percentage;
                        $expensesData['user_id'] = $request->channel_partner_id;
                        $expensesData['renewal_account_id'] = 0;
                        $expensesData['amount'] =$channelPartnerAmount;
                        $expensesData['firm'] =$array['st_sg'];
                        $expensesData['created_by']=auth()->user()->id;
                        $expensesData['date'] = date("Y-m-d");
                        $expensesData['description'] = "JOINING FEES";
                        $expensesData['total_amount'] = $serviceData->renewal_amount;
                        $RenewExpensesId = RenewExpensesModal::create($expensesData);
                    }
                    $demate_id = $request->demate_id[$key];
                    if ($request->mode[$key] == "2") {
                        $request->validate(
                            [
                                "bank.$key" => "required",
                                "mode.$key" => "required|numeric",
                                "joining_date" => "required",
                                "pending_payment.$key" => "required|numeric",
                            ],
                            [
                                "bank.$key.required" => "Please select Bank",
                                "mode.$key.required" => "Invalid Payment mode",
                                "joining_date.required" => "Joining Date is Required",
                                "pending_payment.$key.required" => "Invalid Pending Payment Mark",
                                "pending_payment.$key.numeric" => "Invalid Pending Payment Mark",
                            ]
                        );
                        if ($request->pending_payment[$key] == "0") {
                            $request->validate(
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
                        $payment['client_id'] = $id;

                        $payment_id = ClientPayment::where("id", $request->payment_id[$key])->update($payment);
                    } else {
                        $request->validate([
                            "mode.*" => "required|numeric",
                        ]);
                        $payment['mode'] = $request->mode[$key];
                        $payment['updated_by'] = Auth::id();
                        $payment['updated_at'] = date("Y-m-d H:i:s");
                        $payment['client_id'] = $id;
                        $payment_id = ClientPayment::where("id", $request->payment_id[$key])->update($payment);
                    }

                    if (null !== $request->pan_number) {
                        // pan card image upload
                        foreach ($request->pan_number as $index => $file) {
                            if (is_array($file)) {
                                foreach ($file as $f) {
                                    $newName = CommonService::uploadfile($f, config()->get('constants.UPLOADS.PANCARDS'));
                                    if ($newName['status']) {
                                        PancardImageModel::create(["client_demat_id" => $demate_id, "file" => $newName['data']['filename'], "mime_type" => $newName['data']['mimeType']]);
                                    }
                                }
                            } else {
                                $newName = CommonService::uploadfile($file, config()->get('constants.UPLOADS.PANCARDS'));
                                if ($newName['status']) {
                                    PancardImageModel::create(["client_demat_id" => $demate_id, "file" => $newName['data']['filename'], "mime_type" => $newName['data']['mimeType']]);
                                }
                            }
                        }
                    }

                    // file upload
                    if ($request->mode[$key] == "2" && $request->pending_payment[$key] != "1" && isset($request->screenshot[$key]) && !empty($request->screenshot[$key])) {
                        foreach ($request->screenshot[$key] as $index => $file) {
                            if (is_array($file)) {
                                foreach ($file as $f) {
                                    $newName = CommonService::uploadfile($f, config()->get('constants.UPLOADS.SCREENSHOTS'));
                                    if ($newName['status']) {
                                        Screenshots::create(["client_payment_id" => $request->payment_id[$key], "file" => $newName['data']['filename'], "mime_type" => $newName['data']['mimeType']]);
                                    }
                                }
                            } else {
                                $newName = CommonService::uploadfile($file, config()->get('constants.UPLOADS.SCREENSHOTS'));
                                if ($newName['status']) {
                                    Screenshots::create(["client_payment_id" => $request->payment_id[$key], "file" => $newName['data']['filename'], "mime_type" => $newName['data']['mimeType']]);
                                }
                            }
                        }
                    }
                }
                else{
                    // create new one if not exists
                    $demate_id = ClientDemat::create($array);

                    if ($request->mode[$key] == "2") {
                        $payment = $request->validate(
                            [
                                "bank" => "required",
                                "mode.*" => "required|numeric",
                                "joining_date" => "required",
                                "pending_payment.*" => "required|numeric",
                            ],
                            [
                                "bank.required" => "Select Bank",
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
                        $payment['client_id'] = $id;
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
                        $payment['client_id'] = $id;
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
                            array_push($panCards, $panCardId->id);
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
                    array_push($demat_ids, ["ss" => $screenshots, "pan" => $panCards, "demat" => $demat_id->id, "payment" => $payment_id->id]);
                }
            }
            foreach ($demat_ids as $key => $demat_id) {
                // update pancard and payment screenshot id
                foreach ($demat_ids[$key]['pan'] as $index => $panCardId) {
                    PancardImageModel::where("id", $panCardId)->update(["client_demat_id" => $demat_ids[$key]['demat']]);
                }
                foreach ($demat_ids[$key]['ss'] as $index => $screenshotId) {
                    Screenshots::where("id", $screenshotId)->update(["client_payment_id" => $demat_ids[$key]['payment']]);
                }
                // update client id to demat id
                ClientDemat::where("id", $demat_ids[$key]['demat'])->update(["client_id" => $id]);
                // update demat id to payment id
                ClientPayment::where("id", $demat_ids[$key]['payment'])->update(["demat_id" => $demat_ids[$key]['demat'], "client_id" => $id]);
            }
        }
        else{
            // investment details
            $ids = ClientInvestmentServices::create($request);
            // create client
            $client = Client::create($client);
            if ($client) {
                foreach ($ids as $id) {
                    // update client id
                    ClientInvestmentServices::update(["client_id" => $client->id], $id);
                }
            } else {
                foreach ($ids as $id) {
                    // investment details
                    ClientInvestmentServices::forceDelete($id);
                }
            }
        }
        return Client::with(['clientDemat','clientPayment',"clientPayment.Screenshots"])->where("id",$id)->first();
    }
    public static function remove($id){
        return client::where("id",$id)->delete();
    }
    public static function removePaymentScreenshot($ss){
        Screenshots::where("id",$ss)->update(["deleted_by"=>auth()->user()->id]);
        return Screenshots::where("id",$ss)->delete();
    }
    public static function removeDematePancard($id){
        return PancardImageModel::where("id", $id)->update(["deleted_by"=>auth()->user()->id,"deleted_at"=>date("Y-m-d H:i:s")]);
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

        $clientList["prime_next"] = Client::where("channel_partner_id",$id)
            ->leftJoin('client_demat', 'clients.id', '=', 'client_demat.client_id')
            ->where("client_demat.service_type",3)->get();

        $clientList["ams"] = Client::where("channel_partner_id",$id)
            ->leftJoin('client_demat', 'clients.id', '=', 'client_demat.client_id')
            ->where("client_demat.service_type",2)->get();

        return $clientList;
    }

    public static function allClientTypeWise(){
        if(auth()->user()->user_type!="3"){
            $client['account_handling'] = Client::where("client_type",1)->with('clientDemat')->orderBy('created_at', 'DESC')->get();

            $client['mutual_fund'] = Client::where("client_type",2)->with('clientDemat')->orderBy('created_at', 'DESC')->get();

            $client['unlisted_shares'] = Client::where("client_type",3)->with('clientDemat')->orderBy('created_at', 'DESC')->get();

            $client['insurance'] = Client::where("client_type",4)->orderBy('created_at', 'DESC')->get();
        }else{
            $client['account_handling'] = Client::where("created_by",auth()->user()->id)->where("client_type",1)->with('clientDemat')->orderBy('created_at', 'DESC')->get();
            $client['mutual_fund'] = Client::where("created_by",auth()->user()->id)->where("client_type",2)->with('clientDemat')->orderBy('created_at', 'DESC')->get();
            $client['unlisted_shares'] = Client::where("created_by",auth()->user()->id)->where("client_type",3)->with('clientDemat')->orderBy('created_at', 'DESC')->get();
            $client['insurance'] = Client::where("created_by",auth()->user()->id)->where("client_type",4)->orderBy('created_at', 'DESC')->get();
        }
        $client['account_handling']['count'] = count($client['account_handling']);
        $client['mutual_fund']['count'] = count($client['mutual_fund']);
        $client['unlisted_shares']['count'] = count($client['unlisted_shares']);
        $client['insurance']['count'] = count($client['insurance']);
        return $client;
    }

    public static function getMutualFundClient(){
        $clients_data['data'] = array();

        $clients = Client::where("client_type", 2)->select("name", "id", "number")->orderBy('created_at', 'DESC')->get()->toArray();

        $i = 0;
        foreach ($clients as $client) {
            $i++;
            $arr = array();
            // $html = '<a href="javascript:void(0);" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions<span class="svg-icon svg-icon-5 m-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" /></svg></span></a>
            // <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">
            //     <div class="menu-item px-3">
            //         <a href="javascript:void(0)" data-id="' . $client['id'] . '" class="menu-link viewClient px-3">view</a>
            //     </div>
            //     <div class="menu-item px-3">
            //         <a href="' . route("viewLedger") . '"/' . $client['id'] . '" target="_blank" class="menu-link px-3">Ledger</a>
            //     </div>
            // </div>';
            $html = '<div class="dropdown">
                        <a class="btn btn-light btn-active-light-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>

                        <div class="dropdown-menu menu-state-bg-light-primary" aria-labelledby="dropdownMenuLink">
                            <div class="menu-item">
                                <a href="javascript:void(0)" data-id="' . $client['id'] . '" class="dropdown-item menu-link viewClient px-3">view</a>
                            </div>
                            <div class="menu-item">
                                <a href="' . route("viewLedger") . '"/' . $client['id'] . '" target="_blank" class="dropdown-item menu-link px-3">Ledger</a>
                            </div>
                        </div>
                    </div>';
            array_push($arr, $i);
            array_push($arr, $client['name']);
            array_push($arr, $client['number']);
            array_push($arr, 0);
            array_push($arr, $html);

            array_push($clients_data['data'], $arr);
        }
        $clients_data["recordsTotal"] = $i;
        $clients_data["recordsFiltered"] = $i;
        return $clients_data;
    }
    public static function getUnlistedSharesClient(){
        $clients['data'] = array();

        $clients_data = Client::where("client_type", 3)->select("name", "id", "number")->orderBy('created_at', 'DESC')->get()->toArray();

        $i = 0;
        foreach ($clients_data as $client) {
            $i++;
            $arr = array();
            array_push($arr, $i);
            array_push($arr, $client['name']);
            array_push($arr, $client['number']);
            array_push($arr, 0);
            array_push($arr, '<a href="javascript:void(0)" data-id="'.$client['id'].'" class="viewClient">view</a><a href="'.route("viewLedger").'"/'.$client['id'].'" target="_blank" class="menu-link px-3">Ledger</a>');

            array_push($clients['data'], $arr);
        }
        $clients["recordsTotal"] = $i;
        $clients["recordsFiltered"] = $i;
        return $clients;
    }
    public static function getInsuranceClients(){
        $clients['data'] = array();

        $clients_list = Client::where("client_type", 4)->select("name", "id", "number")->orderBy('created_at', 'DESC')->get()->toArray();

        $i = 0;
        foreach ($clients_list as $client) {
            $i++;
            $arr = array();
            array_push($arr, $i);
            array_push($arr, $client['name']);
            array_push($arr, $client['number']);
            array_push($arr, 0);
            array_push($arr, '<a href="javascript:void(0)" data-id="'.$client['id'].'" class="viewClient">view</a><a href="'.route("viewLedger").'"/'.$client['id'].'" target="_blank" class="menu-link px-3">Ledger</a>');

            array_push($clients['data'], $arr);
        }
        $clients["recordsTotal"] = $i;
        $clients["recordsFiltered"] = $i;
        return $clients;
    }

    public static function getClientDematAccount($filter_type = null, $filter_id = null)
	{
        $query = ClientDemat::leftJoin('clients', function ($join) {
            $join->on('client_demat.client_id', '=', 'clients.id')
                ->where('clients.client_type', '=', 1);
        })->select('client_demat.*','clients.name');

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
                "deleted_at"=> date("Y-m-d h:i:s")
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
            $service_type = '';
            if($demat->service_type == 2){
                $service_type = 'AMS';
            }elseif ($demat->service_type == 1){
                $service_type = 'Prime';
            }else if($demat->service_type == 3){
                $service_type = 'Prime Next';
            }
            $service_type = servicesTypeServices::getByType($service_type);

            $cutoffAmount = $service_type->cutoff;
            $sharing = $service_type->sharing;
            $profit = $demat->final_pl;

            $profit_sharing = 0;
            $fees = 0;
            $renewal_amount = 0;
            if($demat->service_type == 2){
                if($profit > $cutoffAmount){
                    $access_profit = $profit - $cutoffAmount;
                    $profit_sharing = ($sharing * $access_profit) / 100;
                }
                $renewal_amount =$service_type->renewal_amount;
                $fees = $service_type->renewal_amount + $profit_sharing;
            }elseif ($demat->service_type == 1 || $demat->service_type == 3){
                $profit_sharing = ($sharing * $profit) / 100;
                $fees = $profit_sharing;
            }


            $demats[$key]['cutoff'] = $service_type->cutoff;
            $demats[$key]['profit'] = $profit;
            $demats[$key]['fees'] = $fees;
            $demats[$key]['net_profit'] = $renewal_amount+$profit;
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
