<?php

namespace App\Services;

use App\Models\Client;
use App\Models\ClientDemat;
use App\Models\ClientPayment;
use App\Models\Screenshots;
use App\Models\RenewDemat;

class ClientDemateServices{
    function __construct(){

    }
    public static function active(){
        return ClientDemat::where("trader_id", auth()->user()->id)->where("account_status","normal")->whereNull("problem")->with(["withClient"])->leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->select('client_demat.*', 'clients.name')->get();

        //  ClientDemat::where("trader_id", auth()->user()->id)->where("account_status","normal")->whereNull("problem")->with(["withClient"])->get();
    }
    public static function toRenews(){
        return ClientDemat::where("trader_id", auth()->user()->id)->where("account_status", "to_renew")->whereNull("problem")->whereNull("mark_as_problem")->with(["withClient"])->get();
    }
    public static function problemAccounts(){
        return ClientDemat::where("trader_id", auth()->user()->id)->whereNotNull("problem")->where('account_status','!=','terminated')->with(["withClient"])->get();
    }
    public static function allAccounts(){
        $clients = ClientDemat::where("trader_id",auth()->user()->id)->leftJoin('clients as c', function ($join) {
            $join->on('client_demat.client_id', '=', 'c.id')
                ->where('c.client_type', '=', 1);
        })->select('client_demat.*', 'c.name', 'c.number','c.deleted_at')->whereNull("c.deleted_at")->get();
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
        return ClientDemat::where("trader_id", auth()->user()->id)->where("account_status","terminated")->with(["withClient"])->withTrashed()->get();
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
         return RenewDemat::where("bank_id",$bank_id)->where("status","to_renew")->where("created_at",">=",$startDate)->where("created_at","<=",$endDate)->with(["bank_name"])->get()->toArray();

    }
}
