<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AnalystServices;
use Illuminate\Support\Facades\Redirect;

class AnalystController extends Controller
{
    public function view(Request $request){
        $analysts = AnalystServices::all();
        return view("analyst.analyst",compact('analysts'));
    }
    public function createForm(){
        return view("analyst.add");
    }
    public function create(Request $request){
        AnalystServices::create($request);
        return Redirect::route('analysts')->with("info","Analyst has been created");
    }
    public function getAnalyst(Request $request,$id){
        $analyst = AnalystServices::getAnalyst($id);
        return response($analyst)->header('Content-Type', 'application/json');
    }
    public function editAnalyst(Request $request){
        AnalystServices::update($request);
        return Redirect::route('analysts')->with("info", "Analyst has been Updated");
    }
}
