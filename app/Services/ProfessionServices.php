<?php

namespace App\Services;
use App\Models\ProfessionModal;
use Illuminate\Support\Facades\Auth;
use App\Services\LogServices;
class ProfessionServices{
    public static function view()
    {
        return ProfessionModal::get(['id', 'profession']);
    }
    public static function create($request)
    {
        $user_name = auth()->user()->name;
        $type = $request->validate([
            "profession" => "required|alpha_spaces|unique:client_professions,profession"
        ]);
        $type['created_by'] = Auth::id();
        $id = ProfessionModal::create($type);
        if($id){
            LogServices::logEvent(["desc"=>"Profession $id->id created by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Profession by $user_name"]);
        }
    }
    public static function remove($id)
    {
        $user_name = auth()->user()->name;
        $status = ProfessionModal::where("id", $id)->forceDelete();
        if($status){
            return LogServices::logEvent(["desc"=>"Profession $id deleted by $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to delete Profession $id by $user_name"]);
        }
    }
    public static function get($id)
    {
        return ProfessionModal::where("id", $id)->first(["id", "profession"]);
    }
    public static function edit($request)
    {
        $user_name = auth()->user()->name;
        $type = $request->validate([
            "profession" => "required|alpha_spaces|unique:client_professions,profession"
        ]);
        $status = ProfessionModal::where("id", $request->id)->update($type);
        if($status){
            return LogServices::logEvent(["desc"=>"Profession $request->id deleted by $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Profession $request->id deleted by $user_name"]);
        }
    }
}
