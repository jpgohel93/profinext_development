<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientDemat extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "client_demat";
    // protected $hidden = ["password","mpin"];
    protected $fillable = ["client_id","st_sg","serial_number","service_type","pan_number","holder_name","broker","user_id","password","mpin","capital","updated_by"];
}
