<?php

namespace App\Services;
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
            "client_id.exists"=>"Invalid Client",
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

}