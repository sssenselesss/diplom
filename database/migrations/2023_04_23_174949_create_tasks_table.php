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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->foreignId('category_id')->constrained('task_categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('description');
            $table->text('option')->nullable();
            $table->string('place',255);
            $table->string('price',255);
            $table->date('date_start');
            $table->date('date_end');
            $table->string('image')->nullable();
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
