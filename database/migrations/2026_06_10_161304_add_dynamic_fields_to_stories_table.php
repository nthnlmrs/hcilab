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
        Schema::table('stories', function (Blueprint $table) {
            $table->json('characters')->nullable();
            $table->json('themes')->nullable();
            $table->text('historical_significance')->nullable();
            $table->text('did_you_know')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn(['characters', 'themes', 'historical_significance', 'did_you_know']);
        });
    }
};
