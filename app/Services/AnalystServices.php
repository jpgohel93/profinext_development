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
                        AnalystNumbers::create([
                            "number"=>$number,
                            "analyst_id"=>$analyst_id->id
                        ]);
                    }
                }
            }
            LogServices::logEvent(["desc"=>"Analyst created $analyst_id->id by ".$user_name]);
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
                Analyst::where("id", $request->analyst_id)->update($analyst);
                return LogServices::logEvent(["desc"=>"Analyst $request->analyst_id Status $request->status updated by ".$user_name]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        $id = Analyst::where("id", $request->analyst_id)->update(["status"=> "Terminated"]);
        if($id){
            return LogServices::logEvent(["desc"=>"Analyst $request->analyst_id Status $request->status updated by ".$user_name]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to update Analyst $request->analyst_id Status $request->status by ".$user_name]);
        }
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
        $id = Analyst::where("id", $request->analyst_id)->update($analyst);
        if($id){
            return LogServices::logEvent(["desc"=>"Analyst $request->analyst_id Assign to $request->assign_user_id by ".$user_name]);
        }else{
            return LogServices::logEvent(["desc"=>"Analyst $request->analyst_id Assign to $request->assign_user_id by ".$user_name]);
        }
    }

}
