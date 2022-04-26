<?php

namespace App\Services;
use App\Models\ClientInvestmentModel;
use App\Services\LogServices;
class ClientInvestmentServices {
    public static function get($id){
        return ClientInvestmentModel::where("client_id",$id)->get();
    }
    public static function create($request){
        $ids = [];

        $request->validate([
            "amc.*"=> "required",
            "fund.*"=> "required",
            "investmentType.*"=> "required",
            "amount.*"=> "required",
        ],[
            "amc.*.required" => "AMC is required",
            "fund.*.required" => "Fund is required",
            "investmentType.*.required" => "Investment type is required",
            "amount.*.required" => "Amount is required",
        ]);
        $user_name = auth()->user()->name;
        foreach($request->amc as $key => $data){
            $investment = array();
            if($request->investmentType[$key]=="sip"){
                $request->validate([
                    "sipTimeFrame.*"=> "required"
                ]);
                $timeFrames = ["monthly", "quarterly", "half yearly", "yearly"];
                if(!in_array($request->sipTimeFrame[$key],$timeFrames)){
                    $error = \Illuminate\Validation\ValidationException::withMessages([
                        "investmentType"=> ["invalid time frame Type"]
                    ]);
                    throw $error;
                }
            }else if($request->investmentType[$key]!= "lump sum"){
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    "investmentType" => ["invalid Investment Type"]
                ]);
                throw $error;
            }
            $investment['amc'] = $request->amc[$key];
            $investment['fund'] = $request->fund[$key];
            $investment['investment_type'] = $request->investmentType[$key];
            $investment['amount'] = $request->amount[$key];
            $investment['time_frame'] = $request->sipTimeFrame[$key];
            $investment['created_by'] = auth()->user()->id;

            $investment = ClientInvestmentModel::create($investment);
            if($investment){
                LogServices::logEvent(["desc"=>"Investment $investment->id created by $user_name"]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to create Investment by $user_name","data"=>$investment]);
            }
            array_push($ids,$investment->id);
        }
        return $ids;
    }
    public static function update($request,$id){
        $user_name = auth()->user()->name;
        $data = ClientInvestmentModel::where("id",$id)->first();
        $status = ClientInvestmentModel::where("id",$id)->update($request);
        if($status){
            LogServices::logEvent(["desc"=>"Investment $id updated by $user_name","data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to update Investment $id by $user_name","data"=>$request]);
        }
        return $status;
    }
    public static function forceDelete($id){
        $user_name = auth()->user()->name;
        $data = ClientInvestmentModel::where("id", $id)->first();
        $status = ClientInvestmentModel::where("id", $id)->forceDelete();
        if($status){
            LogServices::logEvent(["desc"=>"Investment $id deleted by $user_name","data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to delete Investment $id by $user_name"]);
        }
        return $status;
    }
}
