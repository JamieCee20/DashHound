<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate table, empty table fill with what we need
        Role::truncate();

        Role::create(['name' => 'owner']);
        Role::create(['name' => 'administrator']);
        Role::create(['name' => 'moderator']);
        Role::create(['name' => 'verified']);
        Role::create(['name' => 'user']);
    }
}
