<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        Category::create([
            'name' => 'Medicine'
        ]);

        Category::create([
            'name' => 'Syrup'
        ]);

        Category::create([
            'name' => 'Tablet'
        ]);

        Category::create([
            'name' => 'Capsul'
        ]);

        Category::create([
            'name' => 'Ointment'
        ]);

        Category::create([
            'name' => 'Cream'
        ]);
    }
}
