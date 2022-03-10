<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Analyst;
use App\Models\MonitorData;
use App\Services\UserServices;
use App\Services\MonitorDataServices;
use Illuminate\Http\Request;
use App\Services\AnalystServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AnalystController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:analyst-create', ['only' => ['createForm', 'create']]);
        $this->middleware('permission:analyst-write', ['only' => ['editAnalyst']]);
        $this->middleware('permission:analyst-read', ['only' => ['view', 'getAnalyst']]);
        $this->middleware('permission:analyst-delete', ['only' => ['editAnalyst']]);
        $this->middleware('permission:monitor-read', ['only' => ['viewMonitorData']]);
    }
    public function view(Request $request){
        $analysts = AnalystServices::all();
        $dataArray = array();
        foreach ($analysts['active'] as $key => $analyst){
            $totalCall = MonitorDataServices::countAnalystCall($analyst['id']);
            $analysts['active'][$key]['total_calls'] = $totalCall['close_call'] > 0 ? $totalCall['close_call'] : 0;
            $monitorCallData = MonitorDataServices::getAnalystCallData($analyst['id']);
            $totalProfitCall = 0;
            $accuracy = 0;
            $totalReward= 0;
            $rewardCount= 0;
            foreach ($monitorCallData as $monitorCall){
                $pl = $monitorCall['entry_price'] - $monitorCall['exit_price'];
                if($pl > 0){
                    $totalProfitCall = $totalProfitCall + 1;
                }

                if(($monitorCall['entry_price'] != $monitorCall['sl'])) {
                    $reward = (-($monitorCall['entry_price'] - $monitorCall['exit_price']) * $monitorCall['exit_price']) / (($monitorCall['entry_price'] - $monitorCall['sl']) * $monitorCall['exit_price']);
                    $totalReward = $totalReward + $reward;
                }
                $rewardCount = $rewardCount + 1;
            }
            if($totalProfitCall > 0) {
                $accuracy = $totalProfitCall / $totalCall['close_call'] * 100;
            }

            $analysts['active'][$key]['accuracy'] = $accuracy;
            $analysts['active'][$key]['reward'] = $rewardCount != 0 ? number_format($totalReward/$rewardCount,2) : 0;
        }
        foreach ($analysts['experiment'] as $key => $analyst){
            $totalCall = MonitorDataServices::countAnalystCall($analyst['id']);
            $analysts['experiment'][$key]['total_calls'] = $totalCall['close_call'] > 0 ? $totalCall['close_call'] : 0;
            $monitorCallData = MonitorDataServices::getAnalystCallData($analyst['id']);
            $totalProfitCall = 0;
            $accuracy = 0;
            $totalReward= 0;
            $rewardCount= 0;
            foreach ($monitorCallData as $monitorCall){
                $pl = $monitorCall['entry_price'] - $monitorCall['exit_price'];
                if($pl > 0){
                    $totalProfitCall = $totalProfitCall + 1;
                }
                if(($monitorCall['entry_price'] != $monitorCall['sl'])) {
                    $reward = (-($monitorCall['entry_price'] - $monitorCall['exit_price']) * $monitorCall['exit_price']) / (($monitorCall['entry_price'] - $monitorCall['sl']) * $monitorCall['exit_price']);
                    $totalReward = $totalReward + $reward;
                }
                $rewardCount = $rewardCount + 1;
            }
            if($totalProfitCall > 0) {
                $accuracy = $totalProfitCall / $totalCall['close_call'] * 100;
            }
            $analysts['experiment'][$key]['accuracy'] =$accuracy;
            $analysts['experiment'][$key]['reward'] = $rewardCount != 0 ? number_format($totalReward/$rewardCount,2) : 0;
        }
        foreach ($analysts['paper_trade'] as $key => $analyst){
            $totalCall = MonitorDataServices::countAnalystCall($analyst['id']);
            $analysts['paper_trade'][$key]['total_calls'] = $totalCall['close_call'] > 0 ? $totalCall['close_call'] : 0;
            $monitorCallData = MonitorDataServices::getAnalystCallData($analyst['id']);
            $totalProfitCall = 0;
            $accuracy = 0;
            $totalReward= 0;
            $rewardCount= 0;
            foreach ($monitorCallData as $monitorCall){
                $pl = $monitorCall['entry_price'] - $monitorCall['exit_price'];
                if($pl > 0){
                    $totalProfitCall = $totalProfitCall + 1;
                }
                if(($monitorCall['entry_price'] != $monitorCall['sl'])) {
                    $reward = (-($monitorCall['entry_price'] - $monitorCall['exit_price']) * $monitorCall['exit_price']) / (($monitorCall['entry_price'] - $monitorCall['sl']) * $monitorCall['exit_price']);
                    $totalReward = $totalReward + $reward;
                }
                $rewardCount = $rewardCount + 1;
            }
            if($totalProfitCall > 0) {
                $accuracy = $totalProfitCall / $totalCall['close_call'] * 100;
            }
            $analysts['paper_trade'][$key]['accuracy'] = $accuracy;
            $analysts['paper_trade'][$key]['reward'] = $rewardCount != 0 ? number_format($totalReward/$rewardCount,2) : 0;
        }
        foreach ($analysts['terminated'] as $key => $analyst){
            $totalCall = MonitorDataServices::countAnalystCall($analyst['id']);
            $analysts['terminated'][$key]['total_calls'] = $totalCall['close_call'] > 0 ? $totalCall['close_call'] : 0;
            $monitorCallData = MonitorDataServices::getAnalystCallData($analyst['id']);
            $totalProfitCall = 0;
            $accuracy = 0;
            $totalReward= 0;
            $rewardCount= 0;
            foreach ($monitorCallData as $monitorCall){
                $pl = $monitorCall['entry_price'] - $monitorCall['exit_price'];
                if($pl > 0){
                    $totalProfitCall = $totalProfitCall + 1;
                }
                if(($monitorCall['entry_price'] != $monitorCall['sl'])) {
                    $reward = (-($monitorCall['entry_price'] - $monitorCall['exit_price']) * $monitorCall['exit_price']) / (($monitorCall['entry_price'] - $monitorCall['sl']) * $monitorCall['exit_price']);
                    $totalReward = $totalReward + $reward;
                }
                $rewardCount = $rewardCount + 1;
            }
            if($totalProfitCall > 0) {
                $accuracy = $totalProfitCall / $totalCall['close_call'] * 100;
            }
            $analysts['terminated'][$key]['accuracy'] = $accuracy;
            $analysts['terminated'][$key]['reward'] = $rewardCount != 0 ? number_format($totalReward/$rewardCount,2) : 0;
        }
        foreach ($analysts['free_trade'] as $key => $analyst){
            $totalCall = MonitorDataServices::countAnalystCall($analyst['id']);
            $analysts['free_trade'][$key]['total_calls'] = $totalCall['close_call'] > 0 ? $totalCall['close_call'] : 0;
            $monitorCallData = MonitorDataServices::getAnalystCallData($analyst['id']);
            $totalProfitCall = 0;
            $accuracy = 0;
            $totalReward= 0;
            $rewardCount= 0;
            foreach ($monitorCallData as $monitorCall){
                $pl = $monitorCall['entry_price'] - $monitorCall['exit_price'];
                if($pl > 0){
                    $totalProfitCall = $totalProfitCall + 1;
                }
                if(($monitorCall['entry_price'] != $monitorCall['sl'])) {
                    $reward = (-($monitorCall['entry_price'] - $monitorCall['exit_price']) * $monitorCall['exit_price']) / (($monitorCall['entry_price'] - $monitorCall['sl']) * $monitorCall['exit_price']);
                    $totalReward = $totalReward + $reward;
                }
                $rewardCount = $rewardCount + 1;
            }
            if($totalProfitCall > 0) {
                $accuracy = $totalProfitCall / $totalCall['close_call'] * 100;
            }
            $analysts['free_trade'][$key]['accuracy'] = $accuracy;
            $analysts['free_trade'][$key]['reward'] = $rewardCount != 0 ? number_format($totalReward/$rewardCount,2) : 0;
        }

        return view("analyst.analyst",compact('analysts'));
    }
    public function createForm(){
        $monitor = User::where("role",'like', "%monitor%")->get();
        return view("analyst.add",compact('monitor'));
    }
    public function create(Request $request){
        AnalystServices::create($request);
        return Redirect::route('analysts')->with("info","Analyst has been created");
    }
    public function getAnalyst(Request $request,$id){
        $analyst = AnalystServices::getAnalyst($id);
        return response($analyst)->header('Content-Type', 'application/json');
    }
    public function editAnalyst(Request $request){
        AnalystServices::update($request);
        return Redirect::route('analysts')->with("info", "Analyst has been Updated");
    }
    public function viewMonitor(Request $request){
        $users = User::where("role",'like', "%monitor%")->get();
        foreach ($users as $key => $data){
            $users[$key]['total_analyst'] = MonitorDataServices::countMonitorData($data['id']);
        }
        return view("analyst.monitor",compact('users'));
    }
    public function viewMonitorAnalysts(Request $request){
        $auth_user = Auth::user();
        $analysts = AnalystServices::allUserAssignAnalysts($auth_user->id);
        return view("analyst.monitor_analysts",compact('analysts'));
    }
    public function viewMonitorAnalystsById(Request $request,$id){
        $analysts = MonitorDataServices::allUserAnalysts($id);
        $monitor = User::where("role",'like', "%monitor%")->get();
        return view("analyst.monitor_analysts",compact('analysts','monitor'));
    }

    public function viewMonitorData(Request $request){
        $auth_user = Auth::user();
        $monitorData = MonitorDataServices::all($auth_user->id);
        if(isset($monitorData['analyst']) && !empty($monitorData['analyst'])) {
            foreach ($monitorData['analyst'] as $key => $data) {
                $countData = MonitorDataServices::countAnalystCall($data['id']);
                $monitorData['analyst'][$key]['close_call'] = $countData['close_call'];
                $monitorData['analyst'][$key]['open_call'] = $countData['open_call'];
            }
        }
        return view("analyst.monitor_data",compact('monitorData'));
    }

    public function createMonitorDataForm(Request $request,$id){
        $analysts = Analyst::where("id",$id)->get();
        return view("analyst.monitor_data_add",compact('analysts'));
    }

    public function createMonitorData(Request $request){
        $auth_user = Auth::user();
        $request['monitor_id'] = $auth_user->id;
        MonitorDataServices::create($request);
        return Redirect::route('viewMonitorData')->with("info","Monitor Data has been created");
    }

    public function editMonitorDataForm(Request $request,$id){
        $monitorData = MonitorDataServices::getMonitorData($id);
        $auth_user = Auth::user();
        $analysts = AnalystServices::allUserAnalysts($auth_user->id);
        return view("analyst.monitor_data_edit",compact('monitorData','analysts'));
    }

    public function editMonitorData(Request $request){
        $auth_user = Auth::user();
        $request['monitor_id'] = $auth_user->id;
        $request['sl_status'] = null;
        if($request['status'] == "close"){
            if($request['entry_price'] <= $request['exit_price']) {
                if ($request['exit_price'] == $request['target']) {
                    $request['sl_status'] = "Target";
                } else if ($request['exit_price'] > $request['target']) {
                    $request['sl_status'] = "Access Target";
                } else if ($request['exit_price'] < $request['target']) {
                    $request['sl_status'] = "Early Target";
                }
            }else if($request['entry_price'] > $request['exit_price']) {
                if ($request['exit_price'] == $request['sl']) {
                    $request['sl_status'] = "SL";
                } else if ($request['exit_price'] > $request['sl']) {
                    $request['sl_status'] = "Early SL";
                } else if ($request['exit_price'] < $request['sl']) {
                    $request['sl_status'] = "Trapped";
                }
            }
        }
        MonitorDataServices::update($request);
        return Redirect::route('viewMonitorData')->with("info","Monitor Data has been updated");
    }

    public function editAnalystAssignTo(Request $request){
        AnalystServices::updateAssignTo($request);
        return Redirect::route('viewMonitor')->with("info", "Analyst has been Updated");
    }

    public function report(){
        return view("analyst.report");
    }
}
