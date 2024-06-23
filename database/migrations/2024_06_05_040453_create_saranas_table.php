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
        Schema::create('saranas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kode_inventaris_id')->constrained('kode_inventaris')->restrictOnUpdate()->restrictOnDelete();
            $table->string('nama_sarana');
            $table->longText('desc')->nullable();
            $table->string('jenis_sarana');
            $table->foreignUuid('kategori_id')->constrained('kategoris')->restrictOnUpdate()->restrictOnDelete();
            $table->year('tahun_pengadaan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('harga')->nullable();
            $table->longText('lokasi_sarana')->nullable();
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
        Schema::dropIfExists('saranas');
    }
};
