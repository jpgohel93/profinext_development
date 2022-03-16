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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class ClientController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:client-create', ['only' => ['createClientForm', 'create']]);
        $this->middleware('permission:client-write', ['only' => ['updateForm', 'update']]);
        $this->middleware('permission:client-read', ['only' => ['get', 'all']]);
        $this->middleware('permission:client-delete', ['only' => ['remove', 'removePaymentScreenshot']]);
        $this->middleware('permission:freelancer-data-write', ['only' => ['assignClientToFreelancer', 'removePaymentScreenshot']]);
        $this->middleware('permission:client-demat-read', ['only' => ['clientDematAccount']]);
        $this->middleware('permission:client-demat-write', ['only' => ['editClientDematAccount','makeAsPreferred','updateDematStatus','assignTraderToDemat']]);
        $this->middleware('permission:setup-read', ['only' => ['setup']]);
    }
    // read all clients
    public function all(){
        $clients = ClientServices::allClientTypeWise();
        $professions = ProfessionServices::view(['id', 'profession']);
        $banks = BankDetailsServices::view(['id', 'bank']);
        $brokers = BrokerServices::view(['id', 'broker']);
        //$traders = UserServices::getByRole('trader');
        $freelancerAms= UserServices::getByType(4);
        $freelancerPrime = UserServices::getByType(5);
        return view("clients.client",compact('clients','professions','banks','brokers','freelancerAms','freelancerPrime'));
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
        if($request->form_type == "channelPartner"){
            return Redirect::route("channelPartnerUserData")->with("info","Client have been created");
        }else{
            return Redirect::route("clients")->with("info","Client have been created");
        }
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
    public function clientDematAccount($filter_type = null, $filter_id = null ){

        $freelancerAms= UserServices::getByType(4);
        $freelancerPrime = UserServices::getByType(5);
        $dematAccount = ClientServices::getClientDematAccount($filter_type, $filter_id);
		$traders = UserServices::getByRole('trader');
        return view("clients.client_demat",compact('dematAccount','freelancerAms','freelancerPrime','traders','filter_type','filter_id'));
    }

    //update the available fund and profit / loss in demat
    public function editClientDematAccount(Request $request){
        $availableBalance = (isset($request->available_balance) && $request->available_balance != '') ? $request->available_balance : 0;
        $pl = (isset($request->pl) && $request->pl != '') ? $request->pl : 0;
        $notes = (isset($request->notes) && $request->notes != '') ? $request->notes : '';
        if($availableBalance != 0 || $pl != 0) {
            $requestData['available_balance'] = $availableBalance;
            $requestData['pl'] = $pl;
            $requestData['notes'] = $notes;
            ClientServices::updateClientDematAccount($request->demate_id, $requestData);
            if($request->form_type == "setup"){
                return Redirect::route("setup")->with("info", "Client demat account update successful");
            }elseif ($request->form_type == "client_demat"){
                return Redirect::route("clientDematAccount")->with("info", "Client demat account update successful");
            }elseif ($request->form_type == "freelancer_demat"){
                return Redirect::route("freelancerUserData")->with("info", "Client demat account update successful");
            }
        }else{
            return Redirect::route("clientDematAccount")->with("info", "Please enter the  available fund or profit / loss");
        }
    }

    //makeAsPreferred
    public function makeAsPreferred(Request $request)
    {
        $requestData['is_make_as_preferred'] = $request->is_make_as_preferred;
        $requestData['account_status'] = "normal";
        ClientServices::updateClientDematAccount($request->id, $requestData);
        return true;
    }

    //makeAsPreferred
    public function updateDematStatus(Request $request)
    {
        $requestData['account_status'] = $request->status;
        if($request->status == "normal"){
            $requestData['entry_price'] = 0;
            $requestData['quantity'] = 0;
            $requestData['problem'] = '';
            $requestData['is_make_as_preferred'] = 0;
        }elseif ($request->status == "holding"){
            $requestData['entry_price'] = $request->entry_price;
            $requestData['quantity'] = $request->quantity;
        }elseif ($request->status == "problem"){
            if($request->problem == "other"){
                $requestData['problem'] = $request->other_problem;
            }else{
                $requestData['problem'] = $request->problem;
            }
        }
        ClientServices::updateClientDematAccount($request->id, $requestData);

        if ($request->status == "holding" || $request->status == "problem"){
            return Redirect::route("viewTraderAccounts")->with("info", "stactus change successfully.");
        }else{
            return true;
        }
    }

    // set up
    public function setup(){
        $dematAccount = ClientServices::getClientForSetUp();
		$traders = UserServices::getByRole('trader');
        return view("calls.setup",compact('dematAccount','traders'));
    }

    public function assignTraderToDemat(Request $request)
	{
		/* $trader = $request->validate([
				"client_id" => "required|numeric|exists:clients,id",
				"trader_id" => "required|numeric|exists:users,id",
			],
			[
				"trader_id.unique"=>"Client Already Assign to this trader",
				"trader_id.exists"=>"Invalid Trader ID",
			]
        ); */

		$updateDemat['trader_id'] = $request->trader_id;
		ClientDemat::where("id", $request->client_id)->update($updateDemat);
		return Redirect::route("setup")->with("info", "Trader Assinged successfully.");
    }

    // set up
    public function getLoginInfo(Request $request,$id){
        $dematAccount = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')
            ->select('client_demat.*','clients.name')->
            where("client_demat.id", $id)->first();
        return $dematAccount;
    }

    // create client form
    public function channelPartnerClientForm(){

        $auth_user = Auth::user();
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
        $channelPartner = $auth_user;
        $formType = "channelPartner";
        return view("clients.add", compact('professions', 'banks','brokers','channelPartner','newSTNo','newSGNo','formType'));
    }
}
