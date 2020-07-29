<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();
        DB::table('role_user')->truncate();

        $ownerRole = Role::where('name', 'owner')->first();
        $adminRole = Role::where('name', 'administrator')->first();
        $moderatorRole = Role::where('name', 'moderator')->first();
        $verifiedRole = Role::where('name', 'verified')->first();
        $userRole = Role::where('name', 'user')->first();

        $owner = User::create([
            'name' => 'Jamie Collins',
            'email' => 'test@test.com',
            'username' => 'jamiecee20',
            'image' => 'no-image-available.png',
            'bio' => '',
            'password' => Hash::make('123456789')
        ]);
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'username' => 'administrator',
            'image' => 'no-image-available.png',
            'bio' => '',
            'password' => Hash::make('123456789')
        ]);
        $moderator = User::create([
            'name' => 'Moderator User',
            'email' => 'moderator@test.com',
            'username' => 'moderator',
            'image' => 'no-image-available.png',
            'bio' => '',
            'password' => Hash::make('123456789')
        ]);
        $verified = User::create([
            'name' => 'Verified User',
            'email' => 'verified@test.com',
            'username' => 'Bethesda',
            'image' => 'no-image-available.png',
            'bio' => '',
            'password' => Hash::make('123456789')
        ]);
        $user = User::create([
            'name' => 'Generic User',
            'email' => 'user@test.com',
            'username' => 'basicUser',
            'image' => 'no-image-available.png',
            'bio' => '',
            'password' => Hash::make('123456789')
        ]);

        $owner->roles()->attach($ownerRole);
        $admin->roles()->attach($adminRole);
        $moderator->roles()->attach($moderatorRole);
        $verified->roles()->attach($verifiedRole);
        $user->roles()->attach($userRole);
    }
}
