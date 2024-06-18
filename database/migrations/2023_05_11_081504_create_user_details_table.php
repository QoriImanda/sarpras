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
        Schema::create('user_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nama_lengkap')->nullable();
            $table->string('jk')->nullable();
            $table->foreignUuid('nidn')->nullable()->unique();
            $table->foreignUuid('nim')->nullable()->unique();

            $table->foreignUuid('prodi_id')->nullable()
                ->references('id')->on('prodis')
                ->onDelete('restrict')->onUpdate('restrict');

            $table->string('foto_profile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
