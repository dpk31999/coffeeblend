<?php

use Illuminate\Database\Seeder;
use App\Admin;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Huynh Dong',
            'username' => 'huynhdong123',
            'password' => Hash::make('password'),
            'email' => 'd0129530646@gmail.com',
        ]);

        // $superAdmin = Role::where('name','superadmin')->first();

        // $admin->role()->attach($superAdmin);
    }
}
