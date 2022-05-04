<?php

namespace App\Services;

use App\Models\servicesTypeModel;

class servicesTypeServices
{
    public static function view()
    {
        return servicesTypeModel::get();
    }
    public static function remove($id)
    {
        $user_name = auth()->user()->name;
        $service =servicesTypeModel::where("id", $id)->first();
        $status = servicesTypeModel::where("id", $id)->delete();
        if($status){
            LogServices::logEvent(["desc"=>"Client service $service->name deleted by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to delete Client service $service->name by $user_name"]);
        }
    }
    public static function get($request)
    {
        $request->validate([
            "id" => "required|exists:clients_service_type,id"
        ]);
        return servicesTypeModel::where("id", $request->id)->first();
    }
    public static function edit($request)
    {
        $service = $request->validate([
            "name"=> "required|",
            "renewal_amount"=>"required",
            "sharing"=>"required",
            "is_gst_applicable"=>"required",
            "cutoff"=>"required",
        ],[
            "name.required"=> "The Service type field is required",
            "renewal_amount.required"=> "The Renewal amount field is required",
            "sharing.required"=> "The Sharing field is required",
            "is_gst_applicable.required"=> "The GST Applicable field is required",
        ]);

        if($request->is_gst_applicable){
            $request->validate([
                "gst_rate"=>"required"
            ],[
                "gst_rate.required" => "The GST Rate field is required",
            ]);
            $service['gst_rate'] = $request->gst_rate;
        }
        $data = servicesTypeModel::where("id", $request->id)->first();
        $user_name = auth()->user()->name;
        $status = servicesTypeModel::where("id", $request->id)->update($service);
        if($status){
            LogServices::logEvent(["desc"=>"Client Service $data->name updated by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to update Client Service $data->name by $user_name"]);
        }
    }
    public static function add($request){
        $service = $request->validate([
            "name" => "required",
            "renewal_amount" => "required",
            "sharing" => "required",
            "is_gst_applicable" => "required",
            "cutoff" => "required",
        ], [
            "name.required" => "The Service type field is required",
            "renewal_amount.required" => "The Renewal amount field is required",
            "sharing.required" => "The Sharing field is required",
            "is_gst_applicable.required" => "The GST Applicable field is required",
        ]);

        if ($request->is_gst_applicable) {
            $request->validate([
                "gst_rate" => "required"
            ], [
                "gst_rate.required" => "The GST Rate field is required",
            ]);
            $service['gst_rate'] = $request->gst_rate;
        }
        $status = servicesTypeModel::create($service);
        $user_name = auth()->user()->name;
        if($status){
            LogServices::logEvent(["desc"=>"Client service $request->name created by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Client service $request->name by $user_name"]);
        }
    }
    public static function getById($id){
        return servicesTypeModel::where("id", $id)->first();
    }

    public static function getByType($type){
        return servicesTypeModel::where("name",'like',$type)->first();
    }
}
