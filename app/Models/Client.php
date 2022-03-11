<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "clients";
    protected $fillable = ["client_type","name","number","communication_with","wp_number","profession","updated_by","created_by","channel_partner_id","freelancer_id"];

    public function clientDemat()
    {
        return $this->hasMany(ClientDemat::class);
    }

    public function clientPayment()
    {
        return $this->hasMany(ClientPayment::class);
    }

}
