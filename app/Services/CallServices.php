<?php

namespace App\Services;

use App\Models\Calls;
use App\Models\Analyst;
use App\Models\ClientDemat;
use Illuminate\Support\Facades\Auth;
use App\Services\LogServices;
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
        $user_name = auth()->user()->name;
        $demat = ClientDemat::where("id", $request->client_demate_id)->first()->toArray();
        $ab = $demat['available_balance'];
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
                    $ab_new = $demat['capital']-$margin_value;
                    $data = ClientDemat::where("id",$request->client_demate_id)->first();
                    $dt = ["available_balance"=> $ab_new];
                    $status = ClientDemat::where("id",$request->client_demate_id)->update($dt);
                    if($status){
                        LogServices::logEvent(["desc"=>"Demat ".$demat['holder_name']." updated By $user_name","data"=>$data]);
                    }else{
                        LogServices::logEvent(["desc"=>"Unable to Update Demat ".$demat['holder_name']." By $user_name","data"=>$dt]);
                    }
                }
            }else{
                $ab_new = $demat['available_balance'] - $margin_value;

                $data = ClientDemat::where("id", $request->client_demate_id)->first();
                $dt = ["available_balance" => $ab_new];
                $status = ClientDemat::where("id", $request->client_demate_id)->update($dt);
                if($status){
                    LogServices::logEvent(["desc"=>"Demat ".$demat['holder_name']." Updated By $user_name","data"=>$data]);
                }else{
                    LogServices::logEvent(["desc"=>"Unable to Update Demat ".$demat['holder_name']." By $user_name","data"=>$dt]);
                }
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
                    $ab_new = $demat['capital'] - $total;
                    $data = ClientDemat::where("id", $request->client_demate_id)->first();
                    $dt = ["available_balance" => $demat['capital'] - $total];
                    $status = ClientDemat::where("id", $request->client_demate_id)->update($dt);
                    if($status){
                        LogServices::logEvent(["desc"=>"Demat ".$demat['holder_name']." Updated By $user_name","data"=>$data]);
                    }else{
                        LogServices::logEvent(["desc"=>"Unable to Update Demat ".$demat['holder_name']." By $user_name","data"=>$dt]);
                    }
                }
            }else{
                $ab_new = $demat['available_balance'] - $total;
                $data = ClientDemat::where("id", $request->client_demate_id)->first();
                $dt = ["available_balance" => $demat['available_balance'] - $total];
                $status = ClientDemat::where("id", $request->client_demate_id)->update($dt);
                if($status){
                    LogServices::logEvent(["desc"=>"Demat ".$demat['holder_name']." Updated By $user_name","data"=>$data]);
                }else{
                    LogServices::logEvent(["desc"=>"Unable to Update Demat ".$demat['holder_name']." By $user_name","data"=>$dt]);
                }
            }
        }
        $call['created_by']= Auth::id();
        $id = Calls::create($call);
        if($id){
            LogServices::logEvent(["desc"=>"Call ".$call['script_name']." created By $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Call ".$call['script_name']." By $user_name"]);
        }
        return $id;
    }
    public static function squareOff($request){
        $trade = $request->validate([
            "analyst_id" => "required|exists:analysts,id",
            "demat_id"=>"required|exists:client_demat,id",
            "trade"=> "required|exists:calls,script_name",
            "price"=>"required|numeric",
            "qty"=> "required|numeric"
        ]);
        $demat = ClientDemat::where("id", $request->demat_id)->first()->toArray();
        $total = $request->price*$request->qty;
        $user_name = auth()->user()->name;
        $ab_new = $demat["available_balance"]+$total;
        $ab = $demat["available_balance"];
        $status = ClientDemat::where("id", $request->demat_id)->update([
            "available_balance" => $ab_new
        ]);
        if($status){
            LogServices::logEvent(["desc"=>"Demat ".$demat['holder_name']." Updated By $user_name","data"=>$demat]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to Update Demat ".$demat['holder_name']." By $user_name","data"=>["available_balance" => $ab_new]]);
        }

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
                $total[$call->script_name] = ($total[$call->script_name] + ($call->entry_price * $call->quantity))/2;
            }
        }
        // minus trade which sold
        $entry_price[$trade['trade']] = $request->price;
        if($qty[$trade['trade']]<$request->qty){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "Quantity" => ["Invalid Quantity"]
            ]);
            throw $error;
        }
        $qty[$trade['trade']] -= $request->qty;
        $total[$trade['trade']] -= $request->price*$request->qty;

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
        $call = Calls::with("withDemat")->where("id", $request->id)->first();
        $status = Calls::where("id", $request->id)->delete();
        $user_name = auth()->user->name;
        if($status){
            return LogServices::logEvent(["desc"=>"Call ID $call->script_name deleted for demat ".$call->withDemat->holder_name." By $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to delete Call ID ".$call->withDemat->holder_name." By $user_name"]);
        }
    }
    public static function get($id){
        return Calls::with(["analyst:id,analyst"])->where("id", $id)->first(['analyst_id', "script_name", "entry_price", "target_price", "stop_loss"]);
    }
    public static function getDematCalls($demat_id){
        return Calls::where("client_demate_id", $demat_id)->orderBy("id", "DESC")->get();
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
            $call = Calls::where("id",$request->call_id)->first();
            $status = Calls::where("id",$request->call_id)->update($call);
            $user_name = auth()->user()->name;
            if($status){
                return LogServices::logEvent(["desc"=>"Call ID $call->script_name Updated By $user_name","data"=>$call]);
            }else{
                return LogServices::logEvent(["desc"=>"Unable to update Call ID $call->script_name By $user_name"]);
            }
        } catch (\Throwable $th) {
            CommonService::throwError("Unable to update this call");
        }
    }
}
