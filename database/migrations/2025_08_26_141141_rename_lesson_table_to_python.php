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
        // Chỉ đổi tên nếu bảng 'lessons' tồn tại và bảng 'python' chưa tồn tại.
        if (Schema::hasTable('lessons') && !Schema::hasTable('python')) {
            Schema::rename('lessons', 'python');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Chỉ đổi tên ngược lại nếu bảng 'python' tồn tại và bảng 'lessons' chưa tồn tại.
        if (Schema::hasTable('python') && !Schema::hasTable('lessons')) {
            Schema::rename('python', 'lessons');
        }
    }
};
