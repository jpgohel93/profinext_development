<?php

namespace App\Services;

use App\Models\servicesTypeModel;
use Illuminate\Support\Facades\Auth;

class servicesTypeServices
{
    public static function view()
    {
        return servicesTypeModel::get();
    }
    public static function create($request)
    {
        $type = $request->validate([
            "account_type" => "required|alpha_spaces|unique:user_account_types,account_type"
        ]);
        $type['created_by'] = Auth::id();
        return servicesTypeModel::create($type);
    }
    public static function remove($id)
    {
        return servicesTypeModel::where("id", $id)->delete();
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
        return servicesTypeModel::where("id", $request->id)->update($service);
    }
    public static function add($request){
        $service = $request->validate([
            "name" => "required|",
            "renewal_amount" => "required",
            "sharing" => "required",
            "is_gst_applicable" => "required",
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
        return servicesTypeModel::create($service);
    }
    public static function getById($id){
        return servicesTypeModel::where("id", $id)->first();
    }
}
