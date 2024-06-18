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
        Schema::create('prasaranas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_inventaris')->unique();
            $table->string('nama_prasarana');
            $table->longText('ruang_prasarana')->nullable();
            $table->longText('desc')->nullable();
            $table->foreignUuid('kategori_id')->constrained('kategoris')->restrictOnUpdate()->restrictOnDelete();
            $table->year('tahun_pengadaan')->nullable();
            $table->longText('lokasi_prasarana')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prasaranas');
    }
};
