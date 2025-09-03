
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực Email - Gamification</title>
    <link rel="stylesheet" href="{{ asset('auth.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h2>Xác thực địa chỉ Email của bạn</h2>
        </div>
        <div class="auth-body">
            @if (session('resent'))
                <p class="info-text" style="color: green; font-weight: 500;">
                    Một liên kết xác thực mới đã được gửi đến địa chỉ email của bạn.
                </p>
            @endif

            <p class="info-text">
                Trước khi tiếp tục, vui lòng kiểm tra email của bạn để nhận liên kết xác thực.
            </p>
            <p class="info-text" style="margin-top: 20px;">
                Nếu bạn không nhận được email,
            </p>

            <div class="action-group" style="justify-content: center;">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-submit" style="padding: 12px 20px;">Gửi lại email</button>
                </form>
            </div>
             <div class="auth-links" style="margin-top: 25px;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="auth-links" style="background: none; border: none; cursor: pointer; padding: 0;">Đăng xuất</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Bắt đầu: Sửa lỗi --}}
    <script>
        // "Truyền" các URL từ Blade sang JavaScript
        window.verificationUrls = {
            status: '{{ route("verification.status") }}',
            launcher: '{{ route("launcher") }}'
        };
    </script>
    <script src="{{ asset('reloadpage.js') }}"></script>
    {{-- Kết thúc: Sửa lỗi --}}
</body>
</html>