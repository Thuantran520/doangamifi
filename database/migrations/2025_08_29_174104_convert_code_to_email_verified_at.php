<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Thêm cột email_verified_at nếu chưa có
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users','email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable()->after('email');
            }
        });

        // 2. Gán verified cho user đã không còn mã (coi như đã xác thực)
        if (Schema::hasColumn('users','email_verification_code')) {
            DB::table('users')
                ->whereNull('email_verification_code')
                ->whereNull('email_verified_at')
                ->update(['email_verified_at' => now()]);
        }

        // 3. Xóa các cột mã cũ (nếu tồn tại)
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users','email_verification_code')) {
                $table->dropColumn('email_verification_code');
            }
            if (Schema::hasColumn('users','email_verification_code_expires_at')) {
                $table->dropColumn('email_verification_code_expires_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Khôi phục lại các cột mã (rỗng) nếu rollback
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users','email_verification_code')) {
                $table->string('email_verification_code')->nullable()->after('email_verified_at');
            }
            if (!Schema::hasColumn('users','email_verification_code_expires_at')) {
                $table->timestamp('email_verification_code_expires_at')->nullable()->after('email_verification_code');
            }
            // Không xóa email_verified_at để tránh mất thông tin xác thực; nếu muốn thì bỏ comment phía dưới:
            // if (Schema::hasColumn('users','email_verified_at')) {
            //     $table->dropColumn('email_verified_at');
            // }
        });
    }
};
