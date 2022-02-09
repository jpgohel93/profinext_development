<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTypesModel extends Model
{
    use HasFactory;
    protected $table = "user_account_types";
    protected $fillable = ["account_type", "created_by"];
}
