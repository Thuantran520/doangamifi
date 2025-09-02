
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admin/launcher.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-shield-halved"></i> Bảng điều khiển Admin</h1>
            <p>Chào mừng bạn đến với khu vực quản lý hệ thống.</p>
        </header>

        <main class="admin-grid">
            <a href="{{ route('admin.dashboard') }}" class="grid-item">
                <i class="fas fa-users-cog"></i>
                <h3>Quản lý người dùng</h3>
                <p>Xem, sửa và quản lý tài khoản người dùng.</p>
            </a>
            <a href="{{ route('admin.lesson') }}" class="grid-item">
                <i class="fas fa-book-open"></i>
                <h3>Quản lý bài học</h3>
                <p>Tạo, cập nhật và sắp xếp các bài học.</p>
            </a>
            <a href="{{ route('admin.choose.quiz') }}" class="grid-item">
                <i class="fas fa-file-circle-question"></i>
                <h3>Quản lý câu hỏi Quiz</h3>
                <p>Chỉnh sửa các bộ câu hỏi cho từng ngôn ngữ.</p>
            </a>
            <a href="{{ route('launcher') }}" class="grid-item">
                <i class="fas fa-rocket"></i>
                <h3>Trang người dùng</h3>
                <p>Quay lại trang launcher chính cho người dùng.</p>
            </a>
        </main>

        <footer class="footer">
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </button>
            </form>
        </footer>
    </div>
</body>
</html>