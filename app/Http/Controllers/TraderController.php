<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\TraderServices;
use Illuminate\Support\Facades\Auth;
class TraderController extends Controller
{
    private $viewTrader = "viewTrader";

    public function view()
    {
        $traders = TraderServices::view();
        return view('trader.index', compact('traders'));
    }
    public function create(Request $request)
    {
        TraderServices::create($request);
        return Redirect::route($this->viewTrader)->with("info", "Client Assinged");
    }
    public function remove(Request $request, $id)
    {
        TraderServices::remove($id);
        return Redirect::route($this->viewTrader)->with("info", "Client Removed from trader!");
    }
    public function get(Request $request)
    {
        $type = TraderServices::get($request->id);
        return Response($type)->header('Content-Type', "application/json");
    }
    public function edit(Request $request)
    {
        TraderServices::edit($request);
        return Redirect::route($this->viewTrader)->with("info", "Trader Updated!");
    }
}
