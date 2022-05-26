<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BrokerModal extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "client_brokers";
    protected $fillable = ["broker","created_by"];
}
