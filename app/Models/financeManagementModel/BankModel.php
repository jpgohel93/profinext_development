<?php

namespace App\Models\financeManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BankModel extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "finance_management_banks";
    protected $fillable = [
        "type",
        "name",
        "title",
        "account_name",
        "account_type",
        "account_no",
        "ifsc_code",
        "available_balance",
        "limit_utilize",
        "target",
        "is_primary",
        "is_active",
        "reserve_balance",
        "total_trans_amount",
        "created_at",
        "updated_at",
        "deleted_at",
        "created_by",
        "updated_by",
        "deleted_by",
        "invoice_code",
        "pan_number",
    ];
}
