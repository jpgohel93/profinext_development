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
        RoleServices::roles($request);
    }

    public static function permissions(){
        $permissions = Permission::get();
        return view('create-roles',compact('permissions'));
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
    public static function roles($request){
        $roles = Role::orderBy('id','DESC')->get();
        return view('roles',compact('roles'));
    }
}
