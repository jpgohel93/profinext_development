<?php

namespace App\Services;
use App\Models\ClientDemat;
use App\Models\TraderModal;
use Illuminate\Support\Facades\Auth;
use App\Services\LogServices;
use App\Models\Client;
use App\Models\User;
class TraderServices{

    public static function view()
    {
        return TraderModal::with(["withClient", "withTrader"])->get();
    }
    public static function create($request)
    {
        $trader = $request->validate([
            "client_id" => "required|numeric|exists:clients,id",
            "trader_id" => "required|numeric|exists:users,id",
        ],
        [
            "trader_id.unique"=>"Client Already Assign to this trader",
            "trader_id.exists"=>"Invalid Trader ID",
            "client_id.exists"=>"Invalid Client ID",
        ]
        );
        // get client
        $client = Client::where("id",$request->client_id)->first();
        // get trader
        $trader = User::where("id",$request->trader_id)->first();
        $trader['created_by'] = Auth::id();
        $status = TraderModal::create($trader);
        if($status){
            LogServices::logEvent(["desc"=>"Trader $trader->name assing to $client->name Client"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to assign Trader $trader->name to $client->name Client"]);
        }
    }
    public static function remove($id)
    {
        $trader = User::where("id", $id)->first();
        $status = TraderModal::where("id", $id)->forceDelete();
        $user_name = auth()->user()->name;
        if($status){
            LogServices::logEvent(["desc"=>"Trader $trader->name deleted by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to delete Trader $trader->name by $user_name"]);
        }
    }
    public static function get($id)
    {
        return TraderModal::where("id", $id)->first(["id", "bank"]);
    }
    public static function edit($request)
    {
        $trader = $request->validate([
            "client_id" => "required|numeric|exists:client,id",
            "trader_id" => "required|numeric|exists:users,id",
        ]);
        $trader = User::where("id", $request->trader_id)->first();
        $status = TraderModal::where("id", $request->id)->update($trader);
        $user_name = auth()->user()->name;
        if($status){
            LogServices::logEvent(["desc"=>"Trader $trader->name updated by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to update Trader $trader->name by $user_name"]);
        }
    }

    public static function traderClientList($id){
        $dematAccount['preferred'] = ClientDemat::
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("client_demat.trader_id",$id)->
        where("client_demat.is_make_as_preferred","1")->
        where("client_demat.account_status","normal")->
        select('client_demat.*','clients.name')
            ->get();

        $dematAccount['holding'] = ClientDemat::
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("client_demat.trader_id",$id)->
        where("client_demat.account_status","holding")->
        select('client_demat.*','clients.name')
            ->get();

        $dematAccount['renew'] = ClientDemat::
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("client_demat.trader_id",$id)->
        where("client_demat.account_status","renew")->
        select('client_demat.*','clients.name')
            ->get();

        $dematAccount['problem'] = ClientDemat::
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("client_demat.trader_id",$id)->
        where("client_demat.account_status","problem")->
        select('client_demat.*','clients.name')
            ->get();

        $dematAccount['all'] = ClientDemat::
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("client_demat.trader_id",$id)->
        where("client_demat.account_status","normal")->
        where("client_demat.is_make_as_preferred","!=","1")->
        select('client_demat.*','clients.name')
            ->get();
        return $dematAccount;
    }
    public static function holdingAccounts(){
        return ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->where("client_demat.trader_id", auth()->user()->id)->where("client_demat.account_status", "holding")->select('client_demat.*', 'clients.name')->get();

    }
}
