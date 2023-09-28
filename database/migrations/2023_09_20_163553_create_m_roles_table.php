<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by', 200)->nullable()->default('System');
            $table->string('updated_by', 200)->nullable()->default('System');
        });

        // Insert default roles
        DB::table('m_roles')->insert([
            ['name' => 'admin', 'description' => 'Administrator'],
            ['name' => 'warehouse', 'description' => 'Warehouse User'],
            ['name' => 'customer', 'description' => 'Customer'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_roles');
    }
};
