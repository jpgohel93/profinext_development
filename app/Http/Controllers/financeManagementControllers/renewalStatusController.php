<?php

namespace App\Http\Controllers\financeManagementControllers;

use App\Http\Controllers\Controller;
use App\Services\financeManagementServices\bankServices;
use App\Services\financeManagementServices\financeManagementIncomesServices;
use App\Services\servicesTypeServices;
use Illuminate\Http\Request;
use App\Services\financeManagementServices\renewalStatusService;
use App\Services\ClientDemateServices;
use Illuminate\Support\Facades\Redirect;
use App\Services\TermsAndConditionsServices;
use PDF;
use App\Models\RenewDemat;
class renewalStatusController extends Controller
{
    public function view(){
        $renewalStatus = renewalStatusService::view();
        $preRenewAccounts = renewalStatusService::preRenewAccounts();
        $toRenewAccounts = renewalStatusService::toRenewAccounts();
        $renewedAccounts = renewalStatusService::renewedAccounts();
        $newAccounts = renewalStatusService::newAccounts();
        $partPaymentData= renewalStatusService::partPaymentData();
        $forIncomesBank= bankServices::getForIncomeAccounts();
        return view("financeManagement.renewal-status",compact("renewalStatus", "preRenewAccounts", "toRenewAccounts", "renewedAccounts", "newAccounts","partPaymentData","forIncomesBank"));
    }
    public function clientDematView(Request $request,$id,$type=null){
        $primary_bank = bankServices::getPrimaryBankAccounts(1);
        $bankAccountList = array();
        $bankPerData = array();

        $forIncomes = bankServices::getForIncomeAccountsArray();
        $countPer = array();
        $tempBank = array();
        if(date("m") >= 4){
            $currentYear = date("Y");
            $lastYear = (date("Y")+1);
        }else{
            $currentYear = (date("Y") - 1);
            $lastYear = date("Y");
        }

        $startDate = $currentYear."-04-01";
        $endDate = $lastYear."-03-31";


        if(!empty($primary_bank)){
            $offSet = 0;
            $length = 2;

            $lastTransaction= financeManagementIncomesServices::getLastTransaction($primary_bank['id']);
            if(!empty($lastTransaction)) {
                $days = round((strtotime(date("Y-m-d")) - strtotime($lastTransaction['date'])) / 86400);
            }else{
                $days = 0;
            }
            $incomeRecords = financeManagementIncomesServices::getAllIncomeRowsById($primary_bank['id'],$startDate,$endDate);
            $incomeRecordsBlockAmount = ClientDemateServices::renewAccountList($primary_bank['id'],$startDate,$endDate);
            $sumOfIncome = !empty($incomeRecords) ? array_sum(array_column($incomeRecords, 'amount')) : 0;
            $sumOfBlockIncome = !empty($incomeRecordsBlockAmount) ? array_sum(array_column($incomeRecordsBlockAmount, 'final_amount')) : 0;

            $primary_bank['remain_limit'] = $primary_bank['target'] - ($sumOfIncome+$sumOfBlockIncome);
            $primary_bank['last_transaction_day'] = $days;
            $primary_bank['title'] = $primary_bank['title']."(Primary Bank)";
            $bankAccountList[] = $primary_bank;
        }else{
            $offSet = 0;
            $length = 3;
        }

        foreach ($forIncomes as $key => $incomeBank) {
            $incomeRecords = financeManagementIncomesServices::getAllIncomeRowsById($incomeBank['id'],$startDate,$endDate);
            $incomeRecordsBlockAmount = ClientDemateServices::renewAccountList($incomeBank['id'],$startDate,$endDate);
            $lastTransaction= financeManagementIncomesServices::getLastTransaction($incomeBank['id']);

            if(!empty($lastTransaction)) {
                $days = round((strtotime(date("Y-m-d")) - strtotime($lastTransaction['date'])) / 86400);
            }else{
                $days = 0;
            }

            if (!empty($incomeRecords) || !empty($incomeRecordsBlockAmount)) {
                $sumOfIncome = !empty($incomeRecords) ? array_sum(array_column($incomeRecords, 'amount')) : 0;
                $sumOfBlockIncome = !empty($incomeRecordsBlockAmount) ? array_sum(array_column($incomeRecordsBlockAmount, 'final_amount')) : 0;

                if (count($forIncomes) <= $length) {
                    $forIncomes[$key]['remain_limit'] = $incomeBank['target'] - ($sumOfIncome+$sumOfBlockIncome);
                    $forIncomes[$key]['last_transaction_day'] = $days;
                } else {
                    if ($incomeBank['target'] > 0) {
                        $per = (($sumOfIncome+$sumOfBlockIncome) * 100) / $incomeBank['target'];
                        $countPer[$incomeBank['id']] = 100 - round($per,2);
                        $tempBank[$incomeBank['id']] = $incomeBank;
                        $tempBank[$incomeBank['id']]['remain_limit'] = $incomeBank['target'] - ($sumOfIncome+$sumOfBlockIncome);
                        $tempBank[$incomeBank['id']]['last_transaction_day'] = $days;
                    }
                }
            }else{
                $incomeBank['remain_limit'] = $incomeBank['target'] ;
                $incomeBank['last_transaction_day'] = $days;
                $countPer[$incomeBank['id']] = 100;
                $tempBank[$incomeBank['id']] = $incomeBank;
            }
        }

        if (!empty($countPer)) {
            if (count($countPer) <= $incomeRecords) {
                arsort($countPer);
                $lastThreeIndex = array_slice($countPer, $offSet, $length, true);
                foreach ($lastThreeIndex as $key => $bankPer) {
                    $bankAccountList[] = $tempBank[$key];
                }
            } else {
                $lastThreeIndex = array_slice($forIncomes, $offSet, $length, true);
                foreach ($lastThreeIndex as $key => $bankPer) {
                    $bankAccountList[] = $tempBank[$key];
                }
            }
        }else{
            $lastThreeIndex = array_slice($forIncomes, $offSet, $length, true);
            foreach ($lastThreeIndex as $key => $bankPer) {
                $bankPer['remain_limit'] = $bankPer['target'];
                $bankAccountList[] = $bankPer;
            }
        }


        $demateDetails = ClientDemateServices::getAccountByDemateId($id);
        if($request->ajax()){
            return response($demateDetails,200, ["Content-Type" => "Application/json"]);
        }
        return view("financeManagement.clientDemateView",compact("demateDetails","primary_bank","bankAccountList","type"));
    }
    public function clientDematTerminate(Request $request,$id){
        ClientDemateServices::terminateAccountByDemateId($id);
        if($request->ajax()){
            return response(["info"=>"Account Terminated"], 200, ["Content-Type" => "Application/json"]);
        }
        return Redirect::back()->with("info","Account Terminated");
    }
    public function updatePL(Request $request){
        ClientDemateServices::updatePL($request);
        renewalStatusService::createRenewal($request);
        if($request->page_type == 1) {
            return Redirect::route("renewal_status")->with("info", "PL Updated");
        }elseif ($request->page_type == 2){
            return Redirect::route("clientDematAccountStatus")->with("info", "PL Updated");
        }else{
            return Redirect::route("renewal_status")->with("info", "PL Updated");
        }
    }
    public function mark_as_problem(Request $request){
        ClientDemateServices::markAsProblem($request);
        return Redirect::back()->with("info", "Account marked");
    }
    public function ProblemSolved(Request $request){
        ClientDemateServices::ProblemSolved($request);
        return Redirect::route("renewal_status")->with("info", "Account Problem Solved");
    }
    public function calculateAmount(Request $request){
        $demat_data = ClientDemateServices::getAccountByDemateId($request->demat_id);
        if(!empty($demat_data)){
            $account_type = '';
            $joining_date = $request->joining_date;
            $end_date = $request->end_date;
            $final_pl = $request->final_pl;
            $capital = $demat_data->capital;
            $profit_pr = (100 * $final_pl) / $capital;
            $profit_data = '<h3 class="stepper-title">Profit</h3>';
            $payment_data = ' <h3 class="stepper-title">Payment</h3>';

            $days=round((strtotime($end_date) - strtotime($joining_date)) / 86400);
            if($demat_data->service_type == 2){
                $account_type = 'AMS';
                $service_data = servicesTypeServices::getByType($account_type);

                $cutoff = $service_data->cutoff;
                $sharing = isset($service_data->sharing) ? $service_data->sharing : 1;
                $renewal_fees = $service_data->renewal_amount;
                if($final_pl > $cutoff) {
                    $access_profit = $final_pl - $cutoff;
                    $profit_sharing = ($sharing * $access_profit) / 100;
                    $total_payment = $profit_sharing + $renewal_fees;

                    $profit_data .= '<div class="col-md-6 col-sm-12 mb-5"><label class="d-flex align-items-center fs-5 fw-bold mb-2"><span>Total Profit</span></label>
                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="'.$final_pl.'"  name="total_profit" readonly/></div>';
                    $profit_data .= '<div class="col-md-6 col-sm-12 mb-5"><label class="d-flex align-items-center fs-5 fw-bold mb-2"><span>Promised Profit</span></label>
                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="'.$cutoff.'"  name="promised_profit" readonly/></div>';
                    $profit_data .= '<div class="col-md-6 col-sm-12 mb-5"><label class="d-flex align-items-center fs-5 fw-bold mb-2"><span>Access Profit</span></label>
                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="'.$access_profit.'"  name="access_profit" readonly/></div>';

                    $payment_data .= '<div class="col-md-6 col-sm-12 mb-5"><label class="d-flex align-items-center fs-5 fw-bold mb-2"><span>Profit Sharing</span></label>
                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="'.$profit_sharing.'"  name="profit_sharing" readonly/></div>';
                    $payment_data .= '<div class="col-md-6 col-sm-12 mb-5"><label class="d-flex align-items-center fs-5 fw-bold mb-2"><span>Renewal Fees</span></label>
                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="'.$renewal_fees.'"  name="renewal_fees" readonly/></div>';
                    $payment_data .= '<div class="col-md-6 col-sm-12 mb-5"><label class="d-flex align-items-center fs-5 fw-bold mb-2"><span>Total Payment</span></label>
                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="'.$total_payment.'"  name="total_payment" readonly/></div>';
                }else{
                    $profit_data .= '<div class="col-md-6 col-sm-12 mb-5"><label class="d-flex align-items-center fs-5 fw-bold mb-2"><span>Total Profit</span></label>
                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="'.$final_pl.'"  name="total_profit" readonly/></div>';

                    $payment_data .= '<div class="col-md-6 col-sm-12 mb-5"><label class="d-flex align-items-center fs-5 fw-bold mb-2"><span>Renewal Fees</span></label>
                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="'.$renewal_fees.'"  name="renewal_fees" readonly/></div>';
                    $payment_data .= '<div class="col-md-6 col-sm-12 mb-5"><label class="d-flex align-items-center fs-5 fw-bold mb-2"><span>Total Payment</span></label>
                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="'.$renewal_fees.'"  name="total_payment" readonly/></div>';

                }

                $data["service_type"] = $account_type;

            }elseif ($demat_data->service_type == 1 || $demat_data->service_type == 3){
                $account_type = 'Prime';
                $service_data = servicesTypeServices::getByType($account_type);
                $sharing = isset($service_data->sharing) ? $service_data->sharing : 1;

                $profit_sharing = ($sharing * $final_pl) / 100;

                $profit_data .= '<div class="col-md-6 col-sm-12 mb-5"><label class="d-flex align-items-center fs-5 fw-bold mb-2"><span>Total Profit</span></label>
                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="'.$final_pl.'"  name="total_profit" readonly/></div>';

                $payment_data .= '<div class="col-md-6 col-sm-12 mb-5"><label class="d-flex align-items-center fs-5 fw-bold mb-2"><span>Profit Sharing</span></label>
                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="'.$profit_sharing.'"  name="profit_sharing" readonly/></div>';
                $payment_data .= '<div class="col-md-6 col-sm-12 mb-5"><label class="d-flex align-items-center fs-5 fw-bold mb-2"><span>Total Payment</span></label>
                                    <input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" value="'.$profit_sharing.'"  name="total_payment" readonly/></div>';


                $data["service_type"] = $account_type;
            }

            $data['profit_data'] = $profit_data;
            $data['payment_data'] = $payment_data;
            $data["status"] = true;
            $data["message"] = "<p style='color: green;font-size: 15px;font-weight: bold;'>You have get ".$profit_pr." %  of Return in just ".$days." Days </p>";
            return $data;
        }else{
            $data["status"] = false;
            return $data;
        }

    }

