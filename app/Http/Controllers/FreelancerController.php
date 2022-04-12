<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Services\ClientServices;
use App\Services\UserServices;

class FreelancerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:freelancer-data-read', ['only' => ['freelancerData', 'freelancerClientData']]);
        $this->middleware('permission:freelancer-read', ['only' => ['freelancerUserData']]);
    }
    public function freelancerData(){
        $freelancerData = UserServices::getFreelancerData();
        return view("freelancer.freelancer", compact('freelancerData'));
    }
    public function freelancerClientData(Request $request,$id){
        $freelancerClient = ClientServices::freelancerClientList($id);
        return view("freelancer.freelancer_client", compact('freelancerClient'));
    }

    public function freelancerUserData(){
        $auth_user = Auth::user();
        $freelancerClient = ClientServices::freelancerClientList($auth_user->id);
        return view("freelancer.freelancer_user_client", compact('freelancerClient'));
    }

}
