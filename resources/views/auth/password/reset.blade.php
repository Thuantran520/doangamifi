
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo mật khẩu mới - Gamification</title>
    <link rel="stylesheet" href="{{ asset('auth.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h2>Tạo mật khẩu mới</h2>
        </div>
        <div class="auth-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <input type="email" name="email" class="input-field" placeholder="Email" required value="{{ $email ?? old('email') }}">
                    <i class="icon fas fa-envelope"></i>
                    @error('email')<span style="color: red; font-size: 14px;">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="input-field" placeholder="Mật khẩu mới" required>
                    <i class="icon fas fa-lock"></i>
                    @error('password')<span style="color: red; font-size: 14px;">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="input-field" placeholder="Xác nhận mật khẩu mới" required>
                    <i class="icon fas fa-check-circle"></i>
                </div>
                <button type="submit" class="btn-submit">Đặt lại mật khẩu</button>
            </form>
        </div>
    </div>
</body>
</html>