<?php

namespace App\Models\financeManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class financeManagementExpensesModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "finance_management_expenses";
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
    ];
    public function bank_name(){
        return $this->hasOne(BankModel::class,"id","bank")->latest();
    }
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('created_by', function (\Illuminate\Database\Eloquent\Builder $builder) {
        });
    }
}
