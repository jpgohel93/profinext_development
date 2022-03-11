<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\ClientServices;
use App\Services\UserServices;

class FreelancerController extends Controller
{
    function __construct()
    {

    }
    // View all freelancer data
    public function freelancerData(){
        $freelancerData = UserServices::getFreelancerData();
        return view("freelancer.freelancer", compact('freelancerData'));
    }
    // view all the freelancer client list
        //    public function freelancerClientData(Request $request,$id){
        //        $freelancerClient = ClientServices::freelancerClientList($id);
        //        return view("freelancer.freelancer_client", compact('freelancerClient'));
        //    }
    public function freelancerClientData(Request $request,$id){
        $freelancerClient = ClientServices::freelancerClientList($id);
        return view("freelancer.freelancer_client", compact('freelancerClient'));
    }

}
