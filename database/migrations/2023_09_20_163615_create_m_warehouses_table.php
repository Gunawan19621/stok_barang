<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by', 200)->nullable()->default('System');
            $table->string('updated_by', 200)->nullable()->default('System');
        });

        DB::table('m_warehouses')->insert([
            ['name' => 'Gudangsatu', 'description' => 'Gudang Barang', 'address' => 'Jln. Raya Kesatu'],
            ['name' => 'Gudangdua', 'description' => 'Gudang Makanan', 'address' => 'Jln. Raya Kedua'],
            ['name' => 'Gudangtiga', 'description' => 'Gudang Pakaian', 'address' => 'Jln. Raya Ketiga'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_warehouses');
    }
};
