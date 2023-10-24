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
        Schema::create('barang_keluars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('assets_id')->unsigned()->nullable();
            $table->foreign('assets_id')->references('id')->on('m_assets')->onDelete('set null');
            $table->integer('jumlah')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('penerima_barang', 200)->nullable();
            $table->string('exit_warehouse', 200)->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluars');
    }
};
