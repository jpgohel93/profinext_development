<?php

namespace App\Services;

use App\Models\Calls;
use App\Models\Analyst;
use App\Models\ClientDemat;
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
        $request['due_date'] = date("Y-m-d");
        $call = $request->validate([
            "analyst_id"=> "required|exists:analysts,id",
            "due_date"=>"required|date",
            "script_name"=>"required",
            "entry_price"=> "required|numeric",
            "client_demate_id"=> "required|numeric",
            "quantity"=> "required|numeric",
        ]);
        $margin_value = 0;
        $demat = ClientDemat::where("id", $request->client_demate_id)->first(["available_balance", "capital"])->toArray();
        if($request->options=='future'){
            $request->validate([
                "margin_value" =>"required"
            ]);
            if(preg_match('/^\d+$/', $request->margin_value)){
                $margin_value = $request->margin_value;
            }else{
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    "margin_value" => ["Invalid margin value"]
                ]);
                throw $error;
            }
            if($margin_value>$demat['available_balance']){
                if($margin_value > $demat['capital']){
                    $error = \Illuminate\Validation\ValidationException::withMessages([
                        "capital" => ["Funds not available"]
                    ]);
                    throw $error;
                }else{
                    ClientDemat::where("id",$request->client_demate_id)->update([
                        "available_balance"=> $demat['capital']-$margin_value
                    ]);
                }
            }else{
                ClientDemat::where("id", $request->client_demate_id)->update([
                    "available_balance" => $demat['available_balance'] - $margin_value
                ]);
            }
        }else{
            $total = $request->entry_price* $request->quantity;
            if($total> $demat['available_balance']){
                if($total>$demat['capital']){
                    $error = \Illuminate\Validation\ValidationException::withMessages([
                        "capital" => ["Funds not available"]
                    ]);
                    throw $error;
                }else{
                    ClientDemat::where("id", $request->client_demate_id)->update([
                        "available_balance" => $demat['capital'] - $total
                    ]);
                }
            }else{
                ClientDemat::where("id", $request->client_demate_id)->update([
                    "available_balance" => $demat['available_balance'] - $total
                ]);
            }
        }
        $call['created_by']= Auth::id();
        return Calls::create($call);
    }
    public static function squareOff($request){
        $trade = $request->validate([
            "analyst_id" => "required|exists:analysts,id",
            "demat_id"=>"required|exists:client_demat,id",
            "trade"=> "required|exists:calls,script_name",
            "price"=>"required|numeric",
            "qty"=> "required|numeric"
        ]);
        $demat = ClientDemat::where("id", $request->demat_id)->first(["available_balance", "capital"])->toArray();
        $total = $request->price*$request->qty;
        ClientDemat::where("id", $request->demat_id)->update([
            "available_balance" => $demat["available_balance"]+$total
        ]);

        $calls = Calls::where("client_demate_id", $request->demat_id)->where("script_name","like",$trade['trade'])->get();
        $scripts = array();
        $qty = array();
        $entry_price = array();
        $analyst = array();
        $total = array();
        foreach ($calls as $call) {
            if (!in_array($call->script_name, $scripts)) {
                array_push($scripts, $call->script_name);
                $entry_price[$call->script_name] = (int)$call->entry_price;
                $analyst[$call->script_name] = $call->analyst->id;
                $qty[$call->script_name] = (int)$call->quantity;
                $total[$call->script_name] = ($call->entry_price * $call->quantity);
            } else {
                $entry_price[$call->script_name] += (int)$call->entry_price;
                $qty[$call->script_name] += (int)$call->quantity;
                $total[$call->script_name] += ($call->entry_price * $call->quantity);
            }
        }
        // diduct trade which sell
        $entry_price[$trade['trade']] -= $request->price;
        if($qty[$trade['trade']]<$request->qty){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "Quantity" => ["Invalid Quantity"]
            ]);
            throw $error;
        }
        $qty[$trade['trade']] -= $request->qty;
        $total[$trade['trade']] -= $request->price*$request->qty;

        // return response(["demat_id" => $demat_id, "analyst" => $analyst, "script_name" => $scripts, "qty" => $qty, "entry_price" => $entry_price, "total" => $total], 200, ["Content-Type" => "Application/json"]);

        Calls::where("client_demate_id",$request->demat_id)->where("analyst_id",$request->analyst_id)->where("script_name","like",$trade['trade'])->delete();

        $newCall =array();
        $newCall["analyst_id"] = $request->analyst_id;
        $newCall["due_date"] = date("Y-m-d");
        $newCall["script_name"] = $trade['trade'];
        $newCall["entry_price"] = abs($entry_price[$trade['trade']]);
        $newCall["client_demate_id"] = $request->demat_id;
        $newCall["quantity"] = $qty[$trade['trade']];
        $newCall['created_by'] = Auth::id();
        return Calls::create($newCall);
    }
    public static function remove($request){
        return Calls::where("id", $request->id)->delete();
    }
    public static function get($id){
        return Calls::with(["analyst:id,analyst"])->where("id", $id)->first(['analyst_id', "script_name", "entry_price", "target_price", "stop_loss"]);
    }
    public static function getDematCalls($demat_id){
        return Calls::where("client_demate_id", $demat_id)->get();
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
