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

        $user = Client::create($client);

        $demat = $request->validate([
            "st_sg"=>"required|array",
            "serial_number"=>"required|array",
            "service_type"=>"required|array",
            "pan_number"=>"required|array",
            "holder_name"=>"required|array",
            "broker"=>"required|array",
            "user_id"=>"required|array",
            "password"=>"required|array",
            "mpin"=>"required|array",
            "capital"=>"required|array",
        ]);
        $demat['client_id'] = array();

        // hash all passwords
        foreach($request->password as $key => $password){
            $demat["password"][$key] = Hash::make($password);
            $demat["mpin"][$key] = Hash::make($request->mpin[$key]);
            array_push($demat['client_id'],$user->id);
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
            $newName=["data"=>["filename"=>null]];
            if($request->mode[$key]=="2"){
                $payment = ClientPayment::create([
                    "bank"=>$request->bank[$key],
                    "joining_date"=>$request->joining_date[$key],
                    "fees"=>$request->fees[$key],
                    "mode"=>$request->mode[$key],
                    "pending_payment"=>$request->pending_payment[$key],
                    "client_id"=>$user->id
                ]);
            }else{
                $payment = ClientPayment::create([
                    "mode"=>$request->mode[$key],
                    "client_id"=>$user->id
                ]);
            }
            // file upload
            if($request->mode[$key]=="2" && $request->pending_payment[$key]!="1" && isset($request->screenshot[$key]) && !empty($request->screenshot[$key])){
                foreach($request->screenshot[$key] as $index => $file){
                    $newName = CommonService::uploadfile($file, config()->get('constants.UPLOADS.SCREENSHOTS'));
                    if($newName['status']){
                        Screenshots::create(["payment_id"=>$payment->id,"file"=>$newName['data']['filename'],"mime_type"=>$newName['data']['mimeType']]);
                    }
                }
            }
        }
        return $user->id;
    }
    public static function all(){
        return Client::with('clientDemat')->get();
    }
    public static function get($id){
        return Client::with(['clientDemat','clientPayment','clientPayment.Screenshots'])->where("id",$id)->first();
    }
    public static function update($request,$id){
        // dd($request);
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

        $user = Client::where("id",$id)->update($client);

        $demat = $request->validate([
            "st_sg"=>"required|array",
            "serial_number"=>"required|array",
            "service_type"=>"required|array",
            "pan_number"=>"required|array",
            "holder_name"=>"required|array",
            "broker"=>"required|array",
            "user_id"=>"required|array",
            "password"=>"required|array",
            "mpin"=>"required|array",
            "capital"=>"required|array",
        ]);
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
                $payment = ClientPayment::create([
                    "bank"=>$request->bank[$key],
                    "joining_date"=>$request->joining_date[$key],
                    "fees"=>$request->fees[$key],
                    "mode"=>$request->mode[$key],
                    "pending_payment"=>$request->pending_payment[$key],
                    "updated_by"=>Auth::id(),
                    "client_id"=>$id
                ]);
            }else{
                $payment = ClientPayment::create([
                    "mode"=>$request->mode[$key],
                    "updated_by"=>Auth::id(),
                    'updated_at'=>date("Y-m-d H:i:s"),
                    "client_id"=>$id
                ]);
            }
            // file upload
            if($request->mode[$key]=="2" && $request->pending_payment[$key]!="1" && isset($request->screenshot[$key]) && !empty($request->screenshot[$key])){
                foreach($request->screenshot[$key] as $index => $file){
                    $newName = CommonService::uploadfile($file, config()->get('constants.UPLOADS.SCREENSHOTS'));
                    if($newName['status']){
                        Screenshots::create(["client_payment_id"=>$payment->id,"file"=>$newName['data']['filename'],"mime_type"=>$newName['data']['mimeType']]);
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
