# Nền tảng Học tập Gamification 🎮

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
[![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com/)

Một nền tảng học tập trực tuyến được "game hóa", xây dựng trên Laravel. Dự án cung cấp môi trường tương tác để học các ngôn ngữ lập trình (Python, C++, JavaScript) thông qua các bài giảng và hệ thống trắc nghiệm thử thách.

## ✨ Tính năng nổi bật

### 👤 Dành cho Người dùng (User)
- **Học tập theo lộ trình**: Truy cập các bài học được sắp xếp theo từng ngôn ngữ và chủ đề.
- **Trắc nghiệm tương tác**: Làm các bài quiz để kiểm tra và củng cố kiến thức sau mỗi bài học.
- **Xem kết quả tức thì**: Nhận điểm số và xem lại đáp án ngay sau khi hoàn thành bài trắc nghiệm.
- **Lịch sử học tập**: Theo dõi tiến độ và xem lại lịch sử các bài quiz đã làm cùng điểm số.
- **Xác thực an toàn**: Đăng ký, đăng nhập, xác thực email và đặt lại mật khẩu.

### 🔐 Dành cho Quản trị viên (Admin)
- **Bảng điều khiển (Dashboard)**: Giao diện quản trị tập trung, hiện đại và dễ sử dụng.
- **Quản lý Người dùng**: Xem danh sách, chỉnh sửa và xóa tài khoản người dùng.
- **Quản lý Nội dung**:
    - **Bài học**: Thêm, sửa, xóa các bài học cho Python, C++, và JavaScript.
    - **Câu hỏi Quiz**: Tạo và quản lý ngân hàng câu hỏi trắc nghiệm cho từng ngôn ngữ.
- **Tìm kiếm & Phân trang**: Dễ dàng tìm kiếm và điều hướng qua các danh sách dài.

### ⚙️ Hệ thống
- **Phân quyền**: Hệ thống phân chia vai trò `admin` và `user` rõ ràng.
- **Giao diện đáp ứng (Responsive)**: Tương thích tốt trên cả máy tính và thiết bị di động.
- **Thông báo qua Email**: Tự động gửi email xác thực và hướng dẫn đặt lại mật khẩu.

## 🚀 Công nghệ sử dụng

- **Backend**: Laravel, PHP
- **Frontend**: Blade, CSS3 (Flexbox, Grid), JavaScript
- **Cơ sở dữ liệu**: MySQL
- **Containerization**: Docker, Docker Compose
- **Mail Server**: Hỗ trợ SMTP (Mailtrap, Gmail, etc.)

## 🔧 Hướng dẫn Cài đặt

### Lựa chọn 1: Cài đặt với Docker (Khuyến khích)
Đây là cách nhanh chóng và dễ dàng nhất để khởi chạy dự án mà không cần cài đặt PHP, Composer hay MySQL trên máy của bạn.

1.  **Clone repository**:
    ```bash
    git clone https://github.com/Thuantran520/doangamifi.git
    cd doangamifi
    ```

2.  **Cấu hình môi trường**:
    Sao chép tệp `.env.example` thành `.env`. Các cấu hình cho Docker đã được thiết lập sẵn.
    ```bash
    cp .env.example .env
    ```

3.  **Khởi chạy Docker containers**:
    Lệnh này sẽ build và chạy các service (app, db, mailhog) ở chế độ nền.
    ```bash
    docker-compose up -d --build
    ```

4.  **Cài đặt dependencies & Chạy migrations**:
    - Cài đặt các gói Composer:
      ```bash
      docker-compose exec app composer install
      ```
    - Cài đặt các gói NPM và build assets:
      ```bash
      docker-compose exec app npm install
      docker-compose exec app npm run build
      ```
    - Chạy migrations và seeders để tạo cấu trúc DB và dữ liệu mẫu (bao gồm tài khoản admin):
      ```bash
      docker-compose exec app php artisan migrate --seed
      ```

### Lựa chọn 2: Cài đặt thủ công
Yêu cầu: PHP, Composer, Node.js & NPM, MySQL đã được cài đặt trên máy.

1.  **Clone repository**:
    ```bash
    git clone https://github.com/Thuantran520/doangamifi.git
    cd doangamifi
    ```

2.  **Cài đặt dependencies**:
    ```bash
    composer install
    npm install
    npm run build
    ```

3.  **Cấu hình môi trường**:
    - Sao chép `.env.example` thành `.env`:
      ```bash
      cp .env.example .env
      ```
    - Tạo application key:
      ```bash
      php artisan key:generate
      ```
    - Mở file `.env` và cấu hình thông tin **Cơ sở dữ liệu** và **Email**.

4.  **Chạy migrations và seeders**:
    ```bash
    php artisan migrate --seed
    ```

## 🏃‍♂️ Khởi chạy & Sử dụng

- **URL ứng dụng**: `http://127.0.0.1:8000` (hoặc `http://localhost:8000` nếu dùng Docker)
- **MailHog (để xem email test)**: `http://localhost:8025` (chỉ khi dùng Docker)

### Tài khoản mặc định
Sau khi chạy `php artisan migrate --seed`, một tài khoản admin mặc định sẽ được tạo:
- **Email**: `admin@gmail.com`
- **Mật khẩu**: `123456`

## 🤝 Đóng góp
Mọi đóng góp để cải thiện dự án đều được chào đón! Vui lòng tạo một **Pull Request** với mô tả chi tiết về những thay đổi của bạn.

1.  Fork a project
2.  Tạo branch mới (`git checkout -b feature/AmazingFeature`)
3.  Commit thay đổi (`git commit -m 'Add some AmazingFeature'`)
4.  Push lên branch (`git push origin feature/AmazingFeature`)
5.  Mở một Pull Request

## 📄 Giấy phép
Đây là dự án dành cho học tập và nghiên cứu. Vui lòng không sử dụng cho mục đích thương mại.
