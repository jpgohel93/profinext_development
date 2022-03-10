<?php

namespace App\Services;

use App\Models\Keyword;
use App\Models\AnalystNumbers;
use Illuminate\Support\Facades\Auth;

class KeywordServices
{
    public static function all(){
        return Keyword::get();
    }
    public static function create($request){
        $keyword['name'] = $request['name'];
        $keyword['created_by']= Auth::id();
        return Keyword::create($keyword);
    }
    public static function remove($id){
        return Keyword::where("id",$id)->delete();
    }
    public static function getKeywordByName($name){
        return Keyword::where("name", $name)->first();
    }
    public static function edit($request){
        try {
            $keyword = $request->validate([
                "name"=> "required",
            ]);
            return Keyword::where("id",$request->keyword_id)->update($keyword);
        } catch (\Throwable $th) {
            CommonService::throwError("Unable to update this keyword");
        }
    }

    public static function getKeywordByNameId($id,$name){
        return Keyword::where("id","!=",$id)->where("name", $name)->first();
    }
}
