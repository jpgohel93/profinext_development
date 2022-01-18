<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginServices;
class LoginController extends Controller
{
    public static function login(Request $request)   {
        return LoginServices::login($request);
    }
}