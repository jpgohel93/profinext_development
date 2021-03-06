<?php

namespace App\Http\Controllers;

use App\Services\ClientDemateServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ClientServices;
use App\Services\UserServices;

class ChannelPartnerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:channel-partner-data-read', ['only' => ['channelPartnerData', 'channelPartnerClientData']]);
        $this->middleware('permission:channel-partner-read', ['only' => ['channelPartnerUserData']]);
    }
    // View all channel Partner data
    public function channelPartnerData(){
        $channelPartnerData = UserServices::getChannelPartnerData();
        return view("channelPartner.channel_partner", compact('channelPartnerData'));
    }
    // view all the channel Partner client list
    public function channelPartnerClientData(Request $request,$id){
        $channelPartnerClient = ClientServices::channelPartnerClientList($id);
        return view("channelPartner.channel_partner_client", compact('channelPartnerClient'));
    }

    public function channelPartnerUserData(){
        $auth_user = Auth::user();
        $channelPartnerClient = ClientServices::channelPartnerClientList($auth_user->id);

        $demats = ClientDemateServices::activeDematByChanelPartner();
        $toRenews = ClientDemateServices::toRenewsByChanelPartner();
        $problemAccounts = ClientDemateServices::problemAccountsByChanelPartner();
        $terminatedAccounts = ClientDemateServices::terminatedAccountsByChanelPartner();

        return view("channelPartner.channel_partner_user_client", compact('channelPartnerClient','demats','toRenews','problemAccounts','terminatedAccounts'));
    }

}
