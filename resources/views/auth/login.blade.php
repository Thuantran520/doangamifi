
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập - Gamification</title>
    <link rel="stylesheet" href="{{ asset('auth.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h2>Đăng nhập</h2>
        </div>
        <div class="auth-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="input-field" placeholder="Email" required value="{{ old('email') }}">
                    <i class="icon fas fa-envelope"></i>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="input-field" placeholder="Mật khẩu" required>
                    <i class="icon fas fa-lock"></i>
                </div>
                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                </div>
                <button type="submit" class="btn-submit">Đăng nhập</button>
                <div class="auth-links">
                    <p>Chưa có tài khoản? <a href="{{ route('register.form') }}">Đăng ký ngay</a></p>
                </div>
            </form>
        </div>
    </div>

    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Đăng nhập thất bại',
                html: '{!! implode('<br>', $errors->all()) !!}',
                confirmButtonText: 'Thử lại'
            });
        });
    </script>
    @endif
</body>
</html>
