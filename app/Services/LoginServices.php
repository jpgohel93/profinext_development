<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Services\CommonService;
use Illuminate\Support\Facades\Redirect;
use App\Services\LogServices;
class LoginServices{
    public static function login($request){
        // do login
        $credentials = $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);
        $request->flashExcept(["_token","password"]);
        if(!Auth::attempt($credentials)){
            LogServices::logEvent(["desc"=>"$request->email Login Failed","data"=>$credentials]);
            CommonService::throwError("Login failed");
        }else{
            LogServices::logEvent(["desc"=>"$request->email Logged in"]);
            return Redirect::route("dashboard");
        }
    }
    public static function logout($request)
    {
        $email = null!== auth()->user()?auth()->user()->email:"";
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        LogServices::logEvent(["desc"=>"$email Log out"]);
        return Redirect::route("dashboard");
    }
}
