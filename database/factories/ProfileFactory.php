<?php

class ProfileFactory extends \Illuminate\Database\Eloquent\Factories\Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {

    $id_number =  $this->faker->idNumber;
    return [
        'avatar' => 'media/users/blank.png',
        'id_number' => $id_number,
        'first_name' => $this->faker->firstName,
        'last_name' => $this->faker->lastName,
        'gender' => $this->faker->randomElement(['M','F']),
        'date_of_birth' => $this->faker->date('Y-m-d', Carbon::now()->subDecade()),
        'cell_number' => $this->faker->mobileNumber,
        'address' => $this->faker->streetAddress,
        'city' => $this->faker->city,
        'province' => $this->faker->state,
        'postal_code' => $this->faker->postcode,
        'profile_completed_at' => Carbon::now(),
        'cell_number_verified_at' => now()
    ];


    }
}