    public function getRenewData(Request $request){
        return ClientDemateServices::renewData($request->id);
    }

    public function feesPayment(Request $request){
        ClientDemateServices::demateFeesPayment($request);
        $renewData = ClientDemateServices::renewDataById($request->fees_payment_id);
        if($renewData->service_type == 2){
            $message[0]['heading'] = "AMS Fees";
            $message[0]['description'] = 'Commission Income';
        }else if($renewData->service_type == 1){
            $message[0]['heading'] = "Prime Fees";
            $message[0]['description'] = 'Prime Commission Income';
        }else if($renewData->service_type == 3){
            $message[0]['heading'] = "Prime Next Fees";
            $message[0]['description'] = 'Prime Next Commission Income';
        }

        $message[0]['amount'] = $request->fees_amount;
        $total = $request->fees_amount;
        $grand_total = $request->fees_amount;
        $title = "INVOICE";
        $terms = TermsAndConditionsServices::all(true);
        $type =1;
        return view("financeManagement.fees_invoice",compact("renewData","message",'total','grand_total','title',"terms","type"));
    }

    public function profitSharingPayment(Request $request){
        ClientDemateServices::demateProfitSharing($request);
        $renewData = ClientDemateServices::renewDataById($request->profit_sharing_payment_id);
        if($renewData->service_type == 2){
            $message[0]['heading'] = "AMS Profit Sharing";
            $message[0]['description'] = 'Commission Income on Access Profit';
        }else if($renewData->service_type == 1){
            $message[0]['heading'] = "Prime Profit Sharing";
            $message[0]['description'] = 'Prime Commission Income on Access Profit';
        }else if($renewData->service_type == 3){
            $message[0]['heading'] = "Prime Next Profit Sharing";
            $message[0]['description'] = 'Prime Next Commission Income on Access Profite';
        }

        $message[0]['amount'] = $request->profit_amount;
        $total = $request->profit_amount;
        $grand_total = $request->profit_amount;
        $title = "INVOICE";
        $terms = TermsAndConditionsServices::all(true);
        $type =2;
        return view("financeManagement.fees_invoice",compact("renewData","message",'total',"grand_total","title", "terms","type"));
    }

