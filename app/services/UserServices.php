<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserNumbers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        return User::get();
    }
    public static function create($request){
        $request->validate([
            "name"=>"required|alpha",
            "email"=>"required|email|unique:users,email",
            "account_number"=>"required|numeric|unique:users,account_number",
            "account_type"=>"required|numeric",
            "number"=>"required|array",
            "number.*"=>"numeric",
            "ifsc_code"=>"required",
            "user_type"=>"required",
            "job_description"=>"required",
            "role"=>"required",
        ]);
        if($request->user_type=='1'){
            $request->validate([
                "company"=>"required",
                "percentage"=>"required|numeric|min:0|max:100",
            ]);
        }else{
            $request->validate([
                "salary"=>"required|numeric",
                "joining_date"=>"required|date"
            ]);
        }
        $user_data = $request->all();
        $user_data['password'] = Hash::make("123456");
        $user = User::create($user_data);
        $user->assignRole($request->role);
        $numbers = $request->number;
        foreach($numbers as $number){
            UserNumbers::create(["user_id"=>$user->id, "number"=>$number,"updated_by"=>Auth::id()]);
        }
        return $user->id;
    }
}
