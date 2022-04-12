<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleServices;
use Illuminate\Support\Facades\Redirect;
use App\Services\CommonService;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-create', ['only' => ['createRole', 'addRolesForm']]);
        $this->middleware('permission:role-write', ['only' => ['editRoleForm', 'editRole']]);
        $this->middleware('permission:role-read', ['only' => ['view', 'getPermissions']]);
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
        $auth_user = Auth::user();
        $userRole = $auth_user->role;
        return view("roles.edit", ["role" => $role,"rolePermissions" => $permissions,"permissions"=>RoleServices::permissions(),"userRole" => $userRole]);
    }
    public function editRole(Request $request,$id){
        $role = RoleServices::update($request,$id);
        return Redirect::route('editRoleForm',$id)->with("info","Role updated successfully");
    }
    public function removeRole(Request $request,$id){
        RoleServices::remove($id);
        return Redirect::route("roles")->with("info","Role removed successfully");
    }
    public function getPermissions(Request $request,$role){
        $permissions = RoleServices::getPermissions($role);
        $allPermissions = RoleServices::permissions();
        return CommonService::ajaxResponse(200,["permissions"=>$permissions,"all_permissions"=>$allPermissions->toArray()],"success");
    }
    public function clearPermissionCache($fallback=false){
        RoleServices::clearPermissionCache($fallback);
        return Redirect::route("roles")->with("info","Permissions Cache Has been Cleared");
    }
}
