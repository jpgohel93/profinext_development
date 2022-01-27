<?php

namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleServices
{
    public static function create($request)
    {
        $request->validate([
            'role' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('role')]);
        $role->syncPermissions($request->input('permission'));
        return RoleServices::roles($request);
    }

    public static function permissions(){
        return Permission::get();
        // return view('roles.add',compact('permissions'));
    }

    public static function revoke($request)
    {
        return UserServices::activeClients();
    }

    public static function assign()
    {
        return User::where("status", "1")->get();
    }

    public static function remove()
    {
        return User::where("status", "1")->get();
    }
    public static function roles(){
        $roles = Role::orderBy('id','DESC')->get();
        return view('roles.roles',compact('roles'));
    }
    public static function all(){
        return Role::all();
    }
    public static function get($id){
        return Role::where("id",$id)->first();
    }
    public static function permissionsByRole($id){
        $role = Role::where("id",$id)->first();
        return $role->permissions->pluck("id")->toArray();
    }
    public static function update($request,$id){
        $role = RoleServices::get($id);
        // revoke permissions
        $role->revokePermissionTo($role->permissions);
        // grant permissions
        foreach($request->permission as $perm){
            $role->givePermissionTo($perm);
        }
        return true;
    }
}
