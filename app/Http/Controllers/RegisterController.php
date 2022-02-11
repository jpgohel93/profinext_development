<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\registerServices;
use Illuminate\Support\Facades\Redirect;
class RegisterController extends Controller
{
    public static function register(Request $request)   {
        registerServices::register($request);
        return Redirect::route('login')->with('success','Register successfully');
    }
}