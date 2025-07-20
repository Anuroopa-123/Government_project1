<?php

namespace App\Helpers;

use App\Models\Timeline;

class TimelineLog
{
    public static function log($event, $operation)
    {
        Timeline::create([
            'event' => $event,
            'operation' => $operation
        ]);
    }
}