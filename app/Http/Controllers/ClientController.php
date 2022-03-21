<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ClientServices;
use App\Services\ProfessionServices;
use App\Services\BankDetailsServices;
use App\Services\BrokerServices;
use App\Services\CommonService;
use App\Services\UserServices;
use App\Services\PermissionServices;
use App\Models\ClientDemat;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Datatables;

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
        PermissionServices::has("client-read");
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
        PermissionServices::has("client-create");
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
        PermissionServices::has("client-read");
        $client =  ClientServices::get($id);
        if(!$client)
            CommonService::throwError("Client not found");
        return view("clients.view",compact('client'));
    }
    // edit client
    public function updateForm(Request $request,$id){
        PermissionServices::has("client-write");
        $client =  ClientServices::get($id);
        $professions = ProfessionServices::view(['id', 'profession']);
        $banks = BankDetailsServices::view(['id', 'bank']);
        $brokers = BrokerServices::view(['id', 'broker']);
        $channelPartner = UserServices::getByType(3);
        return view("clients.edit", compact('client','professions', 'banks', 'brokers','channelPartner'));
    }
    public function update(Request $request,$id){
        PermissionServices::has("client-write");
        $client =  ClientServices::update($request,$id);
        return Redirect::route("clientView",$id)->with("info","Client have been updated");
    }
    // remove client
    public function remove(Request $request,$id){
        PermissionServices::has("client-delete");
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

//		$traders = UserServices::getByRole('trader');
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
					/* $btn = '
					<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="svg-icon svg-icon-md">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
										<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>Export</button>
							<!--begin::Dropdown Menu-->
							<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
								<!--begin::Navigation-->
								<ul class="navi flex-column navi-hover py-2">
									<li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
									<li class="navi-item">
										<a href="#" class="navi-link">
											<span class="navi-icon">
												<i class="la la-print"></i>
											</span>
											<span class="navi-text">Print</span>
										</a>
									</li>
									<li class="navi-item">
										<a href="#" class="navi-link">
											<span class="navi-icon">
												<i class="la la-copy"></i>
											</span>
											<span class="navi-text">Copy</span>
										</a>
									</li>
									<li class="navi-item">
										<a href="#" class="navi-link">
											<span class="navi-icon">
												<i class="la la-file-excel-o"></i>
											</span>
											<span class="navi-text">Excel</span>
										</a>
									</li>
									<li class="navi-item">
										<a href="#" class="navi-link">
											<span class="navi-icon">
												<i class="la la-file-text-o"></i>
											</span>
											<span class="navi-text">CSV</span>
										</a>
									</li>
									<li class="navi-item">
										<a href="#" class="navi-link">
											<span class="navi-icon">
												<i class="la la-file-pdf-o"></i>
											</span>
											<span class="navi-text">PDF</span>
										</a>
									</li>
								</ul>
								<!--end::Navigation-->
							</div>
					'; */
					
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
}
