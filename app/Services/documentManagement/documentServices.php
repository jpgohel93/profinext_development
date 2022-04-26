<?php

namespace App\Services\documentManagement;
use App\Models\documentManagement\documentManagementModel;
use App\Models\documentManagement\ImageModel;
use App\Models\PancardImageModel;
use App\Models\renewalAccountImagesModal;
use App\Services\LogServices;
use PDO;

class documentServices{
    // documents
    public static function all(){
        return documentManagementModel::get();
    }
    public static function getData($id){
        return documentManagementModel::where("id",$id)->first();
    }
    public static function addData($request){
        $document = $request->validate([
            "date"=> "required",
            "title"=> "required",
        ]);
        if(null == $request->document && null === $request->id){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "document" => ["Document file is required"]
            ]);
            throw $error;
        }
        if($request->hasFile("document")){
            $destinationPath = public_path('documents/');
            $imageData = documentManagementModel::where("id",$request->id)->first();
            if(!empty($imageData)) {
                if ($imageData->document != '') {
                    if(file_exists($destinationPath.$imageData->document)){
                        unlink($destinationPath.$imageData->document);
                    }
                }
            }
            $filename = $request->file('document')->hashName();
            $request->document->move($destinationPath, $filename);
            $document['document'] = $filename;
        }
        $document['notes'] = $request->notes;
        $user_name = auth()->user()->name;
        if($request->id){
            $document['updated_by'] = auth()->user()->id;
            $data = self::getData($request->id);
            $status = documentManagementModel::where("id",$request->id)->update($document);
            if($status){
                LogServices::logEvent(["desc"=>"Document $request->id updated by $user_name","data"=>$data]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to update Document $request->id by $user_name"]);
            }
        }else{
            $document['created_by'] = auth()->user()->id;
            $id = documentManagementModel::create($document);
            if($id){
                LogServices::logEvent(["desc"=>"Document $id->id created by $user_name"]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to create Document by $user_name"]);
            }
        }
    }
    public static function remove($id){
        $status = documentManagementModel::where("id",$id)->update(["deleted_by"=>auth()->user()->id,"deleted_at"=>date("Y-m-d H:i:s")]);
        $user_name = auth()->user()->name;
        if($status){
            return LogServices::logEvent(["desc"=>"Document $id deleted by $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to delete Document $id by $user_name"]);
        }
    }
    // pan cards
    public static function panCards(){
        $panCards = PancardImageModel::join("client_demat",function($join){
            $join->on("tbl_pancards.client_demat_id","=","client_demat.id");
            $join->join("clients","client_demat.client_id","=","clients.id");
        })->groupBy("tbl_pancards.client_demat_id","tbl_pancards.file")->select("clients.name","clients.id as client_id","client_demat.holder_name","tbl_pancards.*")->get();

        return $panCards;
    }

    public static function getPancardData($id){
        return  PancardImageModel::join("client_demat",function($join){
            $join->on("tbl_pancards.client_demat_id","=","client_demat.id");
            $join->join("clients","client_demat.client_id","=","clients.id");
        })->where("tbl_pancards.id",$id)->groupBy("tbl_pancards.client_demat_id","tbl_pancards.file")->select("clients.name","clients.id as client_id","client_demat.holder_name","client_demat.pan_number_text","tbl_pancards.*")->first()->toArray();
    }

    public static function editPanCardData($request){
        $user_name = auth()->user()->name;
        $document = $request->validate([
            "id"=> "required"
        ]);
        if(null == $request->document){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "document" => ["Document file is required"]
            ]);
            throw $error;
        }
        if($request->hasFile("document")){
            $destinationPath = public_path('pan_cards/');

            $imageData = PancardImageModel::where("id",$request->id)->first();

            if(!empty($imageData)) {
                if ($imageData->file != '') {
                    if(file_exists($destinationPath.$imageData->file)){
                        unlink($destinationPath.$imageData->file);
                    }
                }
            }

            $filename = $request->file('document')->hashName();
            $request->document->move($destinationPath, $filename);
            $document['file'] = $filename;
        }
        if($request->id){
            $document['updated_at'] = date('Y-m-d');
            $data = PancardImageModel::where("id",$request->id)->first();
            $status = PancardImageModel::where("id",$request->id)->update($document);
            if($status){
                return LogServices::logEvent(["desc"=>"Pan card $request->id updated by $user_name","data"=>$data]);
            }else{
                return LogServices::logEvent(["desc"=>"Unable to update Pan card $request->id by $user_name"]);
            }
        }
    }
    public static function removePanCard($id){
        $status = PancardImageModel::where("id",$id)->delete();
        $user_name = auth()->user()->name;
        if($status){
            return LogServices::logEvent(["desc"=>"Pan card $id deleted by $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to delete Pan card $id by $user_name"]);
        }
    }

    public static function screenshots(){
        return  renewalAccountImagesModal::
        leftJoin('renewal_account', 'renewal_account_images.renewal_account_id', '=', 'renewal_account.id')->
        leftJoin('client_demat', 'renewal_account.client_demat_id', '=', 'client_demat.id')->
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        select('clients.name','renewal_account_images.*')
            ->get();
    }

    public static function getScreenshotsData($id){
       return  renewalAccountImagesModal::
        leftJoin('renewal_account', 'renewal_account_images.renewal_account_id', '=', 'renewal_account.id')->
        leftJoin('client_demat', 'renewal_account.client_demat_id', '=', 'client_demat.id')->
        leftJoin('clients', 'client_demat.client_id', '=', 'clients.id')->
        where("renewal_account_images.id",$id)->
        select('clients.name','renewal_account_images.*')
            ->first();
    }

    public static function editScreenshotsData($request){
        $user_name = auth()->user()->name;
        $document = $request->validate([
            "id"=> "required"
        ]);
        if(null == $request->document){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "document" => ["Document file is required"]
            ]);
            throw $error;
        }
        if($request->hasFile("document")){
            $destinationPath = public_path('renewal_account_images/');

            $imageData = renewalAccountImagesModal::where("id",$request->id)->first();

            if(!empty($imageData)) {
                if ($imageData->image_url != '') {
                    if(file_exists($destinationPath.$imageData->image_url)){
                        unlink($destinationPath.$imageData->image_url);
                    }
                }
            }

            $filename = $request->file('document')->hashName();
            $request->document->move($destinationPath, $filename);
            $document['image_url'] = $filename;
        }
        if($request->id){
            $document['updated_at'] = date('Y-m-d');
            $document['title'] = $request->title;
            $data = renewalAccountImagesModal::where("id",$request->id)->first();
            $status = renewalAccountImagesModal::where("id",$request->id)->update($document);
            if($status){
                return LogServices::logEvent(["desc"=>"Renewal account image $request->id updated by $user_name","data"=>$data]);
            }else{
                return LogServices::logEvent(["desc"=>"Unable to update Renewal account image $request->id by $user_name"]);
            }
        }
    }
    public static function removeScreenshots($id){
        $status = renewalAccountImagesModal::where("id",$id)->delete();
        $user_name = auth()->user()->id;
        if($status){
            return LogServices::logEvent(["desc"=>"Renewal account image $id deleted by $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to delete Renewal account image $id by $user_name"]);
        }
    }

    public static function images(){
        return ImageModel::get();
    }

    public static function getImage($id){
        return ImageModel::where("id",$id)->first();
    }
    public static function addImage($request){
        $user_name = auth()->user()->id;
        $document = $request->validate([
            "date"=> "required",
            "title"=> "required",
        ]);
        if(null == $request->document && null === $request->id){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                "document" => ["Document file is required"]
            ]);
            throw $error;
        }
        if($request->hasFile("document")){
            $destinationPath = public_path('images/');

            $imageData = ImageModel::where("id",$request->id)->first();

            if(!empty($imageData)) {
                if ($imageData->image != '') {
                    if(file_exists($destinationPath.$imageData->image)){
                        unlink($destinationPath.$imageData->image);
                    }
                }
            }

            $filename = $request->file('document')->hashName();
            $request->document->move($destinationPath, $filename);
            $document['image'] = $filename;
        }
        $document['notes'] = $request->notes;
        if($request->id){
            $document['updated_by'] = auth()->user()->id;
            $data = ImageModel::where("id",$request->id)->first();
            $status = ImageModel::where("id",$request->id)->update($document);
            if($status){
                return LogServices::logEvent(["desc"=>"Image $request->id updated by $user_name","data"=>$data]);
            }else{
                return LogServices::logEvent(["desc"=>"Unable to update Image $request->id by $user_name"]);
            }
        }else{
            $document['created_by'] = auth()->user()->id;
            $id = ImageModel::create($document);
        }
    }
    public static function removeImage($id){
        return ImageModel::where("id",$id)->delete();
    }
}