    public function partPayment(Request $request){
        ClientDemateServices::partPayment($request);
        return Redirect::route("renewal_status")->with("info", "Payment successfully");
    }

    public function partPaymentReminder(Request $request){
        ClientDemateServices::setPartPaymentReminder($request);
        return Redirect::route("renewal_status")->with("info", "Reminder set successfully");
    }

    public function fullPayment(Request $request){
        ClientDemateServices::fullPayment($request);
       $renewData = ClientDemateServices::renewDataById($request->full_payment_id);

        if($renewData->service_type == 2){
            $message[0]['heading'] = "AMS Fees";
            $message[0]['description'] = 'Commission Income';
        }else if($renewData->service_type == 1){
            $message[0]['heading'] = "Prime Fees";
            $message[0]['description'] = 'Prime Commission Income';
        }else if($renewData->service_type == 3){
            $message[0]['heading'] = "Prime Next Fees";
            $message[0]['description'] = 'Prime Next Commission Income';
        }

        if($renewData->service_type == 2){
            $message[1]['heading'] = "AMS Profit Sharing";
            $message[1]['description'] = 'Commission Income on Access Profit';
        }else if($renewData->service_type == 1){
            $message[1]['heading'] = "Prime Profit Sharing";
            $message[1]['description'] = 'Prime Commission Income on Access Profit';
        }else if($renewData->service_type == 3){
            $message[1]['heading'] = "Prime Next Profit Sharing";
            $message[1]['description'] = 'Prime Next Commission Income on Access Profit';
        }

        $message[1]['amount'] = $renewData->access_profit;
        $message[0]['amount'] = $renewData->renewal_fees;
        $total = $renewData->total_payment;
        $grand_total = $renewData->total_payment;
        $title = "INVOICE";
        $terms = TermsAndConditionsServices::all(true);
        $type = 3;
        return view("financeManagement.fees_invoice",compact("renewData","message","total","grand_total","title", "terms","type"));
    }

