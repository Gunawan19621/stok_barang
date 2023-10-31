<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('username', 32)->nullable();
            $table->string('fullname', 50)->nullable();
            $table->string('nip', 20)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('divisi', 100)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('foto', 255)->nullable();
            $table->string('jenis_kelamin', 20)->nullable();
            $table->string('agama', 15)->nullable();
            $table->foreignId('role_id')->constrained('m_roles')->onDelete('cascade');
            $table->bigInteger('warehouse_id')->unsigned()->nullable();
            $table->foreign('warehouse_id')->references('id')->on('m_warehouses')->onDelete('set null');
            $table->text('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
