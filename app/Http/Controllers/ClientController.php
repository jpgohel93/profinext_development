<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientServices;

class ClientController extends Controller
{
    public static function create(Request $request){
        return ClientServices::create($request);
    }
    public static function all(){
        $clients = ClientServices::activeClients();
        return view("client",["clients"=> $clients]);
    }
    public static function get($client_id){
        return ClientServices::get($client_id);
    }
}
