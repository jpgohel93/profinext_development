<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class renewalAccountImagesModal extends Model
{
    use HasFactory;
    protected $table = "renewal_account_images";
    protected $fillable = [
        "renewal_account_id",
        "mimeType",
        "ext",
        "image_url",
        "title",
        "created_by",
        "updated_by",
        "deleted_by",
        "deleted_at",
    ];
}
