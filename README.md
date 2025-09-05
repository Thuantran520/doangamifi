<h1 align="center">Gamify Learn - Nền tảng Học lập trình Gamification 🚀</h1>

<p align="center">
  <strong>Biến việc học lập trình khô khan thành một cuộc phiêu lưu thú vị!</strong>
  <br />
  <em>Dự án được xây dựng bằng Laravel, kết hợp các yếu tố game hóa để tạo động lực và theo dõi tiến độ học tập một cách trực quan.</em>
</p>

<p align="center">
  <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel"></a>
  <a href="https://www.php.net"><img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"></a>
  <a href="https://www.mysql.com"><img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"></a>
  <a href="https://www.docker.com/"><img src="https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker"></a>
</p>

## ✨ Tính năng Chính

Dự án cung cấp một trải nghiệm học tập tương tác thông qua các bài trắc nghiệm và minigame sáng tạo.

### 🎮 Trải nghiệm Người dùng (Player)
- **🔐 Xác thực Người dùng**: Đăng ký, đăng nhập và quản lý tài khoản cá nhân.
- **🚀 Giao diện Launcher Hiện đại**: Màn hình chính với thiết kế mới, cho phép người dùng dễ dàng lựa chọn các hoạt động.
- **🧠 Trắc nghiệm Lập trình**:
    - Các bài kiểm tra kiến thức về **C++**, **Python**, và **JavaScript**.
    - Giao diện làm bài được "game hóa" để tăng phần hứng thú.
    - Nhận kết quả và điểm số ngay sau khi hoàn thành.
- **🎲 Minigames Tương tác**:
    - **Robot Control**: Điều khiển robot vượt chướng ngại vật bằng các lệnh lập trình.
    - **Sort Challenge**: Thử thách sắp xếp các phần tử theo thuật toán.
- **🏆 Bảng xếp hạng (Leaderboard)**: Theo dõi điểm số và cạnh tranh với những người chơi khác.

### 👑 Chức năng Quản trị viên (Admin)
- **⚙️ Phân quyền**: Hệ thống có vai trò `admin` để quản lý người dùng và nội dung.
- **📊 Dashboard Quản trị**: Giao diện để xem và quản lý người dùng, bài học và câu hỏi.

### ⚙️ Cốt lõi Hệ thống
- **🎭 Phân quyền Linh hoạt**: Hệ thống phân chia vai trò `admin` và `user` rõ ràng thông qua `role` trong bảng `users`.
- **📱 Giao diện Thích ứng (Responsive)**: Giao diện được thiết kế để hoạt động tốt trên các thiết bị khác nhau.

## 🛠️ Công nghệ Sử dụng

| Hạng mục      | Công nghệ                                       |
|---------------|-------------------------------------------------|
| **Backend**   | Laravel, PHP                                    |
| **Frontend**  | Blade, CSS, JavaScript                          |
| **Database**  | MySQL                                           |
| **DevOps**    | Docker, Docker Compose                          |

## 🚀 Bắt đầu Nhanh với Docker (Khuyến khích)

Cách đơn giản nhất để khởi chạy dự án mà không cần cài đặt thủ công.

1.  **Tải mã nguồn**:
    ```bash
    git clone https://github.com/Thuantran520/doangamifi.git
    cd doangamifi
    ```

2.  **Thiết lập môi trường**:
    Sao chép tệp `.env.example` thành `.env`.
    ```bash
    cp .env.example .env
    ```

3.  **Khởi chạy Docker**:
    Lệnh này sẽ build và chạy các service (app, db) ở chế độ nền.
    ```bash
    docker-compose up -d --build
    ```

4.  **Cài đặt & Khởi tạo Dữ liệu**:
    ```bash
    # Cài đặt các gói Composer
    docker-compose exec app composer install

    # Cài đặt các gói NPM và build assets
    docker-compose exec app npm install
    docker-compose exec app npm run build

    # Chạy migrations để tạo cấu trúc DB và seeders để có dữ liệu mẫu
    docker-compose exec app php artisan migrate --seed
    ```

## 🔧 Cài đặt Thủ công

Yêu cầu: PHP, Composer, Node.js & NPM, MySQL đã được cài đặt trên máy.

1.  **Tải mã nguồn & Cài đặt**:
    ```bash
    git clone https://github.com/Thuantran520/doangamifi.git
    cd doangamifi
    composer install
    npm install
    npm run build
    ```

2.  **Thiết lập môi trường**:
    ```bash
    # Sao chép .env.example thành .env
    cp .env.example .env

    # Tạo application key
    php artisan key:generate
    ```
    - Mở file `.env` và cấu hình thông tin **Cơ sở dữ liệu** (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

3.  **Khởi tạo Cơ sở dữ liệu**:
    ```bash
    php artisan migrate --seed
    ```

## 🏃‍♂️ Khởi chạy & Sử dụng

- **URL ứng dụng**:
  - Docker: `http://localhost:8000`
  - Thủ công: `http://127.0.0.1:8000`

### Tài khoản Mặc định
Sau khi chạy `seed`, các tài khoản mẫu sẽ được tạo:
- **Tài khoản Admin**:
  - **Email**: `admin@gmail.com`
  - **Mật khẩu**: `123456`
- **Tài khoản User**:
  - **Email**: `user@gmail.com`
  - **Mật khẩu**: `123456`

## 📄 Giấy phép
Dự án này được cấp phép theo **MIT License**.
