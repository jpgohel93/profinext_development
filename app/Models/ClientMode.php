<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientMode extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "client_mode";
    protected $fillable = ["name","updated_by"];
}
