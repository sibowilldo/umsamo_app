<?php
namespace Database\Factories;

use App\Item;
use App\Status;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {
    $items = Item::pluck('id');
    $statuses = Status::where('model_type', 'App\Event')->pluck('id');

    return [
        'uuid' => $this->faker->uuid,
        'status_id' => $statuses[rand(0, count($statuses)-1)],
        'item_id' => $items[rand(0, count($items)-1)],
        'title' => sprintf('%s of %s',$this->faker->dayOfWeek, $this->faker->monthName),
        'description' => $this->faker->realText(),
    ];


    }
}
