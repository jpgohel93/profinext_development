<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\documentManagement\documentServices;
use Illuminate\Support\Facades\Redirect;
class documentManagementController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:role-create', ['only' => ['createRole', 'addRolesForm']]);
        // $this->middleware('permission:role-write', ['only' => ['editRoleForm', 'editRole']]);
        // $this->middleware('permission:role-read', ['only' => ['view', 'getPermissions']]);
        // $this->middleware('permission:role-delete', ['only' => ['removeRole']]);
    }
    public function data(){
        $documents = documentServices::all();
        return view("documentManagement.data",compact("documents"));
    }
    public function addDocument(Request $request){
        documentServices::addData($request);
        if($request->id){
            return Redirect::back()->with("info","Document Updated");
        }
        return Redirect::back()->with("info","Document uploaded");
    }
    public function getDocument(Request $request,$id){
        $document = documentServices::getData($id);
        if($request->ajax()){
            return response($document,200, ["Content-Type" => "Application/json"]);
        }
        abort(403);
    }
    public function removeDocument($id){
        documentServices::remove($id);
        return Redirect::back()->with("info","Document Removed");
    }
    public function panCards(){
        $panCards = documentServices::panCards();
        return view("documentManagement.pan-card", compact("panCards"));
    }
    public function screenshots(){
        $screenshots = documentServices::screenshots();
        return view("documentManagement.screenshot", compact("screenshots"));
    }
    public function images(){
        $images = documentServices::images();
        return view("documentManagement.images",compact("images"));
    }
    public function getPancardDocument(Request $request,$id){
        $document = documentServices::getPancardData($id);
        if($request->ajax()){
            return response($document,200, ["Content-Type" => "Application/json"]);
        }
        abort(403);
    }
    public function editPanCardDocument(Request $request){
        documentServices::editPanCardData($request);
        if($request->id){
            return Redirect::back()->with("info","Document Updated");
        }
        return Redirect::back()->with("info","Document uploaded");
    }
    public function removePanCardDocument($id){
        documentServices::removePanCard($id);
        return Redirect::back()->with("info","Document Removed");
    }

    public function getScreenshotsDocument(Request $request,$id){
        $document = documentServices::getScreenshotsData($id);
        if($request->ajax()){
            return response($document,200, ["Content-Type" => "Application/json"]);
        }
        abort(403);
    }
    public function editScreenshotDocument(Request $request){
        documentServices::editScreenshotsData($request);
        if($request->id){
            return Redirect::back()->with("info","Document Updated");
        }
        return Redirect::back()->with("info","Document uploaded");
    }
    public function removeScreenshotDocument($id){
        documentServices::removeScreenshots($id);
        return Redirect::back()->with("info","Document Removed");
    }

    public function addImage(Request $request){
        documentServices::addImage($request);
        if($request->id){
            return Redirect::back()->with("info","Image Updated");
        }
        return Redirect::back()->with("info","Image uploaded");
    }
    public function getImage(Request $request,$id){
        $document = documentServices::getImage($id);
        if($request->ajax()){
            return response($document,200, ["Content-Type" => "Application/json"]);
        }
        abort(403);
    }
    public function removeImage($id){
        documentServices::removeImage($id);
        return Redirect::back()->with("info","Image Removed");
    }
}
