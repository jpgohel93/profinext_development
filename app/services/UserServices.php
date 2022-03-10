<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserNumbers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\CommonService;
class UserServices
{
    public static function clients($request)
    {
        return UserServices::activeClients();
    }

    public static function roles($request)
    {
        return UserServices::activeClients();
    }
    public static function activeClients(){
        return User::where("status","1")->get();
    }
    public static function all(){
        return User::withTrashed()->get();
    }
    public static function validateUsersData($data){
        $data->validate([
            "name"=>"required|alpha_spaces",
            "account_type"=>"required",
            "number"=>"required|array",
            "number.*"=>"numeric",
            "ifsc_code"=>"required",
            "user_type"=>"required",
            "job_description"=>"required",
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
        self::validateUsersData($request);
        $request->validate([
            "email"=>"required|email|unique:users,email",
            "account_number"=>"required|numeric|unique:users,account_number",
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
        $user = User::create($user_data);

        $user->assignRole($request->role);
        $numbers = $request->number;
        foreach($numbers as $number){
            UserNumbers::create(["user_id"=>$user->id, "number"=>$number,"updated_by"=>Auth::id()]);
        }
        return $user->id;
    }
    public static function user($id){
        $user = User::where("id",$id)->first();
        if(null === $user) return false;
        $user['numbers'] = UserNumbers::where("user_id",$id)->pluck("number");
        return $user;
    }
    public static function update($request,$id){

        try {
            self::validateUsersData($request);
            $request->validate([
                "email"=>"required|email",
                "account_number"=>"required|numeric",
            ]);
            $user_data = $request->except(['_token',"number"]);
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

            User::where("id",$id)->update($user_data);
            // update role
            $user = User::find($id);
            $user->syncRoles($request->role);
            return UserServices::user($id);
        } catch (\Throwable $th) {
            return false;
        }
    }
    public static function delete($id){
        User::where("id",$id)->delete();
        return User::withTrashed()->get();
    }
    public static function getByRole(String $role=""){
        $user = User::with(['count'])->where("role",$role)->get();
        if(null === $user){
            abort(500);
        }
        return $user;
    }
    public static function getByType($type)
    {
        return User::where("user_type",$type)->get();
    }

    public static function getFreelancerData()
    {
        $freelancer['freelancer_ams'] =  User::where("user_type",4)->get();
        $freelancer['freelancer_prime'] =  User::where("user_type",5)->get();
        return $freelancer;
    }
}
