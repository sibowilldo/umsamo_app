<?php

namespace Database\Factories;
use App\Status;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'user_id' => factory(User::class),
            'status_id' => factory(Status::class),
            'amount' => $this->faker->randomFloat(2, 0, 99999999999.99),
            'discount' => $this->faker->randomFloat(2, 0, 99999999999.99),
            'notes' =>  $this->faker->realText(),
        ];


    }
}
