<?php

namespace App\Models\documentManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ImageModel extends Model
{
    use HasFactory;
    protected $table = "tbl_images";
    protected $fillable = [
        "date",
        "title",
        "notes",
        "image",
        "created_by",
        "updated_by",
        "deleted_by",
    ];
//    protected static function boot()
//    {
//        parent::boot();
//        static::addGlobalScope('created_by', function (\Illuminate\Database\Eloquent\Builder $builder) {
//            $builder->where($builder->getModel()->getTable() . '.created_by', auth()->user()->id);
//        });
//    }

}
