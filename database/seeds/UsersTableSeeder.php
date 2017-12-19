<?php

use Illuminate\Database\Seeder;
use App\Employer;
use App\Employee;
use App\Admin;
use App\Status;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin                 = new Admin();
        $admin->name           = 'Martin';
        $admin->password       = bcrypt('qwerty');
        $admin->remember_token = 'qwertyuiopasdfghjkl';
        $admin->save();

        $adminsLimit = rand(2, 3);
        $iterator    = 1;
        for ($i = 1; $i < $adminsLimit; $i++)
        {
            $admin2                 = new Admin();
            $admin2->name           = 'admin' . $i;
            $admin2->password       = bcrypt('qwerty');
            $admin2->remember_token = 'qazwsxedcrfvtgbyhn' . $i;
            $admin2->save();
        }

        $employersLimit = 80;
        for ($i = 1; $i < $employersLimit; $i++)
        {
            $employer             = new Employer();
            $employer->name       = 'Fatdonalds' . $i;
            $employer->email      = 'fatdonalds' . $i . '@fat.donalds';
            $employer->password   = bcrypt('qwerty');
            $employer->last_login = date('Y-m-d H:i:s', time());
            $employer->remember_token = 'qaklsjlkjlkjlkdjl' . $i;
            $employer->save();
            
            $status         = new Status();
            $status->active = true;
            $employer->status()->save($status);

            $admins = Admin::all();
            foreach ($admins as $admin)
            {
                $employer->admins()->attach($admin);
            }

            $employeesLimit = rand(4, rand(5, rand(6, rand(7, 16))));
            for ($j = 1; $j < $employeesLimit; $j++)
            {
                $employee              = new Employee();
                $employee->employer_id = $i;
                $employee->name        = 'john' . $iterator;
                $employee->password    = '0000';
                $employee->save();

                $status         = new Status();
                $status->active = rand(rand(rand(rand(0, 1), 1), 1), 1);
                $employee->status()->save($status);

                $iterator++;
            }
        }
    }

}
