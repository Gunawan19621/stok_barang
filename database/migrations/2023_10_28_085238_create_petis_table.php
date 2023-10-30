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
        Schema::create('petis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipe_peti_id')->nullable();
            $table->foreign('tipe_peti_id')->references('id')->on('type_petis')->onDelete('set null');
            $table->string('warna', 50);
            $table->string('fix_lot', 100);
            $table->integer('packing_no');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->integer('jumlah')->nullable();
            $table->date('date_pembuatan', 100)->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('warehouse_id')->references('id')->on('m_warehouses')->onDelete('set null');
            $table->string('status_disposal')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by', 200)->nullable();
            $table->string('updated_by', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petis');
    }
};
