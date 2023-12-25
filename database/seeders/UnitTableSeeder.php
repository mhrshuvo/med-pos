<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    public function run()
    {
        Unit::create([
            'name' => 'ml'
        ]);

        Unit::create([
            'name' => 'mg'
        ]);

        Unit::create([
            'name' => 'pc'
        ]);
    }
}
