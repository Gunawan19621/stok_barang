<?php

namespace Database\Seeders;

use App\Models\m_role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role Admin
        m_role::create([
            'name' => 'Admin',
            'description' => 'Peran admin sistem',
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);

        // Role User
        m_role::create([
            'name' => 'User',
            'description' => 'Peran pengguna biasa',
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);
    }
}
