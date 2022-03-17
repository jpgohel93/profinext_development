<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = "blogs";
    protected $fillable = [
        "srno",
        "blogger",
        "achievement",
        "target",
        "date",
        "title",
        "link",
        "is_approve",
        "attampt",
        "notes",
        "schedule",
        "updated_by",
        "tab_id"
    ];
    public function withBlogger(){
        return $this->hasOne(User::class,"id","blogger")->latest();
    }
    public function withTabs(){
        return $this->belongsToMany(blogHasTabs::class,"tab_has_blogs","user_id","tab_id");
    }
}
