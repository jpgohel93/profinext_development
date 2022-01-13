<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPayment extends Model
{
    use HasFactory;
    protected $table = "client_payment";
    protected $hidden = ["client_id"];
    protected $fillable = ["client_id", "joining_date", "fees", "mode", "updated_by"];
}
