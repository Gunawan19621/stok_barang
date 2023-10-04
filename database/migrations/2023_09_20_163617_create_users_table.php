<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50);
            $table->string('fullname');
            $table->string('nip', 20)->nullable();
            $table->string('email')->unique();
            $table->string('no_hp', 20)->nullable();
            $table->string('divisi', 255);
            $table->date('tgl_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'])->nullable();
            $table->string('foto', 255)->nullable();
            $table->bigInteger('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('m_roles');
            $table->bigInteger('warehouse_id')->unsigned();
            $table->foreign('warehouse_id')->references('id')->on('m_warehouses');
            $table->text('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('created_by', 200)->nullable();
            $table->string('updated_by', 200)->nullable();
            $table->softDeletes(); // Menambahkan kolom deleted_at untuk soft delete
        });

        DB::table('users')->insert([
            ['username' => 'Gunawan19621', 'fullname' => 'Gunawan', 'nip' => '111111', 'email' => 'gunawan19621@gmail.com', 'no_hp' => '085159079010', 'divisi' => 'admin', 'role_id' => 1, 'warehouse_id' => 1, 'address' => 'Jl. Raya Gelarmendala', 'password' => bcrypt('19062001')],
            ['username' => 'warehouse123', 'fullname' => 'warehouse', 'nip' => '222222', 'email' => 'warehouse@gmail.com', 'no_hp' => '085159079020', 'divisi' => 'admin', 'role_id' => 2, 'warehouse_id' => 2, 'address' => 'Jl. Raya Ciwatu', 'password' => bcrypt('warehouse123')],
            ['username' => 'customer123', 'fullname' => 'customer', 'nip' => '333333', 'email' => 'customer@gmail.com', 'no_hp' => '085159079030', 'divisi' => 'admin', 'role_id' => 3, 'warehouse_id' => 3, 'address' => 'Jl. Raya Balongan', 'password' => bcrypt('customer123')]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
