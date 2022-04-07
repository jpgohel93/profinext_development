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
            $html.="<div class='col-md-3'><label class='h3'>". $image->title. "</label><div><img src='" . url('common/displayFile/' . Crypt::encryptString($image->id) . '/' . Crypt::encryptString('renewal_image') . '/' . $image->image_url) . "' style='width:200px'></div></div>";
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
        return renewalAccountImagesModal::create($image)   ;
    }
}