<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalystNumbers extends Model
{
    use HasFactory;
    protected $table = "analyst_numbers";
    protected $hidden = ["analyst_id"];
    protected $fillable = ["number","analyst_id", "deleted_at"];
}
