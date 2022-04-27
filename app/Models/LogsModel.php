<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
class LogsModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "tbl_logs";
    protected $fillable = [
        "description",
        "user_id",
        "client_id",
        "demat_id",
        "data",
        "created_at",
        "updated_at",
        "deleted_at",
        "created_by",
        "updated_by",
        "deleted_by",
    ];
}
