<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BankDetailsServices;
use Illuminate\Support\Facades\Redirect;

class BankDetailsController extends Controller
{
    private $viewClientsBanks = "viewClientsBanks";

    public function view()
    {
        $banks = BankDetailsServices::view();
        return view('settings.clients.banks', compact('banks'));
    }
    public function create(Request $request)
    {
        BankDetailsServices::create($request);
        return Redirect::route($this->viewClientsBanks)->with("info", "New Bank created");
    }
    public function remove(Request $request, $id)
    {
        BankDetailsServices::remove($id);
        return Redirect::route($this->viewClientsBanks)->with("info", "Bank Removed!");
    }
    public function get(Request $request)
    {
        $type = BankDetailsServices::get($request->id);
        return Response($type)->header('Content-Type', "application/json");
    }
    public function edit(Request $request)
    {
        BankDetailsServices::edit($request);
        return Redirect::route($this->viewClientsBanks)->with("info", "Bank Updated!");
    }
}
