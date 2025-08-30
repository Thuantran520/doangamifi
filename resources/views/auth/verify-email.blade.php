
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực Email - Gamification</title>
    <link rel="stylesheet" href="{{ asset('auth.css') }}">
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h2>Xác thực địa chỉ Email</h2>
        </div>
        <div class="auth-body">
            @if (session('status') == 'verification-link-sent')
                <p class="info-text" style="color: green;">Một liên kết xác thực mới đã được gửi đến email của bạn.</p>
            @else
                <p class="info-text">Cảm ơn bạn đã đăng ký! Vui lòng kiểm tra email và nhấp vào liên kết xác thực để tiếp tục.</p>
            @endif

            <p class="info-text">Chưa nhận được email?</p>

            <div class="action-group">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-submit" style="padding: 12px 20px;">Gửi lại</button>
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-submit" style="background-color: #888; padding: 12px 20px;">Đăng xuất</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>