    public function viewFeesInvoice($id,$type,$pdf=false){
        $renewData = ClientDemateServices::renewDataById($id);

        $message = array();
        $total = 0;
        $grand_total = 0;
        $title = 0;
        if($type == 1){
            if($renewData->service_type == 2){
                $message[0]['heading'] = "AMS Fees";
                $message[0]['description'] = 'Commission Income';
            }else if($renewData->service_type == 1){
                $message[0]['heading'] = "Prime Fees";
                $message[0]['description'] = 'Prime Commission Income';
            }else if($renewData->service_type == 3){
                $message[0]['heading'] = "Prime Next Fees";
                $message[0]['description'] = 'Prime Next Commission Income';
            }

            $message[0]['amount'] = $renewData->renewal_fees;
            $total = $renewData->renewal_fees;
            $grand_total = $renewData->renewal_fees;
            $title = "INVOICE";
        }elseif ($type == 2){
            if($renewData->service_type == 2){
                $message[0]['heading'] = "AMS Profit Sharing";
                $message[0]['description'] = 'Commission Income on Access Profit';
            }else if($renewData->service_type == 1){
                $message[0]['heading'] = "Prime Profit Sharing";
                $message[0]['description'] = 'Prime Commission Income on Access Profit';
            }else if($renewData->service_type == 3){
                $message[0]['heading'] = "Prime Next Profit Sharing";
                $message[0]['description'] = 'Prime Next Commission Income on Access Profit';
            }

            $message[0]['amount'] = $renewData->profit_sharing;
            $total = $renewData->profit_sharing;
            $grand_total = $renewData->profit_sharing;
            $title = "INVOICE";
        }elseif ($type == 3){
            if($renewData->service_type == 2){
                $message[0]['heading'] = "AMS Fees";
                $message[0]['description'] = 'Commission Income';
            }else if($renewData->service_type == 1){
                $message[0]['heading'] = "Prime Fees";
                $message[0]['description'] = 'Prime Commission Income';
            }else if($renewData->service_type == 3){
                $message[0]['heading'] = "Prime Next Fees";
                $message[0]['description'] = 'Prime Next Commission Income';
            }
            if($renewData->service_type == 2){
                $message[1]['heading'] = "AMS Profit Sharing";
                $message[1]['description'] = 'Commission Income on Access Profit';
            }else if($renewData->service_type == 1){
                $message[1]['heading'] = "Prime Profit Sharing";
                $message[1]['description'] = 'Prime Commission Income on Access Profit';
            }else if($renewData->service_type == 3){
                $message[1]['heading'] = "Prime Next Profit Sharing";
                $message[1]['description'] = 'Prime Next Commission Income on Access Profit';
            }
            $message[1]['amount'] = $renewData->profit_sharing;
            $message[0]['amount'] = $renewData->renewal_fees;
            $total = $renewData->total_payment;
            $grand_total = $renewData->total_payment;
            $title = "INVOICE";
        }
        $terms = TermsAndConditionsServices::all(true);
        if($pdf){
            $pdf = PDF::loadView('financeManagement.fees_invoice', compact("renewData","message","total","grand_total","title", "terms","type"))->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            return $pdf->download("abc.pdf");
        }else{
            return view("financeManagement.fees_invoice",compact("renewData","message","total","grand_total","title", "terms","type"));
        }
    }

