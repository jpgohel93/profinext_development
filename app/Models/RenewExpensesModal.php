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
}
