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
            $table->string('seri', 50);
            $table->string('name', 200);
            $table->text('description');
            $table->bigInteger('warehouse_id')->unsigned();
            $table->foreign('warehouse_id')->references('id')->on('m_warehouses');
            $table->datetime('date');
            $table->integer('qr_count');
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by', 200);
            $table->string('updated_by', 200);
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
