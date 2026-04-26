<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = [
        'title', 'slug', 'short_description', 'description', 'content', 'image', 'duration',
        'price', 'level', 'curriculum', 'is_active', 'views',
        'meta_title', 'meta_description'
    ];

    protected $casts = [
        'curriculum' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $course->slug = Str::slug($course->title);
        });
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
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