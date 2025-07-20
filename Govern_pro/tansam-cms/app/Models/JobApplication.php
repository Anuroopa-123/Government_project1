<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'role',
        'name',
        'contact_number',
        'email',
        'resume',
        'status'
    ];
}
