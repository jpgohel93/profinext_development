<?php

namespace App\Models\documentManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class documentManagementModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "tbl_documents";
    protected $fillable = [
        "date",
        "title",
        "notes",
        "document",
        "created_by",
        "updated_by",
        "deleted_by",
    ];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('created_by', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->where($builder->getModel()->getTable() . '.created_by', auth()->user()->id);
        });
    }

}
