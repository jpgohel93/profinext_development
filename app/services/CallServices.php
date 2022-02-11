<?php

namespace App\Services;

use App\Models\Calls;
use App\Models\Analyst;
use App\Models\AnalystNumbers;
use Illuminate\Support\Facades\Auth;

class CallServices
{
    public static function view(){
        $calls = array();
        $calls['active'] = Calls::with(['analyst:analyst,id'])->get();
        $calls['closed'] = Calls::with(['analyst:analyst,id'])->onlyTrashed()->get();
        $calls['analysts'] = Analyst::get(['id',"analyst"]);
        return $calls;
    }
    public static function create($request){
        $call = $request->validate([
            "analyst_id"=> "required|exists:analysts,id",
            "due_date"=>"required|date",
            "script_name"=>"required",
            "lot_size"=>"required",
            "entry_price"=>"required",
            "target_price"=>"required",
            "stop_loss"=>"required",
            "margin_value"=>"required",
        ]);
        $call['created_by']= Auth::id();
        return Calls::create($call);
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
