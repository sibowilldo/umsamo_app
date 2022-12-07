<?php

namespace Database\Factories;
use App\Appointment;
use App\Status;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {

    $users = User::pluck('id')->toArray();
    $statuses = Status::where('model_type', 'App\Comment')->pluck('id');
    $appointments = Appointment::pluck('id');

    return [
        'user_id' => $users[rand(0, count($users)-1)],
        'status_id' => $statuses[rand(0, count($statuses)-1)],
        'appointment_id' => $appointments[rand(0, count($appointments)-1)],
        'body' =>  $this->faker->realText(),
    ];

    }
}
