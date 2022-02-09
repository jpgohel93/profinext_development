<?php

namespace App\Services;

use App\Models\Client;
use App\Models\ClientDemat;
use App\Models\ClientPayment;
use App\Models\Screenshots;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\CommonService;
use Illuminate\Support\Facades\Storage;

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

        $client = Client::create($client);

        $demat = $request->validate([
            "st_sg.*"=>"required|alpha_spaces",
            "serial_number.*"=>"required",
            "service_type.*"=>"required|numeric",
            "pan_number.*"=>"required",
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
            "pan_number.*.required"=>"PAN Number is required",
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

        // hash all passwords
        foreach($request->password as $key => $password){
            $demat["password"][$key] = Hash::make($password);
            $demat["mpin"][$key] = Hash::make($request->mpin[$key]);
            array_push($demat['client_id'],$client->id);
        }

        // insert one by one
        foreach($demat['st_sg'] as $key => $value){
            $array = array();
            $array['st_sg']=$demat['st_sg'][$key];
            $array['serial_number']=$demat['serial_number'][$key];
            $array['service_type']=$demat['service_type'][$key];
            $array['pan_number']=$demat['pan_number'][$key];
            $array['holder_name']=$demat['holder_name'][$key];
            $array['broker']=$demat['broker'][$key];
            $array['user_id']=$demat['user_id'][$key];
            $array['password']=$demat['password'][$key];
            $array['mpin']=$demat['mpin'][$key];
            $array['capital']=$demat['capital'][$key];
            $array['client_id']=$demat['client_id'][$key];
            
            ClientDemat::insert($array);
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
                    "bank.*.alpha_spaces"=>"Invalid Bank",
                    "joining_date.required"=>"Joining Date is Required",
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
                $payment['client_id']=$client->id;
                $payment_id = ClientPayment::create($payment);
                // $payment = ClientPayment::create($payment);
            }else{
                $request->validate([
                    "mode.*"=>"required|numeric",
                ]);
                $payment['mode']=$request->mode[$key];
                $payment['updated_by']=Auth::id();
                $payment['updated_at']=date("Y-m-d H:i:s");
                $payment['client_id']=$client->id;
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
        return $client->id;
    }
    public static function all(){
        return Client::with('clientDemat')->get();
    }
    public static function get($id){
        return Client::with(['clientDemat','clientPayment','clientPayment.Screenshots'])->where("id",$id)->first();
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
            "pan_number.*"=>"required",
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
            "pan_number.*.required"=>"PAN Number is required",
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
        ClientDemat::where("client_id",$id)->forceDelete();
        // remove all existing payments
        ClientPayment::where("client_id",$id)->forceDelete();

        // insert one by one
        foreach($demat['st_sg'] as $key => $value){

            $array = array();
            $array['st_sg']=$demat['st_sg'][$key];
            $array['serial_number']=$demat['serial_number'][$key];
            $array['service_type']=$demat['service_type'][$key];
            $array['pan_number']=$demat['pan_number'][$key];
            $array['holder_name']=$demat['holder_name'][$key];
            $array['broker']=$demat['broker'][$key];
            $array['user_id']=$demat['user_id'][$key];
            $array['password']=$demat['password'][$key];
            $array['mpin']=$demat['mpin'][$key];
            $array['capital']=$demat['capital'][$key];
            $array['client_id']=$id;
            $array['updated_by']=Auth::id();
            $array['updated_at']=date("Y-m-d H:i:s");
            
            ClientDemat::insert($array);
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
                    "bank.*.alpha_spaces"=>"Invalid Bank",
                    "joining_date.required"=>"Joining Date is Required",
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
}
