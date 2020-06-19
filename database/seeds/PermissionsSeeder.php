<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guest = Role::create(['name' => 'guest']);
        $client = Role::create(['name' => 'client']);
        $administrator = Role::create(['name' => 'administrator']);
        $kingpin = Role::create(['name' => 'kingpin']);

        $this->attachmentPermissions();
        $this->eventPermissions();
        $this->commentPermissions();
        $this->profilePermissions();
        $this->appointmentPermissions();

        $client->givePermissionTo([
            'create profile', 'edit profile', 'delete profile', 'create appointment', 'edit appointment',
            'cancel appointment', 'delete appointment', 'create comment', 'edit comment', 'delete comment',
            'create attachment', 'edit attachment', 'delete attachment']);

        $administrator->givePermissionTo([
            'create profile', 'edit profile', 'delete profile', 'create appointment', 'edit appointment',
            'create event', 'edit event', 'publish event', 'unpublish event', 'delete event',
            'cancel appointment', 'delete appointment', 'create comment', 'edit comment',
            'publish comment', 'unpublish comment', 'delete comment',
            'create attachment', 'edit attachment','publish attachment', 'unpublish attachment', 'delete attachment']);

    }

    private function profilePermissions()
    {
        Permission::create(['name' => 'create profile']);
        Permission::create(['name' => 'edit profile']);
        Permission::create(['name' => 'delete profile']);
    }

    private function eventPermissions()
    {
        Permission::create(['name' => 'create event']);
        Permission::create(['name' => 'edit event']);
        Permission::create(['name' => 'publish event']);
        Permission::create(['name' => 'unpublish event']);
        Permission::create(['name' => 'delete event']);
    }

    private function appointmentPermissions()
    {
        Permission::create(['name' => 'create appointment']);
        Permission::create(['name' => 'edit appointment']);
        Permission::create(['name' => 'cancel appointment']);
        Permission::create(['name' => 'delete appointment']);
    }

    private function commentPermissions()
    {
        Permission::create(['name' => 'create comment']);
        Permission::create(['name' => 'edit comment']);
        Permission::create(['name' => 'publish comment']);
        Permission::create(['name' => 'unpublish comment']);
        Permission::create(['name' => 'delete comment']);
    }

    private function attachmentPermissions()
    {
        Permission::create(['name' => 'create attachment']);
        Permission::create(['name' => 'edit attachment']);
        Permission::create(['name' => 'publish attachment']);
        Permission::create(['name' => 'unpublish attachment']);
        Permission::create(['name' => 'delete attachment']);
    }
}
