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
        return $role->syncPermissions($request->permission);
    }

    public static function permissions(){
        return Permission::get();
    }

    public static function remove($id)
    {
        return Role::where("id", $id)->forcedelete();
    }
    public static function roles(){
        return Role::orderBy('id','DESC')->get();
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
