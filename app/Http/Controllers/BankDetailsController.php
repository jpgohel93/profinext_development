<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BankDetailsServices;
use Illuminate\Support\Facades\Redirect;

class BankDetailsController extends Controller
{
public function __construct()
    {
        $this->middleware('permission:settings-bank-details-read', ['only' => ["view", "get"]]);
        $this->middleware('permission:settings-bank-details-write', ['only' => ["edit"]]);
        $this->middleware('permission:settings-bank-details-create', ['only' => ["create"]]);
        $this->middleware('permission:settings-bank-details-delete', ['only' => ["remove"]]);
    }
    public function view()
    {
        $banks = BankDetailsServices::view();
        return view('settings.clients.banks', compact('banks'));
    }
    public function create(Request $request)
    {
        BankDetailsServices::create($request);
        return Redirect::route("viewClientsBanks")->with("info", "New Bank created");
    }
    public function remove($id)
    {
        BankDetailsServices::remove($id);
        return Redirect::route("viewClientsBanks")->with("info", "Bank Removed!");
    }
    public function get(Request $request)
    {
        $type = BankDetailsServices::get($request->id);
        return Response($type)->header('Content-Type', "application/json");
    }
    public function edit(Request $request)
    {
        BankDetailsServices::edit($request);
        return Redirect::route("viewClientsBanks")->with("info", "Bank Updated!");
    }
}
