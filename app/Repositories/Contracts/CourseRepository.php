<?php

namespace App\Repositories\Contracts;

use App\Repositories\CourseRepositoryInterface;
use App\Repositories\Contracts\BaseRepository;
use App\Models\Course;
use App\Models\Schedule;
use Carbon\Carbon;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    /**
     * The schedule instance.
     */
    protected $schedule;
    /**
     * Create a new Repository instance.
     *
     * @param  CourseRepositoryInterface
     * @return void
     */
    public function __construct(Course $model, Schedule $schedule)
    {
        parent::__construct($model);
        $this->schedule = $schedule;
    }

    /**
     * Filter course with language
     */
    public function filterLanguage($relation, $language)
    {
        $schedule_ids = $this->schedule->where('language_id', $language)->pluck('id')->toArray();

        return $this->model->with($relation)->whereIn('schedule_id', $schedule_ids)->get();
    }

    public function store($data)
    {
        $schedule = $this->schedule->findOrFail($data['schedule_id']);
        $duration = 0;
        foreach ($schedule->phases as $phase) {
            $duration = $phase->pivot->time_duration + $duration;
        }
        $start_date = new Carbon($data['start_date']);
        $data['end_date'] = $start_date->addWeekdays($duration);

        return $this->model->create($data);
    }
}
