<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Customer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            'name' => 'DHARMA',
            'code_customer' => 'DPM',
            'lot_no' => 'JKT23',
            'no_tlp' => '02122344',
            'address' => 'Jalan Raya Ciwatu',
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);
        DB::table('customers')->insert([
            'name' => 'ADHI CHANDRA',
            'code_customer' => 'ACJ',
            'lot_no' => 'JKT23',
            'no_tlp' => '02198765',
            'address' => 'Jalan Raya Gelarmendala',
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);
    }
}
