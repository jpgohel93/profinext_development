<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPayment extends Model
{
    use HasFactory;
    protected $table = "client_payment";
    protected $hidden = ["client_id"];
    protected $fillable = ["client_id", "bank","joining_date", "fees", "mode", "pending_payment","screenshots","updated_by", "created_by", 'demat_id'];
    
    public function Screenshots()
    {
        return $this->hasMany(Screenshots::class);
    }
}   
