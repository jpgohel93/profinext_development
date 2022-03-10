<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\ClientServices;
use App\Services\UserServices;

class ChannelPartnerController extends Controller
{
    function __construct()
    {

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

}
