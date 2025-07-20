<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model
{
    protected $fillable = [
        'course',
        'name',
        'dob',
        'mobile_number',
        'email',
        'address_line_one',
        'address_line_two',
        'city',
        'state',
        'zip_code',
        'college_organization',
        'department_domain',
        'year_experience',
    ];
}
