<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('12345678'),
                'status' => 1,
                'active' => 1,
            ],
//            [
//                'name' => 'member',
//                'email' => 'member@member.com',
//                'password' => Hash::make('12345678'),
//                'status' => 0,
//                'active' => 0,
//            ],
//            [
//                'name' => 'IsaraK',
//                'email' => 'dotsockettest01@gmail.com',
//                'password' => Hash::make('dotsockettest01'),
//                'status' => 1,
//                'active' => 1,
//            ]
        ];

        \App\Models\User::insert($data);
    }
}
