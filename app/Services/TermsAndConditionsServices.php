<?php
namespace App\Services;
use App\Models\TermsAndConditionsModel;
class TermsAndConditionsServices
{
    public static function create($request)
    {
        $terms = $request->validate([
            "title"=> "required",
            "description"=> "required"
        ]);
        $terms['created_by'] = auth()->user()->id;
        return TermsAndConditionsModel::create($terms);
    }
    public static function update($request)
    {
        $terms = $request->validate([
            "title"=> "required",
            "description"=> "required",
            "id"=> "required|exists:terms_and_conditions,id"
        ],[
            "id.required" => "ID is required",
            "id.exists" =>"Terms and conditions not exists"
        ]);
        $terms['updated_by'] = auth()->user()->id;
        return TermsAndConditionsModel::where("id",$request->id)->update($terms);
    }
    public static function all($active = false){
        if($active){
            return TermsAndConditionsModel::where("is_active",1)->get();
        }
        return TermsAndConditionsModel::get();
    }
    public static function get($id)
    {
        return TermsAndConditionsModel::where("id",$id)->first();
    }
    public static function remove($id)
    {
        $terms['deleted_by'] = auth()->user()->id;
        $terms['deleted_at'] = date('Y-m-d H:i:s');
        return TermsAndConditionsModel::where("id", $id)->update($terms);
    }
}
