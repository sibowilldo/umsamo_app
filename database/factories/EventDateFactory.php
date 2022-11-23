<?php

class EventDateFactory extends \Illuminate\Database\Eloquent\Factories\Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {
    $statuses = App\Status::where('model_type', 'App\EventDate')->pluck('id');
    $events = App\Event::pluck('id');

    return [
        'event_id' => $events[rand(0, count($events)-1)],
        'status_id' => $statuses[rand(0, count($statuses)-1)],
        'date_time' => date('Y-m-d', strtotime('now +' . $this->faker->unique()->numberBetween(1, 15) . ' days')),
        'limit' => $this->faker->numberBetween(10,50),
    ];


    }
}
