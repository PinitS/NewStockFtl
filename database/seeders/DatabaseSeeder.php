<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(LocationSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UnitSeeder::class);
//        $this->call(CategorySeeder::class);
//        $this->call(BranchSeeder::class);
        $this->call(ModelSeeder::class);
        $this->call(GroupPartsSeeder::class);

    }
}
