<?php

namespace App\Services;

use App\Models\User;
class UserServices
{
    public static function clients($request)
    {
        return UserServices::activeClients();
    }

    public static function roles($request)
    {
        return UserServices::activeClients();
    }
    public static function activeClients(){
        return User::where("status","1")->get();
    }
    public static function all(){
        return User::get();
    }
}
