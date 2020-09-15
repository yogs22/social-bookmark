<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Content extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'image_url', 'content_url', 'status', 'published_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 200)->where('published_at', '<=', now());
    }

    public function scopePending($query)
    {
        return $query->where('published_at', '>', now());
    }

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getPublishedStatusAttribute()
    {
        if ($this->published_at <= now()) {
            return '<span class="text-success">Published</span>';
        }

        return '<span class="text-danger">Pending</span>';
    }

    public function getPublishedAtFormatedAttribute()
    {
        if ($this->published_at === null) {
            return null;
        }

        return Carbon::parse($this->published_at)->formatLocalized('%d %b %y / %H:%I');
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
