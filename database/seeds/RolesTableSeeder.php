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
        
        $admin = Admin::create([
            'name' => 'Huynh Dong',
            'username' => 'huynhdong123',
            'password' => Hash::make('password'),
            'email' => 'd0129530646@gmail.com',
        ]);

        $admin->role()->attach($superAdmin);
    }
}
