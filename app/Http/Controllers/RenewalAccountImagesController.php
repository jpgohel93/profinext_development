<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RenewalAccountImagesServices;
use Illuminate\Support\Facades\Redirect;
class RenewalAccountImagesController extends Controller
{
    public function create(Request $request){
        RenewalAccountImagesServices::create($request);
        return Redirect::back()->with("info","Image uploaded");
    }
    public function get(Request $request){
        $images = RenewalAccountImagesServices::get($request->id);
        return response(json_encode(["data"=>$images]),200, ["Content-Type" => "Application/json"]);
    }
}
