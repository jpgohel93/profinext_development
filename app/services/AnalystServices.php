<?php

namespace App\Services;
use App\Models\Analyst;
use App\Models\AnalystNumbers;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonService;
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
            return $analyst_id->id;
        } catch (\Throwable $th) {
            CommonService::throwError("Unable to create Analyst");
        }
    }
    public static function getAnalyst($id){
        return Analyst::where("id",$id)->first(["id", "total_calls", "accuracy", "trading_capacity","analyst","status"]);
    }
    public static function update($request){
        if($request->status!= "Terminated"){
            $analyst = $request->validate([
                "analyst"=>"required",
                "total_calls"=>"required",
                "accuracy"=>"required",
                "trading_capacity"=>"required",
                "status"=>"required"
            ]);
            return Analyst::where("id", $request->analyst_id)->update($analyst);
        }
        return Analyst::where("id", $request->analyst_id)->update(["status"=> "Terminated"]);
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
}
