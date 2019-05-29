<?php

namespace App\Http\Controllers;

use App\Repositories\ResultRepositoryInterface;
use App\Repositories\TestRepositoryInterface;
use App\Repositories\TraineeRepositoryInterface;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    protected $trainee, $test, $result;

    public function __construct(TraineeRepositoryInterface $trainee, TestRepositoryInterface $test, ResultRepositoryInterface $result)
    {
        $this->trainee = $trainee;
        $this->test = $test;
        $this->result = $result;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trainee = $this->trainee->get([], $id);
        $result = $this->result->getTraineeResult($id);
        $have_tests = $result[0];
        $not_tests = $result[1];

        return view('admin.results.edit', compact('have_tests', 'not_tests', 'trainee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $trainee = $this->trainee->get([], $id);
        $result = $this->result->update($request->all(), $id);
        $have_tests = $result[0];
        $not_tests = $result[1];

        return view('admin.results.edit', compact('have_tests', 'not_tests', 'trainee'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getResult()
    {
        $id = auth()->user()->trainee->id;
        $result = $this->result->getTraineeResult($id);
        $have_tests = $result[0];
        $not_tests = $result[1];

        return view('trainee.trainee_result', compact('result', 'have_tests', 'not_tests'));
    }
}
