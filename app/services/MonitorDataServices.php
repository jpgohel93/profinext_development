<?php

namespace App\Services;
use App\Models\MonitorData;
use App\Services\CommonService;
use Illuminate\Support\Facades\Auth;

class MonitorDataServices{
    public static function all(){
        $monitorData['open'] = MonitorData::where("status", "open")->get();
        $monitorData['close'] = MonitorData::where("status", "close")->get();
        return $monitorData;
    }
    public static function create($request){
        $monitor = $request->validate([
            "monitor_id"=>"required",
            "analysts_id"=>"required",
            "date"=>"required",
            "script_name"=>"required",
            "entry_time"=>"required",
            "entry_price"=>"required",
            "target"=>"required",
            "exit_price"=>"required",
            "exit_time"=>"required",
            "buy_sell"=>"required",
            "sl"=>"required",
            "status"=>"required",
            "risk_reward"=>"required",
        ]);

        $monitor['created_by'] = Auth::id();
        try {
            $analyst_id = MonitorData::create($monitor);
            return $analyst_id->id;
        } catch (\Throwable $th) {
            CommonService::throwError("Unable to create Analyst".$th);
        }
    }

    public static function update($request)
    {
        $monitor = $request->validate([
            "monitor_id" => "required",
            "analysts_id" => "required",
            "date" => "required",
            "script_name" => "required",
            "entry_time" => "required",
            "entry_price" => "required",
            "target" => "required",
            "exit_price" => "required",
            "exit_time" => "required",
            "buy_sell" => "required",
            "sl" => "required",
            "status" => "required",
            "risk_reward" => "required",
        ]);

        return MonitorData::where("id", $request->monitor_data_id)->update($monitor);
    }

    public static function getMonitorData($id){
        return MonitorData::where("id",$id)->first();
    }

}
