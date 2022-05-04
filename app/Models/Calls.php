<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Calls extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "calls";
    protected $fillable = [
        "analyst_id",
        "due_date",
        "script_name",
        "lot_size",
        "entry_price",
        "target_price",
        "stop_loss",
        "margin_value",
        "deleted_at",
        "created_by",
        "client_demate_id",
        "quantity",
    ];
    protected $hidden = ["analyst_id"];

    public function analyst()
    {
        return $this->belongsTo(Analyst::class,'analyst_id','id');
    }
    public function withDemat(){
        return $this->belongsTo(ClientDemat::class,"client_demate_id","id");
    }
}
