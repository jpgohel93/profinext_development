<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analyst extends Model
{
    use HasFactory;
    protected $table = "analysts";
    protected $fillable = ["analyst", "telegram_id", "youtube", "website", "status", "total_calls","accuracy", "trading_capacity", "created_by", "deleted_at", "deleted_by", "updated_by","assign_user_id"];

    public function analystNumbers()
    {
        return $this->hasMany(AnalystNumbers::class);
    }
    public function calls()
    {
        return $this->hasMany(Calls::class);
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
