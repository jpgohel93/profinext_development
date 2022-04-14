<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewDemat extends Model
{
    use HasFactory;
    protected $table = "renewal_account";
    protected $fillable = ["payment_date","fees_pay_date","profit_sharing_pay_date","reminder_date","order_id","financial_year","invoice_code","bank_code","is_pay_fee","is_pay_profit_sharing","is_part_payment","part_payment","final_amount","total_profit","promised_profit","access_profit","profit_sharing","renewal_fees","total_payment","round_of_amount","round_of_amount_type","client_demat_id","joining_date","end_date","pl","bank_id","status","created_at","updated_at","created_by","updated_by"];

}
