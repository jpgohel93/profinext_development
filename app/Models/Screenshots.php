<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Screenshots extends Model
{
    use HasFactory,SoftDeletes;
    protected $table= "tbl_screenshots";

    protected $hidden = ["client_id"];
    protected $fillable = ["client_payment_id", "file","mime_type", "deleted_by"];
}
