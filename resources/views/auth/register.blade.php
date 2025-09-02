
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Gamification</title>
    <link rel="stylesheet" href="{{ asset('auth.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h2>Tạo tài khoản</h2>
        </div>
        <div class="auth-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input type="text" id="name" name="name" class="input-field" placeholder="Họ và tên" required value="{{ old('name') }}">
                    <i class="icon fas fa-user"></i>
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" class="input-field" placeholder="Email" required value="{{ old('email') }}">
                    <i class="icon fas fa-envelope"></i>
                </div>
                <div class="form-group">
                    <input type="text" id="username" name="username" class="input-field" placeholder="Tên đăng nhập" required value="{{ old('username') }}">
                    <i class="icon fas fa-at"></i>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="input-field" placeholder="Mật khẩu (tối thiểu 6 ký tự)" required>
                    <i class="icon fas fa-lock"></i>
                </div>
                <div class="form-group">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" placeholder="Xác nhận mật khẩu" required>
                    <i class="icon fas fa-check-circle"></i>
                </div>
                <button type="submit" class="btn-submit">Đăng ký</button>
                <div class="auth-links">
                    <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
                </div>
            </form>
        </div>
    </div>

    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Có lỗi xảy ra',
                html: '{!! implode('<br>', $errors->all()) !!}',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif
</body>
</html>
