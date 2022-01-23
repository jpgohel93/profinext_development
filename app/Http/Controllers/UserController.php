<?php

namespace App\Http\Controllers;

use App\Services\RoleServices;
use Illuminate\Http\Request;
use App\Services\UserServices;
use Illuminate\Support\Facades\Redirect;

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
}
