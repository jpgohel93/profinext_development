<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\KeywordServices;

class KeywordController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:keyword-read', ['only' => ['keywordData']]);
        $this->middleware('permission:keyword-write', ['only' => ['editKeyword']]);
        $this->middleware('permission:keyword-create', ['only' => ['addKeyword']]);
        $this->middleware('permission:keyword-delete', ['only' => ['deleteKeyword']]);
    }
    // View all Keyword
    public function keywordData(){
        $keywords = KeywordServices::all();
        return view("keyword.keyword", compact('keywords'));
    }
    // add Keyword
    public function addKeyword(Request $request)
    {
        $keywordData = KeywordServices::getKeywordByName($request->name);
        if (empty($keywordData)) {
            KeywordServices::create($request);
            return Redirect::route("keywordData")->with("info", "Keyword have been created");
        } else {
            return Redirect::route("keywordData")->with("info", "Keyword name is already exits");
        }
    }
    // edit Keyword
    public function editKeyword(Request $request){
        $keywordData = KeywordServices::getKeywordByNameId($request->keyword_id,$request->name);
        if (empty($keywordData)) {
            KeywordServices::edit($request);
            return Redirect::route("keywordData")->with("info", "Keyword have been updated");
        }else {
            return Redirect::route("keywordData")->with("info", "Keyword name is already exits");
        }
    }
    //delete Keyword
    public function deleteKeyword($id){
        KeywordServices::remove($id);
        return Redirect::route("keywordData")->with("info","Keyword have been deleted");
    }

}

