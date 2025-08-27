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
        Schema::table('quiz_questions', function (Blueprint $table) {
            $table->timestamps();
            if (!Schema::hasColumn('quiz_questions', 'difficulty')) {
                $table->string('difficulty')->nullable()->after('correct_answer');
            }
            if (!Schema::hasColumn('quiz_questions', 'topic')) {
                $table->string('topic')->nullable()->after('difficulty');
            }
            // Thêm các cột khác ở đây nếu muốn
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_questions', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
            if (Schema::hasColumn('quiz_questions', 'difficulty')) {
                $table->dropColumn('difficulty');
            }
            if (Schema::hasColumn('quiz_questions', 'topic')) {
                $table->dropColumn('topic');
            }
            // Xóa các cột khác nếu đã thêm
        });
    }
};
