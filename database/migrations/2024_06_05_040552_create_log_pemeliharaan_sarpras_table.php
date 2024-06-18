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
        Schema::create('log_pemeliharaan_sarpras', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sarpras_id');
            $table->year('tahun_periode');
            $table->enum('sarana_or_prasarana', ['Sarana', 'Prasarana']);
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->string('kondisi');
            $table->longText('desc')->nullable();
            $table->longText('akar_masalah')->nullable();
            $table->longText('tindak_lanjut')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_pemeliharaan_sarpras');
    }
};
