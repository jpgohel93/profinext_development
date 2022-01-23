<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNumbers extends Model
{
    use HasFactory;
    protected $table = "user_numbers";
    protected $fillable = [
        "user_id",
        "number"
    ];
}
