<?php

namespace App\Http\Controllers\financeManagementControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\financeManagementServices\financialStatusServices;
class FinancialStatusController extends Controller
{
    public function financialStatus(){
        $banksTab = financialStatusServices::getBanksDetails();
        $usersTab = financialStatusServices::getUsersDetails();
        $servicesTab = financialStatusServices::getServicesDetails();
        return view("financeManagement.financialStatus.index",compact("banksTab", "usersTab", "servicesTab"));
    }
}
