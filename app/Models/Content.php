<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'image_url', 'content_url', 'status'
    ];

    public function getStatusRawAttribute()
    {
        switch ($this->status) {
            case '200':
                return '<span class="text-success">'. $this->status .'</span>';
                break;

            case '404':
                return '<span class="text-warning">'. $this->status .'</span>';
                break;

            case '0':
                return '<span class="text-danger">'. $this->status .'</span>';
                break;

            default:
                return $this->status;
                break;
        }
    }
}
