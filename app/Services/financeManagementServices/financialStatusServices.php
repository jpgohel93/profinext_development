<?php

namespace App\Services\financeManagementServices;
use App\Models\financeManagementModel\BankModel;
use App\Models\User;
use App\Models\ClientDemat;
class financialStatusServices
{
    public static function getBanksDetails(){
        return BankModel::get();
    }
    public static function getUsersDetails(){
        return User::with("withNumber:user_id,number")->get();
    }
    public static function getServicesDetails(){
        $services = array();
        $services['prime'] = ClientDemat::distinct("client_id")->where("service_type",1)->count();
        $services['ams'] = ClientDemat::distinct("client_id")->where("service_type",2)->count();
        return $services;
    }
}
