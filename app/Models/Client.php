<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "clients";
    protected $fillable = ["client_type","name","number","communication_with","wp_number","profession","updated_by","created_by","channel_partner_id","freelancer_id","communication_with_contact_number"];

    public function clientDemat()
    {
        return $this->hasMany(ClientDemat::class);
    }

    public function clientPayment()
    {
        return $this->hasMany(ClientPayment::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();
    //     if(auth()->user()->hasRole("super-admin")){
    //         static::addGlobalScope('created_by', function (\Illuminate\Database\Eloquent\Builder $builder) {
    //             $builder->where($builder->getModel()->getTable() . '.created_by', "LIKE","%%");
    //         });
    //     }else{
    //         static::addGlobalScope('created_by', function (\Illuminate\Database\Eloquent\Builder $builder) {
    //             $builder->where($builder->getModel()->getTable() . '.created_by', auth()->user()->id);
    //         });
    //     }
    // }

}
