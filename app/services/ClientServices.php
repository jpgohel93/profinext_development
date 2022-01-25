<?php

namespace App\Services;

use App\Models\Client;
use App\Models\ClientDemat;
use App\Models\ClientPayment;
class ClientServices
{
    public static function create($request)
    {
        ClientServices::validate($request);
        $client = $request->client;

        $client['created_by'] = "Admin";
        $user = Client::create($client);

        $demat = $request->demat;
        $demat['client_id'] = $user->id;


        ClientDemat::create($demat);
        $payment = $request->payment;

        $payment['client_id'] = $user->id;
        $payment['fees'] = 55000;
        $payment['updated_by'] = "Admin";
        ClientPayment::create($payment);
        
        return ClientServices::activeClients();
    }
    public static function validate($request){
        dd($request);
        $request->validate([
            ""=>""
        ]);
    }
    public static function revoke($request)
    {
        return ClientServices::activeClients();
    }

    public static function assign()
    {
        return ClientServices::activeClients();
    }

    public static function remove()
    {
        return ClientServices::activeClients();
    }

    public static function activeClients(){
        return Client::where("status", "1")->get();
    }

    public static function get($id){
        return Client::where("id", $id)->first();
    }

    public static function roles()
    {
        return ClientServices::activeClients();
    }
}
