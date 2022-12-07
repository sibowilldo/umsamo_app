<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PinCodeFactory extends Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {
    return [
        'user_id' => User::factory(1),
        'code' => $this->faker->word,
        'expires_at' => $this->faker->dateTime(),
        'is_active' => $this->faker->boolean,
    ];


    }
}
