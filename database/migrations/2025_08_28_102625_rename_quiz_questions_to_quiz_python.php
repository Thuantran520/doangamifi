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
        Schema::rename('quiz_questions', 'quiz_python');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('quiz_python', 'quiz_questions');
    }
};
