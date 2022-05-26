<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewExpensesModal extends Model
{
    use HasFactory;
    protected $table = "renew_expenses";
    protected $fillable = [
        "user_id",
        "date",
        "amount",
        "renewal_account_id",
        "created_at",
        "updated_at",
        "created_by",
        "firm",
        "description",
        "total_amount",
        "percentage"
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
