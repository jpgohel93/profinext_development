<?php

namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleServices
{
    public static function create($request)
    {
        $role = $request->validate([
            'role' => 'required|alpha_spaces|unique:roles,name'
        ]);
        $permissions = $request->validate([
            'permission' => 'required|array'
        ]);

        try {
            $role = Role::create(['name' => isset($role['role']) ? $role['role'] : '']);
            return $role->syncPermissions($permissions);
        } catch (\Throwable $th) {
            CommonService::throwError("Unable to create Role");
        }
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
        $role = Role::where("id",$id)->first();
        return ($role)?$role: CommonService::throwError("Role not found");
    }
    public static function permissionsByRole($id){
        $role = Role::where("id",$id)->first();
        return $role->permissions->pluck("id")->toArray();
    }
    public static function update($request,$id){
        $permissions = $request->validate([
            "permission" => "required|array"
        ],
            ["permission.required" => "Please select atleast one permission to edit or create role"]
        );
        try {
            $role = RoleServices::get($id);
            if(!$role)
                return false;
            // revoke permissions
            $role->revokePermissionTo($role->permissions);
            // grant permissions
            foreach($permissions as $permission){
                $role->givePermissionTo($permission);
            }
        } catch (\Throwable $th) {
            CommonService::throwError("Unable to update this role");
        }

    }
}
