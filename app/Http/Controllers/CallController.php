<?php

namespace App\Http\Controllers;

use App\Models\Calls;
use App\Services\ClientServices;
use Illuminate\Http\Request;
use App\Services\CallServices;
use App\Services\KeywordServices;
use Illuminate\Support\Facades\Redirect;
class CallController extends Controller
{
    public function view(){
        $calls = CallServices::view();
        $keywords = KeywordServices::all();
        return view('calls.calls',compact("calls","keywords"));
    }
    public function create(Request $request){
        if(isset($request->script_name) &&  $request->script_name != ''){
            $keyword['name'] = $request->script_name;
            $keywordData = KeywordServices::getKeywordByName($request->script_name);
            if(empty($keywordData)){
                KeywordServices::create($keyword);
            }
        }
        $trade = Calls::where("client_demate_id",$request->client_demate_id)->get()->toArray();
        if(empty($trade)){
            $requestData['account_status'] = "holding";
            ClientServices::updateClientDematAccount($request->client_demate_id, $requestData);
        }
        CallServices::create($request);
        return Redirect::back()->with("info","Trade has been created");
    }
    public function squareOffDemat(Request $request,$demat_id){
        if($request->ajax()){
            $calls = CallServices::getDematCalls($demat_id);
            $scripts = array();
            $qty = array();
            $entry_price = array();
            $analyst = array();
            $total = array();
            foreach ($calls as $call){
                if(!in_array($call->script_name,$scripts)){
                    array_push($scripts,$call->script_name);
                    $entry_price[$call->script_name] = (int)$call->entry_price;
                    $analyst[$call->script_name] = $call->analyst->id;
                    $qty[$call->script_name] = (int)$call->quantity;
                    $total[$call->script_name] = ($call->entry_price* $call->quantity);
                }else{
                    $entry_price[$call->script_name] += (int)$call->entry_price;
                    $qty[$call->script_name] += (int)$call->quantity;
                    $total[$call->script_name] += ($call->entry_price * $call->quantity);
                }
            }
            return response(["demat_id"=>$demat_id,"analyst"=> $analyst,"script_name"=>$scripts,"qty"=>$qty,"entry_price"=>$entry_price,"total"=>$total],200, ["Content-Type" => "Application/json"]);
        }
        return view("trader.square-off", compact('demat_id'));
    }
    public function squareOffForm(Request $request){
        $calls = CallServices::squareOff($request);
        return Redirect::back()->with("info", "Trade Sold");
    }
    public function remove(Request $request){
        CallServices::remove($request);
        return response(true)->header('Content-type', "application/json");
    }
    public function edit(Request $request){
        CallServices::edit($request);
        return Redirect::route('calls')->with("info", "Call has been updated");
    }
    public function get(Request $request){
        $call = CallServices::get($request->id);
        return response($call)->header('Content-type', "application/json");
    }

    // read client
    public function getScriptCall(Request $request){
        if($request->type == "open") {
            $callData = Calls::leftJoin('client_demat', 'calls.client_demate_id', '=', 'client_demat.id')
                ->select('calls.*','client_demat.holder_name')
                ->where("script_name", $request->scriptName)
                ->get()->toArray();
        }elseif ($request->type == "close"){
            $callData = Calls::leftJoin('client_demat', 'calls.client_demate_id', '=', 'client_demat.id')
                ->select('calls.*','client_demat.holder_name')
                ->where("script_name", $request->scriptName)
                ->onlyTrashed()->get()->toArray();
        }else{
            $callData = Calls::leftJoin('client_demat', 'calls.client_demate_id', '=', 'client_demat.id')
                ->select('calls.*','client_demat.holder_name')
                ->where("calls.client_demate_id", $request->id)
                ->get()->toArray();
        }
        return $callData;
    }
}
