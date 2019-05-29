<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Repositories\CourseRepositoryInterface;
use App\Repositories\ScheduleRepositoryInterface;
use App\Repositories\TraineeRepositoryInterface;

class CourseController extends Controller
{
    /**
     * The interface repository instance.
     */
    protected $course;
    protected $schedule;
    protected $trainee;

    /**
     * Create a new controller instance.
     *
     * @param  CourseRepositoryInterFace
     * @return void
     */
    public function __construct(CourseRepositoryInterface $course, ScheduleRepositoryInterface $schedule, TraineeRepositoryInterface $trainee)
    {
        $this->course = $course;
        $this->trainee = $trainee;
        $this->schedule = $schedule;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = $this->course->all(['schedule', 'schedule.language', 'schedule.staff_type']);
        if ($request->has('language')) {
            $courses = $this->course->filterLanguage(['schedule', 'schedule.language', 'schedule.staff_type'], $request->input('language'));
        }
        $languages = $this->trainee->getLanguage();
        
        return view('admin.courses.index', compact('courses', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schedules = $this->schedule->getScheduleArray();

        return view('admin.courses.create', compact('schedules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $course = $this->course->store($request->all());
        if (!$course) {
            return back()->with('error', __('Something went wrong!'));
        }

        return redirect()->route('courses.index')->with('success', __('Create successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trainees = $this->trainee->getTraineesForCourse();
        $course = $this->course->get(['schedule', 'schedule.language', 'schedule.staff_type', 'schedule.phases'], $id);

        return view('admin.courses.show', compact('course', 'trainees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = $this->course->get([], $id);
        if (!$course) {
            return back()->with('error', __('Something went wrong!'));
        }
        $schedules = $this->schedule->getScheduleArray();

        return view('admin.courses.edit', compact('course', 'schedules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        $course = $this->course->update($request->all(), $id);
        if (!$course) {
            return back()->with('error', __('Something went wrong!'));
        }

        return redirect()->route('courses.index')->with('success', __('Update successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->course->delete($id);
        
        return redirect()->back()->with('success', __('Delete successfully!'));
    }

    public function addTraineeIntoCourse(Request $request) 
    {
        $result = $this->trainee->addCourse($request->input('trainee_id'), $request->input('course_id'));
        if (!$result) {
            return back()->with('error', __('Add trainee false!'));
        }

        return redirect()->back()->with('success', __('Add Trainee successfully!'));
    }

    public function removeTraineeFromCourse($id)
    {
        $result = $this->trainee->removeTraineeFromCourse($id);
        if (!$result) {
            return back()->with('error', __('Remove trainee from course false!'));
        }

        return redirect()->back()->with('success', __('Remove trainee from course successfully!'));
    }
}
