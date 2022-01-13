<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleServices;

class RolesController extends Controller
{
    public function create(Request $request){
        $role = RoleServices::create($request);
        dd($role);
    }

    public static function roles(Request $request)
    {
        $roles = RoleServices::roles($request);
        return view("roles", ["roles" => $roles]);
    }
    public static function addRolesForm(Request $request){
        return view("create-roles",["modules"=>RoleServices::roles()]);
    }
    public static function createRole(Request $request){
        return RoleServices::create($request);
    }
}
