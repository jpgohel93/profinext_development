<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\ClirntServices;
use App\Services\UserServices;

class FreelancerController extends Controller
{
    function __construct()
    {

    }
    // create client form
    public function freelancerData(){
        $freelancerData = UserServices::getFreelancerData();
        return view("freelancer.freelancer", compact('freelancerData'));
    }

}
