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
        $user_name = auth()->user()->name;
        $id = AccountTypesModel::create($type);
        if($id){
            LogServices::logEvent(["desc"=>"Account type $type->account_type created by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Account type by $user_name",$type->account_type]);
        }
        return $id;
    }
    public static function remove($id){
        $user_name = auth()->user()->name;
        try {
            $type = AccountTypesModel::where("id",$id)->first();
            $status = AccountTypesModel::where("id",$id)->delete();
            if($status){
                LogServices::logEvent(["desc"=>"Account type $type->account_type Removed by $user_name"]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to remove Account type $type->account_type by $user_name"]);
            }
        } catch (\Throwable $th) {
            return LogServices::logEvent(["desc"=>"Unable to remove Account type $type->account_type by $user_name"]);
        }
    }
    public static function get($id){
        return AccountTypesModel::where("id",$id)->first(["id","account_type"]);
    }
    public static function edit($request){
        $type = $request->validate([
            "account_type" => "required|alpha_spaces|unique:user_account_types,account_type"
        ]);
        $user_name = auth()->user()->name;
        try {
            $type = AccountTypesModel::where("id",$request->id)->first();
            $status = AccountTypesModel::where("id",$request->id)->update($type);
            if($status){
                LogServices::logEvent(["desc"=>"Account type $type->account_type Updated by $user_name","data"=>$type]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to update Account type $type->account_type by $user_name","data"=>$type]);
            }
        } catch (\Throwable $th) {
            LogServices::logEvent(["desc"=>"Unable to update Account type $type->account_type by $user_name","data"=>$type]);
        }
    }
}
