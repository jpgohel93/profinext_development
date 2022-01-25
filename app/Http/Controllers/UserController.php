<?php

namespace App\Http\Controllers;

use App\Services\RoleServices;
use Illuminate\Http\Request;
use App\Services\UserServices;

class UserController extends Controller
{
    public static function clients(Request $request){
        $clients = UserServices::clients($request);
        return view("client",["clients"=>$clients]);
    }
    public static function all(){
        $users = UserServices::all();
        $roles = RoleServices::all();
        return view("users.index",["users"=>$users,"roles"=>$roles]);
    }
    public static function create(Request $request){
        $user = UserServices::create($request);
        return redirect()->route("users")->with("info","User Created!");
    }
    public static function view(Request $request,$id){
        $user = UserServices::user($id);
        return view("users.view",["user"=>$user]);
    }
    public static function updateForm($id){
        $user = UserServices::user($id);
        $roles = RoleServices::all();
        return view("users.edit",["user"=>$user,"roles"=>$roles]);
    }
    public static function update(Request $request,$id){
        $user = UserServices::update($request,$id);
        return redirect()->route("viewUser",$id)->with("info","User Updated!");
    }
}
