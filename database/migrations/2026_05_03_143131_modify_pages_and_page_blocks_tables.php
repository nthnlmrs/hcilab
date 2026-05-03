<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('status')->default('draft')->after('qr_code_path');
            $table->text('description')->nullable()->after('title');
            $table->string('cover_image')->nullable()->after('description');
        });

        Schema::table('page_blocks', function (Blueprint $table) {
            $table->json('data')->nullable()->after('content');
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->string('status')->default('draft')->after('description');
            $table->string('image')->nullable()->after('status');
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->integer('points')->default(10)->after('text');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['status', 'description', 'cover_image']);
        });

        Schema::table('page_blocks', function (Blueprint $table) {
            $table->dropColumn('data');
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn(['status', 'image']);
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('points');
        });
    }
};
