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
        Schema::create('kode_inventaris', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('gol');
            $table->string('bid');
            $table->string('kel');
            $table->string('sub_kel');
            $table->string('sub_sub');
            $table->string('no_urut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_inventaris');
    }
};
