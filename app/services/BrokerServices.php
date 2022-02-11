<?php

namespace App\Services;

use App\Models\BrokerModal;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonService;
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
        try {
            $broker['created_by'] = Auth::id();
            BrokerModal::create($broker);
        } catch (\Throwable $th) {
            CommonService::throwError("Unable to create Broker");
        }
    }
    public static function remove($id)
    {
        return BrokerModal::where("id", $id)->forceDelete();
    }
    public static function get($id)
    {
        $broker = BrokerModal::where("id", $id)->first(["id", "broker"]);
        return (null === $broker)? CommonService::throwError("Unable to create Broker") : $broker;
    }
    public static function edit($request)
    {
        $broker = $request->validate([
            "broker" => "required|alpha_spaces|unique:client_brokers,broker"
        ]);
        try {
            return BrokerModal::where("id", $request->id)->update($broker);
        } catch (\Throwable $th) {
            CommonService::throwError("Unable to create Broker");
        }
    }
}