    public function viewPartPayment(Request $request){
        $paymentHistory = ClientDemateServices::viewPartPaymentHistory($request->id);

        $html = '';
        $totalPayment = 0;
        $i=1;
        foreach ($paymentHistory as $payment){
            $html .= '<tr>';
            $html .= '<td>'.$i++.'</td>';
            $html .= '<td>'.$payment['date'].'</td>';
            $html .= '<td style="text-align: center">'.$payment['amount'].'</td>';
            $html .= '</tr>';

            $totalPayment = $totalPayment + $payment['amount'];
        }
        $html .= '<tr>';
        $html .= '<td colspan="2" style="text-align: right"><b>Total  </b></td>';
        $html .= '<td  style="text-align: center"><b>'.$totalPayment.'</b></td>';
        $html .= '</tr>';

        $data['html'] = $html;
        $data['totalPayment'] = $totalPayment;
        return $data;
    }

    public function editInvoice($id){
        $renewData = ClientDemateServices::renewDataById($id);
        $demateDetails = ClientDemateServices::getAccountByDemateId($renewData->client_demat_id);
        return view("financeManagement.edit_invoice",compact("renewData","demateDetails"));

    }

    public function updateInvoiceDetail(Request $request){

    }

    public function viewRoughCalculationInvoice($id){
        $renewData = ClientDemateServices::renewDataById($id);
        $demateDetails = ClientDemateServices::getAccountByDemateId($renewData->client_demat_id);

        if($demateDetails->service_type == 2){
            $account_type = 'AMS';
        }
        elseif ($demateDetails->service_type == 1){
            $account_type = 'Prime';
        }
        elseif ($demateDetails->service_type == 3){
            $account_type = 'Prime Next';
        }
        $service_data = servicesTypeServices::getByType($account_type);
        $profit_pr = (100 * $demateDetails->final_pl) / $demateDetails->capital;

        $joining_date = $renewData->joining_date;
        $end_date = $renewData->end_date;
        $days=round((strtotime($end_date) - strtotime($joining_date)) / 86400);
        $message = "<p style='color: green;font-size: 20px;font-weight: bold;'>You have get ".$profit_pr." %  of Return in just ".$days." Days </p>";

        return view("financeManagement.rough_calculation_invoice",compact("renewData","demateDetails","service_data","message"));

    }
}
