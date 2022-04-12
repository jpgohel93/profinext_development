<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TermsAndConditionsModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "terms_and_conditions";
    protected $fillable = [
        "title",
        "description",
        "is_active",
        "created_by",
        "updated_by",
        "deleted_by",
        "deleted_at",
    ];
}
