<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
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
                'name' => 'FARMTHAILAND (Chiang Mai)',
                'phone_number' => '0840499115',
                'latitude' => '18.816220',
                'longitude' => '98.982099',
                'address' => '47 79 ถนน โชตนา ตำบลช้างเผือก อำเภอเมืองเชียงใหม่ เชียงใหม่ 50300',
            ],
            [
                'name' => 'FARMTHAILAND (Pathum thani)',
                'phone_number' => '0979624288',
                'latitude' => '14.060185',
                'longitude' => '100.566241',
                'address' => '70 13 หมู่ 5 ถนน ชาวเหนือ ตำบล เชียงรากใหญ่ อำเภอสามโคก ปทุมธานี 12160',
            ],
        ];

        \App\Models\StockBranch::insert($data);
        //
    }
}
