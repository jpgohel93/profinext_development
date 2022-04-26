<?php

namespace App\Services;

use App\Models\keywordAccountTypeModel;
use App\Services\LogServices;
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
        $user_name = auth()->user()->name;
        $status = keywordAccountTypeModel::where("id", $id)->delete();
        if($status){
            LogServices::logEvent(["Keyword $id deleted by $user_name"]);
        }else{
            LogServices::logEvent(["Unable to delete Keyword $id deleted by $user_name"]);
        }
    }
    public static function create($type)
    {
        $user_name = auth()->user()->name;
        $id = keywordAccountTypeModel::firstOrCreate(["name" => $type]);
        if($id){
            LogServices::logEvent(["desc"=>"Keyword $id created by $user_name"]);
        }
        return $id;
    }
}
