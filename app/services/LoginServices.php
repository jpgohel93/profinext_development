<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Services\CommonService;
class LoginServices{
    public static function login($request){
        // do login
        $credentials = $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);
        $request->flashExcept(["_token","password"]);
        if(!Auth::attempt($credentials)){
            CommonService::throwError("Login failed");
        }
    }
    public static function logout($request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}