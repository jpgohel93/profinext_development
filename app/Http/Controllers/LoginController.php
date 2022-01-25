<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginServices;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public static function login(Request $request)   {
        return LoginServices::login($request);
    }
    public function logout(Request $request)
    {
        return LoginServices::logout($request);
    }
}