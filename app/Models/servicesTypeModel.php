<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicesTypeModel extends Model
{
    use HasFactory;
    protected $table = "clients_service_type";
    protected $fillable = [
        "name",
        "renewal_amount",
        "cutoff",
        "sharing",
        "is_gst_applicable",
        "gst_rate",
    ];
}
