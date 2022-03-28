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
    public static function updatePL($request){
        $pl = $request->validate([
            "pl" => "required",
        ]);
        $pl['account_status']="to_renew";
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
}
