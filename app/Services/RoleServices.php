<?php

namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Services\LogServices;
class RoleServices
{
    public static function create($request)
    {
        $role = $request->validate([
            'role' => 'required|unique:roles,name'
        ]);
        $permissions = $request->validate([
            'permission' => 'required|array'
        ]);
        $user_name = auth()->user()->name;
        try {
            $role = Role::create(['name' => $role]);
            if($role){
                LogServices::logEvent(["desc"=>"Role $role->name created by $user_name"]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to create Role $role->name by $user_name","data"=>$role]);
            }
            return $role->syncPermissions($permissions);
        } catch (\Throwable $th) {
            LogServices::logEvent(["desc"=>"Unable to create Role $role->name by $user_name","data"=>$role]);
            CommonService::throwError("Unable to create Role");
        }
    }

    public static function permissions(){
        return Permission::get();
    }

    public static function remove($id)
    {
        $user_name = auth()->user()->name;
        $role = Role::where("id", $id)->first();
        $status = Role::where("id", $id)->forcedelete();
        if($status){
            LogServices::logEvent(['desc'=>"Role $role->role deleted by $user_name"]);
        }else{
            LogServices::logEvent(['desc'=>"Unable to delete Role $role->role by $user_name"]);
        }
    }
    public static function roles(){
        $roles = Role::orderBy('id','DESC')->get();
        foreach($roles as $index => $role){
            $roles[$index]["total"] = User::role($role->name)->count();
        }
        return $roles;
    }
    public static function all(){
        return Role::all();
    }
    public static function get($id){
        $role = Role::where("id",$id)->first();
        return ($role)?$role: CommonService::throwError("Role not found");
    }
    public static function getRoleByName($role){
        $role = Role::findByName($role);
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
        $user_name = auth()->user()->name;
        $roleName['name'] = $request->role;
        Role::where("id",$id)->update($roleName);
        LogServices::logEvent(["desc"=>"Role $request->role updated by $user_name"]);

        $role = RoleServices::get($id);
        if(!$role)
            return false;
        return $role->syncPermissions($permissions);
        // revoke permissions
        // $role->revokePermissionTo($role->permissions);
        // grant permissions
        // foreach($permissions as $permission){
            // $role->givePermissionTo($permission);
            // }
        // try {
        // } catch (\Throwable $th) {
        //     CommonService::throwError("Unable to update this role");
        // }

    }
    public static function getPermissions($role){
        $permissions = Role::findByName($role)->permissions->pluck("name");
        return $permissions->toArray();
    }
    // public static function clearPermissionCache($fallback){
    //     if($fallback){
    //         return self::permissionsFallBack();
    //     }
    //     $permissions = Role::findByName("super-admin")->permissions->pluck("name")->first();
    //     return Role::findByName("super-admin")->givePermissionTo($permissions);
    // }
    public static function permissionsFallBack()
    {
        $user = User::find(auth()->user()->id);
        return $user->syncPermissions(Permission::get());
    }
}
