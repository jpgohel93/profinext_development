<?php

namespace App\Services;

use App\Models\BrokerModal;
use Illuminate\Support\Facades\Auth;

class BrokerServices
{
    public static function view()
    {
        return BrokerModal::get(['id', 'broker']);
    }
    public static function create($request)
    {
        $broker = $request->validate([
            "broker" => "required|alpha_spaces|unique:client_brokers,broker"
        ]);
        $broker['created_by'] = Auth::id();
        return BrokerModal::create($broker);
    }
    public static function remove($id)
    {
        return BrokerModal::where("id", $id)->forceDelete();
    }
    public static function get($id)
    {
        return BrokerModal::where("id", $id)->first(["id", "broker"]);
    }
    public static function edit($request)
    {
        $broker = $request->validate([
            "broker" => "required|alpha_spaces|unique:client_brokers,broker"
        ]);
        return BrokerModal::where("id", $request->id)->update($broker);
    }
}
