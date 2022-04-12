<?php

namespace App\Services;

use App\Models\Calls;
use App\Models\Analyst;
use Illuminate\Support\Facades\Auth;

class CallServices
{
    public static function view(){
        $calls = array();
        $active = Calls::with(['analyst:analyst,id'])->groupBy('script_name')->groupBy('analyst_id')->get();
        $closed = Calls::with(['analyst:analyst,id'])->groupBy('script_name')->groupBy('analyst_id')->onlyTrashed()->get();

        if(!empty($active)){
            foreach ($active as $key => $data){
                $active[$key]['total'] = Calls::where("script_name",$data->script_name)->groupBy("client_demate_id")->count();
            }
        }

        if(!empty($closed)){
            foreach ($closed as $key => $data){
                $closed[$key]['total'] = Calls::where("script_name",$data->script_name)->groupBy("client_demate_id")->onlyTrashed()->count();
            }
        }

        $calls['active'] = $active;
        $calls['closed'] = $closed;

        $calls['analysts'] = Analyst::get(['id',"analyst"]);
        return $calls;
    }
    public static function create($request){
        try {
            $request['due_date'] = date("Y-m-d");
            $call = $request->validate([
                "analyst_id"=> "required|exists:analysts,id",
                "due_date"=>"required|date",
                "script_name"=>"required",
                "entry_price"=>"required",
                "client_demate_id"=>"required",
                "quantity"=>"required",
            ]);
            $call['created_by']= Auth::id();
            return Calls::create($call);
        } catch (\Throwable $th) {
            CommonService::throwError("Unable to update this call");
        }
    }
    public static function remove($request){
        return Calls::where("id", $request->id)->delete();
    }
    public static function get($id){
        return Calls::with(["analyst:id,analyst"])->where("id", $id)->first(['analyst_id', "script_name", "entry_price", "target_price", "stop_loss"]);
    }
    public static function edit($request){
        try {
            $call = $request->validate([
                "analyst_id"=>"required|exists:analysts,id|numeric",
                "script_name"=>"required",
                "entry_price"=>"required",
                "target_price"=>"required",
                "stop_loss"=>"required",
            ],
            [
                "analyst_id.exists" => "Invalid analyst",
                "analyst_id.numeric" => "Invalid analyst",
            ]);
            return Calls::where("id",$request->call_id)->update($call);
        } catch (\Throwable $th) {
            CommonService::throwError("Unable to update this call");
        }
    }
}
