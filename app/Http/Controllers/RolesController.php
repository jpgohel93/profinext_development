<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleServices;

class RolesController extends Controller
{
    public function create(Request $request){
        return $role = RoleServices::create($request);
    }
    public function view(Request $request){
        return RoleServices::roles($request);
    }
    public function roles(Request $request)
    {
        $permissions = RoleServices::roles($request);
        return view("create-roles", ["permissions" => $permissions]);
    }
    public function addRolesForm(Request $request){
        return RoleServices::permissions();
    }
    public function createRole(Request $request){
        return RoleServices::create($request);
    }
    public static function editRoleForm(Request $request,$id){
        $role = RoleServices::get($id);
        $permissions = RoleServices::permissionsByRole($id);
        return view("roles.edit", ["role" => $role,"rolePermissions" => $permissions,"permissions"=>RoleServices::permissions()]);
    }
    public function editRole(Request $request,$id){
        $role = RoleServices::update($request,$id);
        $request->session()->flash("info","Role updated successfully");
        return RolesController::editRoleForm($request,$id);
    }
}
