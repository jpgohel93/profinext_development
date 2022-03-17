<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogTarget extends Model
{
    use HasFactory;
    protected $table= "blog_target";
    protected $fillable = ["user_id","tab_id","target","created_at","updated_at","deleted_at"];
}
