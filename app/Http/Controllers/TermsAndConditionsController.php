<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\TermsAndConditionsServices;
class TermsAndConditionsController extends Controller
{
    public function __construct(){

    }
    public function view(){
        $terms = TermsAndConditionsServices::all();
        return view("settings.terms-and-condition",compact("terms"));
    }
    public function create(Request $request){
        $id = TermsAndConditionsServices::create($request);
        if($id){
            return Redirect::back()->with("info","Terms and conditions created");
        }
        return Redirect::back()->with("info", "Unable to create Terms and conditions");
    }
    public function update(Request $request){
        $id = TermsAndConditionsServices::update($request);
        if($id){
            return Redirect::back()->with("info","Terms and condition updated");
        }
        return Redirect::back()->with("info", "Unable to updated Terms and conditions");
    }
    public function get(Request $request){
        $terms = TermsAndConditionsServices::get($request->id);
        if($request->ajax()){
            return response($terms,200, ["Content-Type" => "Application/json"]);
        }
        return view("settings.terms-and-condition", compact("terms"));
    }
    public function remove($id){
        TermsAndConditionsServices::remove($id);
        return Redirect::back()->with("info", "Terms and conditions removed");
    }
}
