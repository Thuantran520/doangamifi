# Đồ án Quản lý Bài tập / Học tập (Laravel)

## 📌 Giới thiệu
Đây là một ứng dụng web được xây dựng bằng **Laravel**, kết hợp cả **Web** và **API**.  
Ứng dụng hỗ trợ:
- Đăng ký, đăng nhập, đăng xuất (Auth bằng Laravel Sanctum).
- Phân quyền người dùng (Admin, User).
- Quản lý bài học (Lesson).
- Quản lý công việc (Task API).
- Giao diện Web cho học sinh và Admin.

---

## 🚀 Yêu cầu hệ thống
- PHP >= 8.2
- Composer >= 2.x
- MySQL hoặc MariaDB
- Node.js + NPM (dùng cho build giao diện)

---

## ⚙️ Cài đặt
1. Clone project:
   ```bash
   git clone <link-repo>
   cd doangamifi

2. Cài đặt dependencies:
    ```bash
    composer install
    npm install && npm run dev

3. Tạo file .env:
    ```bash
    cp .env.example .env
    Sau đó chỉnh thông tin database (MySQL).
4. Generate key:
    ```bash
    php artisan key:generate
5. Chạy migrate + seed:
    ```bash
    php artisan migrate --seed

## Cấu trúc thư mục chính
    ```bash
    app/
    ├── Http/
    │   ├── Controllers/
    │   │   ├── AuthController.php
    │   │   ├── UserDashboardController.php
    │   │   └── Admin/
    │   │       └── DashboardController.php
    │   └── Requests/
    ├── Models/
    │   └── User.php
    routes/
    ├── web.php     # Route cho Web
    └── api.php     # Route cho API

## API Endpoint chính
* Auth
    - POST /api/register – Đăng ký
    - POST /api/login – Đăng nhập
    - POST /api/logout – Đăng xuất
    - GET /api/user – Thông tin user đang đăng nhập
* Tasks
    - GET /api/tasks
    - POST /api/tasks
    - PUT /api/tasks/{id}
    - DELETE /api/tasks/{id}

## Chạy project
* Chạy server Laravel:
    ```bash
    php artisan serve
* Truy cập: http://127.0.0.1:8000

---
## 📜 License
Đây là dự án mang mục đích học tập. Không mang mục đích thương mại

