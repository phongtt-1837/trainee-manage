<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Trainee;
use App\Models\Trainer;
use App\Notifications\CourseExpired;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CourseNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:course-noti';
    protected $trainer, $trainee;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification to related user when a course is about to end';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Trainer $trainer, Trainee $trainee)
    {
        parent::__construct();
        $this->trainee = $trainee;
        $this->trainer = $trainer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $courses = Course::all();
        $notification_data = array();
        foreach ($courses as $course) {
            $end_date = new Carbon($course->end_date);

            if ($end_date->diffInWeekdays(Carbon::now(), false) <= 2 && $end_date->diffInWeekdays(Carbon::now(), false) >= -2) {
                $notification_data['title'] = config('constants.notification.course_expired');
                foreach ($course->trainees()->get() as $trainee) {
                    $notification_data['trainee_id'] = $trainee->id;
                    $trainee->notify(new CourseExpired($notification_data));
                }
            }
        }
    }
}
