<?php

namespace App\Services\documentManagement;
use App\Models\documentManagement\documentManagementModel;
use App\Models\PancardImageModel;
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
        })->where("client_demat.created_by","=",auth()->user()->id)->groupBy("tbl_pancards.client_demat_id","tbl_pancards.file")->select("clients.name","clients.id as client_id","client_demat.holder_name","tbl_pancards.*")->get();
        $client_ids = [];
        // loop through all pan cards rows of tbl_pancards table
        foreach($panCards as $panCard){
            // check if client exists in array
            if(!array_key_exists($panCard->client_id,$client_ids)){
                // client not exists. create new array using client id and add all demat accounts of that client in this array
                $demat = array();
                $demat['holder_name'] = $panCard->holder_name;
                $demat['created_at'] = date("Y-m-d",strtotime($panCard->created_at));
                $demat['client_name'] = $panCard->name;
                $demat['demat_id'] = $panCard->client_demat_id;
                // create new array by using demat id and
                // we're looping through pan cards not demats so we've need to add all images of pan card own by this demat to this array which one created by demat id.
                $client_ids[$panCard->client_id][$panCard->client_demat_id] = $demat;
            }else{
                // client id and demat id exists. add pan card to demat id array
                if(!array_key_exists($panCard->client_demat_id,$client_ids[$panCard->client_id])){
                    $demat = array();
                    $demat['holder_name'] = $panCard->holder_name;
                    $demat['created_at'] = date("Y-m-d",strtotime($panCard->created_at));
                    $demat['client_name'] = $panCard->name;
                    $demat['demat_id'] = $panCard->client_demat_id;
                    $client_ids[$panCard->client_id][$panCard->client_demat_id] = $demat;
                }
            }
        }
        return $client_ids;
    }
}