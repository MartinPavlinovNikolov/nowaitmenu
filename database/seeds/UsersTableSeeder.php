<?php

use Illuminate\Database\Seeder;
use App\Employer;
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
        $employer           = new Employer();
        $employer->name     = 'Fatdonalds';
        $employer->email    = 'fatdonalds@fat.donalds';
        $employer->password = bcrypt('qwerty');
        $employer->save();

        $admin           = new Admin();
        $admin->name     = 'Martin';
        $admin->email    = 'martinpavlinovnikolov@gmail.com';
        $admin->password = bcrypt('qwerty');
        $admin->save();
    }

}
