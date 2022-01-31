<?php

namespace App\Services;

use App\Models\Client;
use App\Models\ClientDemat;
use App\Models\ClientPayment;
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
            // file upload
            if($request->mode[$key]=="2" && $request->pending_payment[$key]!="1" && isset($request->screenshot[$key])){
                $file = $request->screenshot[$key];
                $newName = CommonService::uploadfile($file, config()->get('constants.UPLOADS.SCREENSHOTS'));
            }
            if($request->mode[$key]=="2"){
                ClientPayment::create([
                    "bank"=>$request->bank[$key],
                    "joining_date"=>$request->joining_date[$key],
                    "fees"=>$request->fees[$key],
                    "mode"=>$request->mode[$key],
                    "pending_payment"=>$request->pending_payment[$key],
                    "screenshots"=>$newName['data']['filename'],
                    "client_id"=>$user->id
                ]);
            }else{
                ClientPayment::create([
                    "mode"=>$request->mode[$key],
                    "client_id"=>$user->id
                ]);
            }
        }
        return $user->id;
    }
    public static function all(){
        return Client::with('clientDemat')->get();
    }
    public static function get($id){
        return Client::with(['clientDemat','clientPayment'])->where("id",$id)->first();
    }
    public static function update($request,$id){

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
                ClientPayment::create([
                    "bank"=>$request->bank[$key],
                    "joining_date"=>$request->joining_date[$key],
                    "fees"=>$request->fees[$key],
                    "mode"=>$request->mode[$key],
                    "pending_payment"=>$request->pending_payment[$key],
                    "updated_by"=>Auth::id(),
                    "client_id"=>$id
                ]);
            }else{
                ClientPayment::create([
                    "mode"=>$request->mode[$key],
                    "updated_by"=>Auth::id(),
                    'updated_at'=>date("Y-m-d H:i:s"),
                    "client_id"=>$id
                ]);
            }
        }
        return Client::with(['clientDemat','clientPayment'])->where("id",$id)->first();
    }
    public static function remove($id){
        return client::where("id",$id)->delete();
    }
}
