<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginServices;
use App\Services\UserServices;
use Illuminate\Support\Facades\Redirect;
class LoginController extends Controller
{
    public static function login(Request $request)   {
        LoginServices::login($request);
        return Redirect::route('dashboard')->with('success','Login successfully');
    }
    public function logout(Request $request)
    {
        return LoginServices::logout($request);
    }
}
