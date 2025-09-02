
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu - Gamification</title>
    <link rel="stylesheet" href="{{ asset('auth.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h2>Đặt lại mật khẩu</h2>
        </div>
        <div class="auth-body">
            @if (session('status'))
                <div class="info-text" style="color: green;">{{ session('status') }}</div>
            @else
                <p class="info-text">Nhập email của bạn để nhận liên kết đặt lại mật khẩu.</p>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="input-field" placeholder="Email" required value="{{ old('email') }}">
                    <i class="icon fas fa-envelope"></i>
                    @error('email')<span style="color: red; font-size: 14px;">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="btn-submit">Gửi liên kết</button>
                <div class="auth-links">
                    <p><a href="{{ route('login') }}">Quay lại đăng nhập</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>