<?php

namespace App\Models\financeManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class HeadingsModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "finance_management_headings";
    protected $fillable = [
        "label_type",
        "sub_heading",
        "is_active",
        "deleted_at",
        "created_by",
        "updated_by",
        "deleted_by",
    ];
}
