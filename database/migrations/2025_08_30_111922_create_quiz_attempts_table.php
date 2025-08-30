<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // quiz_type: 'quizpython' | 'quizcpp' | 'quizjavascript' | other
            $table->string('quiz_type');
            $table->unsignedBigInteger('quiz_id')->nullable();
            $table->json('answers')->nullable(); // lưu answers/choices
            $table->integer('score')->default(0);
            $table->integer('max_score')->default(0);
            $table->boolean('passed')->default(false);
            $table->timestamps();
            $table->index(['user_id', 'quiz_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
    }
};
