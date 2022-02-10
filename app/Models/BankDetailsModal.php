<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BankDetailsModal extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "client_banks";
    protected $fillable = ["bank","created_by"];
}
