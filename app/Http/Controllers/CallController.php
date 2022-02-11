<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CallServices;
use App\Services\CommonService;
use Illuminate\Support\Facades\Redirect;
class CallController extends Controller
{
    public function view(){
        $calls = CallServices::view();
        return view('calls.calls',compact("calls"));
    }
    public function create(Request $request){
        CallServices::create($request);
        return Redirect::route('calls')->with("info","Call has been created");
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
