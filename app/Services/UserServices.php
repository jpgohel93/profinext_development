<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserNumbers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\keywordAccountTypeServices;
use App\Services\RoleServices;
class UserServices
{
    public static function clients()
    {
        return UserServices::activeClients();
    }

    public static function roles()
    {
        return UserServices::activeClients();
    }
    public static function activeClients(){
        return User::where("status","1")->get();
    }
    public static function all($role=null){
        if($role!==null){
            return User::where("role","LIKE",$role)->get();
        }
        return User::get();
    }
    public static function validateUsersData($data){
        $data->validate([
            "name"=>"required|alpha_spaces",
            "account_type"=>"required",
            "number"=>"required|array",
            "number.*"=>"numeric",
            "user_type"=>"required",
            "role"=>"required",
        ]);
        if($data->user_type=='2'){
            $data->validate([
                "salary"=>"required|numeric",
                "joining_date"=>"required|date"
            ]);
        }
    }
    public static function create($request){
        $request->flashExcept(["_token"]);
        $request->validate([
            "name"=>"required|alpha_spaces",
            "email"=>"required|email|unique:users,email",
            "password"=>"required",
            "number"=>"required|array",
            "number.*"=>"numeric|required",
            "user_type"=>"required",
            "salary"=> ($request->user_type == '2'?"required":""),
            "joining_date"=> ($request->user_type == '2' ? "required" : ""),
        ],[
            "number.*.numeric"=>"Invalid Mobile number",
            "number.*.required"=> "Mobile Number is required"
        ]);

        if($request->user_type == '1'){
            if($request->company_1=="1"){
                $request->validate([
                    "profit_company_1"=>"required"
                ],[
                    "profit_company_1.required" => " Smart Trader Profit Percentage is required"
                ]);
            }
            if ($request->company_2 == "1") {
                $request->validate([
                    "profit_company_2" => "required"
                ],[
                    "profit_company_2.required" => " ProfiNext Profit Percentage is required"
                ]);
            }
        }elseif($request->user_type == '3'){
            $request->validate([
                "ams_new_client_percentage"=>"required",
                "ams_renewal_client_percentage"=>"required",
                "prime_new_client_percentage"=>"required",
                "prime_renewal_client_percentage"=>"required",
            ],[
                "ams_new_client_percentage.required" => "  Percentage For AMS New Client is required",
                "ams_renewal_client_percentage.required" => "  Percentage For AMS Renewal Client is required",
                "prime_new_client_percentage.required" => "  Percentage For Prime New Client is required",
                "prime_renewal_client_percentage.required" => "  Percentage For Prime Renewal Client is required"
            ]);
        }elseif($request->user_type == '4'){
            $request->validate([
                "fees_percentage"=>"required",
                "limit"=>"required",
                "ams_new_client_profit"=>"required",
                "joining_date"=>"required",
            ],[
                "fees_percentage.required" => "Percentage of fees is required",
                "limit.required" => "Limit Field is required",
                "ams_new_client_profit.required" => "Percentage For AMS New Client is required",
                "joining_date.required" => "Joining Date is required"
            ]);
        }elseif($request->user_type == '5'){
            $request->validate([
                "percentage"=>"required",
                "joining_date"=>"required",
            ],[
                "percentage.required" => " Percentage of profit sharing is required",
                "joining_date.required" => "Joining Date is required"
            ]);
        }

        $request->validate([
            "role" => "array",
            "role.*"=>"required"
        ],[
            "role.*.required" =>"Role is required",
        ]);

        $user_data = $request->all();
        $user_data['password'] = Hash::make($request->password);
        $user_data['created_by'] = Auth::id();
		$userRoles = implode(",", $request->role);
        $user_data['role'] = $userRoles;
        $user_data['company_first'] = isset($request->company_1) ? 1 : null ;
        $user_data['profit_percentage_first'] = isset($request->profit_company_1) ? $request->profit_company_1 : null ;
        $user_data['company_second'] = isset($request->company_2) ? 1 : null ;
        $user_data['profit_percentage_second'] = isset($request->profit_company_2) ? $request->profit_company_2 : null ;
        $user_data['ams_new_client_percentage'] = isset($request->ams_new_client_percentage) ? $request->ams_new_client_percentage : null ;
        $user_data['ams_renewal_client_percentage'] = isset($request->ams_renewal_client_percentage) ? $request->ams_renewal_client_percentage : null;
        $user_data['prime_new_client_percentage'] = isset($request->prime_new_client_percentage) ? $request->prime_new_client_percentage : null;
        $user_data['prime_renewal_client_percentage'] = isset($request->prime_renewal_client_percentage) ? $request->prime_renewal_client_percentage : null;
        $user_data['ams_limit'] = isset($request->limit) ? $request->limit : null;
        $user_data['fees_percentage'] = isset($request->fees_percentage) ? $request->fees_percentage : null;
        $user_data['dob'] = isset($request->dob) ? date("Y-m-d",strtotime($request->dob)) : null;

        // check permissions
        $direct_permissions=[];
        $role_permissions = [];
        if(isset($request->role) && trim($request->role[0])!="" && isset($request->permission)){
            $role_permissions = RoleServices::permissions()->pluck("name")->toArray();
            $direct_permissions = array_diff($role_permissions,$request->permission);
        }
        // revoke permissions
        $param = array();
        foreach($role_permissions as $permission){
            if(!in_array($permission,$direct_permissions)){
                array_push($param,$permission);
            }
        }
        $user_data['permission'] = json_encode($param);
        $user = User::create($user_data);
        $user->syncPermissions($param);
        $user->syncRoles($request->role);
        $numbers = $request->number;
        foreach($numbers as $number){
            UserNumbers::create(["user_id"=>$user->id, "number"=>$number,"updated_by"=>Auth::id()]);
        }
        // add account type
        keywordAccountTypeServices::create($request->account_type);
        return $user->id;
    }
    public static function user($id){
        $user = User::where("id",$id)->first();
        //$user = User::withTrashed()->where("id",$id)->first();
        if(null === $user) return false;
        $user['numbers'] = UserNumbers::where("user_id",$id)->pluck("number");
        return $user;
    }
    public static function update($request,$id){
        if ($request->user_type == "6") {
            $request['deleted_at'] = date('Y-m-d');
        } else {
            $request['deleted_at'] = null;
        }
        $request->flashExcept(["_token"]);
        $request->validate([
            "name" => "required|alpha_spaces",
            "number" => "required|array",
            "number.*" => "numeric|required",
            "user_type" => "required",
            "salary" => ($request->user_type == '2' ? "required" : ""),
            "joining_date" => ($request->user_type == '2' ? "required" : ""),
        ], [
            "number.*.numeric" => "Invalid Mobile number",
            "number.*.required" => "Mobile Number is required"
        ]);

        if ($request->user_type == '1') {
            if ($request->company_1 == "1") {
                $request->validate([
                    "profit_company_1" => "required"
                ], [
                    "profit_company_1.required" => " Smart Trader Profit Percentage is required"
                ]);
            }
            if ($request->company_2 == "1") {
                $request->validate([
                    "profit_company_2" => "required"
                ], [
                    "profit_company_2.required" => " ProfiNext Profit Percentage is required"
                ]);
            }
        } elseif ($request->user_type == '3') {
            $request->validate([
                "ams_new_client_percentage" => "required",
                "ams_renewal_client_percentage" => "required",
                "prime_new_client_percentage" => "required",
                "prime_renewal_client_percentage" => "required",
            ], [
                "ams_new_client_percentage.required" => "  Percentage For AMS New Client is required",
                "ams_renewal_client_percentage.required" => "  Percentage For AMS Renewal Client is required",
                "prime_new_client_percentage.required" => "  Percentage For Prime New Client is required",
                "prime_renewal_client_percentage.required" => "  Percentage For Prime Renewal Client is required"
            ]);
        } elseif ($request->user_type == '4') {
            $request->validate([
                "fees_percentage" => "required",
                "limit" => "required",
                "ams_new_client_profit" => "required",
                "joining_date" => "required",
            ], [
                "fees_percentage.required" => "Percentage of fees is required",
                "limit.required" => "Limit Field is required",
                "ams_new_client_profit.required" => "Percentage For AMS New Client is required",
                "joining_date.required" => "Joining Date is required"
            ]);
        } elseif ($request->user_type == '5') {
            $request->validate([
                "percentage" => "required",
                "joining_date" => "required",
            ], [
                "percentage.required" => " Percentage of profit sharing is required",
                "joining_date.required" => "Joining Date is required"
            ]);
        }

        $request->validate([
            "role" => "array",
            "role.*" => "required"
        ], [
            "role.*.required" => "Role is required",
        ]);

        $request['company_first'] = isset($request->company_1) ? 1 : 0;
        $request['profit_percentage_first'] = isset($request->profit_company_1) ? $request->profit_company_1 : null;
        $request['company_second'] = isset($request->company_2) ? 1 : 0;
        $request['profit_percentage_second'] = isset($request->profit_company_2) ? $request->profit_company_2 : null;
        $request['ams_new_client_percentage'] = isset($request->ams_new_client_percentage) ? $request->ams_new_client_percentage : null;
        $request['ams_renewal_client_percentage'] = isset($request->ams_renewal_client_percentage) ? $request->ams_renewal_client_percentage : null;
        $request['prime_new_client_percentage'] = isset($request->prime_new_client_percentage) ? $request->prime_new_client_percentage : null;
        $request['prime_renewal_client_percentage'] = isset($request->prime_renewal_client_percentage) ? $request->prime_renewal_client_percentage : null;
        $request['ams_limit'] = isset($request->limit) ? $request->limit : null;
        $request['fees_percentage'] = isset($request->fees_percentage) ? $request->fees_percentage : null;
        $request['job_description'] = isset($request->job_description) ? $request->job_description : null;
        $request['dob'] = isset($request->dob) ? date("Y-m-d",strtotime($request->dob)) : null;

        if (isset($request->password) && $request->password != '') {
            $request['password'] = Hash::make($request->password);
        } else {
            unset($request['password']);
        }
        unset($request["profit_company_1"]);
        unset($request["profit_company_2"]);
        unset($request["company_1"]);
        unset($request["company_2"]);
        unset($request["limit"]);
        // check permissions
        $direct_permissions = [];
        $role_permissions = [];
        if (isset($request->role) && trim($request->role[0]) != "" && isset($request->permission)) {
            $role_permissions = RoleServices::permissions()->pluck("name")->toArray();
            $direct_permissions = array_diff($role_permissions, $request->permission);
        }
        // revoke permissions
        $user = UserServices::user($id);
        $param = array();
        foreach ($role_permissions as $permission) {
            if (!in_array($permission, $direct_permissions)) {
                array_push($param, $permission);
            }
        }
        $user->syncPermissions($param);
        $user->syncRoles($request->role);
        $user_data = $request->except(['_token',"number","permissions"]);
        // remove old numbers
        UserNumbers::where("user_id",$id)->delete();
        // add new numbers
        foreach($request->number as $number){
            if($number){
                UserNumbers::create(["user_id"=>$id, "number"=>$number,"updated_by"=>Auth::id()]);
            }
        }

        $userRoles = implode(",", $request->role);
        $user_data['role'] = $userRoles;
        $user_data['updated_by'] = Auth::id();
        $user_data['permission'] = json_encode($request->permission);
        User::where("id",$id)->update($user_data);
        // update role
        $user = User::find($id);
        // add account type
        keywordAccountTypeServices::create($request->account_type);

        return UserServices::user($id);
    }
    public static function terminatedUsers($role=null){
        if($role!==null){
            return User::withTrashed()->where("role","LIKE",$role)->whereNotNull("deleted_at")->get();
        }
        return User::withTrashed()->whereNotNull("deleted_at")->get();
    }
    public static function delete($id){
        return User::where("id",$id)->delete();
    }
    public static function getByRole(String $role=""){
        $user = User::with(['count'])->where("role",$role)->get();
        if(null === $user){
            abort(500);
        }
        return $user;
    }
    public static function getByType($type,$role= null)
    {
        if($role!==null){
            return User::where("role","LIKE",$role)->where("user_type",$type)->get();
        }
        return User::where("user_type",$type)->get();
    }

    public static function getFreelancerData()
    {
        $freelancer['freelancer_ams'] =  User::where("user_type",4)->get();
        $freelancer['freelancer_prime'] =  User::where("user_type",5)->get();
        return $freelancer;
    }
    public static function getChannelPartnerData()
    {
        return User::where("user_type",3)->get();

    }
}
