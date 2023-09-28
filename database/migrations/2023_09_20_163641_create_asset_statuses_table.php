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
            $table->bigInteger('asset_id')->unsigned();
            $table->foreign('asset_id')->references('id')->on('m_assets')->onDelete('cascade');
            $table->datetime('exit_at');
            $table->string('exit_pic', 200);
            $table->string('exit_warehouse', 200);
            $table->datetime('enter_at')->nullable();
            $table->string('enter_pic', 200)->nullable();
            $table->string('enter_warehouse', 200)->nullable();
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
        Schema::dropIfExists('asset_statuses');
    }
};
