<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $usersData = [
            [
               'name'   =>'Admin',
               'email'  =>'admin@example.com',
               'is_admin' => 1,
               'password' => Hash::make('12345678')
            ],
            [
               'name'       => 'Stuff',
               'email'      => 'stuff@example.com',
               'is_admin'   => 0,
               'password'   => Hash::make('12345678')
            ],
        ];
        foreach ($usersData as $key => $val) {
            User::create($val);
        }
    }
}
