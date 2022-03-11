<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientServices;
use App\Services\ProfessionServices;
use App\Services\BankDetailsServices;
use App\Services\BrokerServices;
use App\Services\CommonService;
use App\Services\UserServices;
use App\Models\ClientDemat;

use Illuminate\Support\Facades\Redirect;
class ClientController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:client-create', ['only' => ['createClientForm', 'create']]);
        $this->middleware('permission:client-write', ['only' => ['updateForm', 'update']]);
        $this->middleware('permission:client-read', ['only' => ['get', 'all']]);
        $this->middleware('permission:client-delete', ['only' => ['remove', 'removePaymentScreenshot']]);
    }
    // read all clients
    public function all(){
        $clients = ClientServices::allClientTypeWise();
        $professions = ProfessionServices::view(['id', 'profession']);
        $banks = BankDetailsServices::view(['id', 'bank']);
        $brokers = BrokerServices::view(['id', 'broker']);
        $traders = UserServices::getByRole('trader');
        $freelancerAms= UserServices::getByType(4);
        $freelancerPrime = UserServices::getByType(5);
        return view("clients.client",compact('clients','professions','banks','traders','brokers','freelancerAms','freelancerPrime'));
    }
    // create client form
    public function createClientForm(){
        $getLastSGNo = ClientDemat::select("serial_number")->where("st_sg", "SG")->orderBy("id", "DESC")->first();

		if(!empty($getLastSGNo)) {
			$newSGNo = $getLastSGNo->serial_number;
		} else {
			$newSGNo = "000";
		}

		$getLastSTNo = ClientDemat::select("serial_number")->where("st_sg", "ST")->orderBy("id", "DESC")->first();

		if(!empty($getLastSTNo)) {
			$newSTNo = $getLastSTNo->serial_number;
		} else {
			$newSTNo = "000";
		}

        $professions = ProfessionServices::view(['id', 'profession']);
        $banks = BankDetailsServices::view(['id', 'bank']);
        $brokers = BrokerServices::view(['id', 'broker']);
        $channelPartner = UserServices::getByType(3);
        return view("clients.add", compact('professions', 'banks','brokers','channelPartner','newSTNo','newSGNo'));
    }
    // create client data
    public function create(Request $request){
        $client = ClientServices::create($request);
        return Redirect::route("clients")->with("info","Client have been created");
    }
    // read client
    public function get(Request $request,$id){
        $client =  ClientServices::get($id);
        if(!$client)
            CommonService::throwError("Client not found");
        return view("clients.view",compact('client'));
    }
    // edit client
    public function updateForm(Request $request,$id){
        $client =  ClientServices::get($id);
        $professions = ProfessionServices::view(['id', 'profession']);
        $banks = BankDetailsServices::view(['id', 'bank']);
        $brokers = BrokerServices::view(['id', 'broker']);
        $channelPartner = UserServices::getByType(3);
        return view("clients.edit", compact('client','professions', 'banks', 'brokers','channelPartner'));
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
    // assign client to freelancer
    public function assignClientToFreelancer(Request $request){
        $requestData['freelancer_id'] = (isset($request->freelancer_id) && $request->freelancer_id != '') ? $request->freelancer_id : $request->ams_freelancer_id;
        ClientServices::updateAssignTo($request->client_demate_id,$requestData);
        return Redirect::route("clientDematAccount")->with("info","Freelancer assign to client demat account");
    }
    // assign client to freelancer
    public function clientDematAccount(){
        $freelancerAms= UserServices::getByType(4);
        $freelancerPrime = UserServices::getByType(5);
        $dematAccount = ClientServices::getClientDematAccount(5);
        return view("clients.client_demat",compact('dematAccount','freelancerAms','freelancerPrime'));

    }
}
