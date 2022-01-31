<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginServices{
    public static function login($request){
        // do login
        $credentials = $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);
        $request->flashExcept(["_token","password"]);
        return Auth::attempt($credentials);
    }
    public static function logout($request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}