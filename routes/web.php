<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home')->middleware('admin')->middleware('can:see-trainees');

Route::post('mark_as_read', 'TestController@markAsRead');

Route::group(['prefix' => 'admin','middleware' => 'can:access-admin'], function () {
    Route::get('/', 'AdminController@index')->name('dashboard');
    //trainer
    Route::resource('trainers', 'TrainerController')->middleware('can:see-admin');
    //trainee
    Route::resource('trainees', 'TraineeController');
    //phase
    Route::resource('phases', 'PhaseController');
    //schedule
    Route::resource('schedules', 'ScheduleController');
    Route::get('trainee_schedule/{trainee_id}/{course_id}', 'ScheduleController@getTraineeSchedule')->name('schedules.trainee_schedule');
    //course
    Route::resource('courses', 'CourseController');
    Route::post('addTraineeIntoCourse', 'CourseController@addTraineeIntoCourse')->name('courses.add_trainee_into_course');
    Route::post('removeTraineeFromCourse/{id}', 'CourseController@removeTraineeFromCourse')->name('courses.remove_trainee_from_course');
    //test
    Route::resource('tests', 'TestController');
    //profile
    Route::get('profile/{id}', 'UserController@showChangePasswordForm')->name('trainers.profile');
    Route::post('profile/{id}', 'UserController@changePassword')->name('trainers.update_profile');
    Route::resource('results', 'ResultController');


});

Route::get('/trainee_schedule', 'TraineeController@getSchedule')->name('trainee.trainee_schedule')->middleware('admin')->middleware('can:see-trainees');
Route::put('updateContent/{id}', 'TestController@updateContent')->name('tests.update_content')->middleware('admin')->middleware('can:see-trainees');
Route::get('show-test', 'TraineeController@showTest')->name('trainees.show_test')->middleware('admin')->middleware('can:see-trainees');

Route::get('profile/{id}', 'UserController@showChangePasswordForm')->name('trainees.profile')->middleware('admin')->middleware('can:see-trainees');
Route::post('profile/{id}', 'UserController@changePassword')->name('trainees.update_profile')->middleware('admin')->middleware('can:see-trainees');
Route::get('trainee_result', 'ResultController@getResult')->name('trainee.trainee_result')->middleware('admin')->middleware('can:see-trainees');
