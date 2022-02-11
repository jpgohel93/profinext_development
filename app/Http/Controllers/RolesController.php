<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleServices;
use Illuminate\Support\Facades\Redirect;
class RolesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-create', ['only' => ['createRole', 'addRolesForm']]);
        $this->middleware('permission:role-write', ['only' => ['editRoleForm', 'editRoleForm']]);
        $this->middleware('permission:role-read', ['only' => ['view', 'view']]);
        $this->middleware('permission:role-delete', ['only' => ['removeRole']]);
    }
    public function view(Request $request){
        $roles = RoleServices::roles($request);
        return view('roles.roles',compact('roles'));
    }
    public function addRolesForm(Request $request){
        $permissions = RoleServices::permissions();
        return view('roles.add',compact('permissions'));
    }
    public function createRole(Request $request){
        $role = RoleServices::create($request);
        return Redirect::route('roles')->with("info","Role created successfully");
    }
    public static function editRoleForm(Request $request,$id){
        $role = RoleServices::get($id);
        $permissions = RoleServices::permissionsByRole($id);
        return view("roles.edit", ["role" => $role,"rolePermissions" => $permissions,"permissions"=>RoleServices::permissions()]);
    }
    public function editRole(Request $request,$id){
        $role = RoleServices::update($request,$id);
        return Redirect::route('editRoleForm',$id)->with("info","Role updated successfully");
    }
    public function removeRole(Request $request,$id){
        RoleServices::remove($id);
        return Redirect::route("roles")->with("info","Role removed successfully");
    }
}
