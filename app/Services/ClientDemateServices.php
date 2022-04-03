<?php

namespace App\Services;

use App\Models\Client;
use App\Models\ClientDemat;
use App\Models\ClientPayment;
use App\Models\Screenshots;

class ClientDemateServices{
    function __construct(){

    }
    public static function getAccountByDemateId($id){
        return ClientDemat::where("id",$id)->with(["withClient"])->first();
    }
    public static function terminateAccountByDemateId($id){
        return ClientDemat::where("id",$id)->update(["account_status"=>"terminated"]);
    }
    public static function updatePL($request){
        $pl['account_status']="to_renew";
        $pl['pl']=$request->pl;
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
}
