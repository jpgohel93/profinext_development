<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginServices;
use Illuminate\Support\Facades\Redirect;
use App\Services\LogServices;
use App\Models\LogsModel;
class LoginController extends Controller
{
    public static function login(Request $request)   {
        LoginServices::login($request);
        return Redirect::route('dashboard')->with('success','Login successfully');
    }
    public function logout(Request $request)
    {
        return LoginServices::logout($request);
    }

    public function dashboardData()
    {
        $userData = auth()->user();

        if($userData->role == "super-admin"){
            $activity = LogServices::getActivity();
        }else{
            $activity = LogServices::getActivityById($userData->id);
        }

        return view("dashboard",compact('activity'));
    }
    public function history(Request $request){
        $userData = auth()->user();
        if($userData->role == "super-admin"){
            $activity = LogServices::getActivity(true);
        }else{
            $activity = LogServices::getActivityById($userData->id,true);
        }
        if($request->ajax()){
            // search
            if(isset($request->search['value']) && $request->search['value']!=""){
                $str = $request->search['value'];
                if($userData->role == "super-admin"){
                    $activity = LogsModel::where("description","LIKE","%$str%")->orWhere('created_at',"LIKE","%$str%")->get();
                }else{
                    $activity = LogsModel::where("description","LIKE","%$str%")->orWhere('created_at',"LIKE","%$str%")->where("created_by",$userData->id)->get();
                }
            }
            $logs['data']= array();
            $i=0;
            foreach($activity as $log){
                $arr = array();
                if($log->description!=""){
                    $date = $log->created_at;
                    if(str_contains($log->description,"updated")){
                        if($log->updated_at){
                            $date = $log->updated_at;
                        }
                    }else if(str_contains($log->description,"deleted")){
                        if($log->deleted_at){
                            $date = $log->deleted_at;
                        }
                    }
                    array_push($arr,++$i);
                    array_push($arr,date('d M-Y h:i A',strtotime((string)$date)));
                    array_push($arr,$log->description);
                    array_push($logs['data'],$arr);
                }
            }
            $logs["recordsTotal"]=$i;
            $logs["recordsFiltered"]=$i;
            return response($logs,200,["Content-Type","Application/json"]);
        }
        return view("history",compact('activity'));
    }
}
