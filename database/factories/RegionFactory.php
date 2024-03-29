<?php

namespace Database\Factories;

use App\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Region::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'description' => $this->faker->realText(),
            'contact_number' => $this->faker->mobileNumber,
            'province' => $this->faker->state,
            'address' => $this->faker->streetAddress,
        ];
    }
}
