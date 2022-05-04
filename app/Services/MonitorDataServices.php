<?php

namespace App\Services;
use App\Models\MonitorData;
use App\Models\Analyst;
use App\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use App\Services\LogServices;
class MonitorDataServices{
    public static function all($id, $filterDate = null)
	{
		$auth_user = Auth::user();
		$explRole = explode(",", $auth_user->role);

		if($filterDate != "") {
			$dates = explode("-", $filterDate);
			$st_dt = str_replace("/","-", $dates[0]);
			$en_dt = str_replace("/","-", $dates[1]);
			$startDate = date("Y-m-d", strtotime($st_dt));
			$endDate = date("Y-m-d", strtotime($en_dt));

			if(in_array("super-admin", $explRole)) {
				$monitorData['open'] = MonitorData::where("status", "open")->whereBetween('date', [$startDate, $endDate])->orderBy('date', 'DESC')->get();
				$monitorData['close'] = MonitorData::where("status", "close")->whereBetween('date', [$startDate, $endDate])->orderBy('exit_date', 'DESC')->get();
				$monitorData['analyst'] = Analyst::where('status', '!=' , "Terminated")->get();
			} else {
				$monitorData['open'] = MonitorData::where("monitor_id", $id)->whereBetween('date', [$startDate, $endDate])->where("status", "open")->orderBy('date', 'DESC')->get();
				$monitorData['close'] = MonitorData::where("monitor_id", $id)->whereBetween('date', [$startDate, $endDate])->where("status", "close")->orderBy('exit_date', 'DESC')->get();
				$monitorData['analyst'] = Analyst::where("assign_user_id", $id)->where('status', '!=' , "Terminated")->get();
			}
		} else {
			if(in_array("super-admin", $explRole)) {
				$monitorData['open'] = MonitorData::where("status", "open")->orderBy('date', 'DESC')->get();
				$monitorData['close'] = MonitorData::where("status", "close")->orderBy('exit_date', 'DESC')->get();
				$monitorData['analyst'] = Analyst::where('status', '!=' , "Terminated")->get();
			} else {
				$monitorData['open'] = MonitorData::where("monitor_id", $id)->where("status", "open")->orderBy('date', 'DESC')->get();
				$monitorData['close'] = MonitorData::where("monitor_id", $id)->where("status", "close")->orderBy('exit_date', 'DESC')->get();
				$monitorData['analyst'] = Analyst::where("assign_user_id", $id)->where('status', '!=' , "Terminated")->get();
			}
		}
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
            $user_name = auth()->user()->name;
            if($analyst_id){
                LogServices::logEvent(["desc"=>"Monitor data ".$monitor['script_name']." created by $user_name"]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to create Monitor data by $user_name","data"=>$monitor]);
            }
            return $analyst_id->id;
        } catch (\Throwable $th) {
            LogServices::logEvent(["desc"=>"Unable to create Monitor data by $user_name","data"=>$monitor]);
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

        $data = MonitorData::where("id", $request->monitor_data_id)->first();
        $user_name = auth()->user()->name;
        $status = MonitorData::where("id", $request->monitor_data_id)->update($monitor);
        if($status){
            LogServices::logEvent(["desc"=>"Monitor data ".$monitor['script_name']." Updated by $user_name","data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to update Monitor data by $user_name","data"=>$monitor]);
        }
        return $status;
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

    public static function remove($id){
        $data = MonitorData::where("id",$id)->firstt();
        $status = MonitorData::where("id",$id)->delete();
        $user_name = auth()->user()->name;
        if($status){
            LogServices::logEvent(["desc"=>"Monitor data $data->script_name Deleted by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to delete Monitor data $data->script_name by $user_name"]);
        }
    }
    public static function close($request){
        $request->validate([
            "call_id"=>"required",
            "status"=>"required",
            "exit_price"=>"required",
            "exit_time"=>"required",
            "exit_date"=>"required",
        ]);
        $call = $request->except(["call_id","_token"]);
        $call['sl_status'] = $request['sl_status'];
        $data = MonitorData::where("id",$request->call_id)->first();
        $user_name = auth()->user()->name;
        $status = MonitorData::where("id",$request->call_id)->update($call);
        if($status){
            LogServices::logEvent(["desc"=>"Monitor data $data->script_name updated by $user_name","data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to update Monitor data by $user_name","data"=>$call]);
        }
    }
}
