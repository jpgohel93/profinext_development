<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PancardImageModel extends Model
{
    use HasFactory;
    protected $table = "tbl_pancards";
    protected $fillable = ["client_demat_id", "file", "mime_type"];
}
