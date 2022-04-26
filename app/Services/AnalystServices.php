<?php

namespace App\Services;
use App\Models\Analyst;
use App\Models\AnalystNumbers;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonService;
use App\Services\LogServices;
class AnalystServices{
    public static function all(){
        $analyst = [];
        // get all Active
        $analyst['active'] = Analyst::with(["analystNumbers"])->where("status", "Active")->get();
        // get all Experiment
        $analyst['experiment'] = Analyst::with(["analystNumbers"])->where("status", "Experiment")->get();
        // get all Paper Trade
        $analyst['paper_trade'] = Analyst::with(["analystNumbers"])->where("status", "Paper Trade")->get();
        // get all Terminated
        $analyst['terminated'] = Analyst::with(["analystNumbers"])->where("status", "Terminated")->get();
        // get all Terminated
        $analyst['free_trade'] = Analyst::with(["analystNumbers"])->where("status", "Free Trade")->get();

        return $analyst;
    }
    public static function allByUserId($id){
        $analyst = [];
        // get all Active
        $analyst['active'] = Analyst::with(["analystNumbers"])->where("created_by",$id)->where("status", "Active")->get();
        // get all Experiment
        $analyst['experiment'] = Analyst::with(["analystNumbers"])->where("created_by",$id)->where("status", "Experiment")->get();
        // get all Paper Trade
        $analyst['paper_trade'] = Analyst::with(["analystNumbers"])->where("created_by",$id)->where("status", "Paper Trade")->get();
        // get all Terminated
        $analyst['terminated'] = Analyst::with(["analystNumbers"])->where("created_by",$id)->where("status", "Terminated")->get();
        // get all Terminated
        $analyst['free_trade'] = Analyst::with(["analystNumbers"])->where("created_by",$id)->where("status", "Free Trade")->get();

        return $analyst;
    }
    public static function create($request){
        $analyst = $request->validate([
            "analyst"=>"required",
            "telegram_id"=>"required",
            "youtube"=>"required",
            "status"=>"required",
            "assign_user_id"=>"required",
        ]);
        if(isset($request->has_site) && $request->has_site=="1"){
            $web = $request->validate([
                "website" => "required",
            ]);
            $analyst['website'] = $web['website'];
        }
        $analyst['created_by'] = Auth::id();
        $user_name = auth()->user()->name;
        try {
            $analyst_id = Analyst::create($analyst);
            // insert numbers
            if(isset($request->numbers) && is_array($request->numbers) && !empty($request->numbers)){
                foreach($request->numbers as $number){
                    if($number){
                        $id = AnalystNumbers::create([
                            "number"=>$number,
                            "analyst_id"=>$analyst_id->id
                        ]);
                        if($id){
                            LogServices::logEvent(["desc"=>"Analyst $analyst_id->id updated by ".$user_name]);
                        }else{
                            LogServices::logEvent(["desc"=>"Unable to add number for Analyst $analyst_id->id by ".$user_name,"data"=>$number]);
                        }
                    }
                }
            }
            if($analyst_id){
                LogServices::logEvent(["desc"=>"Analyst created $analyst_id->id by ".$user_name]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to create Analyst $analyst_id->id by ".$user_name,"data"=>$analyst]);
            }
            return $analyst_id->id;
        } catch (\Throwable $th) {
            LogServices::logEvent(["desc"=>"Unable to create Analyst by ".$user_name]);
            CommonService::throwError("Unable to create Analyst");
        }
    }
    public static function getAnalyst($id){
        return Analyst::where("id",$id)->first(["id", "total_calls", "accuracy", "trading_capacity","analyst","status","assign_user_id"]);
    }
    public static function update($request){
        $user_name = auth()->user()->name;
        if($request->status!= "Terminated"){
            $analyst = $request->validate([
                "analyst"=>"required",
                "status"=>"required"
            ]);
            $analyst['assign_user_id'] = $request->assign_user_id;
            try {
                $data = Analyst::where("id", $request->analyst_id)->first();
                $status = Analyst::where("id", $request->analyst_id)->update($analyst);
                if($status){
                    LogServices::logEvent(["desc"=>"Analyst $request->analyst_id updated by ".$user_name,"data"=>$data]);
                }else{
                    LogServices::logEvent(["desc"=>"Analyst $request->analyst_id updated by ".$user_name,"data"=>$analyst]);
                }
                return $status;
            } catch (\Throwable $th) {
                return LogServices::logEvent(["desc"=>"Analyst $request->analyst_id updated by ".$user_name,"data"=>$analyst]);
            }
        }
        $dt = ["status"=> "Terminated"];
        $data = Analyst::where("id", $request->analyst_id)->first();
        $status = Analyst::where("id", $request->analyst_id)->update($dt);
        if($status){
            LogServices::logEvent(["desc"=>"Analyst $request->analyst_id Status $request->status updated by ".$user_name,"data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to update Analyst $request->analyst_id Status $request->status by ".$user_name,"data"=>$dt]);
        }
        return $status;
    }

    public static function allUserAssignAnalysts($id){
        $analyst = [];
        // get all Active
        $analyst['active'] = Analyst::with(["analystNumbers"])->where("status", "Active")->where('assign_user_id',$id)->get();
        // get all Experiment
        $analyst['experiment'] = Analyst::with(["analystNumbers"])->where("status", "Experiment")->where('assign_user_id',$id)->get();
        // get all Paper Trade
        $analyst['paper_trade'] = Analyst::with(["analystNumbers"])->where("status", "Paper Trade")->where('assign_user_id',$id)->get();
        // get all Terminated
        $analyst['terminated'] = Analyst::with(["analystNumbers"])->where("status", "Terminated")->where('assign_user_id',$id)->get();

        return $analyst;
    }

    public static function allUserAnalysts($id){

        $auth_user = Auth::user();
        $explRole = explode(",", $auth_user->role);

        if(in_array("super-admin", $explRole)) {
            $analyst =  Analyst::get();
        }else{
            $analyst =  Analyst::where('assign_user_id',$id)->get();
        }

        return $analyst;
    }

    public static function updateAssignTo($request)
    {
        $analyst = $request->validate([
            "analyst" => "required",
            "assign_user_id" => "required"
        ]);
        $user_name = auth()->user()->name;
        $data = Analyst::where("id", $request->analyst_id)->first();
        $status = Analyst::where("id", $request->analyst_id)->update($analyst);
        if($status){
            LogServices::logEvent(["desc"=>"Analyst $request->analyst_id updated by ".$user_name,"data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to update Analyst $request->analyst_id by ".$user_name,"data"=>$analyst]);
        }
        return $status;
    }

}
