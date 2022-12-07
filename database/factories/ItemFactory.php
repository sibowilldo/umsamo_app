<?php

namespace Database\Factories;

use App\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{

    protected $model = Item::class;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {
        $statuses = \App\Status::where('model_type', 'App\Item')->pluck('id');

        return [
            'status_id' => $statuses[rand(0, count($statuses)-1)],
            'name' => $this->faker->realText(10, 2),
            'description' => $this->faker->realText(),
            'price' => $this->faker->randomFloat(2, 100.00, 999.99),
            'featured' => $this->faker->boolean,
            'type_is' => $this->faker->realText(10),
            'category_is' => $this->faker->realText(10),
            'rate_is' => 14,
            'thumbnail' => $this->faker->imageUrl(),
        ];

    }
}
