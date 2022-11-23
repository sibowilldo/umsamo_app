<?php

class InvoiceFactory extends \Illuminate\Database\Eloquent\Factories\Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'user_id' => factory(\App\User::class),
            'status_id' => factory(\App\Status::class),
            'amount' => $this->faker->randomFloat(2, 0, 99999999999.99),
            'discount' => $this->faker->randomFloat(2, 0, 99999999999.99),
            'notes' =>  $this->faker->realText(),
        ];


    }
}
