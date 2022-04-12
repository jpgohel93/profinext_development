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

    public static function checkUser(Request $request)   {
        $checkUser = registerServices::checkUser($request);
        $emailId=$request->email;
        if($checkUser){
            return view("auth.set_password",compact('emailId'));
        }else{
            return Redirect::route('resetPassword')->with('info','Email id not exits.');
        }
    }

    public static function resetPassword(Request $request)   {
        if(($request->password != '' && $request->confirm_password != '') && ($request->password == $request->confirm_password)) {
            registerServices::updatePassword($request);
            return Redirect::route('login')->with('success','Password change successfully');
        }else{
            return Redirect::route('resetPassword')->with('info','Please enter valid password.');
        }
    }
}
