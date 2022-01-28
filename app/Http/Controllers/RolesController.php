<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleServices;

class RolesController extends Controller
{
    public function view(Request $request){
        $roles = RoleServices::roles($request);
        return view('roles.roles',compact('roles'));
    }
    public function addRolesForm(Request $request){
        $permissions = RoleServices::permissions();
        return view('roles.add',compact('permissions'));
    }
    public function createRole(Request $request){
        RoleServices::create($request);
        return redirect()->route('roles')->with("info","Role created successfully");
    }
    public static function editRoleForm(Request $request,$id){
        $role = RoleServices::get($id);
        $permissions = RoleServices::permissionsByRole($id);
        return view("roles.edit", ["role" => $role,"rolePermissions" => $permissions,"permissions"=>RoleServices::permissions()]);
    }
    public function editRole(Request $request,$id){
        RoleServices::update($request,$id);
        return redirect()->route('editRoleForm',$id)->with("info","Role updated successfully");
    }
    public function removeRole(Request $request,$id){
        RoleServices::remove($id);
        return redirect()->route("roles")->with("info","Role removed successfully");
    }
}
