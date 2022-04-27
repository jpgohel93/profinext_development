<?php

namespace App\Services;
use App\Models\renewalAccountImagesModal;
use App\Services\CommonService;
use Illuminate\Support\Facades\Crypt;
class RenewalAccountImagesServices{

    public static function get($id){
        $images = renewalAccountImagesModal::where("renewal_account_id",$id)->get(["image_url", "mimeType", "id","title"]);
        $html = "";
        foreach ($images as $image){
            $html.="<div class='col-md-3'><label class='h3'>". $image->title. "</label><div><a target='_blank' href='".url('common/displayFile/' . Crypt::encryptString($image->id) . '/' . Crypt::encryptString('renewal_image') . '/' . $image->image_url) ."'><img src='" . url('common/displayFile/' . Crypt::encryptString($image->id) . '/' . Crypt::encryptString('renewal_image') . '/' . $image->image_url) . "' style='width:200px'></a></div></div>";
        }
        return $html;
    }

    public static function read($id){
        return renewalAccountImagesModal::where("id",$id)->first();
    }

    public static function create($request){
        $image = $request->validate([
            "title"=> "required",
            "renewal_account_id"=> "required|exists:renewal_account,id"
        ],[
            "title.required" =>"Image title is required",
            "id.required" => "Account id is required",
            "id.exists" =>"Account not found"
        ]);
        if($request->image){
            $newName = CommonService::uploadfile($request->image, config()->get('constants.UPLOADS.RENEW_ACCOUNT_IMAGES'));
        }
        $image['created_by']= auth()->user()->id;
        $image['mimeType']= $newName['data']['mimeType'];
        $image['ext']= $newName['data']['extension'];
        $image['image_url']= $newName['data']['filename'];
        $id = renewalAccountImagesModal::create($image);
        $user_name = auth()->user()->name;
        if($id){
            LogServices::logEvent(["desc"=>"Renewal account image uploaded By $user_name","data"=>$image]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to upload Renewal account image $user_name","data"=>$image]);
        }
    }
}
