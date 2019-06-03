<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use App\Repositories\TestRepositoryInterface;
use App\Repositories\Contracts\BaseRepository;
use App\Models\Test;
use App\Notifications\Test as TestNoti;
use App\Notifications\TestResult;
use App\Models\Trainee;
use App\Models\Trainer;

class TestRepository extends BaseRepository implements TestRepositoryInterface
{
    protected $trainer, $trainee;
    /**
     * Create a new Repository instance.
     *
     * @param  TestRepositoryInterface
     * @return void
     */
    public function __construct(Test $model, Trainer $trainer, Trainee $trainee)
    {
        parent::__construct($model);
        $this->trainee = $trainee;
        $this->trainer = $trainer;
    }

    public function all($relation = [])
    {
        return $this->model->with($relation)->where('status', '<>', config('constants.new'))->get();
    }

    public function updateContent($data, $id)
    {
        $model = $this->get([], $id);
        if ($model->status == config('constants.new')) {
            $data['status'] = config('constants.resolved');
        } elseif ($model->status == config('constants.not_achieved')) {
            $data['status'] = config('constants.resend');
        }
        $trainee = $this->trainee->findOrFail($data['trainee_id']);
        $notification_data = $data;
        $notification_data['trainee_id'] = $id;
        $notification_data['title'] = config('constants.notification.test');
        $trainee->trainer->notify(new TestNoti($notification_data));

        return $model->update($data);
    }

    public function update($data, $id)
    {
        $model = $this->get([], $id);
        $trainee = $this->trainee->findOrFail($model->trainee_id);
        $notification_data = $data;
        $notification_data['trainer_id'] = auth()->user()->trainer;
        $notification_data['title'] = config('constants.notification.test_result');
        $trainee->notify(new TestResult($notification_data));

        return $model->update($data);
    }

    public function markAsRead($data)
    {
        if (auth()->user()->trainee) {
            $user = auth()->user()->trainee;
            $user->unreadNotifications->markAsRead();

            return true;
        } elseif (auth()->user()->trainer) {
            $user = auth()->user()->trainer;
            $user->unreadNotifications->markAsRead();

            return true;
        } else {
            return false;
        }
    }

}
