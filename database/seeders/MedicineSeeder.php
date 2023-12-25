<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run()
    {
        Medicine::create([
            'name' => 'Napa',
            'generic_name' => 'Paracetamol',
            'category_id' => 1,
            'unit_id' => 1,
            'type_id' => 1,
            'price' => 1,
            'image' => 'uploads/image/napa.jpg',
            'purchase_price' => 0.8,
            'details' => 'Napa Paracetamol type Medicine',
        ]);

        Medicine::create([
            'name' => 'Fymoxil',
            'generic_name' => 'AntiBiotic',
            'category_id' => 4,
            'unit_id' => 2,
            'type_id' => 1,
            'price' => 5,
            'image' => 'uploads/image/fimoxyl.jpg',
            'purchase_price' => 4,
            'details' => 'Fymoxil AntiBiotic type Medicine for Pain Killer Area',
        ]);
    }
}
