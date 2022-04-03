<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientDemat extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "client_demat";
    // protected $hidden = ["password","mpin"];
    protected $fillable = ["client_id","st_sg","serial_number","service_type","pan_number","holder_name","broker","user_id","password","mpin","capital","updated_by","freelancer_id","trader_id","available_balance","pl","is_make_as_preferred","account_status","entry_price","quantity","problem","joining_date"];

    public function withClient(){
        return $this->hasOne(Client::class,"id","client_id")->latest();
    }
    public function withClientByUser(){
        return $this->hasOne(Client::class,"id","client_id")->where("created_by", auth()->user()->id)->latest();
    }
    public function Pancards()
    {
        return $this->hasMany(PancardImageModel::class);
    }
}
