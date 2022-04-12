<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\servicesTypeServices;
use Illuminate\Support\Facades\Redirect;
class servicesTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:settings-service-type-read', ['only' => ["view", "get"]]);
        $this->middleware('permission:settings-service-type-write', ['only' => ["edit", "editServiceType"]]);
        $this->middleware('permission:settings-service-type-create', ['only' => ["add"]]);
        $this->middleware('permission:settings-service-type-delete', ['only' => ["remove"]]);
    }
    public function view(){
        $serviceTypes = servicesTypeServices::view();
        return view("settings.clients.servicesType",compact("serviceTypes"));
    }
    public function editServiceType(Request $request){
        servicesTypeServices::edit($request);
        return Redirect::route("viewClientsServicesType")->with("info","Service type successfully Updated");
    }
    public function get(Request $request){
        $serviceType = servicesTypeServices::get($request)->toJson();
        return Response($serviceType,200,["Content-Type" => "Application/json"]);
    }
    public function remove($id){
        servicesTypeServices::remove($id);
        return Redirect::route("viewClientsServicesType")->with("info", "Service type Removed!");
    }
    public function add(Request $request){
        servicesTypeServices::add($request);
        return Redirect::route("viewClientsServicesType")->with("info", "Service type Added!");
    }
}
