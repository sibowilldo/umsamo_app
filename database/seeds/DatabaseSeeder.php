<?php

use App\Appointment;
use App\Attachment;
use App\Region;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker as Faker;
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
        factory(App\Status::class, 31)->create();

        //Profile & User
//        factory(App\Profile::class, 15)->create();

        //Items
        factory(App\Item::class, 5)->create();

        //Events & Regions
        factory(App\Region::class, 3)->create();

        //Assign users to roles
        factory(App\User::class, 700)->create()->each(function ($user){

            $user->assignRole('client');
            $user->profile()->save(factory(App\Profile::class)->make());
        });


        $faker = Faker\Factory::create();

        $admin = \App\User::create([
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

        $kingpin = \App\User::create([
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

        Region::all()->each(function ($region) {
            $region->events()->attach(factory(App\Event::class, 4)->create());
        });
        //Event Dates
        factory(App\EventDate::class, 15)->create();


        /**
         * Create 100 Appointments and attach a random number of Attachments between 0-3, then assignment those
         * Appointments to a variable for later use.
         */
        \App\User::all()->each(function ($user){
                $user->appointments()->save(factory(App\Appointment::class)->make());
            });

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
        factory(App\Comment::class, 500)->create();

    }
}
