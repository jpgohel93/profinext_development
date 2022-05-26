<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProfessionModal extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "client_professions";
    protected $fillable = ["profession","created_by"];
}
