<?php

namespace App\Services;

use App\Models\BrokerModal;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonService;
use App\Services\LogServices;
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
        $user_name = auth()->user()->name;
        try {
            $broker['created_by'] = Auth::id();
            $id = BrokerModal::create($broker);
            LogServices::logEvent(["desc"=>"Broker $id->id created by $user_name"]);
        } catch (\Throwable $th) {
            LogServices::logEvent(["desc"=>"Unable to create Broker $user_name"]);
            CommonService::throwError("Unable to create Broker");
        }
    }
    public static function remove($id)
    {
        $user_name = auth()->user()->name;
        $id = BrokerModal::where("id", $id)->forceDelete();
        if($id){
            LogServices::logEvent(["desc"=>"Broker $id removed by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to remove Broker $id by $user_name"]);
        }
    }
    public static function get($id)
    {
        $broker = BrokerModal::where("id", $id)->first(["id", "broker"]);
        return (null === $broker)? CommonService::throwError("Unable to create Broker") : $broker;
    }
    public static function edit($request)
    {
        $user_name = auth()->user()->name;
        $broker = $request->validate([
            "broker" => "required|alpha_spaces|unique:client_brokers,broker"
        ]);
        try {
            BrokerModal::where("id", $request->id)->update($broker);
            return LogServices::logEvent(["desc"=>"Broker $request->id updated by $user_name"]);
        } catch (\Throwable $th) {
            LogServices::logEvent(["desc"=>"Unable to update Broker $request->id by $user_name"]);
            return CommonService::throwError("Unable to create Broker");
        }
    }
}
