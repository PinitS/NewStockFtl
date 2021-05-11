<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
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
                'name' => 'บาท',
            ],
            [
                'name' => 'ขวด',
            ],
            [
                'name' => 'เส้น',
            ],
            [
                'name' => 'ถุง',
            ],

        ];

        \App\Models\UnitParts::insert($data);
    }
}
