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
}
