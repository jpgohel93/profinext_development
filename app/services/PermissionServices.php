<?php

namespace App\Services;

class PermissionServices
{
    public static function has($permission)
    {
        if(!in_array($permission,json_decode(auth()->user()->permission))){
            abort(403);
        }
    }
}
