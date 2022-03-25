<?php

namespace App\Services;

use App\Models\keywordAccountTypeModel;

class keywordAccountTypeServices
{
    public static function all()
    {
        return keywordAccountTypeModel::get();
    }
    public static function get($id)
    {
        return keywordAccountTypeModel::where("id", $id)->first();
    }
    public static function remove($id)
    {
        return keywordAccountTypeModel::where("id", $id)->delete();
    }
    public static function create($type)
    {
        return keywordAccountTypeModel::firstOrCreate(["name" => $type]);
    }
}
