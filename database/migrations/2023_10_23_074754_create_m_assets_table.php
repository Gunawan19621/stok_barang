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
        Schema::create('m_assets', function (Blueprint $table) {
            $table->id();
            $table->string('seri', 50)->nullable();
            $table->string('name', 200)->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('warehouse_id')->references('id')->on('m_warehouses')->onDelete('set null');
            $table->datetime('date')->nullable();
            $table->string('qr_count', 255)->nullable();
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
        Schema::dropIfExists('m_assets');
    }
};
