<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientServices;

class ClientController extends Controller
{
    public function all(){
        $clients = ClientServices::all();
        return view("clients.client",compact('clients'));
    }
    public function createClientForm(){
        return view("clients.add");
    }
    public function create(Request $request){
        $clients = ClientServices::create($request);
        return redirect()->route("clients")->with("info","Clients have been created");
    }
}
