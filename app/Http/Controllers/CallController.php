<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CallServices;
use Illuminate\Support\Facades\Redirect;
class CallController extends Controller
{
    public function view(){
        $calls = CallServices::view();
        return view('calls.calls',compact("calls"));
    }
    public function create(Request $request){
        CallServices::create($request);
        return Redirect::route('calls')->with("info","Call has been created");
    }
}
