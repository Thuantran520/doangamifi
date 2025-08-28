# DoanGamiFi

Nền tảng luyện tập & trắc nghiệm nhanh cho lập trình (Python, C++, JavaScript) xây dựng trên Laravel 12.

## Tính năng chính
- Đăng ký / đăng nhập (Laravel auth / Sanctum nền tảng).
- Quản trị câu hỏi theo từng môn: Python, C++, JavaScript (CRUD + upload hàng loạt).
- Làm bài trắc nghiệm nhanh, chấm điểm tức thì.
- Chọn nhanh môn & chủ đề qua trang giao diện thẻ (Quiz Choice).
- Phân tách view admin & public.
- Hỗ trợ tìm kiếm / lọc theo chủ đề (topic).
- Migration đổi tên bảng `quiz_questions` → `quiz_python` + mở rộng sang C++ / JS.

## Công nghệ
- Laravel 12 (PHP >= 8.2)
- Blade, Bootstrap 5.3
- Pest / PHPUnit (tests mặc định)
- Vite (build frontend)
- MySQL / MariaDB (mặc định, có thể thay bằng SQLite khi dev)

## Chuẩn bị môi trường
| Thành phần | Yêu cầu |
|------------|---------|
| PHP        | 8.2+ (enable: mbstring, pdo, openssl, intl, fileinfo) |
| Composer   | 2.x |
| Node.js    | 18+ |
| Database   | MySQL/MariaDB hoặc SQLite |

## Cài đặt nhanh (PowerShell)
```powershell
git clone <repo-url> doangamifi
cd doangamifi

copy .env.example .env   # hoặc dùng lệnh: cp .env.example .env
composer install
php artisan key:generate

# Cấu hình DB trong .env rồi chạy:
php artisan migrate

npm install
npm run build  # (hoặc npm run dev trong khi phát triển)

php artisan serve
```

Truy cập: http://127.0.0.1:8000

## Các route quan trọng
| Chức năng | URL | Tên route ví dụ |
|-----------|-----|-----------------|
| Trang khởi động | `/` | `launcher` |
| Chọn bài / môn | `/choose-quiz` | `choose.quiz` |
| Quiz Python | `/quizpython` | `quizpython.index` |
| Quiz C++ | `/quizcpp` | `quizcpp.index` |
| Quiz JavaScript | `/quizjavascript` | `quizjavascript.index` |
| Admin quiz Python | `/admin/quizpython` | `admin.quizpython.index` |
| Admin quiz C++ | `/admin/quizcpp` | `admin.quizcpp.index` |
| Admin quiz JS | `/admin/quizjavascript` | `admin.quizjavascript.index` |

(Đảm bảo đã đăng nhập nếu các route nằm trong middleware `auth`.)

## Thêm câu hỏi
1. Vào trang admin môn tương ứng.
2. Nhấn “Create” để thêm tay hoặc dùng chức năng upload (nếu đã bật).
3. Trường quan trọng: `question`, `option_a`… `option_d`, `correct_answer`, `topic`, (tùy chọn: `difficulty`, `description`).

## Cấu trúc bảng (ví dụ quiz_python)
| Cột | Mô tả |
|-----|-------|
| id | Khóa chính |
| question | Nội dung câu hỏi |
| option_a..d | Đáp án lựa chọn |
| correct_answer | Ký tự (a/b/c/d) |
| topic | Chủ đề (dùng để lọc) |
| difficulty (tùy) | Mức độ |
| created_at / updated_at | Thời gian |

## Seed / Dữ liệu mẫu (tùy chọn)
Có thể tạo factory & seeder rồi chạy:
```powershell
php artisan db:seed
```

## Lỗi thường gặp
| Vấn đề | Nguyên nhân | Cách khắc phục |
|--------|-------------|----------------|
| 404 quiz route | Tên route/tham số sai | `php artisan route:list` kiểm tra |
| Missing parameter `{quizpython}` | Sai tên biến trong controller resource | Đồng bộ tham số phương thức & tên route |
| Cột `topic` không tồn tại | Chạy migration sai thứ tự / rollback | `php artisan migrate:status` rồi `migrate:fresh` |

## Developer scripts hữu ích
```powershell
php artisan route:list
php artisan migrate:fresh --seed
php artisan optimize:clear
npm run dev
```

## Kiểm thử
```powershell
php artisan test
# hoặc
vendor\bin\pest
```

## Đóng góp / Phát triển tiếp
- Thêm pagination & mức độ (difficulty) filter.
- Thống kê điểm, lịch sử làm bài.
- API JSON cho mobile app.
- Tính năng upload batch CSV.

## Giấy phép
Dự án mẫu học tập nội bộ. Thêm LICENSE nếu cần.

---
(README được cập nhật để phản ánh hệ thống quiz đa môn vừa thêm.)

