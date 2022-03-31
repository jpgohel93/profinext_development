<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;
    protected $fillable = [
        'name',
        'email',
        'password',
        "bank_name",
        "account_number",
        "ifsc_code",
        "account_type",
        "user_type",
        "company",
        "percentage",
        "salary",
        "joining_date",
        "job_description",
        "role",
        "company_first","profit_percentage_first","company_second","profit_percentage_second",
        "ams_new_client_percentage","ams_renewal_client_percentage","prime_new_client_percentage",
        "prime_renewal_client_percentage","ams_limit","fees_percentage","ams_new_client_profit",
        "created_by",
        "updated_by",
        "permission"
    ];
    protected $hidden = ['password','remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];
    protected $table = "users";

    public function count(){
        return $this->hasMany(TraderModal::class,'trader_id',"id");
    }
    public function withNumber(){
        return $this->belongsTo(UserNumbers::class,"id","user_id");
    }
}
