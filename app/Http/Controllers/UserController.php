<?php

namespace App\Http\Controllers;

use App\Services\RoleServices;
use Illuminate\Http\Request;
use App\Services\UserServices;

class UserController extends Controller
{
    public function all(){
        $users = UserServices::all();
        return view("users.list",["users"=>$users]);
    }
    public function create(Request $request){
        $user = UserServices::create($request);
        return redirect()->route("users")->with("info","User Created!");
    }
    public function view(Request $request,$id){
        $user = UserServices::user($id);
        return view("users.view",["user"=>$user]);
    }
    public function createForm(){
       $roles = RoleServices::all();
       return view("users.index",["roles"=>$roles]);
    }
    public function updateForm($id){
        $user = UserServices::user($id);
        $roles = RoleServices::all();
        return view("users.edit",["user"=>$user,"roles"=>$roles]);
    }
    public function update(Request $request,$id){
        $user = UserServices::update($request,$id);
        return redirect()->route("viewUser",$id)->with("info","User Updated!");
    }
    public function delete(Request $request,$id){
        $user = UserServices::delete($id);
        return redirect()->route("users")->with("info","User Terminated!");
    }
}
