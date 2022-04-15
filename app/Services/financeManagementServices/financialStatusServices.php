<?php

namespace App\Services\financeManagementServices;

use App\Models\Client;
use App\Models\User;
use App\Models\ClientDemat;
use App\Models\financeManagementModel\financeManagementIncomesModel;
use App\Models\financeManagementModel\financeManagementExpensesModel;
use App\Models\financeManagementModel\financeManagementTransferModel;

class financialStatusServices
{
    public static function getFirmsDetails(){
        // current financial year
        $start = date("Y-m-d", strtotime(date("Y") . "-03-31"));
        $end = date("Y-m-d", strtotime((date("Y") + 1) . "-03-31"));

        // st
        $firmTab['st']['income'] = financeManagementIncomesModel::where("income_form","st")->whereDate("date",">=",$start)->whereDate("date", "<=", $end)->sum("amount");

        $firmTab['st']['expense'] = financeManagementExpensesModel::where("income_form","st")->whereDate("date",">=",$start)->whereDate("date", "<=", $end)->sum("amount");

        $firmTab['st']['clients'] = ClientDemat::distinct("client_id","st_sg")->where("st_sg", "ST")->whereDate("joining_date",">=",$start)->whereDate("joining_date", "<=", $end)->count();
        $firmTab['st']['users'] = User::whereNotNull("company_first")->whereDate("joining_date",">=",$start)->whereDate("joining_date", "<=", $end)->count();
        // sg
        $firmTab['sg']['income'] = financeManagementIncomesModel::where("income_form","sg")->whereDate("date",">=",$start)->whereDate("date", "<=", $end)->sum("amount");
        $firmTab['sg']['expense'] = financeManagementExpensesModel::where("income_form","sg")->whereDate("date",">=",$start)->whereDate("date", "<=", $end)->sum("amount");
        $firmTab['sg']['clients'] = ClientDemat::distinct("client_id","st_sg")->where("st_sg", "SG")->whereDate("joining_date",">=",$start)->whereDate("joining_date", "<=", $end)->count();
        $firmTab['sg']['users'] = User::whereNotNull("company_second")->whereDate("joining_date",">=",$start)->whereDate("joining_date", "<=", $end)->count();

        // both income
        $both['st'] = financeManagementIncomesModel::where("income_form","both")->whereDate("date",">=",$start)->whereDate("date", "<=", $end)->sum("st_amount");
        $both['sg'] = financeManagementIncomesModel::where("income_form","both")->whereDate("date",">=",$start)->whereDate("date", "<=", $end)->sum("sg_amount");

        // both expense
        $both_e['st'] = financeManagementExpensesModel::where("income_form","both")->whereDate("date",">=",$start)->whereDate("date", "<=", $end)->sum("st_amount");
        $both_e['sg'] = financeManagementExpensesModel::where("income_form","both")->whereDate("date",">=",$start)->whereDate("date", "<=", $end)->sum("sg_amount");

        $firmTab['st']['income'] += $both['st'];
        $firmTab['sg']['income'] += $both['sg'];

        $firmTab['st']['expense'] += $both_e['st'];
        $firmTab['sg']['expense'] += $both_e['sg'];
        return $firmTab;
    }
    public static function getBanksDetails(){
        $bank = array();
        // current financial year
        $start = date("Y-m-d",strtotime(date("Y")."-03-31"));
        $end = date("Y-m-d",strtotime((date("Y")+1)."-03-31"));

        $bank['salary'] = financeManagementTransferModel::leftJoin("finance_management_banks", "finance_management_transfers.to","like", "finance_management_banks.title")->where("finance_management_banks.type",2)->whereDate("finance_management_transfers.date",">=",$start)->whereDate("finance_management_transfers.date", "<=", $end)->sum("finance_management_transfers.amount");

        $bank['st']['salary'] = financeManagementTransferModel::whereDate("date", ">=", $start)->whereDate("date", "<=", $end)->where("income_form","st")->sum("amount");
        $bank['sg']['salary'] = financeManagementTransferModel::whereDate("date", ">=", $start)->whereDate("date", "<=", $end)->where("income_form", "sg")->sum("amount");
        
        
        $bank['income'] = financeManagementIncomesModel::where("finance_management_incomes.mode", "1")->leftJoin("finance_management_banks", "finance_management_incomes.bank", "=", "finance_management_banks.id")->where("finance_management_banks.type", 1)->whereDate("finance_management_incomes.date", ">=", $start)->whereDate("finance_management_incomes.date", "<=", $end)->sum("finance_management_incomes.amount");
        
        // $bank['income'] = financeManagementIncomesModel::where("mode","1")->whereDate("date",">=",$start)->whereDate("date", "<=", $end)->sum("amount");
        $bank['cash'] = financeManagementIncomesModel::where("mode","0")->whereDate("date",">=",$start)->whereDate("date", "<=", $end)->sum("amount");
        $bank['st']['cash'] = financeManagementIncomesModel::where("mode","0")->whereDate("date",">=",$start)->whereDate("date", "<=", $end)->sum("st_amount");
        $bank['sg']['cash'] = financeManagementIncomesModel::where("mode","0")->whereDate("date",">=",$start)->whereDate("date", "<=", $end)->sum("sg_amount");

        return $bank;
    }
    public static function getUsersDetails(){
        return User::with("withNumber:user_id,number")->get();
    }
    public static function getServicesDetails(){
        $services = array();
        $services['prime'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 1)->get()->count();
        $services['ams'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 2)->get()->count();
        $services['prime_next'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 3)->get()->count();
        $services['mutual_fund'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("clients.client_type", 1)->get()->count();
        $services['unlisted_shares'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("clients.client_type", 2)->get()->count();
        $services['insurance'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("clients.client_type", 3)->get()->count();
        return $services;
    }
    public static function serviceTabFilter($request){
        $services = array();
        $filter = $request->filter;
        if ($filter == "prime") {
            $services = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name", "clients.client_type")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 1)->get();
        }
        else if ($filter == "ams") {
            $services = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name", "clients.client_type")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 2)->get();
        }
        else if ($filter == "prime_next") {
            $services = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name", "clients.client_type")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 3)->get();
        }else{
            $services['prime'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name", "clients.client_type")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 1)->get();
            $services['ams'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name", "clients.client_type")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 2)->get();
            $services['prime_next'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name", "clients.client_type")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 3)->get();

            $data = array();
            $data['data'] = array();
            $i = 0;
            foreach ($services as $serivce) {
                foreach ($serivce as $client){
                    $arr = array();
                    array_push($arr, $i + 1);
                    array_push($arr, $client->name);
                    array_push($arr, Config()->get("constants.USERS_TYPE")[$client->client_type]);
                    array_push($arr, 0);
                    array_push($arr, "<a href='javascript:void(0)' class='viewDemat' data-id='" . $client->id . "'><i class='fas fa-eye fa-xl px-3'></i></a>");
                    array_push($data['data'], $arr);
                    $i++;
                }
            }
            $data["recordsTotal"] = $i;
            $data["recordsFiltered"] = $i;
            return $data;
        }
        $data = array();
        $data['data'] = array();
        $i = 0;
        foreach ($services as $client) {
            $arr = array();
            array_push($arr, $i+1);
            array_push($arr, $client->name);
            array_push($arr, Config()->get("constants.USERS_TYPE")[$client->client_type]);
            array_push($arr, 0);
            array_push($arr, "<a href='javascript:void(0)' class='viewDemat' data-id='" . $client->id . "'><i class='fas fa-eye fa-xl px-3'></i></a>");
            array_push($data['data'], $arr);
            $i++;
        }
        $data["recordsTotal"] = $i;
        $data["recordsFiltered"] = $i;
        return $data;
    }
    public static function getBalanceDetails(){
        $balance = array();
        $balance['bank'] = financeManagementIncomesModel::where("mode",1)->WhereNotNull("bank")->sum("amount");
        $balance['cash'] = financeManagementIncomesModel::where("mode",0)->sum("amount");
        $balance['st'] = financeManagementIncomesModel::where("income_form","st")->orWhere("income_form","both")->sum("st_amount");
        $balance['sg'] = financeManagementIncomesModel::where("income_form","sg")->orWhere("income_form","both")->sum("sg_amount");
        return $balance;
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
        $demat = array();
        $income["day"] = financeManagementIncomesModel::where("created_by", auth()->user()->id)->whereDate("date", date("Y-m-d"))->sum("amount");
        $expense["day"] = financeManagementExpensesModel::where("created_by", auth()->user()->id)->whereDate("date", date("Y-m-d"))->sum("amount");

        $income["month"] = financeManagementIncomesModel::where("created_by", auth()->user()->id)->whereYear("date", date("Y"))->whereMonth("date", date("m"))->sum("amount");
        $expense["month"] = financeManagementExpensesModel::where("created_by", auth()->user()->id)->whereYear("date", date("Y"))->whereMonth("date", date("m"))->sum("amount");
        $demat['total'] = Client::where("created_by", auth()->user()->id)->count();
        $demat['service_details'] = self::getServicesDetails();
        return view("financeManagement.financialStatus.sg", compact("income", "expense", "demat"));
    }
    public static function viewMore($request)
    {
        $demat = array();
        if(null!== $request->startDate){
            $startDate = date("Y-m-d",strtotime($request->startDate));
            $endDate = date("Y-m-d",strtotime($request->endDate));
        }else{
            // current financial year
            $startDate = date("Y-m-d",strtotime("1st day of this month"));
            $endDate = date("Y-m-d",strtotime("last day of this month"));
        }

        $bank = array();

        $bank['salary'] = financeManagementTransferModel::leftJoin("finance_management_banks", "finance_management_transfers.to", "like", "finance_management_banks.title")->where("finance_management_banks.type", 2)->whereDate("finance_management_transfers.date",">=",$startDate)->whereDate("finance_management_transfers.date","<=",$endDate)->sum("finance_management_transfers.amount");

        $bank['st']['salary'] = financeManagementTransferModel::whereDate("date",">=",$startDate)->whereDate("date","<=",$endDate)->sum("amount");

        $bank['sg']['salary'] = financeManagementTransferModel::whereDate("date",">=",$startDate)->whereDate("date","<=",$endDate)->sum("amount");


        $bank['income'] = financeManagementIncomesModel::where("finance_management_incomes.mode", "1")->leftJoin("finance_management_banks", "finance_management_incomes.bank", "=", "finance_management_banks.id")->where("finance_management_banks.type", 1)->whereDate("finance_management_incomes.date",">=",$startDate)->whereDate("finance_management_incomes.date","<=",$endDate)->sum("finance_management_incomes.amount");

        $bank['cash'] = financeManagementIncomesModel::where("mode", "0")->whereDate("date",">=",$startDate)->whereDate("date", "<=",$endDate)->sum("amount");

        $bank['st']['cash'] = financeManagementIncomesModel::where("mode", "0")->whereDate("date",">=",$startDate)->whereDate("date","<=",$endDate)->sum("st_amount");
        $bank['sg']['cash'] = financeManagementIncomesModel::where("mode", "0")->whereDate("date",">=",$startDate)->whereDate("date", "<=", $endDate)->sum("sg_amount");

        $firmTab['st']['income'] = financeManagementIncomesModel::where("income_form", "st")->whereDate("date",">=",$startDate)->whereDate("date","<=",$endDate)->sum("amount");

        $firmTab['sg']['income'] = financeManagementIncomesModel::where("income_form", "sg")->whereDate("date",">=",$startDate)->whereDate("date","<=",$endDate)->sum("amount");

        
        if($request->ajax()){
            $html = "<tr>
                        <td>Income</td>
                        <td>".$bank['income']."</td>
                        <td>".$bank['income']."</td>
                        <td>0</td>
                        <td>".$firmTab['st']['income'].','.$firmTab['sg']['income']."</td>
                        <td>
                            <a href=".route('viewMore').">
                                <i class='fas fa-eye fa-lg'></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Salary</td>
                        <td>".$bank['salary']."</td>
                        <td>".$bank['salary']."</td>
                        <td>0</td>
                        <td>".$bank['st']['salary'].','.$bank['sg']['salary']."</td>
                        <td>
                            <a href=".route('viewMore').">
                                <i class='fas fa-eye fa-lg'></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Cash</td>
                        <td>".$bank['cash']."</td>
                        <td>".$bank['cash']."</td>
                        <td>0</td>
                        <td>".$bank['st']['cash'].','.$bank['sg']['cash']."</td>
                        <td>
                            <a href=".route('viewMore').">
                                <i class='fas fa-eye fa-lg'></i>
                            </a>
                        </td>
                    </tr>";
            return response(json_encode(["data"=>$html]),200, ["Content-Type" => "Application/json"]);
        }else{
            $income["day"] = financeManagementIncomesModel::where("created_by", auth()->user()->id)->whereDate("date", ">=",$startDate)->whereDate("date","<=",$endDate)->sum("amount");
            $expense["day"] = financeManagementExpensesModel::where("created_by", auth()->user()->id)->whereDate("date", ">=",$startDate)->whereDate("date","<=",$endDate)->sum("amount");

            $income["month"] = financeManagementIncomesModel::where("created_by", auth()->user()->id)->whereYear("date", date("Y"))->whereMonth("date", date("m"))->sum("amount");
            $expense["month"] = financeManagementExpensesModel::where("created_by", auth()->user()->id)->whereYear("date", date("Y"))->whereMonth("date", date("m"))->sum("amount");
            $demat['total'] = Client::where("created_by", auth()->user()->id)->count();
            $demat['service_details'] = self::getServicesDetails();
        }
        return view("financeManagement.financialStatus.bank", compact("income", "expense", "demat",'bank', 'firmTab'));
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
            array_push($arr,($account['service_type'] == 1) ? "Prime" : ($account['service_type'] == 2?"AMS":"Prime next"));
            array_push($arr,"<a href='javascript:void(0)' class='viewDemat' data-id='".$account['client_id']."'><i class='fas fa-eye fa-xl px-3'></i></a>");

            array_push($demat['data'],$arr);
            $i++;
        }
        $demat["recordsTotal"]=$i;
        $demat["recordsFiltered"]=$i;
        return $demat;
    }
}   
