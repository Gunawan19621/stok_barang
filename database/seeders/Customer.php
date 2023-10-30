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
            'name' => 'Gunawan',
            'code_customer' => 'G',
            'lot_no' => 'CWT',
            'nip' => '1234567890987654',
            'no_hp' => '085159079010',
            // 'tgl_lahir' => '19-06-2001',
            'jenis_kelamin' => 'Laki-Laki',
            'agama' => 'Islam',
            'address' => 'CIwatu',
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);
        DB::table('customers')->insert([
            'name' => 'Andra Ryandra',
            'code_customer' => 'AR',
            'lot_no' => 'KA',
            'nip' => '1234567890987',
            'no_hp' => '085159079011',
            // 'tgl_lahir' => '19-06-2001',
            'jenis_kelamin' => 'Laki-Laki',
            'agama' => 'Islam',
            'address' => 'CIwatu',
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);
    }
}
