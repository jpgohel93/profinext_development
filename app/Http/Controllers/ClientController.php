<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientServices;

class ClientController extends Controller
{
    function __construct(){
        
    }
    // read all clients
    public function all(){
        $clients = ClientServices::all();
        return view("clients.client",compact('clients'));
    }
    // create client form
    public function createClientForm(){
        return view("clients.add");
    }
    // create client data
    public function create(Request $request){
        $client = ClientServices::create($request);
        if($client){
            return redirect()->route("clients")->with("info","Client have been created");
        }
        return redirect()->route("clients")->with("info","Unable to create client");
    }
    // read client
    public function get(Request $request,$id){
        $client =  ClientServices::get($id);
        return view("clients.view",compact('client'));
    }
    // edit client
    public function updateForm(Request $request,$id){
        $client =  ClientServices::get($id);
        return view("clients.edit",compact('client'));
    }
    public function update(Request $request,$id){
        $client =  ClientServices::update($request,$id);
        return redirect()->route("clientView",$id)->with("info","Client have been updated");
    }
    // remove client
    public function remove(Request $request,$id){
        $client =  ClientServices::remove($id);
        return redirect()->route("clients")->with("info","Client Removed");
    }
    // remove client
    public function removePaymentScreenshot(Request $request,$client,$ss_id){
        ClientServices::removePaymentScreenshot($ss_id);
        return redirect()->route("updateClientForm",$client)->with("info","Screenshot Removed");
    }
}
