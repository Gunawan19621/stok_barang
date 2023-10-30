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
        Schema::create('asset_statuses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('peti_id')->unsigned()->nullable();
            $table->foreign('peti_id')->references('id')->on('petis')->onDelete('set null');
            $table->date('exit_at')->nullable();
            $table->date('est_pengembalian')->nullable();
            $table->string('exit_pic', 200)->nullable();
            $table->bigInteger('exit_warehouse')->unsigned()->nullable();
            $table->date('enter_at')->nullable();
            $table->string('enter_pic', 200)->nullable();
            $table->bigInteger('enter_warehouse')->unsigned()->nullable();
            $table->string('kondisi_peti')->nullable();
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
        Schema::dropIfExists('asset_statuses');
    }
};
