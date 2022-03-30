<?php

namespace App\Models\financeManagementModel;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class financeManagementLoanModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "finance_management_loans";
    protected $fillable = [
        "date",
        "sub_heading",
        "narration",
        "mode",
        "bank",
        "amount",
        "user",
        "created_by",
        "updated_by",
        "deleted_by",
        "deleted_at",
    ];
    public function bank_name()
    {
        return $this->hasOne(BankModel::class, "id", "bank")->latest();
    }
    public function user_name()
    {
        return $this->hasOne(User::class, "id", "user")->latest();
    }
}
