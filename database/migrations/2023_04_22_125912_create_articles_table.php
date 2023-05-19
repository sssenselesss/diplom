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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->foreignId('category_id')->constrained('article_categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('text');
            $table->string('image',255);


            $table->timestamps();
        });

        Schema::table('articles', function($table) {
            $table->integer('views_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
