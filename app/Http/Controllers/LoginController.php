<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginServices;
use Illuminate\Support\Facades\Redirect;
use App\Services\LogServices;

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

    public function dashboardData()
    {
        $userData = auth()->user();

        if($userData->role == "super-admin"){
            $activity = LogServices::getActivity();
        }else{
            $activity = LogServices::getActivityById($userData->id);
        }

        return view("dashboard",compact('activity'));
    }
}
