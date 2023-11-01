<?php

namespace Database\Seeders;

use App\Models\Peti;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class Type_Peti extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_petis')->insert([
            'type' => 'Bagus',
            'size_peti' => '2 X 2 X 2 X 2',
            'description' => 'Detail Barang Bagus',
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);
        DB::table('type_petis')->insert([
            'type' => 'Standar',
            'size_peti' => '3 X 3 X 3 X 3',
            'description' => 'Detail Barang Standar',
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);
    }
}
