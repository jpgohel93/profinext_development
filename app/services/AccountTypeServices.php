<?php

namespace App\Services;
use App\Models\AccountTypesModel;
use Illuminate\Support\Facades\Auth;

class AccountTypeServices{
    public static function view(){
        return AccountTypesModel::get(['id', 'account_type']);
    }
    public static function create($request){
        $type = $request->validate([
            "account_type"=> "required|alpha_spaces|unique:user_account_types,account_type"
        ]);
        $type['created_by'] = Auth::id();
        return AccountTypesModel::create($type);
    }
    public static function remove($id){
        return AccountTypesModel::where("id",$id)->delete();
    }
    public static function get($id){
        return AccountTypesModel::where("id",$id)->first(["id","account_type"]);
    }
    public static function edit($request){
        $type = $request->validate([
            "account_type" => "required|alpha_spaces|unique:user_account_types,account_type"
        ]);
        return AccountTypesModel::where("id",$request->id)->update($type);
    }
}