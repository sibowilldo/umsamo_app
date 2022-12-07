<?php

namespace Database\Factories;

use App\Event;
use App\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventDateFactory extends Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {
    $statuses = Status::where('model_type', 'App\EventDate')->pluck('id');
    $events = Event::pluck('id');

    return [
        'event_id' => $events[rand(0, count($events)-1)],
        'status_id' => $statuses[rand(0, count($statuses)-1)],
        'date_time' => date('Y-m-d', strtotime('now +' . $this->faker->unique()->numberBetween(1, 15) . ' days')),
        'limit' => $this->faker->numberBetween(10,50),
    ];


    }
}
