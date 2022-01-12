<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public static function clients(Request $request){
        $clients = UserServices::clients($request);
        return view("client",["clients"=>$clients]);
    }
}
