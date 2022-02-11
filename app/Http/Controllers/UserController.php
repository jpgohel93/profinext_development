<?php

namespace App\Http\Controllers;

use App\Services\RoleServices;
use Illuminate\Http\Request;
use App\Services\UserServices;
use Illuminate\Support\Facades\Redirect;
use App\Services\AccountTypeServices;
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
    public function update(Request $request,$id){
        $user = UserServices::update($request,$id);
        if (!$user)
            return Redirect::route("users")->with("info", "Unable to update user");
        return Redirect::route("viewUser",$id)->with("info","User Updated!");
    }
    public function delete(Request $request,$id){
        $user = UserServices::delete($id);
        return Redirect::route("users")->with("info","User Terminated!");
    }
}
