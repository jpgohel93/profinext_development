<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\registerServices;

class RegisterController extends Controller
{
    public static function register(Request $request)   {
        $data = registerServices::register($request);
        if($data){
            return redirect()->route('login')->with('success','Register successfully');
        }
        return redirect()->route('register')->with('error','Register failed');
    }
}