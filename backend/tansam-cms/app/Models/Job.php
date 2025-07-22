<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'tansam_jobs';
    protected $fillable = [
        'role',
        'description',
        'posted_on',
        'type',
        'is_published',
    ];
}
