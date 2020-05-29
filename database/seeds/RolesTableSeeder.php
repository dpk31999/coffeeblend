<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Admin;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'author']);


        $superAdmin = Role::where('name','superadmin')->first();
        $admin = Admin::find(1);

        $admin->role()->attach($superAdmin);
    }
}
