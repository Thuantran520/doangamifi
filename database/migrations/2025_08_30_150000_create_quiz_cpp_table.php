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
        if (!Schema::hasTable('quiz_cpp')) {
            Schema::create('quiz_cpp', function (Blueprint $table) {
                $table->id();
                $table->text('question_text');
                $table->string('option_a');
                $table->string('option_b');
                $table->string('option_c');
                $table->string('option_d');
                $table->string('correct_answer');
                $table->string('difficulty')->nullable();
                $table->string('topic')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_cpp');
    }
};