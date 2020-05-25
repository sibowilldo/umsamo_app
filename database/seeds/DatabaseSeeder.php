<?php

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
        factory(App\Status::class, 21)->create();

        //Profile & User
        factory(App\Profile::class, 15)->create();

        //Items
        factory(App\Item::class, 5)->create();

        //Events & Regions
        factory(App\Region::class, 3)->create()->each(function ($region) {
            $region->events()->attach(factory(App\Event::class, 2)->create());
        });

        //Assign users to roles
        \App\User::all()->each(function ($user){
            $user->assignRole('client');
        });

        $faker = Faker\Factory::create();

        $admin = \App\User::create([
            'uuid' => $faker->uuid,
            'email' => 'msomis@gmail.co.za',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),// '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $admin->assignRole('administrator');
        $admin->profile()->create([
            'avatar' => $faker->imageUrl(300, 300),
            'first_name' => 'Sibongiseni',
            'last_name' => 'Msomi',
            'cell_number' => '(081) 589-2345',
            'address' => '176 Blamey Rd, Montclair',
            'city' => 'Durban',
            'province' => 'KwaZulu-Natal',
            'postal_code' => '4001',
            'profile_completed_at' => Carbon::now()
        ]);

        $kingpin = \App\User::create([
            'uuid' => $faker->uuid,
            'email' => 'sibongiseni.msomi@outlook.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),// '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $kingpin->assignRole('kingpin');
        $kingpin->profile()->create([
            'avatar' => $faker->imageUrl(300, 300),
            'first_name' => 'Sibongiseni',
            'last_name' => 'de Kingpin',
            'cell_number' => '(071) 898-8006',
            'address' => '176 Blamey Rd, Montclair',
            'city' => 'Durban',
            'province' => 'KwaZulu-Natal',
            'postal_code' => '4001',
            'profile_completed_at' => Carbon::now()
        ]);

        //Event Dates
        factory(App\EventDate::class, 15)->create();

        //Appointment
        factory(App\Appointment::class, 100)->create();

        //Comments
        factory(App\Comment::class, 10)->create();

        //Attachments
        factory(App\Attachment::class, 5)->create();

    }
}
