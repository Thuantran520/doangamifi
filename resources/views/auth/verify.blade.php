
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực Email - Gamification</title>
    <link rel="stylesheet" href="{{ asset('auth.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h2>Xác thực địa chỉ Email</h2>
        </div>
        <div class="auth-body">
            @if (session('status') == 'verification-link-sent')
                <p class="info-text" style="color: green; font-weight: 500;">Một liên kết xác thực mới đã được gửi đến địa chỉ email của bạn.</p>
            @else
                <p class="info-text">Cảm ơn bạn đã đăng ký! Trước khi tiếp tục, vui lòng kiểm tra email để nhận liên kết xác thực.</p>
            @endif

            <p class="info-text" style="margin-top: 20px;">Nếu bạn không nhận được email,</p>

            <div class="action-group">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-submit" style="padding: 12px 20px;">Gửi lại email</button>
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-submit" style="background-color: #6c757d; padding: 12px 20px;">Đăng xuất</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>