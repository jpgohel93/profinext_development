<?php

namespace App\Services\documentManagement;
use App\Models\documentManagement\documentManagementModel;
use App\Models\documentManagement\ImageModel;
use App\Models\PancardImageModel;
use App\Models\renewalAccountImagesModal;

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
        if($request->id){
            $document['updated_by'] = auth()->user()->id;
            documentManagementModel::where("id",$request->id)->update($document);
        }else{
            $document['created_by'] = auth()->user()->id;
            documentManagementModel::create($document);
        }
    }
    public static function remove($id){
        return documentManagementModel::where("id",$id)->update(["deleted_by"=>auth()->user()->id,"deleted_at"=>date("Y-m-d H:i:s")]);
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
        })->where("tbl_pancards.id",$id)->groupBy("tbl_pancards.client_demat_id","tbl_pancards.file")->select("clients.name","clients.id as client_id","client_demat.holder_name","client_demat.pan_number","tbl_pancards.*")->first()->toArray();
    }

    public static function editPanCardData($request){
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
            PancardImageModel::where("id",$request->id)->update($document);
        }
    }
    public static function removePanCard($id){
        return PancardImageModel::where("id",$id)->delete();
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
            renewalAccountImagesModal::where("id",$request->id)->update($document);
        }
    }
    public static function removeScreenshots($id){
        return renewalAccountImagesModal::where("id",$id)->delete();
    }

    public static function images(){
        return ImageModel::get();
    }

    public static function getImage($id){
        return ImageModel::where("id",$id)->first();
    }
    public static function addImage($request){
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
            ImageModel::where("id",$request->id)->update($document);
        }else{
            $document['created_by'] = auth()->user()->id;
            ImageModel::create($document);
        }
    }
    public static function removeImage($id){
        return ImageModel::where("id",$id)->delete();
    }
}
