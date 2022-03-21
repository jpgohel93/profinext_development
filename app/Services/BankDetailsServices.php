<?php

namespace App\Services;

use App\Models\BankDetailsModal;
use Illuminate\Support\Facades\Auth;

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
        return BankDetailsModal::create($bank);
    }
    public static function remove($id)
    {
        return BankDetailsModal::where("id", $id)->forceDelete();
    }
    public static function get($id)
    {
        return BankDetailsModal::where("id", $id)->first(["id", "bank"]);
    }
    public static function edit($request)
    {
        $bank = $request->validate([
            "bank" => "required|alpha_spaces|unique:client_banks,bank"
        ]);
        return BankDetailsModal::where("id", $request->id)->update($bank);
    }
}
