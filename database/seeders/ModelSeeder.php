<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModelSeeder extends Seeder
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
                'name' => 'IOT_Seeder',
            ],
            [
                'name' => 'BOX_Seeder',
            ],
        ];

        \App\Models\LocationModel::insert($data);
        //
    }
}
