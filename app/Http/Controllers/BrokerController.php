<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\BrokerServices;
class BrokerController extends Controller
{
    private $viewClientsBroker = "viewClientsBroker";

    public function view()
    {
        $brokers = BrokerServices::view();
        return view('settings.clients.broker', compact('brokers'));
    }
    public function create(Request $request)
    {
        BrokerServices::create($request);
        return Redirect::route($this->viewClientsBroker)->with("info", "New Broker created");
    }
    public function remove(Request $request, $id)
    {
        BrokerServices::remove($id);
        return Redirect::route($this->viewClientsBroker)->with("info", "Broker Removed!");
    }
    public function get(Request $request)
    {
        $type = BrokerServices::get($request->id);
        return Response($type)->header('Content-Type', "application/json");
    }
    public function edit(Request $request)
    {
        BrokerServices::edit($request);
        return Redirect::route($this->viewClientsBroker)->with("info", "Broker Updated!");
    }
}
