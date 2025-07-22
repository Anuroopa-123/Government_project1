<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrepreneurship extends Model
{
    protected $fillable = [
        'course_title',
        'course_lab',
        'course_image',
        'start_date',
        'from_time',
        'to_time',
        'mode',
        'contact_person',
        'contact_mail',
        'is_published'
    ];

    public function getCourseImageAttribute($value)
    {
        return url($value);
    }
}