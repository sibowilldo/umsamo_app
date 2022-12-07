<?php
namespace Database\Factories;

use App\Appointment;
use App\EventDate;
use App\Region;
use App\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition()
    {
        // TODO: Implement definition() method.
        $event_dates = EventDate::pluck('id');
        $statuses = Status::where('model_type', 'App\Appointment')->pluck('id');
        $regions = Region::pluck('id');


        return [
            'uuid' => $this->faker->uuid,
            'reference' => Str::upper($this->faker->randomElement(['FAM-', 'SLF-']) . sprintf('%03d', rand(000, 999)) . '-'. Str::random(4)),
            'event_date_id' => $this->faker->randomElement($event_dates),
            'status_id' => $this->faker->randomElement($statuses),
            'type' => $this->faker->randomElement([1,2]),
            'with_family' => $this->faker->boolean(0),
            'region_id' => $this->faker->randomElement($regions),
        ];
    }
}
