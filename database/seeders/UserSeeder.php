<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->full_name = 'John Doe';
        $user->preferred_name = 'John';
        $user->email = 'admin@gmail.com';
        $user->mobile_number = '1234567890';
        $user->email_verified_at = now();
        $user->account_verified_at = now();
        $user->password = bcrypt('password');
        $user->date_of_birth = '1990-01-01';
        $user->gender = 'male';
        $user->date_of_joining = '2020-01-01';
        $user->date_of_leaving = '2021-01-01';
        $user->function = 'Developer';
        $user->save();

        $role = new Role();
        $role->name = 'super_admin';
        $role->save();

        $user->roles()->attach($role->id);
    }
}
