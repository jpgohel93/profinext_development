<?php

namespace App\Http\Controllers\financeManagementControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinancialStatusController extends Controller
{
    public function financialStatus(){
        return view("financeManagement.financialStatus.index");
    }
}
