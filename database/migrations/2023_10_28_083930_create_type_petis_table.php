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
        Schema::create('type_petis', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20);
            $table->string('size_peti', 25);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_petis');
    }
};
