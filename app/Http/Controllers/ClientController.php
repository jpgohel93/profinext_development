<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\ClientDemat;
use App\Models\Analyst;

use App\Services\ClientServices;
use App\Services\financeManagementServices\renewalStatusService;
use App\Services\ProfessionServices;
use App\Services\BankDetailsServices;
use App\Services\BrokerServices;
use App\Services\ClientDemateServices;
use App\Services\CommonService;
use App\Services\UserServices;
use App\Services\TraderServices;
use App\Services\KeywordServices;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use PDF;
class ClientController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:client-create', ['only' => ['createClientForm', 'create']]);
        $this->middleware('permission:client-write', ['only' => ['updateForm', 'update']]);
        $this->middleware('permission:client-read', ['only' => ['get', 'all']]);
        $this->middleware('permission:client-delete', ['only' => ['remove', 'removePaymentScreenshot']]);
        $this->middleware('permission:freelancer-data-write', ['only' => ['assignClientToFreelancer', 'removePaymentScreenshot']]);
        $this->middleware('permission:client-demat-read', ['only' => ['clientDematAccount', "get"]]);
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
	public function getMutualFundClient(){
		return ClientServices::getMutualFundClient();
	}
	public function getUnlistedSharesClient(){
		return ClientServices::getUnlistedSharesClient();
	}
	public function getInsuranceClients(){
		return ClientServices::getInsuranceClients();
	}
    // create client form
    public function createClientForm(){
        $getLastSGNo = ClientDemat::select("serial_number")->orderBy("id", "DESC")->first();

		if(!empty($getLastSGNo)) {
			$newSGNo = $getLastSGNo->serial_number;
		} else {
			$newSGNo = "000";
		}

		$getLastSTNo = ClientDemat::select("serial_number")->orderBy("id", "DESC")->first();

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
        $clientData = ClientServices::getClientUsingMobileNo($request->number,$request->client_type);
        if(empty($clientData)) {
            $client = ClientServices::create($request);
            if ($request->form_type == "channelPartner") {
                return Redirect::route("channelPartnerUserData")->with("info", "Client have been created");
            } else {
                return Redirect::route("clients")->with("info", "Client have been created");
            }
        }else{
            CommonService::throwError("Account is already exits with this mobile number");
        }
    }
    // read client
    public function get(Request $request,$id){
        $client =  ClientServices::get($id);
        if(!$client)
			return response(["info" =>"Client not found"], 200, ["Content-Type" => "Application/json"]);
		if($request->ajax()){
			return response($client,200, ["Content-Type" => "Application/json"]);
		}
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
    // remove client pancard image
    public function removeDematePancard($client_id,$pancard_id){
        ClientServices::removeDematePancard($pancard_id);
        return Redirect::route("updateClientForm", $client_id)->with("info","Pancard Removed");
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

		//$traders = UserServices::getByRole('trader');
        $users = User::get();
        $userIdArray = [];
        foreach ($users as $userData){
            $permission = json_decode($userData->permission,true);
            if(!empty($permission)) {
                if (in_array("trader-read", $permission) ||
                    in_array("trader-write", $permission) ||
                    in_array("trader-create", $permission) ||
                    in_array("trader-delete", $permission)) {
                    $userIdArray[] = $userData->id;
                }
            }
        }
        $traders = User::wherein('id',$userIdArray)->get();

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
            }elseif($request->form_type== "back"){
				return Redirect::back()->with("info", "Client demat account update successful");
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
		if($request->ajax()){
			return true;
		} else if ($request->status == "holding" || $request->status == "problem") {
			return Redirect::back()->with("info", "status change successfully.");
        }else{
            return true;
        }
    }

    // set up
    public function setup(){
        $dematAccount = ClientServices::getClientForSetUp();

		//$traders = UserServices::getByRole('trader');
        $users = User::get();
        $userIdArray = [];
        foreach ($users as $userData){
            $permission = json_decode($userData->permission,true);
            if(!empty($permission)) {
                if (in_array("trader-read", $permission) ||
                    in_array("trader-write", $permission) ||
                    in_array("trader-create", $permission) ||
                    in_array("trader-delete", $permission)) {
                    $userIdArray[] = $userData->id;
                }
            }
        }
        $traders = User::wherein('id',$userIdArray)->get();

        $freelancerAms =  User::where("user_type",4)->get();
        $freelancerPrime =  User::where("user_type",5)->get();

        return view("calls.setup",compact('dematAccount','traders','freelancerAms','freelancerPrime'));
    }

	public function getPreferredAccountData(Request $request)
	{
		if ($request->ajax())
		{
			$auth_user = Auth::user();

			$makeAsPreferred = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
													where("client_demat.is_make_as_preferred",1)->
													where("client_demat.freelancer_id",0)->
													select('client_demat.*','clients.name')->get();

			$data_arr = array();
			foreach($makeAsPreferred as $data)
			{
				$datetime1 = strtotime($data->created_at);
				$datetime2 = strtotime(date("Y-m-d"));
				$days = (int)(($datetime2 - $datetime1)/86400);

				$tempData = array(
					'id' => $data->id,
					'name' => $data->name,
					'service_type' => $data->service_type,
					'serial_number' => $data->st_sg."-".$data->serial_number,
					'holder_name' => $data->holder_name,
					'available_balance' => $data->available_balance,
					'pl' => $data->pl,
					'days' => $days,
					'action' => ""
				);
				array_push($data_arr, $tempData);
			}

            return Datatables::of($data_arr)
				->addIndexColumn()
				->addColumn('action', function($row){
					$btn = "";

					$btn .= '<a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
						<span class="svg-icon svg-icon-5 m-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
							</svg>
						</span>
					</a>';

					$btn .= '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">';
						if (Auth::user()->can('setup-write'))
						{
							$btn .= '<div class="menu-item px-3">
								<a href="javascript:void(0)" data-id="'.$row['id'].'" data-name="'.$row['name'].'" data-holder="'.$row['holder_name'].'" class="menu-link px-3 editDematAccount">Update Status</a>
							</div>
							<div class="menu-item px-3">
								<a href="javascript:void(0)" data-id="'.$row['id'].'" class="menu-link px-3 makeAsPreferred" data-value="0">Remove as Preferred</a>
							</div>
							<div class="menu-item px-3">
								<a href="javascript:void(0)" data-id="'.$row['id'].'" data-clname="'.$row['name'].'" data-name="'.$row['holder_name'].'" class="menu-link px-3 assignTrader">Assign Trader</a>
							</div>
							<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$row['id'].'" data-name="'.$row['name'].'" data-holder="'.$row['holder_name'].'" data-service="'.$row['service_type'].'" class="menu-link px-3 assignFreelancer">Assign Freelancer</a>
							</div>
							<div class="menu-item px-3">
								<a href="javascript:void(0)" data-id="'.$row['id'].'" class="menu-link px-3 loginInfo">Login Info</a>
							</div>';
						}
					$btn .= '</div>';

                    return $btn;
                })
				->rawColumns(['action'])
                ->make(true);
        }
	}

	public function getNormalAccountData(Request $request)
	{
		if ($request->ajax())
		{
			$auth_user = Auth::user();
			$service_type = $request->service_type;

			if($service_type != "") {
				$normalAccount = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
												where("client_demat.service_type",$service_type)->
												where("client_demat.is_make_as_preferred",0)->
												where("client_demat.freelancer_id",0)->
												select('client_demat.*','clients.name')->get();
			} else {
				$normalAccount = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
												where("client_demat.is_make_as_preferred",0)->
												where("client_demat.freelancer_id",0)->
												select('client_demat.*','clients.name')->get();
            }

			$data_arr = array();
			foreach($normalAccount as $data)
			{
				$datetime1 = strtotime($data->created_at);
				$datetime2 = strtotime(date("Y-m-d"));
				$days = (int)(($datetime2 - $datetime1)/86400);

				$tempData = array(
					'id' => $data->id,
					'name' => $data->name,
					'service_type' => $data->service_type,
					'serial_number' => $data->st_sg."-".$data->serial_number,
					'holder_name' => $data->holder_name,
					'available_balance' => $data->available_balance,
					'pl' => $data->pl,
					'days' => $days,
					'action' => ""
				);
				array_push($data_arr, $tempData);
			}

            return Datatables::of($data_arr)
				->addIndexColumn()
				->addColumn('action', function($data){
					$btn = "";

					$btn .= '<a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
						<span class="svg-icon svg-icon-5 m-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
							</svg>
						</span>
					</a>';

					$btn .= '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">';
						if (Auth::user()->can('setup-write'))
						{
							$btn .= '<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-name="'.$data['name'].'" data-holder="'.$data['holder_name'].'" class="menu-link px-3 editDematAccount">Update Status</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" class="menu-link px-3 makeAsPreferred" data-value="1">Make as Preferred</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-clname="'.$data['name'].'" data-name="'.$data['holder_name'].'" class="menu-link px-3 assignTrader">Assign Trader</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-name="'.$data['name'].'" data-holder="'.$data['holder_name'].'" data-service="'.$data['service_type'].'" class="menu-link px-3 assignFreelancer">Assign Freelancer</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" class="menu-link px-3 loginInfo">Login Info</a>
								</div>';
						}
					$btn .= '</div>';

                    return $btn;
                })
				->rawColumns(['action'])
                ->make(true);
        }
	}

	public function getHoldingData(Request $request)
	{
		if ($request->ajax())
		{
			$auth_user = Auth::user();

			$normalAccount = ClientDemat::joinSub('select client_demate_id,count(*) as no_of_holding from calls group by client_demate_id', 'totalCalls', 'client_demat.id', '=', 'totalCalls.client_demate_id', 'left')
										->leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
										where("client_demat.account_status","holding")->
										select('client_demat.*','clients.name','totalCalls.no_of_holding')->get();

			$data_arr = array();
			foreach($normalAccount as $data)
			{
				$datetime1 = strtotime($data->created_at);
				$datetime2 = strtotime(date("Y-m-d"));
				$days = (int)(($datetime2 - $datetime1)/86400);

				$tempData = array(
					'id' => $data->id,
					'name' => $data->name,
					'service_type' => $data->service_type,
					'serial_number' => $data->st_sg."-".$data->serial_number,
					'holder_name' => $data->holder_name,
					'no_of_holding' => (isset($data->no_of_holding) && $data->no_of_holding > 0) ?  $data->no_of_holding : 0,
					'available_balance' => $data->available_balance,
					'pl' => $data->pl,
					'days' => $days,
					'action' => ""
				);
				array_push($data_arr, $tempData);
			}

            return Datatables::of($data_arr)
				->addIndexColumn()
				->addColumn('action', function($data){
					$btn = "";

					$btn .= '<a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
						<span class="svg-icon svg-icon-5 m-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
							</svg>
						</span>
					</a>';

					$btn .= '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">';
						if (Auth::user()->can('setup-write'))
						{
							$btn .= '<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" class="menu-link px-3 viewDematHolding" data-value="holding">View Positions</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-name="'.$data['name'].'" data-holder="'.$data['holder_name'].'" class="menu-link px-3 editDematAccount">Update Status</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" class="menu-link px-3 makeAsPreferred" data-value="1">Make as Preferred</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-clname="'.$data['name'].'" data-name="'.$data['holder_name'].'" class="menu-link px-3 assignTrader">Assign Trader</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-name="'.$data['name'].'" data-holder="'.$data['holder_name'].'" data-service="'.$data['service_type'].'" class="menu-link px-3 assignFreelancer">Assign Freelancer</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" class="menu-link px-3 loginInfo">Login Info</a>
								</div>';
						}
					$btn .= '</div>';

                    return $btn;
                })
				->rawColumns(['action'])
                ->make(true);
        }
	}

	public function getAllAcountData(Request $request)
	{
		if ($request->ajax())
		{
			$auth_user = Auth::user();
			$allotment_type = $request->allotment_type;

			if($allotment_type != "") {

				if($allotment_type == 1) {
					$allAccount = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
												where("client_demat.trader_id",">",0)->
												where("client_demat.account_status","!=","problem")->
												where("client_demat.account_status","!=","renew")->
												where("client_demat.is_make_as_preferred",0)->
												select('client_demat.*','clients.name')->get();
				} else {
					$allAccount = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
												where("client_demat.freelancer_id",">",0)->
												where("client_demat.account_status","!=","problem")->
												where("client_demat.account_status","!=","renew")->
												where("client_demat.is_make_as_preferred",0)->
												select('client_demat.*','clients.name')->get();
				}
			} else {
				$allAccount = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
											where("client_demat.account_status","!=","problem")->
											where("client_demat.account_status","!=","renew")->
											where("client_demat.is_make_as_preferred",0)->
											select('client_demat.*','clients.name')->get();
			}

			$data_arr = array();
			foreach($allAccount as $data)
			{
				$datetime1 = strtotime($data->created_at);
				$datetime2 = strtotime(date("Y-m-d"));
				$days = (int)(($datetime2 - $datetime1)/86400);

				if($data->service_type == 1) {
					$serviceType = "PRIME";
				} else if($data->service_type == 2) {
					$serviceType = "AMS";
				}else{
					$serviceType = "PRIME NEXT";
				}

				$tempData = array(
					'id' => $data->id,
					'client_name' => $data->name,
					'service_type' => $data->service_type,
					'serial_number' => $data->st_sg."-".$data->serial_number,
					'holder_name' => $data->holder_name,
					'available_balance' => $data->available_balance,
					'pl' => $data->pl,
					'serviceType' => $serviceType,
					'action' => ""
				);
				array_push($data_arr, $tempData);
			}

            return Datatables::of($data_arr)
				->addIndexColumn()
				->addColumn('action', function($data){
					$btn = "";

					$btn .= '<a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
						<span class="svg-icon svg-icon-5 m-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
							</svg>
						</span>
					</a>';

					$btn .= '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">';
						if (Auth::user()->can('setup-write'))
						{
							$btn .= '<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-name="'.$data['client_name'].'" data-holder="'.$data['holder_name'].'" class="menu-link px-3 editDematAccount">Update Status</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" class="menu-link px-3 makeAsPreferred" data-value="1">Make as Preferred</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-clname="'.$data['client_name'].'" data-name="'.$data['holder_name'].'" class="menu-link px-3 assignTrader">Assign Trader</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-name="'.$data['client_name'].'" data-holder="'.$data['holder_name'].'" data-service="'.$data['service_type'].'" class="menu-link px-3 assignFreelancer">Assign Freelancer</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" class="menu-link px-3 loginInfo">Login Info</a>
								</div>';
						}
					$btn .= '</div>';

                    return $btn;
                })
				->rawColumns(['action'])
                ->make(true);
        }
	}

	public function getTraderAcountData(Request $request)
	{
		if ($request->ajax())
		{
			$auth_user = Auth::user();

			$trderAccount = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
										leftJoin('users', 'client_demat.trader_id', '=', 'users.id')->
										where("client_demat.trader_id","!=",0)->
										select('client_demat.*','clients.name','users.name as trader_name')->get();

			$data_arr = array();
			foreach($trderAccount as $data)
			{
				$datetime1 = strtotime($data->created_at);
				$datetime2 = strtotime(date("Y-m-d"));
				$days = (int)(($datetime2 - $datetime1)/86400);

				$tempData = array(
					'id' => $data->id,
					'name' => $data->name,
					'service_type' => $data->service_type,
					'serial_number' => $data->st_sg."-".$data->serial_number,
					'holder_name' => $data->holder_name,
					'trader_name' => $data->trader_name,
					'available_balance' => $data->available_balance,
					'pl' => $data->pl,
					'days' => $days,
					'action' => ""
				);
				array_push($data_arr, $tempData);
			}

            return Datatables::of($data_arr)
				->addIndexColumn()
				->addColumn('action', function($data){
					$btn = "";

					$btn .= '<a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
						<span class="svg-icon svg-icon-5 m-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
							</svg>
						</span>
					</a>';

					$btn .= '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">';
						if (Auth::user()->can('setup-write'))
						{
							$btn .= '<div class="menu-item px-3">
										<a href="javascript:void(0)" data-id="'.$data['id'].'" data-name="'.$data['name'].'" data-holder="'.$data['holder_name'].'" class="menu-link px-3 editDematAccount">Update Status</a>
									</div>
									<div class="menu-item px-3">
										<a href="javascript:void(0)" data-id="'.$data['id'].'" class="menu-link px-3 makeAsPreferred" data-value="1">Make as Preferred</a>
									</div>
									<div class="menu-item px-3">
										<a href="javascript:void(0)" data-id="'.$data['id'].'" data-clname="'.$data['name'].'" data-name="'.$data['holder_name'].'" class="menu-link px-3 assignTrader">Assign Trader</a>
									</div>
									<div class="menu-item px-3">
										<a href="javascript:void(0)" data-id="'.$data['id'].'" data-name="'.$data['name'].'" data-holder="'.$data['holder_name'].'" data-service="'.$data['service_type'].'" class="menu-link px-3 assignFreelancer">Assign Freelancer</a>
									</div>

									<div class="menu-item px-3">
										<a href="javascript:void(0)" data-id="'.$data['id'].'" class="menu-link px-3 loginInfo">Login Info</a>
									</div>';
						}
					$btn .= '</div>';

                    return $btn;
                })
				->rawColumns(['action'])
                ->make(true);
        }
	}

	public function getFreelancerAccountData(Request $request)
	{
		if ($request->ajax())
		{
			$auth_user = Auth::user();

			$freelancerAccount = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
										leftJoin('users', 'client_demat.freelancer_id', '=', 'users.id')->
										where("client_demat.freelancer_id","!=",0)->
										select('client_demat.*','clients.name','users.name as freelancer_name')->get();

			$data_arr = array();
			foreach($freelancerAccount as $data)
			{
				$datetime1 = strtotime($data->created_at);
				$datetime2 = strtotime(date("Y-m-d"));
				$days = (int)(($datetime2 - $datetime1)/86400);

				$tempData = array(
					'id' => $data->id,
					'name' => $data->name,
					'service_type' => $data->service_type,
					'serial_number' => $data->st_sg."-".$data->serial_number,
					'holder_name' => $data->holder_name,
					'freelancer_name' => $data->freelancer_name,
					'available_balance' => $data->available_balance,
					'pl' => $data->pl,
					'days' => $days,
					'action' => ""
				);
				array_push($data_arr, $tempData);
			}

            return Datatables::of($data_arr)
				->addIndexColumn()
				->addColumn('action', function($data){
					$btn = "";

					$btn .= '<a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
						<span class="svg-icon svg-icon-5 m-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
							</svg>
						</span>
					</a>';

					$btn .= '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">';
						if (Auth::user()->can('setup-write'))
						{
							$btn .= '<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-name="'.$data['name'].'" data-holder="'.$data['holder_name'].'" class="menu-link px-3 editDematAccount">Update Status</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" class="menu-link px-3 makeAsPreferred" data-value="1">Make as Preferred</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-clname="'.$data['name'].'" data-name="'.$data['holder_name'].'" class="menu-link px-3 assignTrader">Assign Trader</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-name="'.$data['name'].'" data-holder="'.$data['holder_name'].'" data-service="'.$data['service_type'].'" class="menu-link px-3 assignFreelancer">Assign Freelancer</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" class="menu-link px-3 loginInfo">Login Info</a>
								</div>';
						}
					$btn .= '</div>';

                    return $btn;
                })
				->rawColumns(['action'])
                ->make(true);
        }
	}

	public function getUnallotedData(Request $request)
	{
		if ($request->ajax())
		{
			$auth_user = Auth::user();

			$unallotedAccount = ClientDemat::leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
											where("client_demat.freelancer_id","==",0)->
											where("client_demat.trader_id","==",0)->
											select('client_demat.*','clients.name')->get();

			$data_arr = array();
			foreach($unallotedAccount as $data)
			{
				$datetime1 = strtotime($data->created_at);
				$datetime2 = strtotime(date("Y-m-d"));
				$days = (int)(($datetime2 - $datetime1)/86400);

				$tempData = array(
					'id' => $data->id,
					'name' => $data->name,
					'service_type' => $data->service_type,
					'serial_number' => $data->st_sg."-".$data->serial_number,
					'holder_name' => $data->holder_name,
					'capital' => $data->capital,
					'created_at' => $data->created_at->format('d-m-Y'),
					'action' => ""
				);
				array_push($data_arr, $tempData);
			}

            return Datatables::of($data_arr)
				->addIndexColumn()
				->addColumn('action', function($data){
					$btn = "";

					$btn .= '<a href="javascript:;" class="dropdown-toggle1 btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
						<span class="svg-icon svg-icon-5 m-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
							</svg>
						</span>
					</a>';

					$btn .= '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-auto py-4 min-w-125px" data-kt-menu="true">';
						if (Auth::user()->can('setup-write'))
						{
							$btn .= '<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-name="'.$data['name'].'" data-holder="'.$data['holder_name'].'" class="menu-link px-3 editDematAccount">Update Status</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" class="menu-link px-3 makeAsPreferred" data-value="1">Make as Preferred</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-clname="'.$data['name'].'" data-name="'.$data['holder_name'].'" class="menu-link px-3 assignTrader">Assign Trader</a>
								</div>
								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" data-name="'.$data['name'].'" data-holder="'.$data['holder_name'].'" data-service="'.$data['service_type'].'" class="menu-link px-3 assignFreelancer">Assign Freelancer</a>
								</div>

								<div class="menu-item px-3">
									<a href="javascript:void(0)" data-id="'.$data['id'].'" class="menu-link px-3 loginInfo">Login Info</a>
								</div>';
						}
					$btn .= '</div>';

                    return $btn;
                })
				->rawColumns(['action'])
                ->make(true);
        }
	}

	public function getCloseCallData(Request $request)
	{
		if ($request->ajax())
		{
			$auth_user = Auth::user();
			$filterDate = $request->start_date;
			$monitorData = MonitorDataServices::all($auth_user->id,$filterDate);

			$data_arr = array();
			foreach($monitorData['close'] as $monitor)
			{
				$tempData = array(
					'id' => $monitor->id,
					'script_name' => $monitor->script_name,
					'exit_price' => $monitor->exit_price - $monitor->entry_price,
					'sl_status' => $monitor->sl_status,
					'action' => ""
				);
				array_push($data_arr, $tempData);
			}

            return Datatables::of($data_arr)
				->addIndexColumn()
				->addColumn('action', function($row){
					$btn = "";

					if (Auth::user()->can('monitor-write')) {
						$btn .= '<a data-monitor_id="'.$row['id'].'" data-call_type="closeCall" class="editCall menu-link p-1" title="Edit call">
									<i class="fa fa-edit text-dark fa-2x"></i>
								</a>';
					}
					if (Auth::user()->can('monitor-delete')) {
						$btn .= '<a data-monitor_id="'.$row['id'].'" class="menu-link p-1 deleteCall" title="Delete call">
									<i class="fa fa-trash text-dark fa-2x"></i>
								</a>';
					}
                    return $btn;
                })
				->rawColumns(['action'])
                ->make(true);
        }
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
	public function clientDematAccountStatus(){
		$actives = ClientServices::active();
		$demats = ClientDemateServices::active();
        $preRenewAccounts = renewalStatusService::preRenewAccounts();
		$toRenews = ClientDemateServices::toRenews();
		$problemAccounts = ClientDemateServices::problemAccounts();
		$allAccounts = ClientDemateServices::allAccounts();

		$terminatedAccounts = ClientDemateServices::terminatedAccounts();

		$dematAccount = TraderServices::traderClientList(auth()->user()->id);

		$analysts = Analyst::where("status", "Active")->orWhere("status", "Experiment")->get();
		$keywords = KeywordServices::all();

		$users = User::get();
		$userIdArray = [];
		foreach ($users as $userData) {
			$permission = json_decode($userData->permission, true);
			if (!empty($permission)) {
				if (
					in_array("trader-read", $permission) ||
					in_array("trader-write", $permission) ||
					in_array("trader-create", $permission) ||
					in_array("trader-delete", $permission)
				) {
					$userIdArray[] = $userData->id;
				}
			}
		}
		$traders = User::wherein('id', $userIdArray)->get();
		return view("clients.client-status", compact('analysts','keywords','traders','actives', 'demats', 'toRenews', 'problemAccounts', 'allAccounts', 'terminatedAccounts','preRenewAccounts'));
	}
	public function viewDematProblem(Request $request){
		$dematAccount = ClientServices::getDemat($request->id);
		return response($dematAccount,200, ["Content-Type" => "Application/json"]);
	}
	public function issueWithDematAccount(Request $request){
		$dematAccount = ClientServices::issueWithDematAccount($request->id);
		return response($dematAccount,200, ["Content-Type" => "Application/json"]);
	}
	public function dematAccountRestore(Request $request){
		ClientServices::dematAccountRestore($request->id);
		return response(["info" =>"Account Restored"],200, ["Content-Type" => "Application/json"]);
	}
	public function clientDematActivated(Request $request){
		ClientServices::clientDematActivated($request->id);
		return response(["info" => "Account Activated"], 200, ["Content-Type" => "Application/json"]);
	}
	public function terminateClient(Request $request){
		ClientServices::terminateClient($request);
		return response(["info" => "Account Terminated"], 200, ["Content-Type" => "Application/json"]);
	}
	public function viewLedger($id){
		$client_demates = ClientServices::viewLedger($id);
		return view("clients.ledger",compact("client_demates"));
	}
	public function generatePdf($id){
		$client_demates = ClientServices::generatePdf($id);
		$client =  ClientServices::get($id);
		$pdf = PDF::loadView('pdf', compact('client_demates'));
		PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
		return $pdf->download('Ledger of '. $client->name .'.pdf');
	}
	public function generateDoc($id){
		$client_demates = ClientServices::generatePdf($id);
		$client =  ClientServices::get($id);

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();

        $section->addText("Sr No");
        $section->addText("Joining Date");
        $section->addText("End Date");
        $section->addText("No. Days");
        $section->addText("Profit");
        $section->addText("Fees");
        $section->addText("Net Profit");

		foreach ($client_demates as $client_demate){
			$section->addText($client_demate->serial_number);
			$section->addText(date("Y-m-d",strtotime($client_demate->joining_date)));
			$section->addText(($client_demate->end_date)?date("Y-m-d",strtotime($client_demate->end_date)):"-");
			$section->addText(round((time() - strtotime($client_demate->joining_date)) / (60 * 60 * 24)));
			$section->addText($client_demate->profit);
			$section->addText($client_demate->fees);
			$section->addText($client_demate->net_profit);
		}
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(''. $client->name .'.docx');
        return response()->download(public_path('' . $client->name . '.docx'));
	}
}
