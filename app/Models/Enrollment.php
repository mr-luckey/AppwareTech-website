<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'course_id', 'message', 'status'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}