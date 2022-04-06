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
    protected $fillable = ["client_id","st_sg","serial_number","service_type", "pan_number_text","holder_name","broker","user_id","password","mpin","capital","updated_by","freelancer_id","trader_id","available_balance","pl","is_make_as_preferred","account_status","entry_price","quantity","problem","joining_date", "created_by", "deleted_at", "end_date","address","email_id","mobile","final_pl"];

    public function withClient(){
        return $this->hasOne(Client::class,"id","client_id")->latest();
    }
    public function withPayment(){
        return $this->hasOne(ClientPayment::class, "demat_id", "id")->latest();
    }
    public function withClientByUser(){
        return $this->hasOne(Client::class,"id","client_id")->where("created_by", auth()->user()->id)->latest();
    }
    public function Pancards()
    {
        return $this->hasMany(PancardImageModel::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('created_by', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->where($builder->getModel()->getTable() . '.created_by', auth()->user()->id);
        });
    }
}
