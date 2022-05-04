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
            LogServices::logEvent(["desc"=>"Profession $request->profession created by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Profession by $user_name","data"=>$type]);
        }
        return $id;
    }
    public static function remove($id)
    {
        $user_name = auth()->user()->name;
        $data = ProfessionModal::where("id", $id)->first();
        $status = ProfessionModal::where("id", $id)->forceDelete();
        if($status){
            LogServices::logEvent(["desc"=>"Profession $data->profession deleted by $user_name","data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to delete Profession by $user_name"]);
        }
        return $status;
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
        $data = ProfessionModal::where("id", $request->id)->first();
        $status = ProfessionModal::where("id", $request->id)->update($type);
        if($status){
            LogServices::logEvent(["desc"=>"Profession $request->profession updated by $user_name","data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to update Profession by $user_name","data"=>$type]);
        }
        return $status;
    }
}
