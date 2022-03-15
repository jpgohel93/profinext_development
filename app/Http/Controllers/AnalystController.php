<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Analyst;
use App\Models\MonitorData;
use App\Services\UserServices;
use App\Services\MonitorDataServices;
use App\Services\KeywordServices;
use Illuminate\Http\Request;
use App\Services\AnalystServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\JsonReturn;

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
                if($monitorCall['entry_price'] > 0 && $monitorCall['exit_price'] > 0) {
                    $pl = $monitorCall['entry_price'] - $monitorCall['exit_price'];
                    if ($pl > 0) {
                        $totalProfitCall = $totalProfitCall + 1;
                    }

                    if (($monitorCall['entry_price'] != $monitorCall['sl'])) {
                        $reward = (-($monitorCall['entry_price'] - $monitorCall['exit_price']) * $monitorCall['exit_price']) / (($monitorCall['entry_price'] - $monitorCall['sl']) * $monitorCall['exit_price']);
                        $totalReward = $totalReward + $reward;
                    }
                    $rewardCount = $rewardCount + 1;
                }
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
                if($monitorCall['entry_price'] > 0 && $monitorCall['exit_price'] > 0) {
                    $pl = $monitorCall['entry_price'] - $monitorCall['exit_price'];
                    if ($pl > 0) {
                        $totalProfitCall = $totalProfitCall + 1;
                    }
                    if (($monitorCall['entry_price'] != $monitorCall['sl'])) {
                        $reward = (-($monitorCall['entry_price'] - $monitorCall['exit_price']) * $monitorCall['exit_price']) / (($monitorCall['entry_price'] - $monitorCall['sl']) * $monitorCall['exit_price']);
                        $totalReward = $totalReward + $reward;
                    }
                    $rewardCount = $rewardCount + 1;
                }
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
                if($monitorCall['entry_price'] > 0 && $monitorCall['exit_price'] > 0) {
                    $pl = $monitorCall['entry_price'] - $monitorCall['exit_price'];
                    if ($pl > 0) {
                        $totalProfitCall = $totalProfitCall + 1;
                    }
                    if (($monitorCall['entry_price'] != $monitorCall['sl'])) {
                        $reward = (-($monitorCall['entry_price'] - $monitorCall['exit_price']) * $monitorCall['exit_price']) / (($monitorCall['entry_price'] - $monitorCall['sl']) * $monitorCall['exit_price']);
                        $totalReward = $totalReward + $reward;
                    }
                    $rewardCount = $rewardCount + 1;
                }
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
                if($monitorCall['entry_price'] > 0 && $monitorCall['exit_price'] > 0) {
                    $pl = $monitorCall['entry_price'] - $monitorCall['exit_price'];
                    if ($pl > 0) {
                        $totalProfitCall = $totalProfitCall + 1;
                    }
                    if (($monitorCall['entry_price'] != $monitorCall['sl'])) {
                        $reward = (-($monitorCall['entry_price'] - $monitorCall['exit_price']) * $monitorCall['exit_price']) / (($monitorCall['entry_price'] - $monitorCall['sl']) * $monitorCall['exit_price']);
                        $totalReward = $totalReward + $reward;
                    }
                    $rewardCount = $rewardCount + 1;
                }
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
                if($monitorCall['entry_price'] > 0 && $monitorCall['exit_price'] > 0) {
                    $pl = $monitorCall['entry_price'] - $monitorCall['exit_price'];
                    if ($pl > 0) {
                        $totalProfitCall = $totalProfitCall + 1;
                    }
                    if (($monitorCall['entry_price'] != $monitorCall['sl'])) {
                        $reward = (-($monitorCall['entry_price'] - $monitorCall['exit_price']) * $monitorCall['exit_price']) / (($monitorCall['entry_price'] - $monitorCall['sl']) * $monitorCall['exit_price']);
                        $totalReward = $totalReward + $reward;
                    }
                    $rewardCount = $rewardCount + 1;
                }
            }
            if($totalProfitCall > 0) {
                $accuracy = $totalProfitCall / $totalCall['close_call'] * 100;
            }
            $analysts['free_trade'][$key]['accuracy'] = $accuracy;
            $analysts['free_trade'][$key]['reward'] = $rewardCount != 0 ? number_format($totalReward/$rewardCount,2) : 0;
        }

        $monitor = User::where("role",'like', "%monitor%")->get();
        return view("analyst.analyst",compact('analysts','monitor'));
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

		$analysts = Analyst::get();
		$keywords = KeywordServices::all();
        $monitorData = MonitorDataServices::all($auth_user->id);
        if(isset($monitorData['analyst']) && !empty($monitorData['analyst'])) {
            foreach ($monitorData['analyst'] as $key => $data) {
                $countData = MonitorDataServices::countAnalystCall($data['id']);
                $monitorData['analyst'][$key]['close_call'] = $countData['close_call'];
                $monitorData['analyst'][$key]['open_call'] = $countData['open_call'];
            }
        }
        return view("analyst.monitor_data",compact('analysts','keywords','monitorData'));
    }

    public function createMonitorDataForm(Request $request,$id){
        $keywords = KeywordServices::all();
        $analysts = Analyst::where("id",$id)->get();
        return view("analyst.monitor_data_add",compact('analysts','keywords'));
    }

    public function createMonitorData(Request $request){
        $auth_user = Auth::user();
        $request['monitor_id'] = $auth_user->id;

		$rules =
		[
			'date' => 'required',
			'script_name' => 'required',
			'entry_time' => 'required',//|regex:/^\d{3}-\d{3}-\d{4}$/
			'entry_price' => 'required',
			'buy_sell' => 'required',
			'target' => 'required',
			'sl' => 'required'
		];

        $input = $request->only(
            'date',
            'script_name',
            'entry_time',
            'entry_price',
            'buy_sell',
            'target',
            'sl'
        );

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return JsonReturn::error($validator->messages());
        }

        if(isset($request->script_name) &&  $request->script_name != ''){
            $keyword['name'] = $request->script_name;
            $keywordData = KeywordServices::getKeywordByName($request->script_name);
            if(empty($keywordData)){
                KeywordServices::create($keyword);
            }
        }

        $analysts = Analyst::where("id",$request->analysts_id)->first();

		$main = MonitorData::create([
            'monitor_id'	=> $auth_user->id,
            'analysts_id'   => $request->analysts_id,
            'date'          => $request->date,
            'script_name'   => $request->script_name,
            'entry_time'    => $request->entry_time,
            'entry_price' 	=> $request->entry_price,
            'target' 		=> $request->target,
            'buy_sell' 		=> $request->buy_sell,
            'sl' 			=> $request->sl,
            'status' 		=> "open",
            'analyst_status' => $analysts->status,
            'created_by' 	=> Auth::id()
        ]);

		$data["message"] = "Call has been Added succesfully. Please wait...";
        $data["status"] = true;
        return JsonReturn::success($data);
    }

    public function editMonitorDataForm(Request $request){

		$id = $request->id;

        $monitorData = MonitorDataServices::getMonitorData($id);
        $auth_user = Auth::user();
        $analysts = AnalystServices::allUserAnalysts($auth_user->id);
        $keywords = KeywordServices::all();

		$html = '';

		$html .= '<form id="editCallFrm" class="form" method="POST" action="'.route('editMonitorData').'">
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="fw-bolder">Add Monitor Data</h2>
					<button type="button" class="btn btn-icon btn-sm btn-active-icon-primary close" data-bs-dismiss="modal" aria-label="Close">
						<span class="svg-icon svg-icon-1">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
							</svg>
						</span>
					</button>
				</div>

				<div class="modal-body mx-md-10">
					<input type="hidden" name="monitor_data_id" placeholder="" value="'.$monitorData->id.'" />

					<div class="row mb-12">
						<div class="col-md-6">
							<label class="d-flex align-items-center fs-6 fw-bold mb-2">
								<span class="required">Analyst : </span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
							</label>
							<select name="analysts_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Analyst">
								<option value="">Select Anylst</option>';
								if(!empty($analysts)) {
									foreach($analysts as $analyst) {
										$sel = "";
										if($analyst->id == $monitorData->analysts_id) {
											$sel = "selected";
										}
										$html .= '<option value="'.$analyst->id.'" '.$sel.'>'.$analyst->analyst.'</option>';
									}
								}
							$html .= '</select>
						</div>
						<div class="col-md-6">
							<label class="d-flex align-items-center fs-6 fw-bold mb-2">
								<span class="required">Date : </span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
							</label>
							<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="date" placeholder="" value="'.$monitorData->date.'" />
						</div>
					</div>

					<div class="row mb-12">
						<div class="col-md-6">
							<label class="d-flex align-items-center fs-6 fw-bold mb-2">
								<span class="required">Script Name : </span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
							</label>
							<input list="script_name"  class="form-control form-control-lg form-control-solid bdr-ccc" name="script_name" value="'.$monitorData->script_name.'">
							<datalist id="script_name">';
								if(!empty($keywords)) {
									foreach($keywords as $keyword) {
										$html .= '<option value="'. $keyword->name .'">'.$keyword->name.'</option>';
									}
								}
							$html .= '</datalist>
						</div>
						<div class="col-md-6">
							<label class="d-flex align-items-center fs-6 fw-bold mb-2">
								<span class="required">Buy / Sell : </span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
							</label>
							<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="buy_sell" placeholder="Buy / Sell" value="'.$monitorData->buy_sell.'" />
						</div>
					</div>

					<div class="row mb-12">
						<div class="col-md-6">
							<!--begin::Label-->
							<label class="d-flex align-items-center fs-6 fw-bold mb-2">
								<span class="required">Entry Price : </span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
							</label>
							<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="entry_price" placeholder="Entry Price" value="'.$monitorData->entry_price.'" />
						</div>
						<div class="col-md-6">
							<!--begin::Label-->
							<label class="d-flex align-items-center fs-6 fw-bold mb-2">
								<span class="required">Entry Time : </span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
							</label>
							<select name="entry_time" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Status">';
									$sel_yes = $sel_no = "";
									if(isset($monitorData->entry_time) && $monitorData->entry_time == "yes") {
										$sel_yes = "selected";
									}
									if(isset($monitorData->entry_time) && $monitorData->entry_time == "no") {
										$sel_no = "selected";
									}

									$html .= '<option value="yes" '.$sel_yes.' >Yes</option>';
									$html .= '<option value="no" '.$sel_no.' >No</option>
							</select>
						</div>
					</div>

					<div class="row mb-12">
						<div class="col-md-6">
							<label class="d-flex align-items-center fs-6 fw-bold mb-2">
								<span class="required">sl : </span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
							</label>
							<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="sl" placeholder="Enter SL" value="'.$monitorData->sl.'" />
						</div>
						<div class="col-md-6">
							<!--begin::Label-->
							<label class="d-flex align-items-center fs-6 fw-bold mb-2">
								<span class="required">Target : </span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a Account Type" aria-label="Specify a Account Type"></i>
							</label>
							<input type="text" class="form-control form-control-lg form-control-solid bdr-ccc" name="target" placeholder="Enter Target" value="'.$monitorData->target.'" />
						</div>
					</div>

				</div>

				<div class="modal-footer text-center">
					<p id="err_msg1"></p>
					<button type="button" class="btn btn-primary" id="closeModel">
						<span class="indicator-label">Cancel</span>
					</button>
					<button type="submit" id="submitEditCall" class="btn btn-primary">
						<span class="indicator-label">Save</span>
					</button>
				</div>
			</div>
		</form>';

		$data["message"] = $html;
        $data["status"] = true;
        return JsonReturn::success($data);
    }

    public function editMonitorData(Request $request){
        $auth_user = Auth::user();
        $request['monitor_id'] = $auth_user->id;
        /* $request['sl_status'] = null;
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
        } */

        if(isset($request->script_name) &&  $request->script_name != ''){
            $keyword['name'] = $request->script_name;
            $keywordData = KeywordServices::getKeywordByName($request->script_name);
            if(empty($keywordData)){
                KeywordServices::create($keyword);
            }
        }

		$monitor['analysts_id'] = $request->analysts_id;
		$monitor['monitor_id'] = $auth_user->id;
		$monitor['date'] = $request->date;
        $monitor['script_name'] = $request->script_name;
        $monitor['entry_time'] = $request->entry_time;
        $monitor['entry_price'] = $request->entry_price;
        $monitor['target'] = $request->target;
        $monitor['buy_sell'] = $request->buy_sell;
        $monitor['sl'] = $request->sl;
        MonitorData::where("id", $request->monitor_data_id)->update($monitor);

		$data["message"] = "Call has been updated succesfully.";
        $data["status"] = true;
        return JsonReturn::success($data);
    }

    public function editAnalystAssignTo(Request $request){
        AnalystServices::updateAssignTo($request);
        return Redirect::route('viewMonitor')->with("info", "Analyst has been Updated");
    }

    public function deleteMonitorData(Request $request){
        MonitorDataServices::remove($request->id);
        return true;
    }

    public function report(){
        return view("analyst.report");
    }
}
