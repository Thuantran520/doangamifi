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
        // Danh sách các bảng bài học cần cập nhật
        $lessonTables = ['python', 'cpp', 'javascript'];

        foreach ($lessonTables as $tableName) {
            // Kiểm tra xem bảng có tồn tại không trước khi sửa
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    // Thêm cột 'updated_date' nếu nó chưa tồn tại
                    if (!Schema::hasColumn($table->getTable(), 'updated_date')) {
                        $table->date('updated_date')->nullable()->after('created_at');
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
        $lessonTables = ['python', 'cpp', 'javascript'];

        foreach ($lessonTables as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'updated_date')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('updated_date');
                });
            }
        }
    }
};
