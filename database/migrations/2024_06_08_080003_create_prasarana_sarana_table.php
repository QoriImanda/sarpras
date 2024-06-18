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
        Schema::create('prasarana_sarana', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('sarana_id')->constrained('saranas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('prasarana_id')->constrained('prasaranas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prasarana_sarana');
    }
};
