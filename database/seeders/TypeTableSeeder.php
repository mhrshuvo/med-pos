<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{

    public function run()
    {
        Type::create([
            'name' => 'Pain Killer'
        ]);

        Type::create([
            'name' => 'Suspension'
        ]);

        Type::create([
            'name' => 'Heart disease'
        ]);
    }
}
