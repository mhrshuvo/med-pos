<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run()
    {
        Contact::create([
            'name' => 'Walk-In-Cutomer',
            'contact_id' => 'CUS-100001',
            'email' => 'customer@pos.com',
            'phone' => '017865304585',
            'alternate_phone' => '017865304562',
            'contact_type' => '1',
        ]);
        Contact::create([
            'name' => 'Customer',
            'contact_id' => 'CUS-100001',
            'email' => 'customer@pos.com',
            'phone' => '017865304563',
            'alternate_phone' => '017865304562',
            'contact_type' => '1',
        ]);

        Contact::create([
            'name' => 'Supplier',
            'contact_id' => 'SUP-100002',
            'email' => 'supplier@pos.com',
            'phone' => '017865304553',
            'alternate_phone' => '017865304552',
            'contact_type' => '0',
        ]);
    }
}
