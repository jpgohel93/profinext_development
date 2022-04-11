<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PancardImageModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "tbl_pancards";
    protected $fillable = ["client_demat_id", "file", "mime_type", "deleted_by","deleted_at"];
}
