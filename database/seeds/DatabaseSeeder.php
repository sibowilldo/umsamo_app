<?php

use App\Appointment;
use App\Comment;
use App\Event;
use App\EventDate;
use App\Item;
use App\Profile;
use App\Region;
use App\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Seed Roles and Permissions
        $this->call(PermissionsSeeder::class);

        //Statuses
        Status::factory(31)->create();

        //Profile & User
//        factory(App\Profile::class, 15)->create();

        //Items
        Item::factory(5)->create();

        //Events & Regions
        Region::factory(3)->create();

        //Assign users to roles
        User::factory( 700)->create()->each(function ($user){
            $user->profile()->save(Profile::factory(1)->make());
            $user->assignRole('client');
        });


        $faker = Faker\Factory::create();

        $admin = User::create([
            'uuid' => $faker->uuid,
            'email' => 'sibongiseni.msomis@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('&9I2ii5A6Oo&9'),// '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $admin->assignRole('administrator');
        $admin->profile()->create([
            'avatar' => 'media/users/blank.png',
            'id_number' => '8912115460089',
            'first_name' => 'Sibongiseni',
            'last_name' => 'Msomi',
            'gender' => $faker->randomElement(['M','F']),
            'date_of_birth' => $faker->date('Y-m-d', Carbon::now()->subDecade()),
            'cell_number' => '(081) 589-2345',
            'address' => '176 Blamey Rd, Montclair',
            'city' => 'Durban',
            'province' => 'KwaZulu-Natal',
            'postal_code' => '4001',
            'profile_completed_at' => null,
            'cell_number_verified_at' => now()
        ]);

        $kingpin = User::create([
            'uuid' => $faker->uuid,
            'email' => 'sibongiseni.msomi@outlook.com',
            'email_verified_at' => now(),
            'password' => Hash::make('&9I2ii5A6Oo&9'),// '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $kingpin->assignRole('kingpin');
        $kingpin->profile()->create([
            'avatar' => 'media/users/blank.png',
            'id_number' => '7508048081082',
            'first_name' => 'Sibongiseni',
            'last_name' => 'de Kingpin',
            'gender' => 'M',
            'date_of_birth' => $faker->date('Y-m-d', Carbon::now()->subDecade()),
            'cell_number' => '(071) 898-8006',
            'address' => '176 Blamey Rd, Montclair',
            'city' => 'Durban',
            'province' => 'KwaZulu-Natal',
            'postal_code' => '4001',
            'profile_completed_at' => Carbon::now(),
            'cell_number_verified_at' => now()
        ]);


        Region::all()->each(fn($region) => $region->events()->attach(Event::factory(4)->create()));

        //Event Dates
        EventDate::factory(15)->create();


        /**
         * Create 100 Appointments and attach a random number of Attachments between 0-3, then assignment those
         * Appointments to a variable for later use.
         */
        User::all()->each(fn($user) => $user->appointments()->save(Appointment::factory(1)->make()));

        /**
         * Create 100 Appointments and attach a random number of Attachments between 0-3, then assignment those
         * Appointments to a variable for later use.
         */
//        Appointment::all()->each(function ($appointment){
//                $appointment->attachments()->saveMany(factory(Attachment::class,rand(0,3) )->make());
//            });


        //Attachments Meta
//        Attachment::all()->each(function ($attachment){
//                $attachment->attachment_meta()->save(factory(App\AttachmentMeta::class)->make());
//        });

        //Comments
        Comment::factory(500)->create();

    }
}
