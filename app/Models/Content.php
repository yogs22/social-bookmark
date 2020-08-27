<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'image_url', 'content_url', 'status'
    ];
}
