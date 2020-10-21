<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                'name' => 'Resistor',
                'stock_branch_id' => 1
            ]
            ,
            [
                'name' => 'Capacitor',
                'stock_branch_id' => 1
            ]
            ,
            [
                'name' => 'Diode',
                'stock_branch_id' => 1
            ],
            [
                'name' => 'Transistor',
                'stock_branch_id' => 2
            ]
            ,
            [
                'name' => 'Display',
                'stock_branch_id' => 2
            ]
            ,

        ];
        \App\Models\StockCategory::insert($data);

    }
}
