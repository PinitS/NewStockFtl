<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
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
                'name' => 'CustomerSeeder',
                'phone_number' => '999999',
                'latitude' => '58.8160254',
                'longitude' => '18.982099',
                'address' => 'Seeder',
            ],
        ];

        \App\Models\Location::insert($data);
        //
    }
}
