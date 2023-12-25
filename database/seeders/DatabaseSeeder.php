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
        $this->call(CategoryTableSeeder::class);
        $this->call(UnitTableSeeder::class);
        $this->call(TypeTableSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(MedicineSeeder::class);
    }
}
