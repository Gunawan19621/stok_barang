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
            $table->bigInteger('asset_id')->unsigned()->nullable();
            $table->foreign('asset_id')->references('id')->on('m_assets')->onDelete('set null');
            $table->integer('jumlah')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->string('asal_barang', 200)->nullable();
            $table->string('pengiriman_barang', 200)->nullable();
            $table->string('penerima_barang', 200)->nullable();
            $table->string('enter_warehouse', 200)->nullable();
            $table->string('keterangan', 255)->nullable();
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
