<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginServices;
use Illuminate\Support\Facades\Redirect;
class LoginController extends Controller
{
    public static function login(Request $request)   {
        LoginServices::login($request);
        return Redirect::route('dashboard')->with('success','Login successfully');
//        $data = "Dashboard Data";
//        return view("dashboard", compact('data'));
    }
    public function logout(Request $request)
    {
        return LoginServices::logout($request);
    }
}
