<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleServices;

class RolesController extends Controller
{
    public function create(Request $request){
        return $role = RoleServices::create($request);
    }
    public static function view(Request $request){
        return RoleServices::roles($request);
    }
    public static function roles(Request $request)
    {
        $permissions = RoleServices::roles($request);
        return view("create-roles", ["permissions" => $permissions]);
    }
    public static function addRolesForm(Request $request){
        return RoleServices::permissions();
    }
    public static function createRole(Request $request){
        return RoleServices::create($request);
    }
}
