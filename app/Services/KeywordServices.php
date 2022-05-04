<?php

namespace App\Services;

use App\Models\Keyword;
use Illuminate\Support\Facades\Auth;
use App\Services\LogServices;
class KeywordServices
{
    public static function all(){
        return Keyword::get();
    }
    public static function create($request){
        $user_name = auth()->user()->name;
        $keyword['name'] = $request['name'];
        $keyword['created_by']= Auth::id();
        $id = Keyword::create($keyword);
        if($id){
            LogServices::logEvent(["desc"=>"Keyword ".$keyword['name']." created by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Keyword ".$keyword['name']." by $user_name","data"=>$keyword]);
        }
        return $id;
    }
    public static function remove($id){
        $user_name = auth()->user()->name;
        $keyword = Keyword::where("id",$id)->first();
        $status = Keyword::where("id",$id)->delete();
        if($status){
            LogServices::logEvent(["desc"=>"Keyword $keyword->name deleted by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to delete Keyword $keyword->name by $user_name"]);
        }
        return $status;
    }
    public static function getKeywordByName($name){
        return Keyword::where("name", $name)->first();
    }
    public static function edit($request){
        $user_name = auth()->user()->name;
        try {
            $keyword = $request->validate([
                "name"=> "required",
            ]);
            $data = Keyword::where("id",$request->keyword_id)->first();
            $status = Keyword::where("id",$request->keyword_id)->update($keyword);
            if($status){
                LogServices::logEvent(["desc"=>"Keyword $data->name updated by $user_name","data"=>$data]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to updated Keyword $keyword->name by $user_name","data"=>$data]);
            }
            return $status;
        } catch (\Throwable $th) {
            LogServices::logEvent(["desc"=>"Unable to updated Keyword $request->name by $user_name"]);
            return CommonService::throwError("Unable to update this keyword");
        }
    }

    public static function getKeywordByNameId($id,$name){
        return Keyword::where("id","!=",$id)->where("name", $name)->first();
    }
}
