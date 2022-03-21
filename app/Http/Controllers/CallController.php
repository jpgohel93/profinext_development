<?php

namespace App\Http\Controllers;

use App\Models\Calls;
use App\Services\ClientServices;
use Illuminate\Http\Request;
use App\Services\CallServices;
use App\Services\KeywordServices;
use App\Services\CommonService;
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
        return Redirect::route('viewTraderAccounts')->with("info","Trade has been created");
    }
    public function remove(Request $request){
        CallServices::remove($request);
        return response(true)->header('Content-type', "application/json");
    }
    public function edit(Request $request){
        $call = CallServices::edit($request);
        return Redirect::route('calls')->with("info", "Call has been updated");
    }
    public function get(Request $request){
        $call = CallServices::get($request->id);
        return response($call)->header('Content-type', "application/json");
    }
}
