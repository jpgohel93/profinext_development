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
        "amount",
        "narration",
        "created_by",
        "updated_by",
        "deleted_by",
        "deleted_at",
    ];
    public function bank_name()
    {
        return $this->hasOne(BankModel::class, "id", "bank")->latest();
    }
}
