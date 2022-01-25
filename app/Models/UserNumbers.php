<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserNumbers extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "user_numbers";
    protected $fillable = [
        "user_id",
        "number"
    ];
}
