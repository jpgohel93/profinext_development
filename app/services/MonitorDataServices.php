<?php

namespace App\Services;
use App\Models\MonitorData;
use App\Models\Analyst;
use App\Services\CommonService;
use Illuminate\Support\Facades\Auth;

class MonitorDataServices{
    public static function all($id){
        $monitorData['open'] = MonitorData::where("monitor_id", $id)->where("status", "open")->get();
        $monitorData['close'] = MonitorData::where("monitor_id", $id)->where("status", "close")->get();
        $monitorData['analyst'] = Analyst::where("assign_user_id", $id)->where('status', '!=' , "Terminated")->get();
        return $monitorData;
    }
    public static function create($request){
        $monitor = $request->validate([
            "monitor_id"=>"required",
            "analysts_id"=>"required"
        ]);
        $monitor['date'] = $request['date'];
        $monitor['script_name'] = $request['script_name'];
        $monitor['entry_time'] = $request['entry_time'];
        $monitor['entry_price'] = $request['entry_price'];
        $monitor['target'] = $request['target'];
        $monitor['buy_sell'] = $request['buy_sell'];
        $monitor['sl'] = $request['sl'];
        $monitor['status'] = $request['status'];
        $monitor['risk_reward'] = $request['risk_reward'];
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
        $request['exit_date'] = date('Y-m-d');

        $monitor = $request->validate([
            "monitor_id" => "required",
            "analysts_id" => "required"
        ]);

        $monitor['date'] = $request['date'];
        $monitor['script_name'] = $request['script_name'];
        $monitor['entry_time'] = $request['entry_time'];
        $monitor['entry_price'] = $request['entry_price'];
        $monitor['target'] = $request['target'];
        $monitor['buy_sell'] = $request['buy_sell'];
        $monitor['sl'] = $request['sl'];
        $monitor['status'] = $request['status'];
        $monitor['risk_reward'] = $request['risk_reward'];
        $monitor['earning'] = $request['earning'];
        $monitor['exit_date'] = $request['exit_date'];
        $monitor['exit_price'] = $request['exit_price'];
        $monitor['exit_time'] = $request['exit_time'];
        $monitor['sl_status'] = $request['sl_status'];

        return MonitorData::where("id", $request->monitor_data_id)->update($monitor);
    }

    public static function getMonitorData($id){
        return MonitorData::where("id",$id)->first();
    }

    public static function countAnalystCall($id){
        $countCall['open_call'] =  MonitorData::where("analysts_id",$id)->where("status", "open")->count();
        $countCall['close_call'] =  MonitorData::where("analysts_id",$id)->where("status", "close")->count();
        return $countCall;
    }

    public static function countMonitorData($id){
        return Analyst::where("assign_user_id",$id)->where('status', '!=' , "Terminated")->count();
    }

    public static function allUserAnalysts($id){

        $analyst =  Analyst::where('status', '!=' , "Terminated")->where('assign_user_id',$id)->get();
        return $analyst;
    }

    public static function getAnalystCallData($id){
        return MonitorData::where("status","close")->where("analysts_id",$id)->get();
    }
}
