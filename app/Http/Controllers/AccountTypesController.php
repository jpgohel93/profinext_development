<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\AccountTypeServices;

class AccountTypesController extends Controller
{
    public function view()   {
        $types = AccountTypeServices::view();
        return view("settings.users.accountType",compact('types'));
    }
    public function create(Request $request){
        AccountTypeServices::create($request);
        return Redirect::route('viewUsersAccountType')->with("info","New Type created");
    }
    public function remove(Request $request,$id){
        AccountTypeServices::remove($id);
        return Redirect::route('viewUsersAccountType')->with("info", "Account Type Removed!");
    }
    public function get(Request $request){
        $type = AccountTypeServices::get($request->id);
        return Response($type)->header('Content-Type',"application/json");
    }
    public function edit(Request $request){
        AccountTypeServices::edit($request);
        return Redirect::route('viewUsersAccountType')->with("info", "Account Type Updated!");
    }
}
