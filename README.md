# Đồ án Quản lý Bài tập / Học tập (Laravel)

## 📌 Giới thiệu
Ứng dụng web quản lý bài học, bài tập, quiz cho học sinh và admin, xây dựng bằng **Laravel**.  
Hỗ trợ cả giao diện Web và API, phân quyền người dùng, nhập liệu hàng loạt, và quản lý đa ngôn ngữ (Python, C++, Javascript).

---

## 🚀 Yêu cầu hệ thống
- PHP >= 8.2
- Composer >= 2.x
- MySQL hoặc MariaDB
- Node.js + NPM (dùng cho build giao diện)

---

## ⚙️ Cài đặt & Khởi động

1. **Clone project:**
    ```bash
    git clone <link-repo>
    cd doangamifi
    ```

2. **Cài đặt dependencies:**
    ```bash
    composer install
    npm install && npm run dev
    ```

3. **Tạo file .env & cấu hình database:**
    ```bash
    cp .env.example .env
    ```
    - Chỉnh sửa thông tin kết nối database trong file `.env`.

4. **Sinh key ứng dụng:**
    ```bash
    php artisan key:generate
    ```

5. **Chạy migrate & seed dữ liệu mẫu:**
    ```bash
    php artisan migrate --seed
    ```

6. **Khởi động server:**
    ```bash
    php artisan serve
    ```
    - Truy cập: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🗂️ Cấu trúc thư mục chính

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── UserDashboardController.php
│   │   └── Admin/
│   │       └── DashboardController.php
│   └── Requests/
├── Models/
│   ├── User.php
│   ├── Task.php
│   ├── Python.php
│   ├── Cpp.php
│   └── Javascript.php
routes/
├── web.php     # Route cho Web
└── api.php     # Route cho API
resources/
├── views/      # Blade templates cho giao diện
└── css, js     # Frontend assets
```

---

## 🧩 Tính năng nổi bật

- Đăng ký, đăng nhập, đăng xuất (Laravel Sanctum)
- Phân quyền: Admin & User
- Quản lý bài học đa ngôn ngữ: Python, C++, Javascript
- Quản lý công việc (Task API)
- Quản lý quiz, câu hỏi trắc nghiệm
- Nhập liệu hàng loạt qua Excel/CSV
- Giao diện hiện đại, responsive cho học sinh & admin
- Trang lỗi tùy chỉnh, bảo mật session

---

## 🔗 API Endpoint chính

**Auth**
- `POST /api/register` – Đăng ký
- `POST /api/login` – Đăng nhập
- `POST /api/logout` – Đăng xuất
- `GET /api/user` – Thông tin user đang đăng nhập

**Tasks**
- `GET /api/tasks`
- `POST /api/tasks`
- `PUT /api/tasks/{id}`
- `DELETE /api/tasks/{id}`

**Lessons & Quiz**
- `GET /api/lessons/{type}` – Lấy danh sách bài học theo loại
- `POST /api/lessons/{type}` – Thêm bài học
- `GET /api/quizzes` – Lấy danh sách quiz
- `POST /api/quizzes` – Thêm quiz

---

## 💡 Hướng dẫn sử dụng

- Truy cập trang chủ để chọn loại bài học hoặc quản lý (admin).
- Admin có thể thêm/sửa/xóa bài học, quiz, và nhập liệu hàng loạt.
- Người dùng có thể xem bài học, làm quiz, và theo dõi tiến trình.

---

## 📜 License

Dự án phục vụ mục đích học tập, phi thương mại.

---

**Mọi thắc mắc hoặc đóng góp, vui lòng liên hệ hoặc tạo issue trên Github!**

