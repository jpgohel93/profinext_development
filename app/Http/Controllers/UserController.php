<?php

namespace App\Http\Controllers;

use App\Services\RoleServices;
use Illuminate\Http\Request;
use App\Services\UserServices;
use Illuminate\Support\Facades\Redirect;
use App\Services\AccountTypeServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-create', ['only' => ['createForm', 'create']]);
        $this->middleware('permission:user-write', ['only' => ['updateForm', 'update']]);
        $this->middleware('permission:user-read', ['only' => ['all', 'view']]);
        $this->middleware('permission:user-delete', ['only' => ['delete']]);
    }
    public function all(){
        $users = UserServices::all();
        return view("users.list",["users"=>$users]);
    }
    public function create(Request $request){
        $user = UserServices::create($request);
        return Redirect::route("users")->with("info","User Created!");
    }
    public function view(Request $request,$id){
        $user = UserServices::user($id);
        return !$user? Redirect::route("users")->with("info", "User not found")
        : view("users.view", ["user" => $user]);
    }
    public function createForm(){
       $roles = RoleServices::all();
       $account_types = AccountTypeServices::view(['id', 'account_type']);
       return view("users.index",["roles"=>$roles,"account_types"=>$account_types]);
    }
    public function updateForm($id){
        $user = UserServices::user($id);
        if (!$user)
            return Redirect::route("users")->with("info", "User not found");
        $roles = RoleServices::all();
        $account_types = AccountTypeServices::view(['id', 'account_type']);
        return view("users.edit",["user"=>$user,"roles"=>$roles,"account_types"=>$account_types]);
    }
	
    public function assignTraderRoles(Request $request)
	{
		$userId = $request->userId;
		$user = UserServices::user($userId);
        if (!$user)
            return Redirect::route("users")->with("info", "User not found");
		
		if($user->role != "") {
			$user_data['role'] = $user->role.",trader";
		} else {
			$user_data['role'] = "trader";
		}
		
		$user_data['updated_by'] = Auth::id();
		User::where("id",$userId)->update($user_data);
		
		$userData = User::find($userId);
		$exp = explode(",", $userData->role);
        $userData->syncRoles($exp);
		
		return Redirect::route("viewTrader")->with("info","User Updated!");
	}
	
	public function update(Request $request,$id){
        $request['company_first'] = isset($request->company_1) ? 1 : 0;
        $request['profit_percentage_first'] = isset($request->profit_company_1) ? $request->profit_company_1 : null;
        $request['company_second'] = isset($request->company_2) ? 1 : 0;
        $request['profit_percentage_second'] = isset($request->profit_company_2) ? $request->profit_company_2 : null;
        $request['ams_new_client_percentage'] = isset($request->ams_new_client_percentage) ? $request->ams_new_client_percentage : null;
        $request['ams_renewal_client_percentage'] = isset($request->ams_renewal_client_percentage) ? $request->ams_renewal_client_percentage : null;
        $request['prime_new_client_percentage'] = isset($request->prime_new_client_percentage) ? $request->prime_new_client_percentage : null;
        $request['prime_renewal_client_percentage'] = isset($request->prime_renewal_client_percentage) ? $request->prime_renewal_client_percentage : null;
        $request['ams_limit'] = isset($request->limit) ? $request->limit : null;
        $request['fees_percentage'] = isset($request->fees_percentage) ? $request->fees_percentage : null;
        unset($request["profit_company_1"]);
        unset($request["profit_company_2"]);
        unset($request["company_1"]);
        unset($request["company_2"]);
        unset($request["limit"]);
        $user = UserServices::update($request,$id);
        if (!$user)
            return Redirect::route("users")->with("info", "Unable to update user");
        return Redirect::route("users")->with("info","User Updated!");
    }
    public function delete(Request $request,$id){
        $user = UserServices::delete($id);
        return Redirect::route("users")->with("info","User Terminated!");
    }
}
