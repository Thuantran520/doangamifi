<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo hoặc cập nhật tài khoản USER
        // Nếu đã có user tên 'user' thì cập nhật, nếu chưa có thì tạo mới.
        User::updateOrCreate(
            ['username' => 'user'], // Điều kiện để tìm
            [
                'name' => 'User',
                'email' => 'user@gmail.com', // Email phải là duy nhất
                'password' => Hash::make('123456'),
                'role' => 'user', // Giả sử bạn có cột 'role'
            ]
        );

        // Tạo hoặc cập nhật tài khoản ADMIN
        User::updateOrCreate(
            ['username' => 'admin'], // Điều kiện để tìm
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com', // Email phải là duy nhất
                'password' => Hash::make('123456'),
                'role' => 'admin', // Giả sử bạn có cột 'role'
            ]
        );
    }
}
