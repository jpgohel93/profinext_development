<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginServices;
class LoginController extends Controller
{
    public static function login(Request $request)   {
        if (LoginServices::login($request)) {
            dd("login");
            return redirect()->intended("dashboard");
        }
        session()->regenerate();
        return redirect()->route("login")->with("error","Invalid Login");
    }
}