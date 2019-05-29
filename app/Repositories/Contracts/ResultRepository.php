<?php

namespace App\Repositories\Contracts;

use App\Repositories\ResultRepositoryInterface;
use App\Repositories\Contracts\BaseRepository;
use App\Models\Result;
use App\Models\Test;
use App\Models\Trainee;

class ResultRepository extends BaseRepository implements ResultRepositoryInterface
{
    protected $test, $trainee;
    /**
     * Create a new Repository instance.
     *
     * @param  ResultRepositoryInterface
     * @return void
     */
    public function __construct(Result $model, Test $test, Trainee $trainee)
    {
        parent::__construct($model);
        $this->test = $test;
        $this->trainee = $trainee;
    }

    public function getResult()
    {
        $trainee = auth()->user()->trainee;
        $result = $trainee->result;
        if (is_null($result)) {
            $list_test = $this->test->where('trainee_id', $trainee->id)->get();
            $test_array = array();
            foreach ($list_test as $test) {
                $test_array[$test->name] = $test->mark;
            }
            $not_test = $trainee->course->schedule->phases->where('test_or_not', 0);
            foreach ($not_test as $test) {
                $test_array[$test->name] = '';
            }
            $results = json_encode($test_array);
            $result = $this->model->create([
                'result' => $results,
                'comment' => config('constants.constants.default_value'),
                'trainee_id' => $trainee->id,
            ]);

            return $test_array;
        } else {
            return json_decode($result->result, true);
        }
    }

    public function getTraineeResult($id)
    {
        $trainee = $this->trainee->findOrFail($id);
        $result = $trainee->result;
        if (is_null($result)) {
            $list_test = $this->test->where('trainee_id', $trainee->id)->get();
            $phase_have_test = array();
            $phase_have_no_test = array();
            foreach ($list_test as $test) {
                $phase_have_test[$test->name] = $test->mark;
            }

            $not_tests = $trainee->course->schedule->phases->where('test_or_not', 0);
            foreach ($not_tests as $not_test) {
                $name = str_replace(' ', '_', $not_test->name);
                $phase_have_no_test[$name] = '';
            }
            $phase_have_test = json_encode($phase_have_test);
            $phase_have_no_test = json_encode($phase_have_no_test);
            $result = $this->model->create([
                'result' => $phase_have_test . '|' . $phase_have_no_test,
                'comment' => config('constants.constants.default_value'),
                'trainee_id' => $trainee->id,
            ]);
            $phase_have_test = json_decode($phase_have_test, true);
            $phase_have_no_test = json_decode($phase_have_no_test, true);

            return array($phase_have_test, $phase_have_no_test);
        } else {
            $result = explode('|', $result->result);
            $phase_have_test = json_decode($result[0], true);
            $phase_have_no_test = json_decode($result[1], true);

            return array($phase_have_test, $phase_have_no_test);
        }
    }

    public function update($data, $id)
    {
        unset($data['_token'], $data['_method']);

        $trainee = $this->trainee->findOrFail($id);
        $this_result = $trainee->result;
        $result = explode('|', $this_result->result);
        $phase_have_test = json_decode($result[0], true);
        $phase_have_no_test = json_decode($result[1], true);
        $phase_have_no_test = array_merge($phase_have_no_test, $data);
        $phase_have_test = json_encode($phase_have_test);
        $phase_have_no_test = json_encode($phase_have_no_test);
        $this_result->update([
            'result' => $phase_have_test . '|' . $phase_have_no_test,
        ]);
        $phase_have_test = json_decode($phase_have_test, true);
        $phase_have_no_test = json_decode($phase_have_no_test, true);

        return array($phase_have_test, $phase_have_no_test);
    }
}
