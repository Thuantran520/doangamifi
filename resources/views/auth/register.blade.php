<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('register.css') }}">
</head>
<body>
    <div class="register-container">
        <h2>Đăng ký tài khoản</h2>
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="form-group">
                <label for="name">Họ và tên</label>
                <input type="text" id="name" name="name" placeholder="Nhập họ và tên" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Nhập email" required>
            </div>

            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại (tùy chọn)</label>
                <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại">
            </div>
            <button type="submit">Đăng ký</button>
            <p class="login-link">Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a></p>
        </form>

    </div>
</body>
</html>
