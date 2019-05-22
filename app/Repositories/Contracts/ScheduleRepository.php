<?php

namespace App\Repositories\Contracts;

use App\Models\Course;
use App\Models\Phase;
use App\Models\StaffType;
use App\Models\Trainee;
use App\Repositories\ScheduleRepositoryInterface;
use App\Repositories\Contracts\BaseRepository;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ScheduleRepository extends BaseRepository implements ScheduleRepositoryInterface
{
    protected $course;
    /**
     * Create a new Repository instance.
     *
     * @param  ScheduleRepositoryInterface
     * @return void
     */
    public function __construct(Schedule $model, Course $course)
    {
        parent::__construct($model);
        $this->course = $course;
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $this->model->language_id = $data['language_id'];
            $this->model->applied_day = $data['applied_day'];
            $this->model->status = config('constants.constants.default_value');
            $this->model->staff_type_id = $data['staff_type_id'];
            $this->model->name = $data['name'];
            $selected_phases_id = $data['selected_phases_id'];
            $selected_phases_id = ltrim($selected_phases_id, '-');
            $selected_phases_id = explode("-", $selected_phases_id);

            if ($this->model->save()) {
                foreach ($selected_phases_id as $key => $value) {
                    $phase_schedule_data = [
                        'time_duration' => $data['time_duration_' . $key],
                        'priority' => $key,
                    ];
                    $this->model->phases()->attach($selected_phases_id[$key], $phase_schedule_data);
                }
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            return redirect()->route('schedules.index');
        }
    }

    public function getStaffType()
    {
        return StaffType::all();
    }

    public function getPhase($id)
    {
        $schedule = $this->model->findOrFail($id);

        return $schedule->phases;
    }

    public function getTime($id)
    {
        $schedule = $this->model->findOrFail($id);
        $final_result = array();
        $schedule_sort = $schedule->phases->sortBy('pivot.priority');
        foreach ($schedule_sort as $phase) {
            $result = ([
                'date' => $phase->pivot->time_duration . __(' day(s)'),
                'content' => $phase->name,
            ]);
            $result = (object) $result;
            array_push($final_result, $result);
        }

        return $final_result;
    }

    /**
     * Get array of schedule
     * @param  array $relation
     * @return array
     */
    public function getScheduleArray()
    {
        return $this->model->get()->pluck('name', 'id')->toArray();
    }

    public function getTraineeSchedule($id)
    {
        $course = Course::findOrFail($id);

        return $course->schedule_id;
    }

    public function getCurrentPhase($id)
    {
        $course = Course::findOrFail($id);
        $number_of_days = Carbon::now()->diffInWeekDays($course->start_date);

        $schedule = $this->model->findOrFail($course->schedule_id);
        $result = array(
            'current_phase' => '',
            'days_left' => '',
        );

        for ($i = 0; $i < $schedule->phases->count(); $i++) {
            $number_of_days = $number_of_days - $schedule->phases[$i]->pivot->time_duration;
            if ($number_of_days <= 0) {
                $days_left = abs($number_of_days);
                return $result = ([
                    'current_phase' => $i,
                    'days_left' => $days_left,
                ]
                );
            }
        }

        return $result;
    }
}
