<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInvestmentModel extends Model
{
    use HasFactory;
    protected $table = "client_investments";
    protected $fillable = [
        "client_id",
        "amc",
        "fund",
        "investment_type",
        "time_frame",
        "amount",
        "created_by",
        "updated_by",
        "deleted_by",
    ];
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
