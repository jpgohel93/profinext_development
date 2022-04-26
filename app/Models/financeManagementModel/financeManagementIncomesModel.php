<?php

namespace App\Models\financeManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class financeManagementIncomesModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "finance_management_incomes";
    protected $fillable = [
        "date",
        "sub_heading",
        "text_box",
        "mode",
        "bank",
        "income_form",
        "st_amount",
        "sg_amount",
        "amount",
        "narration",
        "created_by",
        "updated_by",
        "deleted_by",
        "deleted_at",
        "renewal_account_id"
    ];
    public function bank_name()
    {
        return $this->hasOne(BankModel::class, "id", "bank")->latest();
    }
    public function withUser()
    {
        return $this->hasOne(Users::class, "id", "created_by")->latest();
    }
//    protected static function boot()
//    {
//        parent::boot();
//
//        static::addGlobalScope('created_by', function (\Illuminate\Database\Eloquent\Builder $builder) {
//            $builder->where($builder->getModel()->getTable() . '.created_by', auth()->user()->id);
//        });
//    }
}
