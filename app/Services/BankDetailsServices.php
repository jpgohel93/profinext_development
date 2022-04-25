<?php

namespace App\Services;

use App\Models\BankDetailsModal;
use Illuminate\Support\Facades\Auth;
use App\Services\LogServices;
class BankDetailsServices
{
    public static function view()
    {
        return BankDetailsModal::get(['id', 'bank']);
    }
    public static function create($request)
    {
        $bank = $request->validate([
            "bank" => "required|alpha_spaces|unique:client_banks,bank"
        ]);
        $bank['created_by'] = Auth::id();
        $id = BankDetailsModal::create($bank);
        $user_name = auth()->user()->name;
        if($id){
            return LogServices::logEvent(["desc"=>"Bank $id->id created by $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to create Bank by $user_name"]);
        }
    }
    public static function remove($id)
    {
        $user_name = auth()->user()->name;
        $status = BankDetailsModal::where("id", $id)->forceDelete();
        if($status){
            return LogServices::logEvent(["desc"=>"Bank $id deleted by $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to delete Bank by $user_name"]);
        }
    }
    public static function get($id)
    {
        return BankDetailsModal::where("id", $id)->first(["id", "bank"]);
    }
    public static function edit($request)
    {
        $user_name = auth()->user()->name;
        $bank = $request->validate([
            "bank" => "required|alpha_spaces|unique:client_banks,bank"
        ]);
        $status = BankDetailsModal::where("id", $request->id)->update($bank);
        if($status){
            return LogServices::logEvent(["desc"=>"Bank $request->id updated by $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to update Bank $request->id by $user_name"]);
        }
    }
}
