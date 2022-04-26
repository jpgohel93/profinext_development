<?php

namespace App\Models\financeManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class financeManagementTransferModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "finance_management_transfers";
    protected $fillable = [
        "date",
        "from",
        "purpose",
        "to",
        "bank_type",
        "narration",
        "income_form",
        "st_amount",
        "sg_amount",
        "amount",
        "created_by",
        "updated_by",
        "deleted_by",
        "deleted_at",
        "transfer_type",
        "from_bank_id"
    ];
    public function withBank(){
        return $this->hasOne(BankModel::class, "id", "from")->latest();
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
