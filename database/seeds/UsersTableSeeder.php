<?php

use Illuminate\Database\Seeder;
use App\Employer;
use App\Employee;
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
        for ($i = 0; $i < 10; $i++)
        {
            $employer           = new Employer();
            $employer->name     = 'Fatdonalds' . $i;
            $employer->email    = 'fatdonalds' . $i . '@fat.donalds';
            $employer->password = bcrypt('qwerty');
            $employer->status   = true;
            $employer->save();
        }

        for ($i = 0; $i < 100; $i++)
        {
            $employee           = new Employee();
            $employee->employer_id = rand(1, 10);
            $employee->name     = 'john' . $i;
            $employee->password = '0000';
            $employee->status   = rand(0, 1);
            $employee->save();
        }
        
        $admin           = new Admin();
        $admin->name     = 'Martin';
        $admin->password = bcrypt('qwerty');
        $admin->save();
    }

}
