<?php

namespace App\Services;

use App\Models\Client;
use App\Models\ClientDemat;
use App\Models\ClientPayment;
class ClientServices
{
    public static function create($request)
    {
        dd($request);
        $request->validate([

        ]);
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
        
        return Client::get();
    }
    public static function all(){
        return Client::get();
    }
}
