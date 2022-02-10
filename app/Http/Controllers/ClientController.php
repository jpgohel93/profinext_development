<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientServices;
use App\Services\ProfessionServices;
use App\Services\BankDetailsServices;
use App\Services\BrokerServices;

use Illuminate\Support\Facades\Redirect;
class ClientController extends Controller
{
    function __construct(){
        
    }
    // read all clients
    public function all(){
        $clients = ClientServices::all();
        $professions = ProfessionServices::view(['id', 'profession']);
        $banks = BankDetailsServices::view(['id', 'bank']);
        $brokers = BrokerServices::view(['id', 'broker']);
        return view("clients.client",compact('clients','professions','banks','account_types','brokers'));
    }
    // create client form
    public function createClientForm(){
        $professions = ProfessionServices::view(['id', 'profession']);
        $banks = BankDetailsServices::view(['id', 'bank']);
        $brokers = BrokerServices::view(['id', 'broker']);
        return view("clients.add", compact('professions', 'banks', 'account_types','brokers'));
    }
    // create client data
    public function create(Request $request){
        $client = ClientServices::create($request);
        if($client){
            return Redirect::route("clients")->with("info","Client have been created");
        }
        return Redirect::route("clients")->with("info","Unable to create client");
    }
    // read client
    public function get(Request $request,$id){
        $client =  ClientServices::get($id);
        return view("clients.view",compact('client'));
    }
    // edit client
    public function updateForm(Request $request,$id){
        $client =  ClientServices::get($id);
        $professions = ProfessionServices::view(['id', 'profession']);
        $banks = BankDetailsServices::view(['id', 'bank']);
        $brokers = BrokerServices::view(['id', 'broker']);
        return view("clients.edit", compact('client','professions', 'banks', 'account_types', 'brokers'));
    }
    public function update(Request $request,$id){
        $client =  ClientServices::update($request,$id);
        return Redirect::route("clientView",$id)->with("info","Client have been updated");
    }
    // remove client
    public function remove(Request $request,$id){
        $client =  ClientServices::remove($id);
        return Redirect::route("clients")->with("info","Client Removed");
    }
    // remove client
    public function removePaymentScreenshot(Request $request,$client,$ss_id){
        ClientServices::removePaymentScreenshot($ss_id);
        return Redirect::route("updateClientForm",$client)->with("info","Screenshot Removed");
    }
}
