<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProfessionServices;
use Illuminate\Support\Facades\Redirect;

class ProfessionController extends Controller
{
    public function view(){
        $professions = ProfessionServices::view();
        return view('settings.clients.profession',compact('professions'));
    }
    public function create(Request $request)
    {
        ProfessionServices::create($request);
        return Redirect::route('viewClientsProfession')->with("info", "New Profession created");
    }
    public function remove(Request $request, $id)
    {
        ProfessionServices::remove($id);
        return Redirect::route('viewClientsProfession')->with("info", "Profession Removed!");
    }
    public function get(Request $request)
    {
        $type = ProfessionServices::get($request->id);
        return Response($type)->header('Content-Type', "application/json");
    }
    public function edit(Request $request)
    {
        ProfessionServices::edit($request);
        return Redirect::route('viewClientsProfession')->with("info", "Profession Updated!");
    }
}
