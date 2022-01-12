<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginServices{
    public static function login($request){
        // do login
        $credentials = $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);
        $request->flashExcept(["_token","password"]);
        if(Auth::attempt($credentials)){
            return true;
        }
        return false;
    }
}