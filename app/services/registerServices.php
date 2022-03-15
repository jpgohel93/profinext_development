<?php

namespace App\Services;

use App\Services\CommonService;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class registerServices{
    public static function register($request){
        // do register
        $data = $request->validate([
            "email"=>"required|email|unique:users,email",
            "password"=>"required|min:6:same:confirm-password"
        ]);
        $request->validate([
            "first-name"=>"required|alpha",
            "last-name"=>"required|alpha",
            "terms"=>"accepted"
        ]);
        $request->flashExcept(["_token","password","confirm-password"]);
        $data['name'] = $request->input("first-name")." ".$request->input("last-name");
        $data['password'] = Hash::make($data['password']);

        try {
            $user = User::create($data);
        } catch (\Throwable $th) {
            CommonService::throwError("Registration failed");
        }

    }

    public static function checkUser($request){
        $user = User::where("email",$request->email)->first();

        if(empty($user))
            return false;
        else
            return true;
    }
}
