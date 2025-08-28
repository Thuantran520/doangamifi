<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Launcher</title>
    <link rel="stylesheet" href="{{ asset('admin/launcher.css') }}">
</head>
<body>
    <a href="{{ route('launcher') }}" class="btn-back-home">Quay lại</a>
    <div class="container">
        <h1>Chào mừng Admin!</h1>
        <nav class="admin-menu">
            <a href="{{ route('admin.dashboard') }}" class="btn-menu">Quản lý người dùng</a>
            <a href="{{ route('admin.lesson') }}" class="btn-menu">Quản lý bài học</a>
            <a href="{{ route('launcher') }}" class="btn-menu">Trang launcher</a>
            <a href="{{ route('admin.choose.quiz') }}" class="btn-menu">Quản lý câu hỏi Quiz</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-menu">Đăng xuất</button>
            </form>
        </nav>
    </div>
</body>
</html>