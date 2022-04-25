<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class LogsController extends Controller
{
    public function logEvent($event){
        Controller::log($event);
    }
    public function logEventAjax(Request $request){
        if($request->ajax()){
            Controller::log($request->all());
            return response(["info"=>"Event Logged","status"=>1],200,["Content-Type"=>"Application/json"]);
        }
    }
}
