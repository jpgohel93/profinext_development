<?php

namespace App\Services\financeManagementServices;

use App\Models\Client;
use App\Models\financeManagementModel\BankModel;
use App\Models\User;
use App\Models\ClientDemat;
use App\Models\financeManagementModel\financeManagementIncomesModel;
use App\Models\financeManagementModel\financeManagementExpensesModel;
use App\Services\ClientDemateServices;
class financialStatusServices
{
    public static function getFirmsDetails(){
        // st
        $firmTab['st']['income'] = financeManagementIncomesModel::where("income_form","st")->sum("amount");
        $firmTab['st']['expense'] = financeManagementExpensesModel::where("income_form","st")->sum("amount");
        $firmTab['st']['clients'] = ClientDemat::distinct("client_id","st_sg")->where("st_sg", "ST")->count();
        $firmTab['st']['users'] = User::whereNotNull("company_first")->count();
        // sg
        $firmTab['sg']['income'] = financeManagementIncomesModel::where("income_form","sg")->sum("amount");
        $firmTab['sg']['expense'] = financeManagementExpensesModel::where("income_form","sg")->sum("amount");
        $firmTab['sg']['clients'] = ClientDemat::distinct("client_id","st_sg")->where("st_sg", "SG")->count();
        $firmTab['sg']['users'] = User::whereNotNull("company_second")->count();

        // both income
        $both['st'] = financeManagementIncomesModel::where("income_form","both")->sum("st_amount");
        $both['sg'] = financeManagementIncomesModel::where("income_form","both")->sum("sg_amount");

        // both expense
        $both_e['st'] = financeManagementExpensesModel::where("income_form","both")->sum("st_amount");
        $both_e['sg'] = financeManagementExpensesModel::where("income_form","both")->sum("sg_amount");

        $firmTab['st']['income'] += $both['st'];
        $firmTab['sg']['income'] += $both['sg'];

        $firmTab['st']['expense'] += $both_e['st'];
        $firmTab['sg']['expense'] += $both_e['sg'];
        return $firmTab;
    }
    public static function getBanksDetails(){
        return BankModel::get();
    }
    public static function getUsersDetails(){
        return User::with("withNumber:user_id,number")->get();
    }
    public static function getServicesDetails(){
        $services = array();
        // $services['prime'] = ClientDemat::distinct("client_id")->where("service_type",1)->count();
        $services['prime'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 1)->get()->count();

        $services['ams'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 2)->get()->count();
        return $services;
    }
    public static function viewMoreSt()
    {
        $income["day"] = financeManagementIncomesModel::where("created_by", auth()->user()->id)->whereDate("date",date("Y-m-d"))->sum("amount");
        $expense["day"] = financeManagementExpensesModel::where("created_by", auth()->user()->id)->whereDate("date", date("Y-m-d"))->sum("amount");

        $income["month"] = financeManagementIncomesModel::where("created_by", auth()->user()->id)->whereYear("date", date("Y"))->whereMonth("date", date("m"))->sum("amount");
        $expense["month"] = financeManagementExpensesModel::where("created_by", auth()->user()->id)->whereYear("date", date("Y"))->whereMonth("date", date("m"))->sum("amount");
        $demat['total'] = Client::where("created_by",auth()->user()->id)->count();
        $demat['service_details'] = self::getServicesDetails();
        return view("financeManagement.financialStatus.st",compact("income","expense","demat"));
    }
    public static function viewMoreSg()
    {
        $income["day"] = financeManagementIncomesModel::where("created_by", auth()->user()->id)->whereDate("date", date("Y-m-d"))->sum("amount");
        $expense["day"] = financeManagementExpensesModel::where("created_by", auth()->user()->id)->whereDate("date", date("Y-m-d"))->sum("amount");

        $income["month"] = financeManagementIncomesModel::where("created_by", auth()->user()->id)->whereYear("date", date("Y"))->whereMonth("date", date("m"))->sum("amount");
        $expense["month"] = financeManagementExpensesModel::where("created_by", auth()->user()->id)->whereYear("date", date("Y"))->whereMonth("date", date("m"))->sum("amount");
        $demat['total'] = Client::where("created_by", auth()->user()->id)->count();
        $demat['service_details'] = self::getServicesDetails();
        return view("financeManagement.financialStatus.sg", compact("income", "expense", "demat"));
    }
    public static function dematDetailsFinancialStatus($request){
        $demat['data']= array();

        if(isset($request->startDate) && $request->startDate!="" && isset($request->endDate) && $request->endDate != ""){
            $accounts = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->whereDate("client_demat.created_at",">=", date("Y-m-d",strtotime($request->startDate)))->whereDate("client_demat.created_at","<=", date("Y-m-d",strtotime($request->endDate)))->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->get();
        }else{
            $accounts = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->whereYear("client_demat.created_at", date("Y"))->whereMonth("client_demat.created_at", date("m"))->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->get();
        }
        
        $i=0;
        foreach($accounts as $account){
            $arr = array();
            array_push($arr,$account['serial_number']);
            array_push($arr,$account['name']);
            array_push($arr,($account['service_type']==1)?"Prime":"AMS");
            array_push($arr,"<a href='javascript:void(0)' class='viewDemat' data-id='".$account['client_id']."'>View more</a>");

            array_push($demat['data'],$arr);
            $i++;
        }
        $demat["recordsTotal"]=$i;
        $demat["recordsFiltered"]=$i;
        return $demat;
    }
}   
