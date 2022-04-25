<?php

namespace App\Services;
use App\Models\AccountTypesModel;
use Illuminate\Support\Facades\Auth;
use App\Services\LogServices;

class AccountTypeServices{
    public static function view(){
        return AccountTypesModel::get(['id', 'account_type']);
    }
    public static function create($request){
        $type = $request->validate([
            "account_type"=> "required|alpha_spaces|unique:user_account_types,account_type"
        ]);
        $type['created_by'] = Auth::id();
        $id = AccountTypesModel::create($type);
        if($id){
            $name = auth()->user()->name;
            return LogServices::logEvent(["desc"=>"Account type $id->id created by $name"]);
        }else{
            $name = auth()->user()->name;
            return LogServices::logEvent(["desc"=>"Unable to update Account type by $name"]);
        }
    }
    public static function remove($id){
        $name = auth()->user()->name;
        try {
            AccountTypesModel::where("id",$id)->delete();
            LogServices::logEvent(["desc"=>"Account type $id Removed by $name"]);
        } catch (\Throwable $th) {
            return LogServices::logEvent(["desc"=>"Unable to remove Account type by $name"]);
        }
    }
    public static function get($id){
        return AccountTypesModel::where("id",$id)->first(["id","account_type"]);
    }
    public static function edit($request){
        $type = $request->validate([
            "account_type" => "required|alpha_spaces|unique:user_account_types,account_type"
        ]);
        $name = auth()->user()->name;
        try {
            AccountTypesModel::where("id",$request->id)->update($type);
            LogServices::logEvent(["desc"=>"Account type $request->id Updated by $name"]);
        } catch (\Throwable $th) {
            LogServices::logEvent(["desc"=>"Unable to update Account type $request->id by $name"]);
        }
    }
}
