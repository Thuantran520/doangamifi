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
        // Danh sách các bảng quiz cần cập nhật
        $quizTables = ['quizpython', 'quizcpp', 'quizjavascript'];

        foreach ($quizTables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    // Thêm cột timestamps (created_at, updated_at) nếu chưa có
                    if (!Schema::hasColumn($table->getTable(), 'created_at') && !Schema::hasColumn($table->getTable(), 'updated_at')) {
                        $table->timestamps();
                    }
                    // Thêm cột difficulty nếu chưa có
                    if (!Schema::hasColumn($table->getTable(), 'difficulty')) {
                        $table->string('difficulty')->nullable()->after('correct_answer');
                    }
                    // Thêm cột topic nếu chưa có
                    if (!Schema::hasColumn($table->getTable(), 'topic')) {
                        $table->string('topic')->nullable()->after('difficulty');
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $quizTables = ['quizpython', 'quizcpp', 'quizjavascript'];

        foreach ($quizTables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    // Xóa các cột nếu chúng tồn tại
                    if (Schema::hasColumn($table->getTable(), 'topic')) {
                        $table->dropColumn('topic');
                    }
                    if (Schema::hasColumn($table->getTable(), 'difficulty')) {
                        $table->dropColumn('difficulty');
                    }
                    if (Schema::hasColumn($table->getTable(), 'created_at') && Schema::hasColumn($table->getTable(), 'updated_at')) {
                        $table->dropTimestamps();
                    }
                });
            }
        }
    }
};
