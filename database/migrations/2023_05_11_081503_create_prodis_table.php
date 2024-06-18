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
        Schema::create('prodis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_prodi');
            $table->string('kode_prodi');
            $table->string('slug');
            $table->string('jenjang')->nullable();
            $table->foreignUuid('user_id')->nullable()
                ->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('restrict');
            $table->foreignUuid('fakultas_id')
                ->references('id')->on('fakultas')
                ->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodis');
    }
};
