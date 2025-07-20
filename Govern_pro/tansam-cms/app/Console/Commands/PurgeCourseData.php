<?php

namespace App\Console\Commands;

use App\Models\CourseRegistration;
use Illuminate\Console\Command;

class PurgeCourseData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purge-course-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete course data after their course period';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $courseRegs = CourseRegistration::all();
        // foreach ($courseRegs as $courseReg) {
        //     if(now() > $courseReg->course_period) {
        //         $courseReg->delete();
        //     }
        // }
    }
}
