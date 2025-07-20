<?php

namespace App\Console\Commands;

use App\Models\Timeline;
use Illuminate\Console\Command;

class PurgeTimelineData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purge-timeline-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete timeline data older than 7 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $timeline = Timeline::all();
        // foreach ($timeline as $data) {
        //     if(now() > $data->created_at->addDays(7)) {
        //         $data->delete();
        //     }
        // }
    }
}
