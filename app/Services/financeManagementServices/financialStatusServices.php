<?php

namespace App\Services\financeManagementServices;

use App\Models\Client;
use App\Models\User;
use App\Models\ClientDemat;
use App\Models\financeManagementModel\financeManagementIncomesModel;
use App\Models\financeManagementModel\financeManagementExpensesModel;
use App\Models\financeManagementModel\financeManagementTransferModel;
use App\Models\financeManagementModel\financeManagementLoanModel;
use App\Models\financeManagementModel\BankModel;
use App\Models\RenewExpensesModal;
use App\Services\CommonService;
class financialStatusServices
{
    public static function getFirmsDetails(){
        // current financial year
        $start = date("Y-m-d", strtotime(date("Y") . "-04-01"));
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
        $start = date("Y-m-d",strtotime(date("Y")."-04-01"));
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
    public static function getUsersDetails($request){
        if(null !== $request->filter){
            $filter = $request->filter;
            if($filter=="quarterly"){
                $days= CommonService::getQuarterDay(date('n'), date('j'), date('Y'));
                $startDate = date("Y-m-01");
                $endDate = date("Y-m-t");
            }
            else if($filter==100){
                // current month
                $startDate = date("Y-m-01");
                $endDate = date("Y-m-t");
            }
            else if($filter==500){
                // current year
                $startDate = date("Y-01-01");
                $endDate = date("Y-m-d",strtotime((date("Y")+1)."-12-"."31"));
            }else{
                // custom
                $startDate = trim(explode("/",$request->filter)[0]);
                $endDate = trim(explode("/",$request->filter)[1]);
            }
        }else{
            $startDate = date("Y-m-01");
            $endDate = date("Y-m-t");
        }
        // current financial year
        $start = date("Y-m-d", strtotime(date("Y") . "-04-01"));
        $end = date("Y-m-d", strtotime((date("Y") + 1) . "-03-31"));


        $users_data = User::whereDate("joining_date",">=",$startDate)->whereDate("joining_date","<=",$endDate)->select('name',"user_type","id as user_id","company_first","company_second","profit_percentage_first","profit_percentage_second")->get();

        $users['data']= array();
        $i=0;

        // all incomes
        $incomes = financeManagementIncomesModel::whereDate("date",">=",$startDate)->whereDate("date","<=",$endDate)->sum("amount");
        $expense = financeManagementExpensesModel::whereDate("date",">=",$startDate)->whereDate("date","<=",$endDate)->sum("amount");
        $net_profit = (int)$incomes-(int)$expense;
        foreach($users_data as $user){
            $arr = array();
            if(isset($user->user_id)){
                array_push($arr,++$i);
                array_push($arr,$user->name);
                array_push($arr, isset($user->user_type)?Config()->get("constants.USERS_TYPE")[$user->user_type]:"");

                $earnings = 0;
                if($user->user_type==1){
                    if($user->company_first!==null && $user->profit_percentage_first){
                        $earnings += ($net_profit*$user->profit_percentage_first)/100;
                    }
                    if($user->company_second!==null){
                        $earnings += ($net_profit*$user->profit_percentage_second)/100;
                    }
                }else if($user->user_type==2){
                    $transers = financeManagementTransferModel::whereDate("date",">=",$start)->whereDate("date","<=",$end)->where("purpose","like","distribution")->where("to",$user->user_id)->where("bank_type","user")->sum("amount");
                    $renew_expenses = RenewExpensesModal::where("user_id",$user->user_id)->whereDate("date",">=",$start)->whereDate("date","<=",$end)->sum("amount");
                    $earnings += (int)$renew_expenses - (int)$transers;
                }
                array_push($arr,$earnings);
                array_push($arr, "<a href='".route('transactionDetailsFinancialStatus',$user->user_id)."' class='viewUser' data-id='" . $user->id . "'><i class='fas fa-eye fa-xl px-3'></i></a>");
                array_push($users['data'],$arr);
            }
        }
        $users["recordsTotal"]=$i;
        $users["recordsFiltered"]=$i;
        return $users;
    }
    public static function getServicesDetails($firm_type=null){
        $services = array();
        if($firm_type!=null){
            $services['prime'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 1)->where("client_demat.st_sg","like",$firm_type)->get()->count();
            $services['ams'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 2)->where("client_demat.st_sg","like",$firm_type)->get()->count();
            $services['prime_next'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 3)->where("client_demat.st_sg","like",$firm_type)->get()->count();
            $services['mutual_fund'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("clients.client_type", 1)->where("client_demat.st_sg","like",$firm_type)->get()->count();
            $services['unlisted_shares'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("clients.client_type", 2)->where("client_demat.st_sg","like",$firm_type)->get()->count();
            $services['insurance'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("clients.client_type", 3)->where("client_demat.st_sg","like",$firm_type)->get()->count();
        }else{
            $services['prime'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 1)->get()->count();
            $services['ams'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 2)->get()->count();
            $services['prime_next'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("client_demat.service_type", 3)->get()->count();
            $services['mutual_fund'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("clients.client_type", 1)->get()->count();
            $services['unlisted_shares'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("clients.client_type", 2)->get()->count();
            $services['insurance'] = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->where("clients.client_type", 3)->get()->count();
        }

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
    public static function viewMoreSt(){
        $income["day"] = financeManagementIncomesModel::where("created_by", auth()->user()->id)->whereDate("date",date("Y-m-d"))->sum("amount");
        $expense["day"] = financeManagementExpensesModel::where("created_by", auth()->user()->id)->whereDate("date", date("Y-m-d"))->sum("amount");

        $income["month"] = financeManagementIncomesModel::where("created_by", auth()->user()->id)->whereYear("date", date("Y"))->whereMonth("date", date("m"))->sum("amount");
        $expense["month"] = financeManagementExpensesModel::where("created_by", auth()->user()->id)->whereYear("date", date("Y"))->whereMonth("date", date("m"))->sum("amount");
        $demat['total'] = Client::where("created_by",auth()->user()->id)->count();
        $demat['service_details'] = self::getServicesDetails("st");
        return view("financeManagement.financialStatus.st",compact("income","expense","demat"));
    }
    public static function viewMoreSg(){
        $demat = array();

        $income["day"] = financeManagementIncomesModel::where("created_by", auth()->user()->id)->whereDate("date", date("Y-m-d"))->sum("amount");
        $expense["day"] = financeManagementExpensesModel::where("created_by", auth()->user()->id)->whereDate("date", date("Y-m-d"))->sum("amount");

        $income["month"] = financeManagementIncomesModel::where("created_by", auth()->user()->id)->whereYear("date", date("Y"))->whereMonth("date", date("m"))->sum("amount");
        $expense["month"] = financeManagementExpensesModel::where("created_by", auth()->user()->id)->whereYear("date", date("Y"))->whereMonth("date", date("m"))->sum("amount");
        $demat['total'] = Client::where("created_by", auth()->user()->id)->count();
        $demat['service_details'] = self::getServicesDetails("sg");

        return view("financeManagement.financialStatus.sg", compact("income", "expense", "demat"));
    }
    public static function viewMore($request){
        $demat = array();
        if(null!== $request->startDate){
            $startDate = date("Y-m-d",strtotime($request->startDate));
            $endDate = date("Y-m-d",strtotime($request->endDate));
        }else{
            // current financial year
            $startDate = date("Y-m-d",strtotime(date("Y")."-04-01"));
            $endDate = date("Y-m-d",strtotime(date("Y")."-03-31"));
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
    public static function incomeExpenseDetailsFinancialStatus($request){
        $demat['data']= array();
        $startDate = date("Y-m-d",strtotime(date("Y")."-04-01"));
        $endDate = date("Y-m-d",strtotime((date("Y")+1)."-03-31"));
        if(isset($startDate) && $startDate!="" && isset($endDate) && $endDate != ""){
            $income = collect(financeManagementIncomesModel::where("mode",0)->whereDate("date",">=",$startDate)->whereDate("date","<=",$endDate)->select("*","id as income")->get());

            $expense = collect(financeManagementExpensesModel::where("mode",0)->whereDate("date",">=",$startDate)->whereDate("date","<=",$endDate)->select("*","id as expense")->get());
        }else{
            $query_one = \Illuminate\Support\Facades\DB::table("finance_management_incomes")->where("income_form",$request->income_form)->leftJoin("finance_management_banks","finance_management_incomes.bank","=","finance_management_banks.id");

            $accounts = \Illuminate\Support\Facades\DB::table("finance_management_incomes")->where("income_form",$request->income_form)->leftJoin("finance_management_banks","finance_management_incomes.bank","=","finance_management_banks.id")->unionAll($query_one)->get();
        }
        $accounts = $income->merge($expense);
        $i=0;
        foreach($accounts as $account){
            $arr = array();
            array_push($arr,++$i);
            array_push($arr,$account->date);
            array_push($arr,$account->sub_heading);
            array_push($arr,$account->text_box);
            array_push($arr,(null!==$account->income)?"<span style='color:#3cba54'>".$account->amount."</span>":"<span style='color:#db3236'>".$account->amount."</span>");

            array_push($demat['data'],$arr);
        }
        $demat["recordsTotal"]=$i;
        $demat["recordsFiltered"]=$i;
        return $demat;
    }
    public static function cashConversionDetailsFinancialStatus($request){
        $demat['data']= array();
        $startDate = date("Y-m-d",strtotime(date("Y")."-04-01"));
        $endDate = date("Y-m-d",strtotime((date("Y")+1)."-03-31"));
        if(isset($startDate) && $startDate!="" && isset($endDate) && $endDate != ""){
            $accounts = financeManagementTransferModel::where("purpose","like","Cash Conversion")->whereDate("date",">=",$startDate)->whereDate("date","<=",$endDate)->get();

        }else{
            $accounts = financeManagementTransferModel::where("purpose","like","Cash Conversion")->whereDate("date",">=",$startDate)->whereDate("date","<=",$endDate)->get();
        }
        $i=0;
        foreach($accounts as $account){
            $arr = array();
            array_push($arr,++$i);
            array_push($arr,$account->date);
            array_push($arr,$account->from);
            array_push($arr,$account->to);
            array_push($arr,$account->narration);
            array_push($arr,$account->amount);
            array_push($demat['data'],$arr);
        }
        $demat["recordsTotal"]=$i;
        $demat["recordsFiltered"]=$i;
        return $demat;
    }
    public static function dematDetailsFinancialStatus($request){
        $demat['data']= array();

        if(isset($request->startDate) && $request->startDate!="" && isset($request->endDate) && $request->endDate != ""){
            $accounts = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->whereDate("client_demat.created_at",">=", date("Y-m-d",strtotime($request->startDate)))->whereDate("client_demat.created_at","<=", date("Y-m-d",strtotime($request->endDate)))->where("client_demat.st_sg",$request->income_form)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->get();
        }else{
            $accounts = ClientDemat::leftJoin("clients", "client_demat.client_id", "=", "clients.id")->where("clients.created_by", auth()->user()->id)->whereYear("client_demat.created_at", date("Y"))->whereMonth("client_demat.created_at", date("m"))->where("client_demat.st_sg",$request->income_form)->select("client_demat.serial_number", "client_demat.service_type", "client_demat.client_id","client_demat.id as demat_id", "clients.name")->groupBy("client_demat.service_type", "client_demat.client_id")->get();
        }

        $i=0;
        foreach($accounts as $account){
            $arr = array();
            array_push($arr,++$i);
            array_push($arr,$account['name']);
            array_push($arr,($account['service_type'] == 1) ? "Prime" : ($account['service_type'] == 2?"AMS":"Prime next"));
            array_push($arr,"<a href='javascript:void(0)' class='viewDemat' data-id='".$account['demat_id']."'><i class='fas fa-eye fa-xl px-3'></i></a>");

            array_push($demat['data'],$arr);
        }
        $demat["recordsTotal"]=$i;
        $demat["recordsFiltered"]=$i;
        return $demat;
    }
    public static function plDetailsFinancialStatus($request){
        $demat['data']= array();

        if(isset($request->startDate) && $request->startDate!="" && isset($request->endDate) && $request->endDate != ""){
            $query_one = \Illuminate\Support\Facades\DB::table("finance_management_incomes")->where("income_form",$request->income_form)->whereDate("date",">=",$request->startDate)->whereDate("date","<=",$request->endDate)->leftJoin("finance_management_banks","finance_management_incomes.bank","=","finance_management_banks.id");

            $accounts = \Illuminate\Support\Facades\DB::table("finance_management_incomes")->where("income_form",$request->income_form)->whereDate("date",">=",$request->startDate)->whereDate("date","<=",$request->endDate)->leftJoin("finance_management_banks","finance_management_incomes.bank","=","finance_management_banks.id")->unionAll($query_one)->get();
        }else{
            $query_one = \Illuminate\Support\Facades\DB::table("finance_management_incomes")->where("income_form",$request->income_form)->leftJoin("finance_management_banks","finance_management_incomes.bank","=","finance_management_banks.id");

            $accounts = \Illuminate\Support\Facades\DB::table("finance_management_incomes")->where("income_form",$request->income_form)->leftJoin("finance_management_banks","finance_management_incomes.bank","=","finance_management_banks.id")->unionAll($query_one)->get();
        }

        $i=0;
        foreach($accounts as $account){
            $arr = array();
            array_push($arr,++$i);
            array_push($arr,$account->date);
            array_push($arr,$account->sub_heading);
            array_push($arr,$account->text_box);
            array_push($arr,$account->title);
            array_push($arr,$account->amount);

            array_push($demat['data'],$arr);
        }
        $demat["recordsTotal"]=$i;
        $demat["recordsFiltered"]=$i;
        return $demat;
    }
    public static function distributionDetailsFinancialStatus($request){
        $demat['data']= array();

        if(isset($request->startDate) && $request->startDate!="" && isset($request->endDate) && $request->endDate != ""){
            $accounts = financeManagementTransferModel::where("from","distribution")->where("income_form",$request->income_form)->where("date",">=",$request->startDate)->whereDate("date","<=",$request->endDate)->get();
        }else{
            $accounts = financeManagementTransferModel::where("from","distribution")->where("income_form",$request->income_form)->leftJoin("users","finance_management_transfers.created_by","=","users.id")->select("users.name as by","finance_management_transfers.date","finance_management_transfers.from","finance_management_transfers.to","finance_management_transfers.amount","finance_management_transfers.id")->get();
        }

        $i=0;
        foreach($accounts as $account){
            $arr = array();
            array_push($arr,++$i);
            array_push($arr,$account->date);
            array_push($arr,$account->from);
            array_push($arr,$account->by);
            array_push($arr,$account->to);
            array_push($arr,$account->amount);
            array_push($arr,"<a href='javascript:void(0)' class='viewNarration' data-id='".$account->id."'>View</a>");

            array_push($demat['data'],$arr);
        }
        $demat["recordsTotal"]=$i;
        $demat["recordsFiltered"]=$i;
        return $demat;
    }
    public static function loanDetailsFinancialStatus($request){
        $demat['data']= array();

        if(isset($request->startDate) && $request->startDate!="" && isset($request->endDate) && $request->endDate != ""){
            $accounts = financeManagementLoanModel::where("income_form",$request->income_form)->where("date",">=",$request->startDate)->whereDate("date","<=",$request->endDate)->get();
        }else{
            $accounts = financeManagementLoanModel::where("income_form",$request->income_form)->get();
        }

        $i=0;
        foreach($accounts as $account){
            $arr = array();
            array_push($arr,++$i);
            array_push($arr,$account->date);
            array_push($arr,$account->sub_heading);
            array_push($arr,$account->narration);
            array_push($arr,($account->mode==0)?"Cash":"Bank");
            array_push($arr,$account->amount);
            array_push($demat['data'],$arr);
        }
        $demat["recordsTotal"]=$i;
        $demat["recordsFiltered"]=$i;
        return $demat;
    }
    public static function bankDetailsFinancialStatus($request){
        $demat['data']= array();

        if(isset($request->startDate) && $request->startDate!="" && isset($request->endDate) && $request->endDate != ""){
            $accounts = BankModel::where("income_form",$request->income_form)->where("date",">=",$request->startDate)->whereDate("date","<=",$request->endDate)->get();
        }else{
            $accounts = BankModel::where("is_active","1")->select("available_balance","reserve_balance","title")->get();
        }

        $i=0;
        foreach($accounts as $account){
            $arr = array();
            $total_balance = $account->reserve_balance+$account->available_balance;
            array_push($arr,++$i);
            array_push($arr,$account->title);
            array_push($arr,$total_balance);
            array_push($arr,$total_balance-$account->reserve_balance);
            array_push($arr,$total_balance-$account->available_balance);
            array_push($arr,0);
            array_push($demat['data'],$arr);
        }
        $demat["recordsTotal"]=$i;
        $demat["recordsFiltered"]=$i;
        return $demat;
    }
    public static function serviceDetailsFinancialStatus($request){
        $demat['data']= array();

        $accounts = self::getServicesDetails();

        $i=0;
        foreach($accounts as $service => $count){
            $arr = array();
            array_push($arr,++$i);
            array_push($arr,ucwords(str_replace("_"," ",$service)));
            array_push($arr,$count);
            array_push($arr,0);
            array_push($arr,"<a href='javascript:void(0)' class='viewDemat' data-id='".$service."'>View</a>");
            array_push($demat['data'],$arr);
        }
        $demat["recordsTotal"]=$i;
        $demat["recordsFiltered"]=$i;
        return $demat;
    }
    public static function transactionDetailsFinancialStatus($request){
        $transactions = array();

        if(null !== $request->filter){
            $filter = $request->filter;
            if($filter=="quarterly"){
                $days= CommonService::getQuarterDay(date('n'), date('j'), date('Y'));
                dd($days);
            }
            else if($filter==100){
                // current month
                $startDate = date("Y-m-01");
                $endDate = date("Y-m-t");
            }
            else if($filter==500){
                // current year
                $startDate = date("Y-01-01");
                $endDate = date("Y-m-d",strtotime((date("Y")+1)."-12-"."31"));
            }else{
                // custom
                $startDate = trim(explode("/",$request->filter)[0]);
                $endDate = trim(explode("/",$request->filter)[1]);
            }
        }else{
            $startDate = date("Y-m-01");
            $endDate = date("Y-m-t");
        }

        $transactions['day']['distribution'] = financeManagementTransferModel::select('users.name',"users.role","users.id as user_id", \Illuminate\Support\Facades\DB::raw('SUM(finance_management_transfers.amount) As earnings'))->leftJoin('users', 'finance_management_transfers.created_by', '=', "users.id")->where("users.id","=",$request->user_id)->whereDate("finance_management_transfers.date","=",date("Y-m-d"))->get();

        $transactions['month']['distribution'] = financeManagementTransferModel::select('users.name',"users.role","users.id as user_id", \Illuminate\Support\Facades\DB::raw('SUM(finance_management_transfers.amount) As earnings'))->leftJoin('users', 'finance_management_transfers.created_by', '=', "users.id")->where("users.id","=",$request->user_id)->whereYear("finance_management_transfers.date","=",date("Y"))->whereMonth("finance_management_transfers.date",date("m"))->get();


        $transactions['day']['income'] = financeManagementIncomesModel::select('users.name',"users.user_type","users.id as user_id", \Illuminate\Support\Facades\DB::raw('SUM(finance_management_incomes.amount) As earnings'))->leftJoin('users', 'finance_management_incomes.created_by', '=',"users.id")->where("users.id",$request->user_id)->whereDate("finance_management_incomes.date","=",date("Y-m-d"))->get();

        $transactions['month']['income'] = financeManagementIncomesModel::select('users.name',"users.user_type","users.id as user_id", \Illuminate\Support\Facades\DB::raw('SUM(finance_management_incomes.amount) As earnings'))->leftJoin('users', 'finance_management_incomes.created_by', '=', "users.id")->where("users.id",$request->user_id)->whereYear("finance_management_incomes.date",">=",date("Y"))->whereMonth("finance_management_incomes.date","<=",date("m"))->get();

        $transactions["all"] = financeManagementTransferModel::whereDate("finance_management_transfers.date",">=",$startDate)->whereDate("finance_management_transfers.date","<=",$endDate)->get();

        $transactions['data'] = array();
        $i=0;
        foreach($transactions['all'] as $transaction){

            $arr = array();
            array_push($arr,++$i);
            array_push($arr,$transaction->date);
            array_push($arr,$transaction->from);
            array_push($arr,$transaction->to);
            array_push($arr,$transaction->narration);
            array_push($arr,$transaction->mode==0?"Cash":"Bank");
            array_push($arr,$transaction->amount);
            array_push($transactions['data'],$arr);
        }
        $transactions["recordsTotal"]=$i;
        $transactions["recordsFiltered"]=$i;
        return $transactions;
    }
    public static function viewMoreIncomeFigures(){
        $figures = array();

        $figures["day"]["income"] = financeManagementIncomesModel::leftJoin("finance_management_banks","finance_management_incomes.bank","=","finance_management_banks.id")->where("finance_management_incomes.mode",1)->whereDate("finance_management_incomes.date","=",date("Y-m-d"))->where("finance_management_banks.type",1)->sum("amount");

        $figures["month"]["income"] = financeManagementIncomesModel::leftJoin("finance_management_banks","finance_management_incomes.bank","=","finance_management_banks.id")->where("finance_management_incomes.mode",1)->WhereYear("finance_management_incomes.date","=",date("Y"))->whereMonth("finance_management_incomes.date","=",date("m"))->where("finance_management_banks.type",1)->sum("amount");

        $figures["day"]["expense"] = financeManagementExpensesModel::leftJoin("finance_management_banks","finance_management_expenses.bank","=","finance_management_banks.id")->where("finance_management_expenses.mode",1)->whereDate("finance_management_expenses.date","=",date("Y-m-d"))->where("finance_management_banks.type",1)->sum("amount");

        $figures["month"]["expense"] = financeManagementExpensesModel::leftJoin("finance_management_banks","finance_management_expenses.bank","=","finance_management_banks.id")->where("finance_management_expenses.mode",1)->whereYear("finance_management_expenses.date","=",date("Y"))->whereMonth("finance_management_expenses.date","=",date("m"))->where("finance_management_banks.type",1)->sum("amount");

        return $figures;

    }
    public static function viewMoreSalary(){
        $figures = array();

        $figures["day"]["transfer"] = financeManagementTransferModel::whereDate("finance_management_transfers.date","=",date("Y-m-d"))->sum("amount");

        $figures["month"]["transfer"] = financeManagementTransferModel::WhereYear("date","=",date("Y"))->whereMonth("date","=",date("m"))->sum("amount");

        return $figures;

    }
}
