<?php


class EventFactory extends \Illuminate\Database\Eloquent\Factories\Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {
    $items = App\Item::pluck('id');
    $statuses = App\Status::where('model_type', 'App\Event')->pluck('id');

    return [
        'uuid' => $this->faker->uuid,
        'status_id' => $statuses[rand(0, count($statuses)-1)],
        'item_id' => $items[rand(0, count($items)-1)],
        'title' => "$this->faker->dayOfWeek of $this->faker->monthName",
        'description' => $this->faker->realText(),
    ];


    }
}
