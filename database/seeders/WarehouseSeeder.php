<?php

namespace Database\Seeders;

use App\Models\m_warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Warehouse 1
        m_warehouse::create([
            'name' => 'Gudang A',
            'description' => 'Gudang utama',
            'address' => 'Alamat Gudang A',
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);

        // Warehouse 2
        m_warehouse::create([
            'name' => 'Gudang B',
            'description' => 'Gudang cabang',
            'address' => 'Alamat Gudang B',
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);
    }
}
