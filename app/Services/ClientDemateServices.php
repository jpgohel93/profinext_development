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
            "pl" => "required"
        ]);
        return ClientDemat::where("id",$request->id)->update($pl);
    }
}
