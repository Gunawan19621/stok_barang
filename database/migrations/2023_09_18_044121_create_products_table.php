<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->integer('stok');
            $table->decimal('harga', 10, 3);
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('kode_barang');
        });
    }
};
