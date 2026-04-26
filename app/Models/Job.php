<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Job extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'image', 'location', 'type',
        'salary_range', 'requirements', 'benefits', 'is_active', 'views',
        'meta_title', 'meta_description'
    ];

    protected $casts = [
        'requirements' => 'array',
        'benefits' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            $job->slug = Str::slug($job->title);
        });
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}