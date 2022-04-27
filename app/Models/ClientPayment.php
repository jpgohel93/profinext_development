<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPayment extends Model
{
    use HasFactory;
    protected $table = "client_payment";
    protected $hidden = ["client_id"];
    protected $fillable = ["client_id", "bank","joining_date", "fees", "mode", "pending_payment","screenshots","updated_by", "created_by", 'demat_id'];

    public function Screenshots()
    {
        return $this->hasMany(Screenshots::class);
    }
    public function withClient(){
        return $this->hasOne(Client::class,"id","client_id");
    }
    public function withDemat(){
        return $this->hasOne(ClientDemat::class,"id", "demat_id");
    }
    protected static function boot()
    {
        parent::boot();
        if(auth()->user()->hasRole("super-admin")){
            static::addGlobalScope('created_by', function (\Illuminate\Database\Eloquent\Builder $builder) {
                $builder->where($builder->getModel()->getTable() . '.created_by', "LIKE","%%");
            });
        }else{
            static::addGlobalScope('created_by', function (\Illuminate\Database\Eloquent\Builder $builder) {
                $builder->where($builder->getModel()->getTable() . '.created_by', auth()->user()->id);
            });
        }
    }

}
