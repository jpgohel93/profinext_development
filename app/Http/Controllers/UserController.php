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
        return view("users.list",compact('users'));
    }
    public function create(Request $request){
        UserServices::create($request);
        return Redirect::route("users")->with("info","User Created!");
    }
    public function view($id){
        $user = UserServices::user($id);
        $rolePermissions = RoleServices::getPermissions($user->role);
        $permissions = RoleServices::permissions()->toArray();
        return !$user? Redirect::route("users")->with("info", "User not found")
        : view("users.view", compact("user","rolePermissions","permissions"));
    }
    public function createForm(){
       $roles = RoleServices::all();
       $account_types = AccountTypeServices::view(['id', 'account_type']);
       return view("users.index",compact("roles","account_types"));
    }
    public function updateForm($id){
        $user = UserServices::user($id);
        if (!$user)
            return Redirect::route("users")->with("info", "User not found");
        $roles = RoleServices::all();
        $account_types = AccountTypeServices::view(['id', 'account_type']);
        $permissions = $user->permissions->pluck("name")->toArray();
        $rolePermissions=array();
        if($user->role){
            $rolePermissions = RoleServices::getPermissions($user->role);
        }
        $all_permissions = RoleServices::permissions()->pluck("name")->toArray();
        $auth_user = Auth::user();
        $userRole = $auth_user->role;
        return view("users.edit",["user"=>$user,"roles"=>$roles,"account_types"=>$account_types,"permissions"=>$permissions,"rolePermissions"=>$rolePermissions,"all_permissions"=>$all_permissions,"userRole"=>$userRole]);
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
        if($request->user_type == "6"){
            $request['deleted_at'] = date('Y-m-d');
        }else{
            $request['deleted_at'] = null;
        }
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
        if(isset($request->password) && $request->password != ''){
            $request['password'] = Hash::make($request->password);
        }else{
            unset($request['password']);
        }
        $userRoles = implode(",", $request->role);
        unset($request["profit_company_1"]);
        unset($request["profit_company_2"]);
        unset($request["company_1"]);
        unset($request["company_2"]);
        unset($request["limit"]);
        // check permissions
        $direct_permissions=[];
        $role_permissions = [];
        if(isset($request->role) && trim($request->role[0])!="" && isset($request->permission)){
            // $role_permissions = RoleServices::getRoleByName($request->role[0]);
            // $role_permissions = $role_permissions->permissions->pluck('name')->toArray();
            $role_permissions = RoleServices::permissions()->pluck("name")->toArray();
            $direct_permissions = array_diff($role_permissions,$request->permission);
        }
        // revoke permissions
        $user = UserServices::user($id);
        $param = array();
        foreach($role_permissions as $permission){
            if(!in_array($permission,$direct_permissions)){
                array_push($param,$permission);
                // $user->givePermissionTo($permission);
            }
        }
        $user->syncPermissions($param);
        // dd($user->permissions);
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
