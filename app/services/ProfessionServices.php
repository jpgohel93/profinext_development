<?php

namespace App\Services;
use App\Models\ProfessionModal;
use Illuminate\Support\Facades\Auth;
class ProfessionServices{
    public static function view()
    {
        return ProfessionModal::get(['id', 'profession']);
    }
    public static function create($request)
    {
        $type = $request->validate([
            "profession" => "required|alpha_spaces|unique:client_professions,profession"
        ]);
        $type['created_by'] = Auth::id();
        return ProfessionModal::create($type);
    }
    public static function remove($id)
    {
        return ProfessionModal::where("id", $id)->forceDelete();
    }
    public static function get($id)
    {
        return ProfessionModal::where("id", $id)->first(["id", "profession"]);
    }
    public static function edit($request)
    {
        $type = $request->validate([
            "profession" => "required|alpha_spaces|unique:client_professions,profession"
        ]);
        return ProfessionModal::where("id", $request->id)->update($type);
    }
}