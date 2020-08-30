<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Content extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'image_url', 'content_url', 'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 200);
    }

    public function getCreatedAtFormatedAttribute()
    {
        return Carbon::parse($this->created_at)->formatLocalized('%d %b %y / %H:%I');
    }

    public function getUrlAttribute()
    {
        return route('home.single', $this->slug);
    }

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
