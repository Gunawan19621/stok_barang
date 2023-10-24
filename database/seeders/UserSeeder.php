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
            'fullname' => 'Admin User',
            'nip' => '12345',
            'email' => 'admin@gmail.com',
            'no_hp' => '1234567890',
            'divisi' => 'Admin Division',
            'tgl_lahir' => '1990-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'foto' => '', // Ganti dengan nama berkas foto jika diperlukan
            'role_id' => 1, // Ganti dengan ID peran yang sesuai
            'warehouse_id' => 1, // Ganti dengan ID gudang yang sesuai
            'address' => 'Alamat Admin',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);

        // User lainnya
        User::create([
            'username' => 'user1',
            'fullname' => 'User Satu',
            'nip' => '54321',
            'email' => 'user1@gmail.com',
            'no_hp' => '9876543210',
            'divisi' => 'Divisi Satu',
            'tgl_lahir' => '1985-05-15',
            'jenis_kelamin' => 'Perempuan',
            'agama' => 'Kristen',
            'foto' => '', // Ganti dengan nama berkas foto jika diperlukan
            'role_id' => 2, // Ganti dengan ID peran yang sesuai
            'warehouse_id' => 2, // Ganti dengan ID gudang yang sesuai
            'address' => 'Alamat User Satu',
            'email_verified_at' => now(),
            'password' => bcrypt('user1'),
            'created_by' => 'Seeder',
            'updated_by' => 'Seeder',
        ]);
    }
}
