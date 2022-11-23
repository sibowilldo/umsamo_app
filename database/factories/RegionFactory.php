<?php

class RegionFactory extends \Illuminate\Database\Eloquent\Factories\Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

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
