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
        // Chỉ đổi tên nếu bảng 'quiz_questions' tồn tại
        // và bảng 'quiz_python' chưa tồn tại.
        if (Schema::hasTable('quiz_questions') && !Schema::hasTable('quiz_python')) {
            Schema::rename('quiz_questions', 'quiz_python');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Chỉ đổi tên ngược lại nếu bảng 'quiz_python' tồn tại.
        if (Schema::hasTable('quiz_python') && !Schema::hasTable('quiz_questions')) {
            Schema::rename('quiz_python', 'quiz_questions');
        }
    }
};
