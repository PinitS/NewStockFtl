<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GroupPartsSeeder extends Seeder
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
                'name' => 'Seed 1',
                'cost' => '5',
                'unit_parts_id' => '1',
            ],
            [
                'name' => 'Seed 2',
                'cost' => '10',
                'unit_parts_id' => '2',
            ],
            [
                'name' => 'Seed 3',
                'cost' => '15',
                'unit_parts_id' => '3',
            ],
            [
                'name' => 'Seed 4',
                'cost' => '20',
                'unit_parts_id' => '4',
            ],
        ];

        \App\Models\GroupParts::insert($data);
        //
    }
}
