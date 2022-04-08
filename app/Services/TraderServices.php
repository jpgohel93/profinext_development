<?php

namespace App\Services;
use App\Models\ClientDemat;
use App\Models\TraderModal;
use Illuminate\Support\Facades\Auth;
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
        ]
        );
        $trader['created_by'] = Auth::id();
        return TraderModal::create($trader);
    }
    public static function remove($id)
    {
        return TraderModal::where("id", $id)->forceDelete();
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
        return TraderModal::where("id", $request->id)->update($trader);
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
