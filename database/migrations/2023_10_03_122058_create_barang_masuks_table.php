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
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('asset_id')->unsigned();
            $table->foreign('asset_id')->references('id')->on('m_assets');
            $table->integer('jumlah'); // Kolom untuk jumlah barang masuk
            $table->date('tanggal_masuk'); // Kolom untuk tanggal barang masuk
            $table->string('asal_barang', 200); // Kolom untuk PIC barang masuk
            $table->string('pengirim_barang', 200); // Kolom untuk PIC barang masuk
            $table->string('penerima_barang', 200); // Kolom untuk PIC barang masuk
            $table->string('enter_warehouse', 200)->nullable();
            $table->string('keterangan')->nullable(); // Kolom untuk keterangan (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};
