<?php
namespace Database\Factories;

use App\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory{

    protected $model = Status::class;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {

    $statuses = [
        //Event Statuses
        ['title' => 'Active', 'color' => 'primary', 'model_type' => 'App\Event'], //1
        ['title' => 'Cancelled', 'color' => 'danger', 'model_type' => 'App\Event'], //2
        ['title' => 'Closed', 'color' => 'dark', 'model_type' => 'App\Event'], //3
        ['title' => 'Deleted', 'color' => 'danger', 'model_type' => 'App\Event'], //4
        ['title' => 'Postponed', 'color' => 'info', 'model_type' => 'App\Event'], //5
        ['title' => 'Published', 'color' => 'success', 'model_type' => 'App\Event'],//6
        ['title' => 'Unpublished', 'color' => 'light', 'model_type' => 'App\Event'],//7

        //Event Date Statuses
        ['title' => 'Active', 'color' => 'success', 'model_type' => 'App\EventDate'],//8
        ['title' => 'Full', 'color' => 'danger', 'model_type' => 'App\EventDate'],//9
        ['title' => 'Unpublished', 'color' => 'light', 'model_type' => 'App\EventDate'],//10

        //Appointment Statuses
        ['title' => 'Active', 'color' => 'primary', 'model_type' => 'App\Appointment'],//11
        ['title' => 'Cancelled', 'color' => 'danger', 'model_type' => 'App\Appointment'],//12
        ['title' => 'Confirmed', 'color' => 'success', 'model_type' => 'App\Appointment'],//13
        ['title' => 'Deleted', 'color' => 'danger', 'model_type' => 'App\Appointment'],//14
        ['title' => 'Pending', 'color' => 'warning', 'model_type' => 'App\Appointment'],//15
        ['title' => 'Postponed', 'color' => 'info', 'model_type' => 'App\Appointment'],//16

        //Item Statuses
        ['title' => 'Published', 'color' => 'success', 'model_type' => 'App\Item'],//17
        ['title' => 'Unpublished', 'color' => 'light', 'model_type' => 'App\Item'],//18
        //Invoice Statuses
        ['title' => 'On Hold', 'color' => 'warning', 'model_type' => 'App\Invoice'],//19
        ['title' => 'Paid', 'color' => 'success', 'model_type' => 'App\Invoice'],//20
        ['title' => 'Pending', 'color' => 'warning', 'model_type' => 'App\Invoice'],//21
        ['title' => 'Processing', 'color' => 'secondary', 'model_type' => 'App\Invoice'],//22

        //Comment Statuses
        ['title' => 'Blocked', 'color' => 'danger', 'model_type' => 'App\Comment'],//23
        ['title' => 'Deleted', 'color' => 'danger', 'model_type' => 'App\Comment'],//24
        ['title' => 'Published', 'color' => 'success', 'model_type' => 'App\Comment'],//25
        ['title' => 'Unpublished', 'color' => 'light', 'model_type' => 'App\Comment'],//26

        //Family Appointment Statuses
        ['title' => 'Cancelled', 'color' => 'danger', 'model_type' => 'App\FamilyAppointment'], //27
        ['title' => 'Confirmed', 'color' => 'success', 'model_type' => 'App\FamilyAppointment'], //28
        ['title' => 'Deleted', 'color' => 'danger', 'model_type' => 'App\FamilyAppointment'], //29
        ['title' => 'Pending', 'color' => 'warning', 'model_type' => 'App\FamilyAppointment'], //30
        ['title' => 'Postponed', 'color' => 'info', 'model_type' => 'App\FamilyAppointment'], //31

    ];

    static $count = 0;
    $status = $statuses[$count++];

    return [
        'title' => $status['title'],
        'description' => $this->faker->realText(),
        'model_type' => $status['model_type'],
        'is_active' => true,
        'color' => $status['color']
    ];


    }
}
