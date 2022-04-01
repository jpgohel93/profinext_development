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
        "narration",
        "income_form",
        "st_amount",
        "sg_amount",
        "amount",
        "created_by",
        "updated_by",
        "deleted_by",
        "deleted_at",
    ];
}