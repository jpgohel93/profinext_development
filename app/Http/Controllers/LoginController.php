<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginServices;

class LoginController extends Controller
{
    public static function login(Request $request)   {
        $login = LoginServices::login($request);
        if($login){
            return redirect()->route('dashboard')->with('success','Login successfully');
        }
        return redirect()->route('login')->with('error','Login failed');
    }
    public function logout(Request $request)
    {
        return LoginServices::logout($request);
    }
}