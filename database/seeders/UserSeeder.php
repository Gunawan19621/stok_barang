<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'fullname' => 'Admin System',
            'nip' => '1234567890123456',
            'email' => 'admin@gmail.com',
            'no_hp' => '085159079010',
            'divisi' => 'Admin Division',
            'tgl_lahir' => '1990-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'foto' => '', // Ganti dengan nama berkas foto jika diperlukan
            'role_id' => 1, // Ganti dengan ID peran yang sesuai
            'warehouse_id' => 1, // Ganti dengan ID gudang yang sesuai
            'address' => 'Jalan Ciwatu',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);

        // User lainnya
        User::create([
            'username' => 'Operator',
            'fullname' => 'Operator System',
            'nip' => '6543210987654321',
            'email' => 'operator@gmail.com',
            'no_hp' => '087779767603',
            'divisi' => 'Operator Gudang',
            'tgl_lahir' => '1985-05-15',
            'jenis_kelamin' => 'Perempuan',
            'agama' => 'Islam',
            'foto' => '', // Ganti dengan nama berkas foto jika diperlukan
            'role_id' => 2, // Ganti dengan ID peran yang sesuai
            'warehouse_id' => 2, // Ganti dengan ID gudang yang sesuai
            'address' => 'Jalan Gelarmendala',
            'email_verified_at' => now(),
            'password' => bcrypt('operator'),
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);
    }
}
