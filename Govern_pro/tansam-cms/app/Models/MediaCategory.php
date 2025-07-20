<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_published',
    ];
}
