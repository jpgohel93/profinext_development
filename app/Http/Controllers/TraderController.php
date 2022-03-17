<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Services\TraderServices;
use App\Models\User;

class TraderController extends Controller
{
    private $viewTrader = "viewTrader";
    function __construct()
    {
        $this->middleware('permission:trader-create', ['only' => ['create']]);
        $this->middleware('permission:trader-write', ['only' => ['edit']]);
        $this->middleware('permission:trader-read', ['only' => ['view', 'get','view_trader_client','getTraderList','viewTraderClientList']]);
        $this->middleware('permission:trader-delete', ['only' => ['remove', 'removePaymentScreenshot']]);
    }
    public function view()
    {
        $traders = TraderServices::view();

		$users = User::where("status","1")->where(function($q) {
						$q->whereRaw("!FIND_IN_SET(?, role)", ["super-admin"])
						->whereRaw("!FIND_IN_SET(?, role)", ["admin"])
						->whereRaw("!FIND_IN_SET(?, role)", ["trader"])
						->orWhere('role', NULL);
                    })->get();

		//->where("role",NULL)->whereRaw("!FIND_IN_SET(?, role)", ["super-admin"])->whereRaw("!FIND_IN_SET(?, role)", ["admin"])->whereRaw("!FIND_IN_SET(?, role)", ["trader"])->get();

        return view('trader.index', compact('traders','users'));
    }
    public function create(Request $request)
    {
        TraderServices::create($request);
        return Redirect::route($this->viewTrader)->with("info", "Client Assinged");
    }
    public function remove(Request $request, $id)
    {
        TraderServices::remove($id);
        return Redirect::route($this->viewTrader)->with("info", "Client Removed from trader!");
    }
    public function get(Request $request)
    {
        $type = TraderServices::get($request->id);
        return Response($type)->header('Content-Type', "application/json");
    }
    public function edit(Request $request)
    {
        TraderServices::edit($request);
        return Redirect::route($this->viewTrader)->with("info", "Trader Updated!");
    }

    public function viewTraderAccounts()
    {
        $auth_user = Auth::user();

        $dematAccount = TraderServices::traderClientList($auth_user->id);
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

        return view('trader.view_trader_client', compact('dematAccount','traders'));
    }

    public function getTraderList(){
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

        //$traders = UserServices::getByRole('trader');
        return  view('trader.trader_list', compact('traders'));;
    }

    public function viewTraderClientList(Request $request,$id)
    {
        $dematAccount = TraderServices::traderClientList($id);

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

        //$traders = UserServices::getByRole('trader');

        return view('trader.view_trader_client', compact('dematAccount','traders'));
    }

    public function viewTraderClient(Request $request)
    {
        $dematAccount = TraderServices::traderClientList($request->trader_id);

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

        //$traders = UserServices::getByRole('trader');

        return view('trader.view_trader_client', compact('dematAccount','traders'));
    }
}
