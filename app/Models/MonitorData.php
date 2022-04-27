<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitorData extends Model
{
    use HasFactory;
    protected $table = "monitor_data";
    protected $fillable = ["monitor_id", "analysts_id", "date","script_name","buy_sell","entry_price","entry_time","target","sl","exit_price","exit_time","status","risk_reward","created_at","created_by","updated_at","updated_by","earning","exit_date","sl_status","analyst_status"];

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
