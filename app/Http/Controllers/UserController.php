<?php

namespace App\Http\Controllers;

use App\Services\RoleServices;
use Illuminate\Http\Request;
use App\Services\UserServices;
use Illuminate\Support\Facades\Redirect;
use App\Services\keywordAccountTypeServices;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-create', ['only' => ['createForm', 'create']]);
        $this->middleware('permission:user-write', ['only' => ['updateForm', 'update', "assignTraderRoles"]]);
        $this->middleware('permission:user-read', ['only' => ['all', 'view']]);
        $this->middleware('permission:user-delete', ['only' => ['delete']]);
    }
    public function all(){
        $partner  = UserServices::getByType(1);
        $employee = UserServices::getByType(2);
        $channelPartner = UserServices::getByType(3);
        $freelancerAMS = UserServices::getByType(4);
        $freelancerPrime = UserServices::getByType(5);
        $users = UserServices::all();
        return view("users.list",compact('users','partner','employee','channelPartner','freelancerAMS','freelancerPrime'));
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
       $account_types = keywordAccountTypeServices::all();
       return view("users.index",compact("roles","account_types"));
    }
    public function updateForm($id){
        $user = UserServices::user($id);
        if (!$user)
            return Redirect::route("users")->with("info", "User not found");
        $roles = RoleServices::all();
        $account_types = keywordAccountTypeServices::all();
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
        $user = UserServices::update($request,$id);
        if (!$user)
            return Redirect::route("users")->with("info", "Unable to update user");
        return Redirect::route("users")->with("info","User Updated!");
    }
    public function delete($id){
        UserServices::delete($id);
        return Redirect::route("users")->with("info","User Terminated!");
    }

}
