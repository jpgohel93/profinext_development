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
            LogServices::logEvent(["desc"=>"Bank $id->id created by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Bank by $user_name","data"=>$bank]);
        }
        return $id;
    }
    public static function remove($id)
    {
        $user_name = auth()->user()->name;
        $data = BankDetailsModal::where("id", $id)->first();
        $status = BankDetailsModal::where("id", $id)->forceDelete();
        if($status){
            LogServices::logEvent(["desc"=>"Bank $id deleted by $user_name","data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to delete Bank $id by $user_name"]);
        }
        return $status;
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
        $data = BankDetailsModal::where("id", $request->id)->first();
        $status = BankDetailsModal::where("id", $request->id)->update($bank);
        if($status){
            LogServices::logEvent(["desc"=>"Bank $request->id updated by $user_name","data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to update Bank $request->id by $user_name","data"=>$bank]);
        }
        return $status;
    }
}
