<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TraderModal extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "trader";
    protected $fillable = ["client_id", "trader_id", "created_by"];

    public function withClient(){
        return $this->belongsTo(Client::class,"client_id","id")->with(["clientDemat"]);
    }
    public function withTrader(){
        return $this->belongsTo(User::class,"trader_id","id");
    }
}
