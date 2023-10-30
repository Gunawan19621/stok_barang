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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('code_customer', 50);
            $table->string('lot_no', 50);
            $table->string('nip', 20)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('jenis_kelamin', 30)->nullable();
            $table->string('agama', 30)->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
