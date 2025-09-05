<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // <-- Dòng này rất quan trọng

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạm thời vô hiệu hóa kiểm tra khóa ngoại
        Schema::disableForeignKeyConstraints();

        // Xóa dữ liệu cũ ở cả bảng trung gian và bảng chính
        DB::table('badge_user')->truncate();
        DB::table('badges')->truncate();

        // Kích hoạt lại kiểm tra khóa ngoại
        Schema::enableForeignKeyConstraints();

        // Bắt đầu thêm dữ liệu mới
        Badge::create(['name' => 'Tân Binh', 'icon' => 'rookie-medal.png', 'description' => 'Đạt 100 điểm đầu tiên']);
        Badge::create(['name' => 'Chuyên Gia', 'icon' => 'expert-trophy.png', 'description' => 'Đạt 1000 điểm']);
        Badge::create(['name' => 'Bậc Thầy', 'icon' => 'master.png', 'description' => 'Hoàn hảo bài test Python']);
        Badge::create(['name' => 'Chuỗi Thắng', 'icon' => 'winning-streak.png', 'description' => 'Hoàn thành 3 bài quiz liên tiếp']);
        Badge::create(['name' => 'Top 10', 'icon' => 'top-10-crown.png', 'description' => 'Lọt vào top 10 bảng xếp hạng hàng tháng']);
    }
}
