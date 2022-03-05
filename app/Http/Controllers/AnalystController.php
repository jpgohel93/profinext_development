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
    }
    public function view(Request $request){
        $analysts = AnalystServices::all();
        return view("analyst.analyst",compact('analysts'));
    }
    public function createForm(){
        $monitor = User::where("role","monitor")->get();
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
        $users = User::where("role","monitor")->get();
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
        $analysts = AnalystServices::allUserAssignAnalysts($id);
        return view("analyst.monitor_analysts",compact('analysts'));
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
        MonitorDataServices::update($request);
        return Redirect::route('viewMonitorData')->with("info","Monitor Data has been updated");
    }
}
