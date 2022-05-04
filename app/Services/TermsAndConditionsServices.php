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
        $status = TermsAndConditionsModel::create($terms);
        $user_name = auth()->user()->name;
        if($status){
            LogServices::logEvent(["desc"=>"Terms and conditions $request->title created by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Terms and conditions $request->title by $user_name"]);
        }
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
        $data = TermsAndConditionsModel::where("id",$request->id)->first();
        $user_name = auth()->user()->name;
        $status = TermsAndConditionsModel::where("id",$request->id)->update($terms);
        if($status){
            LogServices::logEvent(["desc"=>"Terms and conditions $request->title updated by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to update Terms and conditions $request->title by $user_name"]);
        }
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
        $user_name = auth()->user()->name;
        $data = TermsAndConditionsModel::where("id", $id)->first();
        $status = TermsAndConditionsModel::where("id", $id)->update($terms);
        if($status){
            LogServices::logEvent(["desc"=>"Terms and conditions $data->title deleted by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to delete Terms and conditions $data->title by $user_name"]);
        }
    }
}
