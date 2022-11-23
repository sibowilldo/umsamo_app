<?php

class PinCodeFactory extends \Illuminate\Database\Eloquent\Factories\Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {
    return [
        'user_id' => \App\User::factory(1),
        'code' => $this->faker->word,
        'expires_at' => $this->faker->dateTime(),
        'is_active' => $this->faker->boolean,
    ];


    }
}
