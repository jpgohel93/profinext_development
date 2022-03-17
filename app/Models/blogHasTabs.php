<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogHasTabs extends Model
{
    use HasFactory;
    protected $table = "tab_has_blogs";
    protected $fillable = ["user_id","tab_id","created_by","deleted_by"];

    public function withBlogs(){
        return $this->belongsTo(Blog::class,"id","user_id");
    }
}
