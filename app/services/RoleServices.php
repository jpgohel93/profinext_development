<?php

namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleServices
{
    public static function create($request)
    {
        foreach($request->all() as $module => $permissions){
            echo $module;
            if(is_array($permissions)){

                echo "<pre>";
                print_r($permissions);
                echo "</pre>";
                // foreach ($permissions as $permission_type => $permission) {
                //     echo $permission_type;
                // }
            }
        }
        dd($request->all());
        $role = Role::create(['name' => $request->role]);
        return UserServices::activeClients();
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
        return Role::all();
    }
}
