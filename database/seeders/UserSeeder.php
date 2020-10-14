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
                    ],

                    [
                        'name' => 'member1',
                        'email' => 'member1@member.com',
                        'password' => Hash::make('12345678'),
                        'status' => 0,
                    ]
                ];

        \App\Models\User::insert($data);
    }
}
